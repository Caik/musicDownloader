<?php

class MusicElement {
	
	private $id = '';
	private $name = '';
	private $downloadUrl = '';
	private $duration = '';
	private $bitrate = '';
	private $size = '';
	
	public function __construct($id, $name, $downloadUrl, $duration, $bitrate, $size) {
		$this->id = $id;
		$this->name = $name;
		$this->downloadUrl = $downloadUrl;
		$this->duration = $duration;
		$this->bitrate = $bitrate;
		$this->size = $size;
	}
	
	public function getId(){
		return $this->id;
	}
	
	public function getName(){
		return $this->name;
	}
	
	public function getDownloadUrl(){
		return $this->downloadUrl;
	}
	
	public function getDuration(){
		return $this->duration;
	}
	
	public function getBitrate(){
		return $this->bitrate;
	}
	
	public function getSize(){
		return $this->size;
	}
	
	public function toArray(){
		return array(
			'id' => $this->id,
			'name' => $this->name,
			'downloadUrl' => $this->downloadUrl,
			'duration' => $this->duration,
			'bitrate' => $this->bitrate,
			'size' => $this->size
		);
	}
}