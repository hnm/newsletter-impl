<?php
namespace newsletter\impl\common\bo;

use newsletter\core\bo\NewsletterCi;
use newsletter\core\bo\HistoryEntry;
use n2n\impl\web\ui\view\html\HtmlView;
use newsletter\core\model\ui\TextView;
use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoTable;
use n2n\persistence\orm\annotation\AnnoManagedFile;

class NewsletterCiFeaturedArticle extends NewsletterCi {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoTable('newsletter_impl_common_ci_featured_article'));
		$ai->p('fileImage', new AnnoManagedFile());
	}
	
	private $fileImage;
	private $title;
	private $lead;
	private $textHtml;
	private $link;
	private $linkLabel;
	
	public function createHtmlUiComponent(HistoryEntry $historyEntry, HtmlView $view) {
		return $view->getImport('\newsletter\impl\common\view\ci\ciFeaturedArticle.html', array('article' => $this));
	}

	public function getFileImage() {
		return $this->fileImage;
	}

	public function setFileImage($fileImage) {
		$this->fileImage = $fileImage;
	}

	public function getTitle() {
		return $this->title;
	}

	public function setTitle($title) {
		$this->title = $title;
	}

	public function getLead() {
		return $this->lead;
	}

	public function setLead($lead) {
		$this->lead = $lead;
	}

	public function getTextHtml() {
		return $this->textHtml;
	}

	public function setTextHtml($textHtml) {
		$this->textHtml = $textHtml;
	}
	
	public function getLink() {
		return $this->link;
	}

	public function setLink($link) {
		$this->link = $link;
	}

	public function getLinkLabel() {
		return $this->linkLabel;
	}

	public function setLinkLabel($linkLabel) {
		$this->linkLabel = $linkLabel;
	}

	public function createTextUiComponent(HistoryEntry $historyEntry, TextView $view, string $eol) {
		$text = $this->title . $eol . $this->lead . $eol . $eol . $this->htmlToText($this->textHtml, $eol) . $eol;
		if (null !== $this->link) {
			$text .= $eol . $this->link;
			if (null !== $this->linkLabel) {
				$text .= ' (' . $this->linkLabel .')'; 
			}
		}
		return $text;
	}
	
	
	public function getLabel() {
		if ($this->linkLabel) return $this->linkLabel;
		
		if (null === $this->link) return null;
		
		return str_replace(array('http://', 'https://'), '', $this->link);
	}

}