<?php
	use n2n\impl\web\ui\view\html\HtmlView;
	use n2n\impl\web\ui\view\html\img\ProportionalImgComposer;
	use newsletter\impl\common\bo\NewsletterCiArticle;
	use newsletter\impl\common\ui\CommonNewsletterHtmlBuilder;

	$view = HtmlView::view($this);
	$html = HtmlView::html($view);
	$request = HtmlView::request($view);
	
	$article = $view->getParam('article');
	$view->assert($article instanceof NewsletterCiArticle);
	
	$commonHtml = new CommonNewsletterHtmlBuilder($view);
	$styleCollection = $commonHtml->getStyleCollection();
	$dir = $article->getPicPos() == NewsletterCiArticle::PIC_POS_LEFT ? 'ltr' : 'rtl';
	
	$tdAttrs = array('bgcolor' => $styleCollection->getTextBackgroundColor(), 'align' => 'center', 'height' => '100%', 
			'valign' => 'top', 'width' => '100%', 'style' => 'padding: 10px 0', 'dir' => $dir);
	$view->useTemplate('ciTemplate.html', array('tdAttrs' => $tdAttrs));
	
	$fs = $article->getFileImage()->getFileSource();
	if ($fs->getUrl()->isRelative()) {
		$fs->setUrl($request->getHostUrl()->ext($fs->getUrl()));
	}
?>
<!--[if mso]>
<table <?php $commonHtml->presentationTableAttrs(array('width' => '680', 'style' => 'width: 680px')) ?>>
	<tr>
		<td align="center" valign="top" width="680" style="width: 680px;">
<![endif]-->
<table <?php $commonHtml->presentationTableAttrs(array('width' => '100%', 'style' => 'max-width: 680px')) ?>>
	<tr>
		<td align="center" valign="top" style="font-size:0; padding: 10px 0;">
			<!--[if mso]>
			<table <?php $commonHtml->presentationTableAttrs(array('width' => '680', 'style' => 'width: 680px')) ?>>
				<tr>
					<td align="left" valign="top" width="280" style="width: 280px;">
			<![endif]-->
			<div style="display:inline-block; margin: 0 -2px; max-width: 280px; min-width:160px; vertical-align:top; width:100%;" class="stack-column">
				<table <?php $commonHtml->presentationTableAttrs(array('width' => '100%')) ?>>
					<tr>
						<td dir="ltr" style="padding: 20px;">
							<?php $html->image($article->getFileImage(), new ProportionalImgComposer(240, 240), 
									$commonHtml->getImageStyleAttrsArray(array('width' => '240px'), 
											array('width' => '100%', 'max-width' => '240px;')), false, false) ?>
						</td>
					</tr>
				</table>
			</div>
			<!--[if mso]>
					</td>
					<td align="left" valign="top" width="440" style="width: 440px;">
			<![endif]-->
			<div style="display:inline-block; margin: 0 -2px; max-width:60%; min-width:280px; vertical-align:top;" class="stack-column">
				<table <?php $commonHtml->presentationTableAttrs(array('width' => '100%')) ?>>
					<tr>
						<td <?php $commonHtml->textCellAttrs(array('dir' => 'ltr'), 
								array('padding' => '20px', 'text-align' => 'left')) ?>>
							<?php if (null !== ($title = $article->getTitle())): ?>
								<h2 <?php $commonHtml->headingsAttrs() ?>><?php $html->out($title)?></h2>
							<?php endif ?>
							<?php $commonHtml->htmlOut($article->getDescriptionHtml()) ?>
							<?php if ($article->getLink()): ?>
								<?php $view->import('inc\button.html', array('url' => $article->getLink(), 'label' => $article->getLabel())); ?>
							<?php endif ?>
						</td>
					</tr>
				</table>
			</div>
			<!--[if mso]>
					</td>
				</tr>
			</table>
			<![endif]-->
		</td>
	</tr>
</table>
<!--[if mso]>
		</td>
	</tr>
</table>
<![endif]-->
