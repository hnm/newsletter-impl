<?php 
	use newsletter\core\model\SimpleSubscriptionForm;
	use n2n\impl\web\ui\view\html\HtmlView;
	use n2nutil\bootstrap\ui\BsFormHtmlBuilder;
	use newsletter\impl\bs\model\NewsletterBsConfig;
	use n2nutil\bootstrap\ui\Bs;
	use newsletter\core\model\NewsletterState;
	
	$view = HtmlView::view($this);
	$html = HtmlView::html($view);
	
	$simpleSubscriptionForm = $view->getParam('simpleSubscriptionForm'); 
	$view->assert($simpleSubscriptionForm instanceof SimpleSubscriptionForm);
	
	$newsletterState = $view->lookup('newsletter\core\model\NewsletterState');
	$view->assert($newsletterState instanceof NewsletterState);
	
	$bsHtml = new BsFormHtmlBuilder($view, NewsletterBsConfig::createBsComposer());
	
	$view->useTemplate($view->getParam('templateViewId'), 
			array('title' => $view->getL10nText('newsletter_subscription_title')));
?>

<div class="newsletter-box">
	<p class="lead">
		<?php $html->text('newsletter_subscription_text') ?>
	</p>
	
	<?php $bsHtml->open($simpleSubscriptionForm, null, null, 
			array('class' => 'newsletter-simple-subscription-form form-inline')) ?>
		<?php $bsHtml->inputGroup('email', Bs::req()) ?>
		 
		<?php $bsHtml->buttonSubmitGroup('subscribe', $view->getL10nText('newsletter_subscription_form_subscribe'), 
				Bs::cAttr('class', 'btn btn-primary')) ?>
	<?php $bsHtml->close() ?>
</div>
