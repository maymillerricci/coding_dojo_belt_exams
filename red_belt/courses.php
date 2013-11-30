<?php
	// require("connection.php");
	// session_start();
	// var_dump($_SESSION);
	require "process_course.php"
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Courses</title>
		<link rel="stylesheet" type="text/css" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/hot-sneaks/jquery-ui.css" type="text/css" media="all" />
		<link rel="stylesheet" href="courses.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){

				$("#accordion").accordion();

				$('textarea.edit').hide();

				//when add course form is submitted
				$(document).on('submit', '#add_course_form', function() {
					$.post(
						$(this).attr('action'),
						$(this).serialize(),
						function(data) {
							console.log(data);
							$('#accordion').append(data);
							$("#accordion").accordion();
						},
						"json"
					);
					return false;
				});

				//when delete course form is submitted
				$(document).on('submit', '.delete_course_form', function() {	
					$.post(
						$(this).attr('action'),
						$(this).serialize(),
						function(data) {
							console.log(data);
							$('h3#' + data).remove();
							$('div#' + data).remove();
						},
						"json"
					);
					return false;
				});

				//when edit course form is submitted
				$(document).on('submit', '.edit_course_form', function() {	
					$.post(
						$(this).attr('action'),
						$(this).serialize(),
						function(data) {
							console.log('textarea#' + data)
							$('textarea#' + data + ".edit").show();
						},
						"json"
					);
					return false;
				});
		});
	</script>
	</head>
	<body>
		<div id="wrapper">
			<div class="row" id="header">
				<?php  
				//if logged in
				if(isset($_SESSION['user_info']))
				{
					echo "<div class='col-md-3'><h2>Courses!</h2></div>";
					echo "<div class='col-md-3'><h4>Welcome, " . $_SESSION['user_info']['first_name'] . "!</h4></div>"; 
					echo "<div class='col-md-3'><h4>" . $_SESSION['user_info']['email'] . "</h4></div>"; 
					echo "<div class='col-md-3'>
							<form action='process.php' method='post'>
								<input type='hidden' name='action' value='logout'>
								<input type='submit' value='Log Out' class='btn btn-primary'>
							</form>
						</div>";
				}
				//if not logged in
				else
				{
					echo "<div class='col-md-3'><h2>Courses!</h2></div>";
					echo "<div class='col-md-7'><h4>Welcome!  You must be logged in to view your courses.</h4></div>";
					echo "<div class='col-md-2'>
							<form action='process.php' method='post'>
								<input type='hidden' name='action' value='log_back_in'>
								<input type='submit' value='Log In' class='btn btn-primary'>
							</form>
						</div>";
						die;
				}
				?>
			</div> <!-- close header div -->

			<form action="process_course.php" method="post" id="add_course_form">
				<h3>Add Course:</h3>
				<p><label for="title">Title:</label>
				<input type="text" name="title" id="title"></p>
				<p><label for="description">Description:</label>
				<textarea name="description" id="description"></textarea></p>
				<input type="hidden" name="user_id" value=" <?= $_SESSION['user_info']['id'] ?>">
				<input type="hidden" name="action" value="add_course">
				<input type="submit" value="Add Course" id="add_course">
			</form>

			<h3>Courses!!</h3>
			<?php
				$courses = $process_course->get_courses($_SESSION['user_info']['id']);
			?>
			<div id="accordion">
				<?php 
				foreach($courses as $course)
				{
					echo "<h3 id=" . $course['id'] . ">" . $course['title'] . "</h3>";
					echo "<div id=" . $course['id'] . "><p>" . $course['description'] . "</p>";

					echo "<textarea class='edit' id=" . $course['id'] . ">" . $course['description'] . "</textarea>";
					
					echo "<form action='process_course.php' method='post' class='edit_course_form'>";
					echo "<input type='hidden' name='course_id' value=" . $course['id'] . ">";
					echo "<input type='hidden' name='action' value='edit_course'>";
					echo "<input type='submit' value='Edit' class='edit'>";
					echo "</form>";

					echo "<form action='process_course.php' method='post' class='delete_course_form'>";
					echo "<input type='hidden' name='course_id' value=" . $course['id'] . ">";
					echo "<input type='hidden' name='action' value='delete_course'>";
					echo "<input type='submit' value='Delete' class='delete'>";
					echo "</form></div>";
				}
				?>
			</div> <!-- close accordion -->
		</div> <!-- close wrapper div -->
	</body>
</html>