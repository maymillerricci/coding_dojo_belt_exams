<?php 
	require("connection.php");
	session_start();
	// var_dump($_POST);

	//UPDATE
	//figure out which student it is and if they have a latest clock
	if(isset($_POST) && $_POST['action'] == "update")
	{
		//fixed from prior version to match based on id (getting id from select value while still showing name)
		$query = "SELECT * FROM students WHERE id = '" . $_POST['id'] . "'";
		$student = fetch_record($query);
		$student_id = $student['id'];
		$query = "SELECT * FROM clocks WHERE student_id ='" . $student_id . "' ORDER BY clockintime DESC LIMIT 1";
		$latest_clock = fetch_record($query);

		//have they ever done a clock before?
		if($latest_clock)
		{
			if(isset($latest_clock['clockouttime'])) //clockout time is set
			{
				//time for a new clock in
				$_SESSION['step2'] = "clockin";
				$_SESSION['student_info'] = $student;
				header("location: clock.php");
			}
			else //clockout time not yet set
			{
				//option to clock out of this one
				$_SESSION['step2'] = "clockout";
				$_SESSION['student_info'] = $student;
				header("location: clock.php");
			}
		}
		else //if they've never done a clock before
		{
			//set clock in form
			$_SESSION['step2'] = "clockin";
			$_SESSION['student_info'] = $student;
			header("location: clock.php");
		}
	}

	//CLOCK IN
	if(isset($_POST) && $_POST['action'] == "clockin")
	{
		//create new clockin record in clocks table
		$query = "INSERT INTO clocks (student_id, clockintime, created_at, updated_at) 
					VALUES (" . $_SESSION['student_info']['id'] . ", now(), now(), now())";
		mysql_query($query);
		header("location: summary.php");
	}

	//CLOCK OUT
	if(isset($_POST) && $_POST['action'] == "clockout")
	{
		//get latest clock record and update it with clockout time and note
		$query = "SELECT * FROM clocks WHERE student_id ='" . $_SESSION['student_info']['id'] . "' ORDER BY clockintime DESC LIMIT 1";
		$latest_clock = fetch_record($query);
		$query = "UPDATE clocks
					SET clockouttime=NOW(), note = '" . $_POST['note'] .
					"' WHERE id = " . $latest_clock['id'];
		mysql_query($query);
		header("location: summary.php");
	}
?>