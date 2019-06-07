<?php

require_once("lib/class/CurlRequest.class.php");
require_once("lib/class/DataParser.class.php");

class TermoRequest {
	
	private $url = "http://mp3clan.com/mp3/";
	private $infoFlg = 1;
	private $data = '';
	private $resultados = array();
	
	public function __construct($termoBusca, $infoFlg) {
		$this->url .= trim(preg_replace("/\s/", "_", $termoBusca)) . ".html";
		$this->infoFlg = intval($infoFlg);
	}
	
	public function getResultados() {
		$curl = new CurlRequest($this->url);
		$curl->addOpt(CURLOPT_RETURNTRANSFER, true);
		$this->data = $curl->getResultados();
		
		if($this->data == '')
			return $this->data;
		
		$this->resultados = DataParser::getElementos($this->data, $this->infoFlg);
		
		return $this->resultados;
	}
}