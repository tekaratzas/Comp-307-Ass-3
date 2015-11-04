<?php 

	require 'vendor/autoload.php';    
	$app = new \Slim\Slim();

	$paramValue = $app->request->getBody();

	print("hello ");
	print($paramValue);



>