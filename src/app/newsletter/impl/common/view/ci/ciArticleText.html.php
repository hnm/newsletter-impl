<?php
	use n2n\impl\web\ui\view\html\HtmlView;
	use newsletter\impl\common\bo\NewsletterCiArticle;
	use newsletter\impl\common\ui\CommonNewsletterHtmlBuilder;

	$view = HtmlView::view($this);
	$html = HtmlView::html($view);
	
	$article = $view->getParam('article');
	$view->assert($article instanceof NewsletterCiArticle); 
	
	$emailHtml = new CommonNewsletterHtmlBuilder($view);
	$styleCollection = $emailHtml->getStyleCollection();
	
	$view->useTemplate('ciTemplate.html', array('tdAttrs' => array('bgcolor' => $styleCollection->getTextBackgroundColor())));
?>

<table <?php $emailHtml->presentationTableAttrs(array('width' => '100%')) ?>>
	<tr>
		<td <?php echo $emailHtml->textCellAttrs(null, array('padding' => '20px')) ?>>
			<h2 <?php $emailHtml->headingsAttrs() ?>>
				<?php $html->out($article->getTitle()) ?>
			</h2>
			<?php $emailHtml->htmlOut($article->getDescriptionHtml()) ?>
			<?php if ($article->getLink()): ?>
				<?php $view->import('inc\button.html', array('url' => $article->getLink(), 'label' => $article->getLabel())); ?>
			<?php endif ?>
		</td>
	</tr>
</table>
