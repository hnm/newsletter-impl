<?php
namespace newsletter\impl\common\model;

use n2n\context\RequestScoped;
use newsletter\core\model\NewsletterState;
use n2n\core\container\N2nContext;
use n2n\web\http\Request;
use n2n\io\managed\impl\FileFactory;
use page\model\nav\murl\MurlPage;
use newsletter\impl\common\bo\NewsletterPageController;
use n2n\mail\smtp\SmtpConfig;
use newsletter\core\model\NewsletterDao;
use newsletter\core\model\mail\MailManager;
use newsletter\core\model\mail\impl\SwiftMailer;
use n2n\util\uri\UnavailableUrlException;
use newsletter\core\controller\NewsletterController;

class CommonNewsletterSetuper implements RequestScoped {
	
	private $setupExecuted = false;
	
	private $newsletterState;
	private $n2nContext;
	private $config;
	private $newsletterDao;
	private $recipientCategories;
	private $mailManager;
	
	private function _init(NewsletterState $newsletterState, Request $request, 
			N2nContext $n2nContext, CommonNewsletterConfig $config, NewsletterDao $newsletterDao, MailManager $mailManager) {
		$this->newsletterState = $newsletterState;
		$this->n2nContext = $n2nContext;
		$this->config = $config;
		$this->newsletterDao = $newsletterDao;
		$this->mailManager = $mailManager;
	}
	
	public function setup(bool $forceSetup = false) {
		if ($this->setupExecuted && ! $forceSetup) return;
		
		$this->setupNewsletterState();
		
		$this->recipientCategories = $this->config->getRecipientCategories($this->newsletterDao);
		$this->mailManager->setup(new SwiftMailer(), new SmtpConfig($this->config->getSmtpHost(),
				$this->config->getSmtpEmail(), $this->config->getSmtpPassword(), $this->config->getSmtpPort(),
				null, $this->config->getSmtpSecurityMode()));
		
		$this->setupExecuted = true;
	}
	
	private function setupNewsletterState() {
		$request = $this->n2nContext->getHttpContext()->getRequest();
		
		$hostContextUrl = $request->getHostUrl()->ext($request->getContextPath());
		$this->newsletterState->setTemplateUrl($hostContextUrl->extR(array('newsletter-template')));
		$this->newsletterState->setTemplateStyleCollection(new CommonStyleCollection());
		$this->newsletterState->setSenderEmail($this->config->getSenderEmail());
		$this->newsletterState->setSenderName($this->config->getSenderName());
		$this->newsletterState->setReplyToEmail($this->config->getReplyToEmail());
		$this->newsletterState->setReplyToName($this->config->getReplyToName());
		
		$moduleManager = $this->n2nContext->getModuleManager();
		if ($moduleManager->containsModuleNs('page')) {
			$pageMurl = MurlPage::tag(NewsletterPageController::class);
			try {
				
				$this->newsletterState->setNewsletterUrl($pageMurl->toUrl($this->n2nContext));
				$this->newsletterState->setActivationUrl(MurlPage::tag(NewsletterPageController::class)
						->pathExt(NewsletterController::ACTION_ACTIVATE)->toUrl($this->n2nContext));
				$this->newsletterState->setUnsubscriptionUrl(MurlPage::tag(NewsletterPageController::class)
						->pathExt(NewsletterController::ACTION_UNSUBSCRIBE)->toUrl($this->n2nContext));
				$this->newsletterState->setThanksUrl(MurlPage::tag(NewsletterPageController::class)
						->pathExt(NewsletterController::ACTION_THANKS)->toUrl($this->n2nContext));
				$this->newsletterState->setSimpleUrl(MurlPage::tag(NewsletterPageController::class)
						->pathExt(NewsletterController::ACTION_SIMPLE)->toUrl($this->n2nContext));
			} catch (UnavailableUrlException $e) {
				
			}
		}
		
		if (!$this->newsletterState->hasNewsletterUrl()) {
			$newsletterUrl = $hostContextUrl->extR(array('newsletter'));
			$this->newsletterState->setNewsletterUrl($newsletterUrl);
			$this->newsletterState->setActivationUrl($newsletterUrl->pathExt(NewsletterController::ACTION_ACTIVATE));
			$this->newsletterState->setUnsubscriptionUrl($newsletterUrl->pathExt(NewsletterController::ACTION_UNSUBSCRIBE));
			$this->newsletterState->setThanksUrl($newsletterUrl->pathExt(NewsletterController::ACTION_THANKS));
			$this->newsletterState->setSimpleUrl($newsletterUrl->pathExt(NewsletterController::ACTION_SIMPLE));
		}
		
		$this->newsletterState->getDtc()->assignModule($moduleManager->getModuleByNs('newsletter\impl'), true);
		
		$this->setupNewsletterControllerConfig();
		$this->setupTemplateConfig();
	}
	
	private function setupNewsletterControllerConfig() {
		$newsletterControllerConfig = $this->newsletterState->getNewsletterControllerConfig();
		
		$newsletterControllerConfig->setNotifyOnUnsubscription($this->config->isNotifyOnUnsubscription());
		$newsletterControllerConfig->setUnsubscriptionMailRecipient($this->config->getUnsubscriptionMailRecipient());
		$newsletterControllerConfig->setSubscriptionAllowed($this->config->isSubscriptionAllowed());
		
		$newsletterControllerConfig
				->setActivationCompleteViewId('\newsletter\impl\bs\view\activationComplete.html')
				->setActivationViewId('\newsletter\impl\bs\view\activation.html')
				->setSimpleSubscriptionFormViewId('\newsletter\impl\bs\view\simpleSubscriptionForm.html')
				->setSubscriptionFormViewId('\newsletter\impl\bs\view\subscriptionForm.html')
				->setSubscriptionThanksViewId('\newsletter\impl\bs\view\subscriptionThanks.html')
				->setTemplateViewId($this->config->getTemplateViewId())
				->setUnsubscriptionConfirmationViewId('\newsletter\impl\bs\view\unsubscriptionConfirmation.html')
				->setUnsubscriptionFormViewId('\newsletter\impl\bs\view\unsubscriptionForm.html');

	}
	
	private function setupTemplateConfig() {
		$templateConfig = $this->newsletterState->getTemplateConfig();
		
		$templateConfig->setTemplateHtmlViewId('newsletter\impl\common\view\template\template.html');
		$templateConfig->setFileLogo(FileFactory::createFromFs($this->config->getLogoPath()));
	}
	
	public function getRecipientCategories() {
		return $this->recipientCategories;
	}
}
