<?php
namespace newsletter\impl\common\model;

use n2n\context\RequestScoped;
use n2n\core\config\MailConfig;
use n2n\core\config\FilesConfig;
use newsletter\core\model\NewsletterDao;

class CommonNewsletterConfig implements RequestScoped {
	
	private $unsubscriptionMailRecipient;
	private $filesConfig;
	
	private function _init(MailConfig $mailConfig, FilesConfig $filesConfig) {
		$this->unsubscriptionMailRecipient = $mailConfig->getCustomerAddress();
		$this->filesConfig = $filesConfig;
	}
	
	public function getUnsubscriptionMailRecipient() {
		return $this->unsubscriptionMailRecipient;
	}
	
	public function isNotifyOnUnsubscription() {
		return true;
	}
	
	public function isSubscriptionAllowed() {
		return true;
	}
	
	public function getSenderEmail() {
		return 'noreply@newsletter.ch';
	}
	
	public function getSenderName() {
		return '{Company Name}';
	}
	
	public function getSmtpHost() {
		return 'smtp.newsletter.ch';
	}
	
	public function getSmtpEmail() {
		return 'postmaster@newlsetter.ch';
	}
	
	public function getSmtpPassword() {
		return '{password}';
	}
	
	public function getReplyToEmail() {
		return 'office@knewsletter.ch';
	}
	
	public function getReplyToName() {
		return $this->getSenderName();
	}
	
	public function getSmtpPort() {
		return 587;
	}
	
	public function getSmtpSecurityMode() {
		return 'tls';
	}
	
	public function isCronjobAvailable() {
		return true;
	}
	
	public function getNumMailsPerHour() {
		return 1000;
	}
	
	public function getNumMailsPerRequest() {
		return 1000;
	}
	
	public function getLogoPath() {
		return $this->filesConfig->getAssetsDir()->ext(array('newsletter-impl-common', 'files', 'logo.png'));
	}
	
	public function getRecipientCategories(NewsletterDao $newsletterDao) {
		return [];
	}
}