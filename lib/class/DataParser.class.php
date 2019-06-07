<?php

require_once("lib/class/MusicElement.class.php");
require_once("lib/class/BitrateRequest.class.php");

class DataParser {
	
	public static function getElementos($data, $infoFlg) {
		$elementos = array();
		
		$data = self::cleanInitialData($data);
		
		preg_match_all("/<li.+<\/li>/sU", $data, $elementos);
		
		$elementos = self::cleanElementos($elementos[0]);
		$elementos = self::mountElementos($elementos, $infoFlg);
		
		return $elementos;
	}
	
	private static function cleanInitialData($data) {
		$data = preg_replace('/^.+(<div id="content">.+)<div class="footer">.+$/s', "$1", $data);
		$data = preg_replace('/<meta.+>/sU', '', $data);
		$data = preg_replace('/<script.+<\/script>/sU', '', $data);
		
		return $data;
	}
	
	private static function cleanElementos($elementos) {
		foreach($elementos as $key => $elemento) {
			$elemento = preg_replace("/^<li.+>/sU", '', $elemento);
			$elemento = preg_replace("/<\/li>/sU", '', $elemento);
			$elemento = preg_replace("/<div .+><\/div>/U", '', $elemento);
			$elemento = preg_replace("/^\s+/m", '', $elemento);
			$elemento = preg_replace("/\s+$/m", '', $elemento);
			$elementos[$key] = $elemento;
		}
		
		return $elementos;
	}
	
	private static function mountElementos($elementos, $infoFlg) {
		$newElementos = array();
		foreach($elementos as $elemento) {
			$name = preg_replace("/^<div.+>(.+)<\/div>.+$/sU", "$1", $elemento);
			$id = preg_replace("/^.*bitrate\('(.+)'\).+$/sU", "$1", $elemento);
			$downloadUrl = preg_replace("/play/", "dl", preg_replace("/^.*<a.+href=\"(.+).mp3\".+$/sU", "$1", $elemento));
			$duration = preg_replace("/^.*Check <br>(\d*:\d+).+$/s", "$1", $elemento) . " min";
			
			$bitrate = '';
			$size = '';
			if($infoFlg){
				// Getting the music bitrate and others info
				$bitrateRequest = new BitrateRequest($id);
				$data = $bitrateRequest->getData();
				$bitrate = preg_replace("/^(\d+ kbps).+$/s", "$1", $data);
				$size = preg_replace("/^.+(\d*\.\d+ mb).+$/s", "$1", $data);
			}
			
			$newElementos[] = new MusicElement($id, $name, $downloadUrl, $duration, $bitrate, $size);
		}
		
		return $newElementos;
	}
}