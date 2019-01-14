<?php
namespace newsletter\impl\common\bo;

use newsletter\core\bo\RecipientCategory;
use n2n\reflection\annotation\AnnoInit;
use page\bo\PageController;
use page\annotation\AnnoPage;
use newsletter\core\controller\NewsletterController;
use n2n\persistence\orm\annotation\AnnoManyToMany;
use n2n\persistence\orm\annotation\AnnoTable;
use newsletter\impl\common\model\CommonNewsletterSetuper;

class NewsletterPageController extends PageController {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoTable('newsletter_impl_common_npc'));
		$ai->p('recipientCategories', new AnnoManyToMany(RecipientCategory::getClass()));
		$ai->m('newsletterPage', new AnnoPage(true));
	}
	
	private $recipientCategories;
	
	public function __construct() {
		$this->recipientCategories = new \ArrayObject();
	}
	/**
	 * @return RecipientCategory []
	 */
	public function getRecipientCategories() {
		return $this->recipientCategories;
	}

	public function setRecipientCategories($recipientCategories) {
		$this->recipientCategories = $recipientCategories;
	}

	public function newsletterPage(CommonNewsletterSetuper $cns, NewsletterController $nsc, array $params = null) {
		$cns->setup();
		$nsc->setRecipientCategories($this->recipientCategories->getArrayCopy());
		$this->delegate($nsc);
	}
}
