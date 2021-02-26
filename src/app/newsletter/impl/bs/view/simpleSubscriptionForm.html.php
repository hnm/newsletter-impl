<?php 
	use newsletter\core\model\SimpleSubscriptionForm;
	use n2n\impl\web\ui\view\html\HtmlView;
	use newsletter\impl\common\model\CommonNewsletterSetuper;
	
	$view = HtmlView::view($this);
	$html = HtmlView::html($view);
	
	$simpleSubscriptionForm = $view->getParam('simpleSubscriptionForm'); 
	$view->assert($simpleSubscriptionForm instanceof SimpleSubscriptionForm);
	
	$view->useTemplate($view->getParam('templateViewId'), 
			array('title' => $view->getL10nText('newsletter_subscription_title')));
?>
<?php $view->import('inc\simpleSubscriptionForm.html', ['simpleSubscriptionForm' => $simpleSubscriptionForm]) ?>