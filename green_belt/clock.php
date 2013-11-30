<?php 
	require("connection.php");
	session_start();
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Clock In/Out</title>
		<link rel="stylesheet" href="clock.css">
	</head>
	<body>
		<div class="container">
		<a href="summary.php">Summary</a>
		<!-- step 1: choose your name-->
			<div class="step1">
				<h2>Clock In/Out</h2>
				<h4>Step 1: Choose your name</h4>
				<form action="process.php" method="post">
					Name: 
					<!-- fixed from prior version where select value is id but is still showing name - so can match by id -->
					<select name="id">
						<?php
						$query = "SELECT id, first_name, last_name FROM students";
						$students = fetch_all($query);
						foreach($students as $student)
						{
							$full_name = $student['first_name'] . " " . $student['last_name'];
							echo "<option value = " . $student['id'] . ">" . $full_name . "</option>";
						}
						?>
					</select>
					<input type="hidden" name="action" value="update">
					<input type="submit" value="Update">
			</form>
			</div>
		<!-- step 2: clock in or out -->
		<?php
			//clock in
			if(isset($_SESSION['step2']) && $_SESSION['step2'] == "clockin")
			{
				echo "<div class='step2'>
						<h3>Hi " . $_SESSION['student_info']['first_name'] . "!</h2>
						<form action='process.php' method='post'>
							<input type='hidden' name='action' value='clockin'>
							<input type='submit' value='Clock In!'>
						</form>
					</div>";
				unset($_SESSION['step2']);
			}
			//clock out
			elseif(isset($_SESSION['step2']) && $_SESSION['step2'] == "clockout")
			{
				echo "<div class='step2'>
						<h3>Hi " . $_SESSION['student_info']['first_name'] . "!</h2>
						<form action='process.php' method='post'>" . 
							"<p>Date: " . date('M jS Y', time()) . "</p>" . 
							"<p>Time: " . date('h:i:s a', time()) . "</p>" .
							"<p>Notes:</p><textarea name='note'></textarea>
							<input type='hidden' name='action' value='clockout'>
							<br>
							<input type='submit' value='Clock Out!'>
						</form>
					</div>";
				unset($_SESSION['step2']);
			}
		?>
		</div> <!-- close container div -->
	</body>
</html>