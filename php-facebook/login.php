<?php
	require_once 'config.php';

	$redirectURL = 'http://localhost:8080/fb-callback.php';
	$permissions = ['email'];
	$loginURL = $helper->getLoginURL($redirectURL, $permissions);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Log In</title>
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
					<img src="images/logo.png"><br><br>
					<form>
						<input name="email" placeholder="Email" class="form-control"><br>
						<input name="password" placeholder="Password" type="password" class="form-control"><br>
						<input type="submit" value="Log In" class="btn btn-primary">
						<input
							type="button"
							value="Log In With Facebook"
							class="btn btn-primary"
							onclick="window.location = '<?php echo $loginURL ?>';"
						>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
