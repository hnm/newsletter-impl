<?php
namespace newsletter\impl\common\bo;

use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoTable;
use newsletter\core\bo\NewsletterCi;
use newsletter\core\model\ui\TextView;
use newsletter\core\bo\HistoryEntry;

class NewsletterCiWysiwyg extends NewsletterCi {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoTable('newsletter_impl_common_ci_wysiwyg'));
	}
	
	private $title;
	private $textHtml;

	
	public function getTitle() {
		return $this->title;
	}

	public function setTitle($title) {
		$this->title = $title;
	}

	public function getTextHtml() {
		return $this->textHtml;
	}

	public function setTextHtml($textHtml) {
		$this->textHtml = $textHtml;
	}

	public function createHtmlUiComponent(HistoryEntry $historyEntry, \n2n\impl\web\ui\view\html\HtmlView $view) {
		return $view->getImport('\newsletter\impl\common\view\ci\ciWysiwyg.html', array('wysiwyg' => $this));
	}

	public function createTextUiComponent(HistoryEntry $historyEntry, TextView $view, string $eol) {
		return self::htmlToText($this->textHtml, $eol);
	}
}