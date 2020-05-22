<?php
	session_start();

	if (!isset($_SESSION['access_token'])) {
		header('Location: login.php');
		exit();
	}

	$logoutURL = 'http://localhost/logout.php';
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
				<div class="col-md-3">
				<img src="<?php echo $_SESSION['userData']['picture']['url'] ?>">
				</div>
				<div class="col-md-9">
					<table class="table table-hover table-bordered">
						<tbody>
							<tr>
								<td>ID</td>
								<td><?php echo $_SESSION['userData']['id'] ?></td>
							</tr>
							<tr>
								<td>First Name</td>
								<td><?php echo $_SESSION['userData']['first_name'] ?></td>
							</tr>
							<tr>
								<td>Last Name</td>
								<td><?php echo $_SESSION['userData']['last_name'] ?></td>
							</tr>
							<tr>
								<td>Email</td>
								<td><?php echo $_SESSION['userData']['email'] ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<button onclick="window.location='<?php echo $logoutURL ?>';" class="btn btn-primary">Log Out</button>

		</div>
	</body>
</html>

