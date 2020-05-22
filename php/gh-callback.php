<?php
	require_once 'config.php';

	$code = $_GET['code'];

	if ($code == '') {
		header('Location: login.php');
		exit;
	}

	$url = 'https://github.com/login/oauth/access_token';

	$postParams = [
		'client_id' => $_ENV['GITHUB_CLIENT_ID'],
		'client_secret' => $_ENV['GITHUB_CLIENT_SECRET'],
		'code' => $code,
	];

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postParams);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));

	$response = curl_exec($ch);
	$data = json_decode($response);

	if ($data->access_token != '') {
		$_SESSION['access_token'] = $data->access_token;

		header('Location: index.php');
		exit;
	}
