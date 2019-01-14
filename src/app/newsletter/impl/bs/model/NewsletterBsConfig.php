<?php
namespace newsletter\impl\bs\model;

use n2nutil\bootstrap\ui\Bs;

class NewsletterBsConfig {
	
	public static function createBsComposer() {
		return Bs::row('col-sm-4', 'col-sm-8', 'offset-sm-4');
	}
}