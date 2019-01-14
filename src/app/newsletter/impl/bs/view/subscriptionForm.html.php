<?php 
	use newsletter\core\model\SubscriptionForm;
	use n2n\impl\web\ui\view\html\HtmlView;
	use n2nutil\bootstrap\ui\BsFormHtmlBuilder;
	use newsletter\impl\bs\model\NewsletterBsConfig;
	use n2nutil\bootstrap\ui\Bs;
	use newsletter\core\model\NewsletterState;
	
	$view = HtmlView::view($this);
	$html = HtmlView::html($view);
	
	$subscriptionForm = $view->getParam('subscriptionForm'); 
	$view->assert($subscriptionForm instanceof SubscriptionForm);
	
	$newsletterState = $view->lookup('newsletter\core\model\NewsletterState');
	$view->assert($newsletterState instanceof NewsletterState);
	
	$bsHtml = new BsFormHtmlBuilder($view, NewsletterBsConfig::createBsComposer());
	
	$message = $view->getParam('message', false);
	$inActivation = $view->getParam('inActivation', false, false);
	
	$view->useTemplate($view->getParam('templateViewId'), 
			array('title' => $view->getL10nText(($inActivation) ? 'newsletter_activation_title' : 'newsletter_subscription_title')));
?>

<div class="newsletter-box">
	<p class="lead">
		<?php if ($subscriptionForm->isShowEmail()): ?>
			<?php $html->text('newsletter_subscription_text') ?>
		<?php else: ?>
			<?php $html->out($message) ?>
			<?php $html->text('newsletter_subscription_completion_text') ?>
		<?php endif ?>
	</p>
	
	<?php $bsHtml->open($subscriptionForm, null, null, array('class' => 'newsletter-subscription-form form-horizontal')) ?>
		<?php if ($subscriptionForm->hasCategories()) : ?>
			<?php $bsHtml->inputCheckboxesCheck('categoryIds', $subscriptionForm->getCategoryIdOptions()) ?>
		<?php endif ?>
		<?php if ($subscriptionForm->isShowEmail()): ?>
			<?php $bsHtml->inputGroup('email', Bs::req()) ?>
		<?php endif ?>
		<?php $bsHtml->inputGroup('firstName', Bs::req()) ?>
		<?php $bsHtml->inputGroup('lastName', Bs::req()) ?>
		<?php $bsHtml->inputRadiosCheckInline('gender', $subscriptionForm->getGenderOptions(), Bs::req()) ?>
		<?php $bsHtml->selectGroup('saluteWith', $subscriptionForm->getSalutationOptions(), Bs::req()) ?>
		
		<?php $bsHtml->buttonSubmitGroup('subscribe', $view->getL10nText($subscriptionForm->isShowEmail()
				? 'newsletter_subscription_form_subscribe' : 'newsletter_subscription_form_subscribe_complete'), 
				Bs::cAttr('class', 'btn btn-primary')) ?>
	<?php $bsHtml->close() ?>
</div>
