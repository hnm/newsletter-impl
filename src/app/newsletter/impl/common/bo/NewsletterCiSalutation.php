<?php
namespace newsletter\impl\common\bo;

use newsletter\core\bo\NewsletterCi;
use newsletter\core\bo\HistoryEntry;
use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoTable;

class NewsletterCiSalutation extends NewsletterCi {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoTable('newsletter_impl_common_ci_salutation'));
	}
	/**
	 * {@inheritDoc}
	 * @see \newsletter\core\bo\NewsletterCi::createHtmlUiComponent()
	 */
	public function createHtmlUiComponent(HistoryEntry $historyEntry, \n2n\impl\web\ui\view\html\HtmlView $view) {
		return $view->import('\newsletter\impl\common\view\ci\ciSalutation.html', array('historyEntry' => $historyEntry));
	}

	/**
	 * {@inheritDoc}
	 * @see \newsletter\core\bo\NewsletterCi::createTextUiComponent()
	 */
	public function createTextUiComponent(HistoryEntry $historyEntry, \newsletter\core\model\ui\TextView $view, string $endOfLine) {
		return $historyEntry->getSalutation();
	}

	
}