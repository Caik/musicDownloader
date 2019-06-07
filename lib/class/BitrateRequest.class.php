<?php

require_once("lib/class/CurlRequest.class.php");

class BitrateRequest {
	
	private $url = "http://mp3clan.com/bitrate.php?tid=";
	private $data = '';
	
	public function __construct($id) {
		$this->url .= $id;
	}
	
	public function getData() {
		
		$curl = new CurlRequest($this->url);
		$curl->addOpt(CURLOPT_RETURNTRANSFER, true);
		$this->data = $curl->getResultados();
		
		return $this->data;
	}
}