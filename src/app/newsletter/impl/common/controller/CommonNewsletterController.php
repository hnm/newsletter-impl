<?php
namespace newsletter\impl\common\controller;

use n2n\web\http\controller\ControllerAdapter;
use newsletter\core\controller\NewsletterController;
use newsletter\impl\common\model\CommonNewsletterSetuper;

class CommonNewsletterController extends ControllerAdapter {
	
	public function index(CommonNewsletterSetuper $setuper, NewsletterController $newsletterController, 
			array $delegateParams = null) {
		$setuper->setup();
		$newsletterController->setRecipientCategories($setuper->getRecipientCategories());
		$this->delegate($newsletterController);
	}
}