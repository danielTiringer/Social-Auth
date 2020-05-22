<?php
	session_start();

	require_once 'config.php';

	if (isset($_SESSION['access_token']) || (isset($_SESSION['userData']['email']) && isset($_SESSION['loggedIn']))) {
		header('Location: index.php');
		exit();
	}

	$redirectURL = 'http://localhost/fb-callback.php';
	$permissions = ['email'];
	$loginURL = $helper->getLoginURL($redirectURL, $permissions);

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
		<title>Log In</title>
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
					<form action="login.php" method="POST">
						<input type="text" name="email" placeholder="Email" class="form-control"><br>
						<input type="password" name="password" placeholder="Password" type="password" class="form-control"><br>
						<input type="submit" name="logIn" value="Log In" class="btn btn-primary">
						<input
							type="button"
							onclick="window.location='<?php echo $loginURL ?>';"
							value="Log In With Facebook"
							class="btn btn-primary"
						>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
