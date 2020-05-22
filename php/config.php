<?php
	session_start();

	require __DIR__ . '/vendor/autoload.php';

	$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
	$dotenv->load();

	$FB = new \Facebook\Facebook([
		'app_id' => $_ENV['APP_ID'],
		'app_secret' => $_ENV['APP_SECRET'],
		'default_graph_version' => 'v7.0'
	]);

	$helper = $FB->getRedirectLoginHelper();

	$gClient = new Google_Client();
	$gClient->setClientId($_ENV['GOOGLE_CLIENT_ID']);
	$gClient->setClientSecret($_ENV['GOOGLE_CLIENT_SECRET']);
	$gClient->setApplicationName('Social Login');
	$gClient->setRedirectUri('http://localhost/g-callback.php');
	$gClient->addScope('https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email');
