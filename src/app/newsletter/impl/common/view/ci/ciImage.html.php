<?php
	use n2n\impl\web\ui\view\html\HtmlView;
	use n2n\impl\web\ui\view\html\img\ProportionalImgComposer;
	use newsletter\impl\common\bo\NewsletterCiImage;
	use newsletter\impl\common\ui\CommonNewsletterHtmlBuilder;

	$view = HtmlView::view($this);
	$html = HtmlView::html($view);
	$request = HtmlView::request($view);
	
	$ciNewsletterImage = $view->getParam('ciNewsletterImage');
	$view->assert($ciNewsletterImage instanceof NewsletterCiImage);
	if (!$ciNewsletterImage->getFileImage()->isValid()) return;
	
	$emailHtml = new CommonNewsletterHtmlBuilder($view);
	
	$view->useTemplate('ciTemplate.html', array('tdAttrs' => 
			array('bgcolor' => $emailHtml->getStyleCollection()->getTextBackgroundColor(), 'style' => 'padding: 0')));
	
	$fs = $ciNewsletterImage->getFileImage()->getFileSource();
	if ($fs->getUrl()->isRelative()) {
		$fs->setUrl($request->getHostUrl()->ext($fs->getUrl()));
	}
	
?>

<?php if (null !== $link = $ciNewsletterImage->getLink()): ?>
	<?php $html->linkStart($link) ?>
<?php endif ?>
<?php $html->image($ciNewsletterImage->getFileImage(), 
		new ProportionalImgComposer(CommonNewsletterHtmlBuilder::EMAIL_WIDTH, CommonNewsletterHtmlBuilder::EMAIL_WIDTH), 
		$emailHtml->getFluidImageStyleAttrsArray(), false, false) ?>
<?php if ($link) : ?>
	<?php $html->linkEnd() ?>
<?php endif ?>
