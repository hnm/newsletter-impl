<?php
namespace newsletter\impl\common\controller;

use n2n\context\RequestScoped;
use n2n\core\container\TransactionManager;
use newsletter\impl\common\model\CommonNewsletterConfig;
use newsletter\core\model\SendBatchDao;
use newsletter\impl\common\model\CommonNewsletterSetuper;
use newsletter\core\model\HistoryEntryGenerator;

class CommonNewsletterBatchJob implements RequestScoped {

	private $sendBatchDao;
	private $config;
	private $historyEntryGenerator;

	private function _init(HistoryEntryGenerator $historyEntryGenerator, SendBatchDao $sendBatchDao, 
			CommonNewsletterConfig $config, CommonNewsletterSetuper $setuper) {
		$this->config = $config;
		$this->sendBatchDao = $sendBatchDao;
		$this->historyEntryGenerator = $historyEntryGenerator;
		$setuper->setup();
	}
	
	public function _onTrigger(TransactionManager $tm) {
		// can also run in dev mode, as NewsletterMail returns system manager mail on dev mode
		// if (N2N::isDevelopmentModeOn()) return;
		set_time_limit(0);
		$this->historyEntryGenerator->buildHistoryEntriesForFirstUnpreparedHistory();
		$this->sendBatchDao->sendMails($this->config->isCronjobAvailable(), $this->config->getNumMailsPerHour(), 
				$this->config->getNumMailsPerRequest());
	}
}