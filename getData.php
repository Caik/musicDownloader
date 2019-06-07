<?php

require_once("lib/class/TermoRequest.class.php");

if(isset($_POST['busca']) && $_POST['busca'] != ''){
	
	$request = new TermoRequest($_POST['busca'], $_POST['info']);
	$resultados = $request->getResultados();
	
	$infoFlg = $_POST['info'] && true;
	
	include("inc/data.php");
}