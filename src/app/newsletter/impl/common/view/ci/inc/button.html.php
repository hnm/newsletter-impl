<?php
	use n2n\impl\web\ui\view\html\HtmlView;
	use newsletter\impl\common\ui\CommonNewsletterHtmlBuilder;

	$view = HtmlView::view($this);
	$html = HtmlView::html($view);
	
	$url = $view->getParam('url');
	$label = $view->getParam('label');
	
	$btnAttrs = $view->getParam('btnAttrs', false, array());
	$btnAttrs = array_merge($btnAttrs, array('href' => $url, 'class' => 'button-a', 'target' => '_blank'));
	
	$commonNewsletterHtml = new CommonNewsletterHtmlBuilder($view);
	
?>
<table <?php $commonNewsletterHtml->presentationTableAttrs(array('class' => 'center-on-narrow', 'style' => 'float:left;')) ?>>
	<tr>
		<td style="border-radius: 0px; background: #222222; text-align: left;" class="button-td">
			<a <?php $commonNewsletterHtml->buttonLinkStyleAttrs($btnAttrs)?>>
				<span style="color:#ffffff; line-height: 30px" class="button-link">&nbsp;&nbsp;&nbsp;&nbsp;<?php $html->out($label) ?>&nbsp;&nbsp;&nbsp;&nbsp;</span>
			</a>
		</td>
	</tr>
</table>