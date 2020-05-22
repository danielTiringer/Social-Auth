<?php
	if (isset($_POST['forgotPassword'])) {
		$connection = new mysqli('mysql', 'root', 'password', 'phpAuth');

		$emailAddress = $connection->real_escape_string($_POST['email']);

		$emailData = $connection->query("SELECT id FROM users WHERE email='$emailAddress'");

		if ($emailData->num_rows > 0) {
			$randomString = str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
			$randomString = substr($randomString, 0, 10);
			$resetUrl = "http://localhost/resetpassword.php?token=$randomString&email=$emailAddress";

			mail($emailAddress, 'Reset Password', "To reset your password, please visit this link: $resetUrl", 'From: noreply@example.com\r\n');
		} else {
			echo "The provided email address wasn't found.";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Forgot Password</title>
		<link rel="shortcut icon" type="image/png" href="assets/php-icon.ico"/>
		<link
			rel="stylesheet"
			href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
			integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
			crossorigin="anonymous"
		>
	</head>

	<body>
		<div class="container" style="margin-top: 100px">
			<div class="row justify-content-center">
				<div class="col-md-6 col-md-offset-3" align="center">
					<img src="assets/logo.png"><br><br>
					<form action="forgotpassword.php" method="POST">
						<input type="text" name="email" placeholder="Email" class="form-control"><br>
						<input type="submit" name="forgotPassword" value="Request Password" class="btn btn-primary">
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
