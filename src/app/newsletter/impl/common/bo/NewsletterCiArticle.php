<?php
namespace newsletter\impl\common\bo;

use n2n\reflection\annotation\AnnoInit;
use \n2n\io\managed\File;
use n2n\persistence\orm\annotation\AnnoManagedFile;
use n2n\persistence\orm\annotation\AnnoTable;
use newsletter\core\bo\NewsletterCi;
use newsletter\core\model\ui\TextView;
use \n2n\impl\web\ui\view\html\HtmlView;
use newsletter\core\bo\HistoryEntry;

class NewsletterCiArticle extends NewsletterCi {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoTable('newsletter_impl_common_ci_article'));
		$ai->p('fileImage', new AnnoManagedFile());
	}

	const PIC_POS_LEFT = 'left';
	const PIC_POS_RIGHT = 'right';

	private $title;
	private $descriptionHtml;
	private $fileImage;
	private $link;
	private $linkLabel;
	private $picPos;

	public function createHtmlUiComponent(HistoryEntry $historyEntry, HtmlView $view) {
		if ($this->fileImage && $this->fileImage->isValid()) {
			return $view->getImport('\newsletter\impl\common\view\ci\ciArticleImage.html', array('article' => $this));
		} 
		
		return $view->getImport('\newsletter\impl\common\view\ci\ciArticleText.html', array('article' => $this));
	}

	public function createTextUiComponent(HistoryEntry $historyEntry, TextView $view, string $eol) {
		$text = $this->title . $eol . $this->htmlToText($this->descriptionHtml, $eol) . $eol;
		if (null !== $this->link) {
			$text .= $eol . $this->link;
			if (null !== $this->linkLabel) {
				$text .= ' (' . $this->linkLabel .')'; 
			}
		}
		return $text;
	}

	/*
	 * individual methods
	 */
	
	public function getLabel() {
		if ($this->linkLabel) return $this->linkLabel;
		
		if (null === $this->link) return null;
		
		return str_replace(array('http://', 'https://'), '', $this->link);
	}

	public function getTitle() {
		return $this->title;
	}

	public function setTitle($title) {
		$this->title = $title;
	}
	
	public function getDescriptionHtml() {
		return $this->descriptionHtml;
	}

	public function setDescriptionHtml($descriptionHtml) {
		$this->descriptionHtml = $descriptionHtml;
	}

	/**
	 * @return File
	 */
	public function getFileImage() {
		return $this->fileImage;
	}

	/**
	 * @param File $fileImage
	 */
	public function setFileImage(File $fileImage = null) {
		$this->fileImage = $fileImage;
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

	public function getPicPos() {
		return $this->picPos;
	}

	public function setPicPos($picPos) {
		$this->picPos = $picPos;
	}
}