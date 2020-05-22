<?php
	if (isset($_POST['register'])) {
		$connection = new mysqli('mysql', 'root', 'password', 'phpAuth');

		$firstName = $connection->real_escape_string($_POST['firstName']);
		$lastName = $connection->real_escape_string($_POST['lastName']);
		$email = $connection->real_escape_string($_POST['email']);
		$password = $connection->real_escape_string($_POST['password']);

		$data = $connection->query("INSERT INTO users (firstName, lastName, email, password) VALUES ('$firstName', '$lastName', '$email', '$password')");

		if ($data === false) echo $connection->error;
		else echo 'The new user has been saved.';
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Register</title>
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
					<form action="register.php" method="POST">
						<input type="text" name="firstName" placeholder="First Name" class="form-control" /><br>
						<input type="text" name="lastName" placeholder="Last Name" class="form-control" /><br>
						<input type="text" name="email" placeholder="Email" class="form-control" /><br>
						<input type="password" name="password" placeholder="Password" type="password" class="form-control" /><br>
						<input type="submit" name="register" value="Register" class="btn btn-primary" />
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
