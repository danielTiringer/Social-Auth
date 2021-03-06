<?php
	require 'logincheck.php';

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
				<?php if ($_SESSION['picture']) : ?>
					<img src="<?php echo $_SESSION['picture'] ?>" width="200px" height="200px">
				<?php else : ?>
					<img
						src="https://www.xyrius.co.uk/wp-content/uploads/2017/06/Placeholder-Profile-Image-1.jpg"
						width="200px"
						height="200px"
					>
				<?php endif; ?>
				</div>
				<div class="col-md-9">
					<table class="table table-hover table-bordered">
						<tbody>
							<tr>
								<td>ID</td>
								<td><?php echo $_SESSION['id'] ?></td>
							</tr>
							<tr>
								<td>First Name</td>
								<td><?php echo $_SESSION['first_name'] ?></td>
							</tr>
							<tr>
								<td>Last Name</td>
								<td><?php echo $_SESSION['last_name'] ?></td>
							</tr>
							<tr>
								<td>Email</td>
								<td><?php echo $_SESSION['email'] ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<button onclick="window.location='<?php echo $logoutURL ?>';" class="btn btn-primary">Log Out</button>

		</div>
	</body>
</html>

