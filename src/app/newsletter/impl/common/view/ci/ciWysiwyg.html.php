<?php
	use n2n\impl\web\ui\view\html\HtmlView;
	use newsletter\impl\common\ui\CommonNewsletterHtmlBuilder;
	use newsletter\impl\common\bo\NewsletterCiWysiwyg;

	$view = HtmlView::view($this);
	$emailHtml = new CommonNewsletterHtmlBuilder($view);
	$html = HtmlView::html($view);
	
	$wysiwyg = $view->getParam('wysiwyg');
	$view->assert($wysiwyg instanceof NewsletterCiWysiwyg);
	
	$view->useTemplate('ciTemplate.html', 
			array('tdAttrs' => array('bgcolor' => $emailHtml->getStyleCollection()->getTextBackgroundColor())));
	
?>
<table <?php $emailHtml->presentationTableAttrs(array('width' => '100%')) ?>>
	<tr>
		<td <?php $emailHtml->textCellAttrs(null, array('padding' => '20px')) ?>>
			<?php if (null !== $title = $wysiwyg->getTitle()) : ?>
				<h2 <?php $emailHtml->headingsAttrs() ?>><?php $html->out($title)?></h2>
			<?php endif ?>
			<?php $emailHtml->htmlOut($wysiwyg->getTextHtml()) ?>
		</td>
	</tr>
</table>