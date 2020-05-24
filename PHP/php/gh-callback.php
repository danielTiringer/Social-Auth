<?php
	require_once 'config.php';

	$code = $_GET['code'];

	if ($code == '') {
		header('Location: login.php');
		exit;
	}

	$authUrl = 'https://github.com/login/oauth/access_token';

	$authParams = [
		'client_id' => $_ENV['GITHUB_CLIENT_ID'],
		'client_secret' => $_ENV['GITHUB_CLIENT_SECRET'],
		'code' => $code,
	];

	$authQuery = curl_init();
	curl_setopt($authQuery, CURLOPT_URL, $authUrl);
	curl_setopt($authQuery, CURLOPT_POST, 1);
	curl_setopt($authQuery, CURLOPT_POSTFIELDS, $authParams);
	curl_setopt($authQuery, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($authQuery, CURLOPT_HTTPHEADER, array('Accept: application/json'));

	$authResponse = curl_exec($authQuery);
	$authData = json_decode($authResponse);

	$accessToken = $authData->access_token;

	$userUrl = 'https://api.github.com/user';
	$userAuthHeader = 'Authorization: token ' . $accessToken;
	$userAgentHeader = 'User-Agent: ' . $_ENV['GITHUB_APP_NAME'];

	$userQuery = curl_init();
	curl_setopt($userQuery, CURLOPT_URL, $userUrl);
	curl_setopt($userQuery, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($userQuery, CURLOPT_HTTPHEADER, array('Accept: application/json', $userAuthHeader, $userAgentHeader));

	$userResponse = curl_exec($userQuery);
	$userData = json_decode($userResponse);

	$userName = explode(' ', $userData->name);
	$firstName = $userName[0];
	$lastName = $userName[1];

	if ($accessToken != '') {
		$_SESSION['id'] = $userData->id;
		$_SESSION['first_name'] = $firstName;
		$_SESSION['last_name'] = $lastName;
		$_SESSION['picture'] = $userData->avatar_url;
		$_SESSION['access_token'] = $accessToken;

		header('Location: index.php');
		exit;
	}
