<?php
	if (isset($_GET['email']) && isset($_GET['token'])) {
		$connection = new mysqli('mysql', 'root', 'password', 'phpAuth');

		$email = $connection->real_escape_string($_GET['email']);
		$token = $connection->real_escape_string($_GET['token']);

		$data = $connection->query("SELECT id FROM users WHERE email='$email' AND token='$token'");

		if ($data->num_rows > 0) {
			$randomString = str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
			$randomString = substr($randomString, 0, 15);

			$password = sha1($randomString);

			$connection->query("UPDATE users SET password='$password', token='' WHERE email='$email'");

			echo "Your password is now set to: '$randomString'";
		} else {
			echo "The link doesn't appear to be correct.";
		}
	} else {
		header('Location: login.php');
		exit();
	}
?>
