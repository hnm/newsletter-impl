<?php
namespace newsletter\impl\common\rocket;

use newsletter\impl\common\model\CommonNewsletterSetuper;
use rocket\impl\ei\component\modificator\adapter\IndependentEiModificatorAdapter;
use rocket\ei\util\Eiu;
use n2n\util\type\CastUtils;

class NewsletterSetupModificator extends IndependentEiModificatorAdapter {
	
	public function setupEiFrame(Eiu $eiu) {
		$cns = $eiu->lookup(CommonNewsletterSetuper::class);
		CastUtils::assertTrue($cns instanceof CommonNewsletterSetuper);
		
		$cns->setup();
	}
}