<?php
namespace newsletter\impl\common\ui;

use n2n\impl\web\ui\view\html\HtmlView;
use n2n\impl\web\ui\view\html\HtmlElement;
use n2n\web\ui\Raw;
use newsletter\core\model\NewsletterState;

class CommonNewsletterHtmlBuilder {
	// change with caution!
	const EMAIL_WIDTH = '680';
	
	private $view;
	private $html;
	private $styleCollection;
	
	public function __construct(HtmlView $view) {
		$this->view = $view;
		$this->html = $view->getHtmlBuilder();
		$newsletterState = $view->lookup('newsletter\core\model\NewsletterState');
		$view->assert($newsletterState instanceof NewsletterState);
		
		$this->styleCollection = $newsletterState->getTemplateStyleCollection();
	}
	
	public function getAttrs(array $attrs = null) {
		return new Raw(HtmlElement::buildAttrsHtml($attrs));
	}
	
	public function attrs(array $attrs = null) {
		$this->view->out($this->getAttrs($attrs));
	}
	
	/**
	 * @return \newsletter\core\model\TemplateStyleCollection
	 */
	public function getStyleCollection() {
		return $this->styleCollection;
	}
	
	public function getBodyAttrs(array $attrs = null) {
		$attrs['width'] = '100%';
		$attrs['style'] = 'margin: 0; mso-line-height-rule: exactly;';
		if (!isset($attrs['bgcolor'])) {
			$attrs['bgcolor'] = $this->styleCollection->getBodyBackgroundColor();
		}
		return $this->getAttrs($attrs);
	}
	
	public function bodyAttrs(array $attrs = null) {
		$this->view->out($this->getBodyAttrs($attrs));
	}
	
	public function getCenterAttrs(array $attrs = null) {
		$attrs['style'] = 'width: 100%; background: ' . $this->styleCollection->getBodyBackgroundColor() 
				. '; text-align: left;';
		return $this->getAttrs($attrs);
	}
	
	public function centerAttrs(array $attrs = null) {
		$this->view->out($this->getCenterAttrs($attrs));
	}
	
	public function getEmailContainerAttrs(array $attrs = null) {
		$attrs['style'] = 'max-width: ' . self::EMAIL_WIDTH . 'px; margin: auto;';
		$attrs['class'] = 'email-container';
		
		return $this->getAttrs($attrs);
	}
	
	public function emailContainerAttrs(array $attrs = null) {
		$this->view->out($this->getEmailContainerAttrs($attrs));
	}
	
	public function getTableAttrs(array $attrs = null) {
		if (!isset($attrs['cellspacing'])) {
			$attrs['cellspacing'] = 0;
		}
		if (!isset($attrs['cellpadding'])) {
			$attrs['cellpadding'] = 0;
		}
		if (!isset($attrs['border'])) {
			$attrs['border'] = 0;
		}
		if (!isset($attrs['align'])) {
			$attrs['align'] = 'center';
		}
		
		return $this->getAttrs($attrs);
	}
	
	public function tableAttrs(array $attrs = null) {
		$this->view->out($this->getTableAttrs($attrs));
	}
	
	public function getPresentationTableAttrs(array $attrs = null) {
		$attrs['role'] = 'presentation';
		$attrs['aria-hidden'] = 'true';
		
		return $this->getTableAttrs($attrs);
	}
	
	public function presentationTableAttrs(array $attrs = null) {
		$this->view->out($this->getPresentationTableAttrs($attrs));
	}
	
	public function getTextCellAttrs(array $attrs = null, array $style = null) {
		$style = $this->getTextStyle($style);
		
		$styleParts = array();
		foreach ($style as $key => $value) {
			$styleParts[] = $key . ': ' . $value;
		}
		$attrs['style'] = implode('; ', $styleParts);
		
		return $this->getAttrs($attrs);
	}
	
	public function textCellAttrs(array $attrs = null, array $style = null) {
		$this->view->out($this->getTextCellAttrs($attrs, $style));
	}
	
	
	public function getLinkAttrs(array $attrs = null, array $style = null) {
		$style = $this->getLinkStyle($style);
		
		$styleParts = array();
		foreach ($style as $key => $value) {
			$styleParts[] = $key . ': ' . $value;
		}
		$attrs['style'] = implode('; ', $styleParts);
		
		return $this->getAttrs($attrs);
	}
	
	public function getHeadingsAttrs(array $attrs = null, array $style = null) {
		$style = $this->getTextHeadingsStyle($style);
		
		$styleParts = array();
		foreach ($style as $key => $value) {
			$styleParts[] = $key . ': ' . $value;
		}
		$attrs['style'] = implode('; ', $styleParts);
		
		return $this->getAttrs($attrs);
	}
	
	public function headingsAttrs(array $attrs = null, array $style = null) {
		$this->view->out($this->getHeadingsAttrs($attrs, $style));
	}
	
	public function getButtonLinkStyleAttrs(array $attrs = null, array $style = null) {
		$style = $this->getButtonLinkStyle($style);
		
		$styleParts = array();
		foreach ($style as $key => $value) {
			$styleParts[] = $key . ': ' . $value;
		}
		$attrs['style'] = implode('; ', $styleParts);
		
		return $this->getAttrs($attrs);
	}
	
	public function buttonLinkStyleAttrs(array $attrs = null, array $style = null) {
		$this->view->out($this->getButtonLinkStyleAttrs($attrs, $style));
	}
	
	public function getImageStyleAttrs(array $attrs = null, array $style = null) {
		$attrs = $this->getImageStyleAttrsArray($attrs, $style);
		return $this->getAttrs($attrs);
	}
	
	public function imageStyleAttrs(array $attrs = null, array $style = null) {
		$this->view->out($this->getImageStyleAttrs($attrs, $style));
	}

	public function getFluidImageStyleAttrs(array $attrs = null, array $style = null) {
		$attrs = $this->getFluidImageStyleAttrsArray($attrs, $style);
		return $this->getAttrs($attrs);
	}
	
	public function imageFluidStyleAttrs(array $attrs = null, array $style = null) {
		$this->view->out($this->getFluidImageStyleAttrs($attrs, $style));
	}
	
	/*
	 * Methods that return a style array 
	 */
	
	public function getImageStyleAttrsArray(array $attrs = null, array $style = null) {
		if (!isset($attrs['arria-hidden'])) {
			$attrs['aria-hidden'] = 'true';
		}
		if (!isset($attrs['alt'])) {
			$attrs['alt'] = '';
		}

		if (!isset($attrs['border'])) {
			$attrs['border'] = '0';
		}
		if (!isset($attrs['align'])) {
			$attrs['align'] = 'middle';
		}
		
		$style = $this->getImageStyle($style);
		$styleParts = array();
		foreach ($style as $key => $value) {
			$styleParts[] = $key . ': ' . $value;
		}
		$attrs['style'] = implode('; ', $styleParts);
		
		return $attrs;
	}
		
	public function getFluidImageStyleAttrsArray(array $attrs = null, array $style = null) {
		if (!isset($attrs['width'])) {
			$attrs['width'] = self::EMAIL_WIDTH;
		}
		if (!isset($attrs['height'])) {
			$attrs['height'] = '';
		}
		if (!isset($attrs['class'])) {
			$attrs['class'] = 'fluid';
		}
		
		$style = $this->getFluidImageStyle($style);
		$attrs = $this->getImageStyleAttrsArray($attrs, $style);
		return $attrs;
	}
	
	public function htmlOut($html) {
		$this->view->out($this->getHtmlOut($html));
	}
	
	public function getHtmlOut($html) {
		$html = str_replace('<p>', '<p style="margin: 0 0 ' . $this->styleCollection->getPMargin() . 'px 0;">', $html);
		$html = str_replace('<a ', '<a ' . $this->getLinkAttrs(), $html);
		$html = str_replace('<h1>', '<h1 ' . $this->getHeadingsAttrs() . '>', $html);
		$html = str_replace('<h2>', '<h2 ' . $this->getHeadingsAttrs() . '>', $html);
		$html = str_replace('<h3>', '<h3 ' . $this->getHeadingsAttrs() . '>', $html);
		
		return $this->view->getOut($html);
	}
	
	/*
	 * Style Helper Classes
	 */
	
	
	protected function getFluidImageStyle(array $style = null) {
		// get basic styles for image
		$style = $this->getImageStyle($style);
		
		if (!isset($style['width'])) {
			$style['width'] = '100%';
		}
		if (!isset($style['max-width'])) {
			$style['max-width'] = self::EMAIL_WIDTH . 'px';
		}
		return $style;
	}
	
	protected function getImageStyle(array $style = null) {
		$style = $this->getTextStyle($style);
		if (!isset($style['height'])) {
			$style['height'] = 'auto';
		}
		
		if (!isset($style['background'])) {
			$style['background'] = $this->styleCollection->getMediumGray();
		}
		
		return $style;
	}
	
	protected function getLinkStyle(array $style = null) {
		if (!isset($style['color'])) {
			$style['color'] = $this->styleCollection->getPrimaryColor();
		}
		
		return $style;
	}
	
	
	protected function getButtonLinkStyle(array $style = null) {
		if (!isset($style['font-size'])) {
			$style['font-size'] = $this->styleCollection->getButtonFontPixelSize() . 'px';
		}
		if (!isset($style['line-height'])) {
			$style['line-height'] = $this->styleCollection->getButtonLineHeight();
		}
		$style = $this->getTextStyle($style);
		
		if (!isset($style['background'])) {
			$style['background'] = $this->styleCollection->getButtonColor();
		}
		if (!isset($style['border'])) {
			$style['border'] = '2px solid' . $this->styleCollection->getButtonColor();
		}
		if (!isset($style['text-align'])) {
			$style['text-align'] = 'center';
		}
		if (!isset($style['text-decoration'])) {
			$style['text-decoration'] = 'none';
		}
		if (!isset($style['display'])) {
			$style['display'] = 'block';
		}
		if (!isset($style['font-weight'])) {
			$style['font-weight'] = 'bold';
		}
		return $style;
	}
	
	
	protected function getTextStyle(array $style = null) {
		if (!isset($style['font-family'])) {
			$style['font-family'] = $this->styleCollection->getBaseFontFamily();
		}
		if (!isset($style['font-size'])) {
			$style['font-size'] = $this->styleCollection->getBaseFontPixelSize() . 'px';
		}
		if (!isset($style['line-height'])) {
			$style['line-height'] = $this->styleCollection->getBasePixelLineHeight() . 'px';
		}
		if (!isset($style['color'])) {
			$style['color'] = $this->styleCollection->getTextColor();
		}

		return $style;
	}
		
	protected function getTextHeadingsStyle(array $style = null) {
		if (!isset($style['font-family'])) {
			$style['font-family'] = $this->styleCollection->getHeadingsFontFamily();
		}
		if (!isset($style['font-size'])) {
			$style['font-size'] = $this->styleCollection->getHeadingsFontPixelSize() . 'px';
		}
		if (!isset($style['font-weight'])) {
			$style['font-weight'] = $this->styleCollection->getHeadingsFontWeight();
		}
		if (!isset($style['line-height'])) {
			$style['line-height'] = $this->styleCollection->getHeadingsPixelLineHeight() . 'px';
		}
		if (!isset($style['color'])) {
			$style['color'] = $this->styleCollection->getPrimaryColor();
		}
		if (!isset($style['margin'])) {
			$style['margin'] = '0 0 ' . $this->styleCollection->getPMargin() . 'px 0';
		}
		return $style;
	}
		
}

