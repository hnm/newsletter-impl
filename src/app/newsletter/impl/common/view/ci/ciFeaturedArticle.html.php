<?php

	use n2n\impl\web\ui\view\html\HtmlView;
	use newsletter\impl\common\bo\NewsletterCiFeaturedArticle;
	use n2n\impl\web\ui\view\html\img\ProportionalImgComposer;
	use newsletter\impl\common\ui\CommonNewsletterHtmlBuilder;

	$view = HtmlView::view($this);
	$html = HtmlView::html($view);
	$request = HtmlView::request($view);
	
	$article = $view->getParam('article');
	$view->assert($article instanceof NewsletterCiFeaturedArticle);
	
	$image = $article->getFileImage();
	$emailHtml = new CommonNewsletterHtmlBuilder($view);
	
	$view->useTemplate('ciTemplate.html', array('tdAttrs' =>
			array('bgcolor' => $emailHtml->getStyleCollection()->getTextBackgroundColor(), 'style' => 'padding: 0')));
	
	if ($image) {
		$fs = $image->getFileSource();
		if ($fs->getUrl()->isRelative()) {
			$fs->setUrl($request->getHostUrl()->ext($fs->getUrl()));
		}
	}
	
?>
<?php // Image ?>
<?php if ($image): ?>
	<?php if (null !== $link = $article->getLink()): ?>
		<?php $html->linkStart($link) ?>
	<?php endif ?>
	<?php $html->image($image, 
			new ProportionalImgComposer(CommonNewsletterHtmlBuilder::EMAIL_WIDTH, CommonNewsletterHtmlBuilder::EMAIL_WIDTH), 
			$emailHtml->getFluidImageStyleAttrsArray(), false, false) ?>
	<?php if ($link) : ?>
		<?php $html->linkEnd() ?>
	<?php endif ?>
<?php endif ?>

<?php // Text ?>
<table <?php $emailHtml->presentationTableAttrs(array('width' => '100%')) ?>>
	<tr>
		<td <?php $emailHtml->textCellAttrs(null, array('padding' => '20px')) ?>>
			<h2 <?php $emailHtml->headingsAttrs() ?>><?php $html->out($article->getTitle())?></h2>
			<?php if (null !== $lead = $article->getLead()): ?>
				<strong><?php $view->out(nl2br($lead)) ?></strong><br><br>
			<?php endif ?>
			<?php if (null !== $textHtml = $article->getTextHtml()): ?>
				<?php $emailHtml->htmlOut($textHtml) ?>
			<?php endif ?>
			<?php if (null !== $link = $article->getLink()): ?>
				<?php $view->import('inc\button.html', array('url' => $link, 'label' => $article->getLabel())); ?>
			<?php endif ?>
		</td>
	</tr>
</table>