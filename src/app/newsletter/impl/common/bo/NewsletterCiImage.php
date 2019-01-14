<?php
namespace newsletter\impl\common\bo;

use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoManagedFile;
use n2n\persistence\orm\annotation\AnnoTable;
use n2n\io\managed\File;
use newsletter\core\bo\NewsletterCi;
use newsletter\core\model\ui\TextView;
use newsletter\core\bo\HistoryEntry;

class NewsletterCiImage extends NewsletterCi {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoTable('newsletter_impl_common_ci_image'));
		$ai->p('fileImage', new AnnoManagedFile());
	}
	
	private $fileImage;
	private $link;
	
	/**
	 * @return \n2n\io\managed\File
	 */
	public function getFileImage() {
		return $this->fileImage;
	}

	public function setFileImage(File $fileImage) {
		$this->fileImage = $fileImage;
	}
	
	public function getLink() {
		return $this->link;
	}
	public function setLink($link) {
		$this->link = $link;
	}
	
	public function createHtmlUiComponent(HistoryEntry $historyEntry, \n2n\impl\web\ui\view\html\HtmlView $view) {
		return $view->getImport('\newsletter\impl\common\view\ci\ciImage.html', array('ciNewsletterImage' => $this));
	}
	
	public function createTextUiComponent(HistoryEntry $historyEntry, TextView $view, string $eol) {
		return $this->link;
	}
}