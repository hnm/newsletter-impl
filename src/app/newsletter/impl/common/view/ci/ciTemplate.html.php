<?php
	use n2n\impl\web\ui\view\html\HtmlView;
	use newsletter\impl\common\ui\CommonNewsletterHtmlBuilder;

	$view = HtmlView::view($this);
	
	$newsletterTciTemplateHtmlBuilder = new CommonNewsletterHtmlBuilder($view);
	
	$tdAttrs = $view->getParam('tdAttrs');

?>

<tr>
	<td <?php $newsletterTciTemplateHtmlBuilder->attrs($tdAttrs) ?>>
		<hr style="border: 1px solid #eeeeee">
		<?php $view->importContentView() ?>
	</td>
</tr>
