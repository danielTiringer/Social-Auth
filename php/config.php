<?php
	session_start();

	require __DIR__ . '/vendor/autoload.php';
	require_once 'Facebook/autoload.php';

	$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
	$dotenv->load();

	$FB = new \Facebook\Facebook([
		'app_id' => $_ENV['APP_ID'],
		'app_secret' => $_ENV['APP_SECRET'],
		'default_graph_version' => 'v7.0'
	]);

	$helper = $FB->getRedirectLoginHelper();
