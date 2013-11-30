<?php 
	require("connection.php");
	session_start();
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Clock Summary</title>
		<link rel="stylesheet" href="clock.css">
	</head>
	<body>
		<div class="container">
			<a href="clock.php">Clock In/Out</a>
			<h2>Summary</h2>
			<table>
				<thead>
					<tr>
						<th>Name</th>
						<th>Date</th>
						<th>Clock In</th>
						<th>Clock Out</th>
						<th>Total Hours</th>
						<th>Note</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$query = "SELECT first_name, last_name, clockintime, clockouttime, note 
								FROM clocks
								LEFT JOIN students
								ON students.id = clocks.student_id
								ORDER BY last_name";
					$clocks = fetch_all($query);
					foreach($clocks as $clock)
					{
						$full_name = $clock['first_name'] . " " . $clock['last_name'];
						$date = date('M jS Y', strtotime($clock['clockintime']));
						$clockintime = date('h:i:s a', strtotime($clock['clockintime']));
						if(isset($clock['clockouttime']))
						{
							$clockouttime = date('h:i:s a', strtotime($clock['clockouttime']));
							$total_hours = round((strtotime($clockouttime) - strtotime($clockintime)) / 3600, 2) . " hrs";
						}
						else
						{
							$clockouttime = null;
							$total_hours = null;
						}
						echo 
							"<tr>" .
								"<td>" . $full_name . "</td>" .
								"<td>" . $date . "</td>" .
								"<td>" . $clockintime . "</td>" .
								"<td>" . $clockouttime . "</td>" .
								"<td>" . $total_hours . "</td>" .
								"<td>" . $clock['note'] . "</td>" . 
							"</tr>";
					}
					?>
				</tbody>
			</table>
		</div> <!-- close container div -->
	</body>
</html>