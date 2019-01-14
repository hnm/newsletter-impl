<?php
namespace newsletter\impl\common\model;

use newsletter\core\model\TemplateStyleCollection;

class CommonStyleCollection implements TemplateStyleCollection {
	public function getTextColor() {
		return '#333333';
	}
	
	public function getFooterTextColor() {
		return '#ffffff';
	}

	public function getBodyBackgroundColor() {
		return '#ffffff';
	}

	public function getTextBackgroundColor() {
		return '#ffffff';
	}
	
	public function getHeaderBackgroundColor() {
		return $this->getBodyBackgroundColor();
	}
	
	public function getLogoBackgroundColor() {
		return $this->getHeaderBackgroundColor();
	}
	
	public function getFooterBackgroundColor() {
		return '#3c3c3c';
	}

	public function getPrimaryColor() {
		return '#E63329';
	}

	public function getBaseFontFamily() {
		return 'Arial, sans-serif';
	}

	public function getBaseFontPixelSize() {
		return 16;
	}

	public function getBasePixelLineHeight() {
		return 24;
	}
	
	public function getHeadingsFontFamily() {
		return 'Tahoma, Arial, sans-serif';
	}

	public function getHeadingsFontPixelSize() {
		return 24;
	}
	public function getHeadingsFontWeight() {
		return 'normal';
	}

	public function getHeadingsPixelLineHeight() {
		return 30;
	}
	
	public function getButtonColor() {
		return $this->getPrimaryColor();
	}
	
	public function getButtonHoverColor() {
		return '#cc2d24';
	}
	
	public function getButtonFontPixelSize() {
		return 14;
	}

	public function getButtonLineHeight() {
		return '30px';
	}
	
	public function getLightGray() {
		return '#f3f3f3';
	}

	public function getMediumGray() {
		return '#aaaaaa';
	}

	public function getDarkGray() {
		return '#6b6b6b';
	}
	
	public function getPMargin() {
		return 10;
	}
}