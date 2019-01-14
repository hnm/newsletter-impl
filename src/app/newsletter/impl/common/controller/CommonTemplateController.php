<?php
namespace newsletter\impl\common\controller;

use n2n\web\http\controller\ControllerAdapter;
use newsletter\core\controller\TemplateController;
use newsletter\impl\common\model\CommonNewsletterSetuper;

class CommonTemplateController extends ControllerAdapter {
	
	public function index(CommonNewsletterSetuper $setuper, TemplateController $templateController, 
			array $delegateParams = null) {
		$setuper->setup();
		$this->delegate($templateController);
	}
}