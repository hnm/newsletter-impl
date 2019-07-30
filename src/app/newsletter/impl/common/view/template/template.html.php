<?php 
	use newsletter\core\bo\Newsletter;
	use newsletter\core\controller\TemplateController;
	use newsletter\core\model\NewsletterDao;
	use n2n\impl\web\ui\view\html\HtmlView;
	use n2n\io\managed\img\ImageFile;
	use newsletter\core\bo\HistoryEntry;
	use n2n\io\managed\File;
	use newsletter\impl\common\ui\CommonNewsletterHtmlBuilder;
	use newsletter\core\model\NewsletterState;
	
	$view = HtmlView::view($this);
	$request = HtmlView::request($view);
	$html = HtmlView::html($view);
	$httpContext = HtmlView::httpContext($view);
	
	$newsletterState = $view->lookup('newsletter\core\model\NewsletterState');
	$view->assert($newsletterState instanceof NewsletterState);
	
	$newsletter = $view->getParam('newsletter');
	$view->assert($newsletter instanceof Newsletter);
	
	$fileLogo = $view->getParam('fileLogo', false);
	$view->assert(null === $fileLogo || $fileLogo instanceof File);
	
	$historyEntry = $view->getParam('historyEntry');
	$view->assert($historyEntry instanceof HistoryEntry);
	
	$newsletterDao = $view->lookup('\newsletter\core\model\NewsletterDao');
	$view->assert($newsletterDao instanceof NewsletterDao);
	
	$templateHtml = new CommonNewsletterHtmlBuilder($view);
	$styleCollection = $newsletterState->getTemplateStyleCollection();
	
	$imageLogo = null;
	if ($fileLogo !== null && $fileLogo->isValid()) {
		$imageLogo = new ImageFile($fileLogo);
	}
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="x-apple-disable-message-reformatting">
	<title><?php $html->out($newsletter->getSubject()) ?></title>

	<!--[if mso]>
		<style>
			* {
				font-family: <?php $styleCollection->getBaseFontFamily() ?> !important;
			}
		</style>
	<![endif]-->

	<style>
		html,
		body {
			margin: 0 auto !important;
			padding: 0 !important;
			height: 100% !important;
			width: 100% !important;
		}

		* {
			-ms-text-size-adjust: 100%;
			-webkit-text-size-adjust: 100%;
		}

		div[style*="margin: 16px 0"] {
			margin:0 !important;
		}

		table,
		td {
			mso-table-lspace: 0pt !important;
			mso-table-rspace: 0pt !important;
		}

		table {
			border-spacing: 0 !important;
			border-collapse: collapse !important;
			table-layout: fixed !important;
			margin: 0 auto !important;
		}
		table table table {
			table-layout: auto;
		}

		img {
			-ms-interpolation-mode:bicubic;
		}

		*[x-apple-data-detectors],	/* iOS */
		.x-gmail-data-detectors, 	/* Gmail */
		.x-gmail-data-detectors *,
		.aBn {
			border-bottom: 0 !important;
			cursor: default !important;
			color: inherit !important;
			text-decoration: none !important;
			font-size: inherit !important;
			font-family: inherit !important;
			font-weight: inherit !important;
			line-height: inherit !important;
		}

		.a6S {
			display: none !important;
			opacity: 0.01 !important;
		}
		img.g-img + div {
			display:none !important;
		   }

		.button-link {
			text-decoration: none !important;
		}

		@media only screen and (min-device-width: 375px) and (max-device-width: 413px) { /* iPhone 6 and 6+ */
			.email-container {
				min-width: 375px !important;
			}
		}

		.button-td,
		.button-a {
			transition: all 100ms ease-in;
		}
		.button-td:hover,
		.button-a:hover {
			background: <?php $html->out($styleCollection->getButtonHoverColor()) ?> !important;
			border-color: <?php $html->out($styleCollection->getButtonHoverColor()) ?> !important;
		}

		@media screen and (max-width: 480px) {

			.fluid {
				width: 100% !important;
				max-width: 100% !important;
				height: auto !important;
				margin-left: auto !important;
				margin-right: auto !important;
			}

			.stack-column,
			.stack-column-center {
				display: block !important;
				width: 100% !important;
				max-width: 100% !important;
				direction: ltr !important;
			}
			.stack-column-center {
				text-align: center !important;
			}

			.center-on-narrow {
				text-align: center !important;
				display: block !important;
				margin-left: auto !important;
				margin-right: auto !important;
				float: none !important;
			}
			table.center-on-narrow {
				display: inline-block !important;
			}

			/* Adjust typography on small screens to improve readability */
			.email-container p {
				font-size: 17px !important;
				line-height: 22px !important;
			}
		}

	</style>

	<!--[if gte mso 9]>
	<xml>
	  <o:OfficeDocumentSettings>
		<o:AllowPNG/>
		<o:PixelsPerInch>96</o:PixelsPerInch>
	 </o:OfficeDocumentSettings>
	</xml>
	<![endif]-->
	
</head>
<body <?php $templateHtml->bodyAttrs() ?>>
	<center <?php $templateHtml->centerAttrs() ?>>
	<!--[if mso | IE]>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#222222">
    <tr>
    <td>
    <![endif]-->
		<?php /* ?>
		<!-- Visually Hidden Preheader Text : BEGIN -->
		<div style="display:none;font-size:1px;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;mso-hide:all;font-family: sans-serif;">
			(Optional) This text will appear in the inbox preview, but not the email body.
		</div>
		<!-- Visually Hidden Preheader Text : END -->
		<?php */ ?>
		
		<table  <?php $templateHtml->presentationTableAttrs(array('width' => '100%', 'bgcolor' => $styleCollection->getHeaderBackgroundColor())) ?>>
			<tr>
				<td valign="top" align="center">
					<div <?php $templateHtml->emailContainerAttrs() ?>>
						<!--[if mso]>
							<table role="presentation" cellspacing="0" cellpadding="0" border="0" width="680" align="center">
								<tr>
									<td>
						<![endif]-->
						
						<!-- Email Header -->
						<table <?php $templateHtml->presentationTableAttrs(array('width' => '100%', 'style' => 'max-width: ' . $templateHtml::EMAIL_WIDTH . 'px;')) ?>>
							<tr>
								<td style="padding: 20px 0; text-align: center">
									<?php if ($imageLogo): ?>
										<img src="<?php $html->out($newsletterState->getTemplateUrl()->extR(array(TemplateController::ACTION_LOGO, 
												$newsletter->getId(), $historyEntry->getCode()))) ?>" 
											<?php $templateHtml->imageStyleAttrs(array('width' => $imageLogo->getWidth(), 'height' => $imageLogo->getHeight())) ?> />
									<?php endif ?>
								</td>
							</tr>
						</table>
						
						<!--[if mso]>
									</td>
								</tr>
							</table>
						<![endif]-->
					</div>
				</td>
			</tr>
		</table>
		
		<div <?php $templateHtml->emailContainerAttrs() ?>>
			<!--[if mso]>
			<table <?php $templateHtml->presentationTableAttrs(array('width' => $templateHtml::EMAIL_WIDTH)) ?>>
				<tr>
					<td>
			<![endif]-->
			
			<!-- Email Body -->
			<table <?php $templateHtml->presentationTableAttrs(array('width' => '100%', 'style' => 'max-width: ' . $templateHtml::EMAIL_WIDTH . 'px;', 'class' => 'email-container')) ?>>
				<?php foreach ($newsletter->getNewsletterCis() as $newsletterCi) : ?>
					<?php $html->out($newsletterCi->createHtmlUiComponent($historyEntry, $this)) ?>
				<?php endforeach ?>
			</table>
			
			<!--[if mso]>
					</td>
				</tr>
			</table>
			<![endif]-->
		</div>
		
		 <table  <?php $templateHtml->presentationTableAttrs(array('width' => '100%', 'bgcolor' => $styleCollection->getFooterBackgroundColor())) ?>>
            <tr>
                <td valign="top" align="center">
                    <div <?php $templateHtml->emailContainerAttrs() ?>>
                        <!--[if mso]>
                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="680" align="center">
                        <tr>
                        <td>
                        <![endif]-->
		
						<!-- Email Footer : BEGIN -->
							<table <?php $templateHtml->presentationTableAttrs(array('width' => '100%', 'style' => 'max-width: ' . $templateHtml::EMAIL_WIDTH . 'px;')) ?>>
								<tr <?php $templateHtml->textCellAttrs(null, array('font-size' => ($styleCollection->getBaseFontPixelSize() - 2) . 'px', 'color' => $styleCollection->getFooterTextColor())) ?>>
									<td <?php $templateHtml->textCellAttrs(array('class' => 'x-gmail-data-detectors'), array('padding' => '40px 10px', 'width' => '100%', 
											'text-align' => 'center', 'color' =>  $styleCollection->getFooterTextColor())) ?>>
										<webversion style="color: <?php $html->out($styleCollection->getFooterTextColor())?>; text-decoration:underline; font-weight: bold;">
											<?php $html->link($newsletterState->buildWebTemplateUrl($newsletter, $historyEntry) , 
													$view->getL10nText('newsletter_template_link_alternate'), 
													array('style' => 'font-size: ' . ($styleCollection->getBaseFontPixelSize() - 2) . 'px; color: ' . $styleCollection->getFooterTextColor() . ';')) ?>
										</webversion>
										<br><br>
										{company}<br>{address}<br>{phone}
										<br><br>
										<unsubscribe style="color: <?php $html->out($styleCollection->getTextColor())?>; text-decoration:underline;">
											<?php $html->link($newsletterState->buildUnsubscriptionUrl($historyEntry->getEmail()), 
													$view->getL10nText('unsubscribe_txt'), 
													array('style' => 'color: ' . $styleCollection->getFooterTextColor() . ';')) ?>
										</unsubscribe>
									</td>
								</tr>
							</table>
						<!-- Email Footer : END -->
						
						<!--[if mso]>
						</td>
						</tr>
						</table>
						<![endif]-->
					</div>
				</td>
			</tr>
		</table>
		
	<!--[if mso | IE]>
    </td>
    </tr>
    </table>
    <![endif]-->
	</center>
</body>
</html>