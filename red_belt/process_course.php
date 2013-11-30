<?php 
	require("connection.php");
	session_start();

	class Process_course extends Database
	{
		public function __construct()
		{
			new Database;

			if(isset($_POST['action']) && $_POST['action'] == "add_course")
			{
				$this->add_course($_POST['user_id'], $_POST['title'], $_POST['description']);
				$new_course_html = "<h3 class='ui-accordion-header ui-helper-reset ui-state-default ui-corner-all ui-accordion-icons' role='tab' aria-controls='ui-accordion-accordion-panel-4' tabindex='-1'><span class='ui-accordion-header-icon ui-icon ui-icon-triangle-1-e'></span>" . $_POST['title'] . "</h3>" .
									"<p class=.ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom' style='display: none; height: 55px;' aria-labelledby='ui-accordion-accordion-header-4' role='tabpanel'>" . $_POST['description'] . "</p>";
				echo json_encode($new_course_html);
			}

			if(isset($_POST['action']) && $_POST['action'] == "delete_course")
			{
				$this->delete_course($_POST['course_id']);
				$deleted_course_id = $_POST['course_id'];
				echo json_encode($deleted_course_id);
			}

			if(isset($_POST['action']) && $_POST['action'] == "edit_course")
			{
				//run update query here
				$edited_course_id = $_POST['course_id'];
				echo json_encode($edited_course_id);
			}
		}

		public function get_courses($user_id)
		{
			$query = "SELECT * FROM courses WHERE user_id=" . $user_id;
			return $this->fetch_all($query);
			
		}

		public function add_course($user_id, $title, $description)
		{
			$query = "INSERT INTO courses (user_id, title, description, created_at, updated_at)
						VALUES (" . $user_id . ", '" . $title . "', '" . $description . "', NOW(), NOW())";
			mysql_query($query);
		}

		public function delete_course($course_id)
		{
			$query = "DELETE FROM courses
						WHERE id=" . $course_id;
			mysql_query($query);
		}

	}

	$process_course = new Process_Course();

?>