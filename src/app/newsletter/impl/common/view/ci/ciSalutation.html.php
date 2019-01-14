<?php
	use n2n\impl\web\ui\view\html\HtmlView;
	use newsletter\impl\common\ui\CommonNewsletterHtmlBuilder;
	use newsletter\core\bo\HistoryEntry;
	
	$view = HtmlView::view($this);
	$emailHtml = new CommonNewsletterHtmlBuilder($view);
	
	$hisoryEntry = $view->getParam('historyEntry');
	$view->assert($hisoryEntry instanceof HistoryEntry);
	
	$view->useTemplate('ciTemplate.html',
			array('tdAttrs' => array('bgcolor' => $emailHtml->getStyleCollection()->getTextBackgroundColor())));

?>
<table <?php $emailHtml->presentationTableAttrs(array('width' => '100%')) ?>>
	<tr>
		<td <?php $emailHtml->textCellAttrs(null, array('padding' => '20px 40px 0')) ?>>
			<?php $emailHtml->htmlOut($hisoryEntry->getSalutation()) ?>
		</td>
	</tr>
</table>