<?php
	require("connection.php");
	session_start();
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Login or Register</title>
		<link rel="stylesheet" type="text/css" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="courses.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script type="text/javascript">
			// $(document).ready(function() {
			// 	$(document).on('submit', '#login_form', function() {
			// 		$.post(
			// 			$(this).attr('action'),
			// 			$(this).serialize(),
			// 			function(data) {
			// 				console.log(data);
			// 				if(data['error_login']) {
			// 					console.log(data['error_login']);
			// 					$('#error_login').text(data['error_login']);
			// 				}
			// 				else {
			// 					console.log('success');
			// 				}
			// 			},
			// 			"json"
			// 		);
			// 		return false;
			// 	});
			// });
		</script>
	</head>
	<body>
		<div id="wrapper">
			<div class="border" id="login">
				<h3>Login</h3>
				<!-- <div class='col-md-11 alert alert-danger' id='error_login'></div> -->
				<?php
				if(isset($_SESSION['error_login']))
				{
					echo "<div class='col-md-11 alert alert-danger' id='error_login'>" . $_SESSION['error_login'] . "</div>";
					unset($_SESSION['error_login']);
				}
				?>
				<form action="process.php" method="post" id="login_form">
					<div class="row">
						<div class="col-md-2"><label for="login_email">Email:</label></div>
						<div class="col-md-5"><input type="text" name="login_email" id="login_email"></div>
					</div>
					<div class="row">
						<div class="col-md-2"><label for="login_password">Password:</label></div>
						<div class="col-md-5"><input type="password" name="login_password" id="login_password"></div>
					</div>
					<input type="hidden" name="action" value="login">
					<input type="submit" value="Log In" class="btn btn-primary">
				</form>
			</div> <!-- close login div-->
			<div class="border" id="register">
				<h3>Register</h3>
				<?php 
				if(isset($_SESSION['error_main']) && $_SESSION['valid_main'] == false)
				{
					echo "<div class='col-md-11 alert alert-danger' id='error_main'>" . $_SESSION['error_main'] . "</div>";
					unset($_SESSION['error_main']);
				}
				?>
				</p>
				<form action="process.php" method="post" id="register_form">
					<div class="row">
						<div class="col-md-2"><label for="first_name">*First Name:</label></div>
						<div class="col-md-5"><input type="text" name="first_name" id="first_name"></div>
						<?php 
						if(isset($_SESSION['error_first_name']) && $_SESSION['valid_first_name'] == false)
						{
							echo "<div class='col-md-4 alert alert-danger' id='error_first_name'>" . $_SESSION['error_first_name'] . "</div>";
							unset($_SESSION['error_first_name']);
						}
						?>
					</div>
					<div class="row">
						<div class="col-md-2"><label for="last_name">*Last Name:</label></div>
						<div class="col-md-5"><input type="text" name="last_name" id="last_name"></div>
						<?php 
						if(isset($_SESSION['error_last_name']) && $_SESSION['valid_last_name'] == false)
						{
							echo "<div class='col-md-4 alert alert-danger' id='error_last_name'>" . $_SESSION['error_last_name'] . "</div>";
							unset($_SESSION['error_last_name']);
						}
						?>
					</div>
					<div class="row">
						<div class="col-md-2"><label for="email">*Email:</label></div>
						<div class="col-md-5"><input type="text" name="email" id="email"></div>
						<?php 
						if(isset($_SESSION['error_email']) && $_SESSION['valid_email'] == false)
						{
							echo "<div class='col-md-4 alert alert-danger' id='error_email'>" . $_SESSION['error_email'] . "</div>";
							unset($_SESSION['error_email']);
						}
						?>
					</div>
					<div class="row">
						<div class="col-md-2"><label for="password">*Password:</label></div>
						<div class="col-md-5"><input type="password" name="password" id="password"></div>
						<?php 
						if(isset($_SESSION['error_password']) && $_SESSION['valid_password'] == false)
						{
							echo "<div class='col-md-4 alert alert-danger' id='error_password'>" . $_SESSION['error_password'] . "</div>";
							unset($_SESSION['error_password']);
						}
						?>
					</div>
					<input type="hidden" name="action" value="register">
					<input type="submit" value="Register" class="btn btn-primary">
				</form>
			</div> <!-- close register div-->
		</div> <!-- close wrapper div-->
	</body>
</html>