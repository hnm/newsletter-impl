<?php
	use n2n\impl\web\ui\view\html\HtmlView;
	use newsletter\impl\bs\bo\CiSubscriptionForm;

	$view = HtmlView::view($view);
	$html = HtmlView::html($view);
	$ciSubscriptionForm =  $view->getParam('ciSubscriptionForm');
	$view->assert($ciSubscriptionForm instanceof CiSubscriptionForm);
?>
<?php $view->import('..\view\inc\simpleSubscriptionForm.html', ['recipientCategories' => $ciSubscriptionForm->getRecipientCategories()]) ?>