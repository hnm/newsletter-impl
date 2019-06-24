<?php
namespace newsletter\impl\bs\bo;

use n2n\web\http\orm\ResponseCacheClearer;
use n2n\impl\web\ui\view\html\HtmlView;
use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoEntityListeners;
use n2n\persistence\orm\annotation\AnnoTable;
use rocket\impl\ei\component\prop\ci\model\ContentItem;
use newsletter\core\bo\RecipientCategory;
use n2n\persistence\orm\annotation\AnnoManyToMany;

class CiSubscriptionForm extends ContentItem {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoEntityListeners(ResponseCacheClearer::getClass()), new AnnoTable('newsletter_impl_ci_subscription_form'));
		$ai->p('recipientCategories', new AnnoManyToMany(RecipientCategory::getClass()));
	}

	private $recipientCategories;

	public function createUiComponent(HtmlView $view) {
		return $view->getImport('\newsletter\impl\bs\bo\ciSubscriptionForm.html', array('ciSubscriptionForm' => $this));
	}

	/**
	 * @return RecipientCategory[]
	 */
	public function getRecipientCategories() {
		return $this->recipientCategories;
	}

	public function setRecipientCategories($recipientCategories) {
		$this->recipientCategories = $recipientCategories;
	}
}