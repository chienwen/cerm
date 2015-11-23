<?php

    if(php_sapi_name() !== 'cli'){
        die("This script should be run under command line.\n");
    }

	require('lib/lib.net.curl.php');
	require('const.visa.inc.php');
	date_default_timezone_set('Asia/Taipei');
	define("STORAGE_PATH", "data");

	$STDERR = fopen('php://stderr', 'w');

	function err($msg){
		global $STDERR;
		fwrite($STDERR, trim($msg)."\n");
	}
	function curl($url){
		if(rand(1,100) < 30){
			$sec = rand(1,5);
			err('sleep '.$sec.' second(s)');
			sleep($sec);
		}
		err('Curl: '.$url);
		return curlFetch($url);
	}

	if(empty($argv[1])){
		$fetch_days = 3;
	}
	else{
		$fetch_days = $argv[1];
	}

	$t_init = time();

	abstract class ExchangeRateFetcher {
		protected $filename = '/data.json';
		protected $ts;
		protected $dir;
		protected $extable;
		public function __construct($ts, $dir){
			$this->ts = $ts;
			$this->dir = $dir;
			$this->extable = array();
		}
		public function run(){
			$extable = array();
			if(file_exists($this->dir.$this->filename)){
				$extable = json_decode(file_get_contents($this->dir.$this->filename), true);
			}
			if(empty($extable)){
				$this->fetch();
				if(!empty($this->extable)){
					file_put_contents($this->dir.$this->filename, json_encode($this->extable));
				}
			}
			else{
				err('existing '.$this->dir.$this->filename.', skip');
			}
		}
		abstract protected function fetch();
	}

	class JCBExchangeRateFetcher extends ExchangeRateFetcher {
		protected $filename = '/jcb.json';
		protected function fetch(){
			$data = curl('http://www.jcb.jp/uploads/'.date('Ymd', $this->ts).'.csv');
			foreach(explode("\n",$data) as $line){
				$tline = trim($line);
				if(preg_match('/USD,=,(.+),(.+),(.+),(.+)/', $tline, $regs)){
					$this->extable[trim($regs[4])] = array(
								'mid' => $regs[2]/1,
								'buy' => $regs[1]/1,
								'sell' => $regs[3]/1,
							);
				}
			}
		}
	}

	class MasterCardExchangeRateFetcher extends ExchangeRateFetcher {
		protected $filename = '/mc.json';
		protected function fetch(){
    		$data = curl('https://www.mastercard.com/psder/eu/callPsder.do?service=getExchngRateDetails&baseCurrency=USD&settlementDate='.date('m/d/Y',$this->ts));
    		$xml = new SimpleXMLElement($data);
    		$cnt = $xml->TRANSACTION_CURRENCY->count();
    		if($cnt > 0){
    			foreach ($xml->TRANSACTION_CURRENCY->children() as $curr) {
    				$this->extable[$curr->ALPHA_CURENCY_CODE.''] = array(
    							'name' => $curr->CURRENCY_NAME.'',
    							'mid' => ($curr->CONVERSION_RATE.'')/1,
    						);
    			}
    		}
		}
	}

	class VisaExchangeRateFetcher extends ExchangeRateFetcher {
		protected $filename = '/visa.json';
		protected function fetch(){
			global $VISA_CURRENCY_DICT;
    		foreach($VISA_CURRENCY_DICT as $curr => $name){
    			$data = curl('https://usa.visa.com/support/consumer/travel-support/exchange-rate-calculator.html?fromCurr='.$curr.'&toCurr=USD&fee=0&exchangedate='.date('m/d/Y',$this->ts));
    			$rate = false;
    			foreach(explode("\n",$data) as $line){
    				if(preg_match('/<strong>1 USD = (.+) '.$curr.'<strong>/',$line,$regs)){
    					$rate = $regs[1]/1;
    					break;
    				}
    			}
				if(empty($rate)){
					err('cannot find rate');
					break;
				}
				err('find rate '.$rate);
    			$this->extable[$curr] = array(
    						'name' => $name,
    						'mid' => $rate,
    					);
    		}
			if(count($this->extable) !== count($VISA_CURRENCY_DICT)){
				$this->extable = array();
			}
		}
	}

	for($t = $t_init; $t > $t_init - 86400 * $fetch_days; $t -= 86400){
		err("Fetching ".date('Ymd', $t));
		$dir = STORAGE_PATH . "/" . date('Ymd', $t);
		if(!file_exists($dir)){
			mkdir($dir);
		}

		/////////////////////////////////
		// fetch jcb
		$fetcher = new JCBExchangeRateFetcher($t, $dir);
		$fetcher->run();

		/////////////////////////////////
		// fetch master card
		$fetcher = new MasterCardExchangeRateFetcher($t, $dir);
		$fetcher->run();

		/////////////////////////////////
		// fetch visa card
		$fetcher = new VisaExchangeRateFetcher($t, $dir);
		$fetcher->run();
	}
