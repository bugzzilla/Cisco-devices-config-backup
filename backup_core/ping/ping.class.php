<?php

	include_once ( __DIR__ . '/../inc/misc.php');
	
	class ping {
		
		public $pingResult = array (
							'rawStdout' => '', 
							'returnVar' => -1);
		
		public function ping($hostname, $echoRequestCount = 3) {

			exec('ping -c '.$echoRequestCount.' '.$hostname.' -W '._PING_TIMEOUT_." 2>&1",$this->pingResult['rawStdout'],$this->pingResult['returnVar']);
		}
		
	}