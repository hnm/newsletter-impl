<?php
	use n2n\impl\web\ui\view\html\HtmlView;
	use newsletter\core\model\NewsletterState;

	$view = HtmlView::view($this);
	$html = HtmlView::html($view);
	
	$newsletterState = $view->lookup(NewsletterState::class);
	$view->assert($newsletterState instanceof NewsletterState);
	
	$view->useTemplate($view->getParam('templateViewId'), 
			array('title' => $view->getL10nText('newsletter_unsubscription_title')));
?>
<div class="newsletter-box">
	<p class="lead">
		<?php $html->text('newsletter_unsubscription_confirmation_text') ?>
	</p>
</div>