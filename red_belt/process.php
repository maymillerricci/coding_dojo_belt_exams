<?php
	require("connection.php");
	session_start();

	class Process extends Database
	{
		//constructor for process class
		public function __construct()
		{
			new Database;

			if(isset($_POST['action']) && $_POST['action'] == "login")
			{
				$this->login();
			}

			if(isset($_POST['action']) && $_POST['action'] == "register")
			{
				$this->register();
			}

			if(isset($_POST['action']) && $_POST['action'] == "logout")
			{
				$this->logout();
			}

			if(isset($_POST['action']) && $_POST['action'] == "log_back_in")
			{
				$this->log_back_in();
			}

			if(isset($_POST['action']) && $_POST['action'] == "add_friend")
			{
				$this->add_friend();
			}
		}

		//login
		private function login()
		{
			//set variables from post
			$login_email = $_POST['login_email'];
			$login_password = md5($_POST['login_password']);

			//query database for that email
			$query = "SELECT * FROM users WHERE email='{$login_email}'";
			$user = $this->fetch_record($query);

			//error if email is blank
			if(empty($login_email))
			{
				$_SESSION['error_login'] = "Please enter an email.";
				header("location: index.php");
			}
			//error if email is not in database
			elseif(!$user)
			{
				$_SESSION['error_login'] = "No user with this email exists.";
				header("location: index.php");
				// $data['error_login'] = "No user with this email exists.";
				// echo json_encode($data);
			}
			//error if username and password don't match
			elseif($user['password'] != $login_password)
			{
				$_SESSION['error_login'] = "Email and password do not match.";
				header("location: index.php");
			}
			//success if username and password match
			elseif($user['password'] == $login_password)
			{
				$_SESSION['email'] = $login_email;
				$this->success();
			}
		}

		//register
		private function register()
		{
			//set variables from post
			$error_main = "";
			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			//validate first name
			if(!empty($first_name) && ctype_alpha($first_name))
			{
				$_SESSION['valid_first_name'] = true;
			}
			else
			{
				$_SESSION['valid_first_name'] = false;
				$_SESSION['error_first_name'] = "Please enter a valid first name (letters only).";
			}
			//validate last name
			if(!empty($last_name) && ctype_alpha($last_name))
			{
				$_SESSION['valid_last_name'] = true;
			}
			else
			{
				$_SESSION['valid_last_name'] = false;
				$_SESSION['error_last_name'] = "Please enter a valid last name (letters only).";
			}
			//validate email
			//first check if email is already in database
			$query = "SELECT * FROM users WHERE email='{$email}'";
			$user = $this->fetch_record($query);
			if($user)
			{
				$_SESSION['valid_email'] = false;
				$_SESSION['error_email'] = "A user already exists with this email.  Please enter a different email.";
			}
			//then do regular email validation
			elseif(filter_var($email, FILTER_VALIDATE_EMAIL))
			{
				$_SESSION['valid_email'] = true;
			}
			else
			{
				$_SESSION['valid_email'] = false;
				$_SESSION['error_email'] = "Please enter a valid email address.";
			}
			//validate password
			if(!empty($password) && strlen($password) >= 5)
			{
				$_SESSION['valid_password'] = true;
			}
			else
			{
				$_SESSION['valid_password'] = false;
				$_SESSION['error_password'] = "Please enter a valid password of at least 5 characters.";
			}

			//redirect to courses page if all fields are valid
			if($_SESSION['valid_first_name'] && $_SESSION['valid_last_name'] && $_SESSION['valid_email'] && $_SESSION['valid_password'])
			{
				$query = "INSERT INTO users (first_name, last_name, email, password, created_at, updated_at) 
					VALUES ('{$first_name}', '{$last_name}', '{$email}', md5('{$password}'), NOW(), NOW())";
				mysql_query($query);
				$_SESSION['valid_main'] = true;
				$_SESSION['email'] = $email;
				$this->success();
			}
			//redirect back to register page if any errors with appropriate error messages
			else
			{
				$_SESSION['valid_main'] = false;
				$_SESSION['error_main'] = "Please correct the below information.";	
				header("location: index.php");
			}
		}

		//if successfully register or log in, bring user info to course page
		private function success()
		{
			//individual user info
			$query = "SELECT * FROM users WHERE email='{$_SESSION['email']}'";
			$user = $this->fetch_record($query);
			$_SESSION['user_info'] = $user;
			header("location: courses.php");
		}

		//logout
		private function logout()
		{
			session_destroy();
			header("location: index.php");
		}
		
		//log back in (if somehow on wall page w/out being logged in - like via back button)
		private function log_back_in()
		{
			header("location: index.php");
		}
	}

	//instantiate process
	$process = new Process();	
?>