<?php
	session_start();

	require_once 'config.php';

	if (isset($_SESSION['access_token']) || (isset($_SESSION['userData']['email']) && isset($_SESSION['loggedIn']))) {
		header('Location: index.php');
		exit();
	}

	// Facebook login details
	$fbRedirectURL = 'http://localhost/fb-callback.php';
	$permissions = ['email'];
	$fbLoginURL = $helper->getLoginURL($fbRedirectURL, $permissions);

	// Google login details
	$googleLoginURL = $gClient->createAuthUrl();

	// Regular login form
	if (isset($_POST['logIn'])) {
		$connection = new mysqli('mysql', 'root', 'password', 'phpAuth');

		$email = $connection->real_escape_string($_POST['email']);
		$password = sha1($connection->real_escape_string($_POST['password']));

		$data = $connection->query("SELECT id, firstName, lastName FROM users WHERE email='$email' AND password='$password'");

		$result = mysqli_fetch_array($data);

		if ($data->num_rows > 0) {
			$_SESSION['userData']['email'] = $email;
			$_SESSION['userData']['id'] = $result['id'];
			$_SESSION['userData']['first_name'] = $result['firstName'];
			$_SESSION['userData']['last_name'] = $result['lastName'];
			$_SESSION['loggedIn'] = 1;

			header('Location: index.php');
			exit();
		} else {
			echo "The entered credentials did not match!";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Log In</title>
		<link rel="shortcut icon" type="image/png" href="assets/php-icon.ico"/>
		<link
			rel="stylesheet"
			href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
			integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
			crossorigin="anonymous"
		>
		<link
			rel="stylesheet"
			href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-social/5.1.1/bootstrap-social.css"
			crossorigin="anonymous"
		>
		<script src="https://kit.fontawesome.com/cd68a50978.js" crossorigin="anonymous"></script>
  </head>
	</head>

	<body>
		<div class="container" style="margin-top: 100px">
			<div class="row justify-content-center">
				<div class="col-md-6 col-md-offset-3" align="center">
					<img src="assets/logo.png"><br><br>
					<form action="login.php" method="POST">
						<input type="text" name="email" placeholder="Email" class="form-control"><br>
						<input type="password" name="password" placeholder="Password" type="password" class="form-control"><br>
						<input type="submit" name="logIn" value="Sign In" class="btn btn-primary">
						<a class="btn btn-social btn-facebook text-white" onclick="window.location='<?php echo $fbLoginURL ?>';">
							<span class="fa fa-facebook"></span> Sign in with Facebook
						</a>
						<a class="btn btn-social btn-google text-white" onclick="window.location='<?php echo $googleLoginURL ?>';">
							<span class="fa fa-google"></span> Sign in with Google
						</a>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
