<?php 
	use newsletter\core\model\UnsubscriptionForm;
	use n2n\impl\web\ui\view\html\HtmlView;
	use n2nutil\bootstrap\ui\BsFormHtmlBuilder;
	use newsletter\impl\bs\model\NewsletterBsConfig;
	use n2nutil\bootstrap\ui\Bs;
	
	$view = HtmlView::view($this);
	$html = HtmlView::html($view);
	
	$unsubscriptionForm = $view->getParam('unsubscriptionForm'); 
	$view->assert($unsubscriptionForm instanceof UnsubscriptionForm);
	
	$html->meta()->addMeta(array('name' => 'robots', 'content' => 'noindex'));
	
	$bsHtml = new BsFormHtmlBuilder($view, NewsletterBsConfig::createBsComposer());
	
	$view->useTemplate($view->getParam('templateViewId'), 
			array('title' => $view->getL10nText('newsletter_unsubscription_title')));
?>

<div class="newsletter-box">
	<p class="lead"><?php $html->text('newsletter_unsubscription_text') ?></p>
	
	<?php $bsHtml->open($unsubscriptionForm, null, null, array('class' => 'newsletter-unsubscription-form')); ?>
		<?php $bsHtml->inputGroup('email', Bs::req()) ?>
		<?php $bsHtml->buttonSubmitGroup('unsubscribe', 
				$view->getL10nText('newsletter_unsubscription_form_action'), Bs::cAttr('class', 'btn btn-primary')) ?>
	<?php $bsHtml->close() ?>
</div>