<?php

require_once("lib/class/exception/RequestException.class.php");

class CurlRequest {
	
	private $url = '';
	private $handle = null;
	private $opt = array();
	private $resultado = '';
	
	public function __construct($url) {
		$this->url = $url;
	}
	
	public function addOpt($opt, $value){
		$this->opt[] = array($opt => $value);
	}
	
	private function setOpt() {
		curl_setopt_array($this->handle, $this->opt);
	}
	
	public function getResultados() {
		if($this->url == ''){
			throw new RequestException("URL não definida!");
		}
		
		$this->handle = curl_init($this->url);
		$this->setOpt();
		
		ob_start();
		curl_exec($this->handle);
		$this->resultado = ob_get_clean();
		ob_end_flush();
		if(curl_getinfo($this->handle)['http_code'] != 200){
			$this->resultado = '';
		}
		
		curl_close($this->handle);
		
		return $this->resultado;
	}
}