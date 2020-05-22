<?php
	require_once 'config.php';

	try {
		$accessToken = $helper->getAccessToken();
	} catch (\Facebook\Exceptions\FacebookResponseException $e) {
		echo 'Response exception: ' . $e->getMessage();
		exit();
	} catch (\Facebook\Exceptions\FacebookSDKException $e) {
		echo 'SDK exception: ' . $e->getMessage();
		exit();
	}

	if (!$accessToken) {
		header('Location: login.php');
		exit();
	}

	$oAuth2Client = $FB->getOAuth2Client();
	if (!$accessToken->isLongLived()) $accessToken = $oAuth2Client->getLongLivedAccessToken();

	$response = $FB->get('/me?fields=id,first_name,last_name,email,picture.type(large)', $accessToken);
	$userData = $response->getGraphNode()->asArray();

	$userData = $response->getGraphNode()->asArray();
	$_SESSION['userData'] = $userData;
	$_SESSION['access_token'] = (string) $accessToken;
	header('Location: index.php');
	exit();
?>
