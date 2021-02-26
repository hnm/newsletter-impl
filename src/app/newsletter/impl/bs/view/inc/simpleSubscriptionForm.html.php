<?php 
	use newsletter\core\model\SimpleSubscriptionForm;
	use n2n\impl\web\ui\view\html\HtmlView;
	use n2nutil\bootstrap\ui\BsFormHtmlBuilder;
	use newsletter\impl\bs\model\NewsletterBsConfig;
	use n2nutil\bootstrap\ui\Bs;
	use newsletter\core\model\NewsletterState;
use newsletter\core\controller\NewsletterController;
use newsletter\impl\common\model\CommonNewsletterSetuper;
	
	$view = HtmlView::view($this);
	$html = HtmlView::html($view);
	
	$newsletterState = $view->lookup('newsletter\core\model\NewsletterState');
	$view->assert($newsletterState instanceof NewsletterState);
	
	$simpleSubscriptionForm = $view->getParam('simpleSubscriptionForm', false);
	if (null !== $simpleSubscriptionForm) {
		$view->assert($simpleSubscriptionForm instanceof SimpleSubscriptionForm);
	} else {
		$recipientCategories = $view->getParam('recipientCategories', false, null);
		$simpleSubscriptionForm = new SimpleSubscriptionForm($newsletterState->getDtc(), $recipientCategories);
	}
	
	$setuper = $view->lookup(CommonNewsletterSetuper::class);
	$view->assert($setuper instanceof CommonNewsletterSetuper);
	
	$setuper->setup();
	
	$bsHtml = new BsFormHtmlBuilder($view, NewsletterBsConfig::createBsComposer());
?>

<div class="newsletter-box">
	<p class="lead">
		<?php $html->text('newsletter_subscription_text') ?>
	</p>
	
	<?php $bsHtml->open($simpleSubscriptionForm, null, null, 
			array('class' => 'newsletter-simple-subscription-form form-inline'), 
			$newsletterState->getNewsletterUrl()->pathExt(NewsletterController::ACTION_SIMPLE)) ?>
		<?php $bsHtml->inputGroup('email', Bs::req()) ?>
		 
		<?php $bsHtml->buttonSubmitGroup('subscribe', $newsletterState->getDtc()->t('newsletter_subscription_form_subscribe'), 
				Bs::cAttr('class', 'btn btn-primary')) ?>
	<?php $bsHtml->close() ?>
</div>
