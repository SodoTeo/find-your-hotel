<?php
	require_once '../admin/include/db_config.php';
	//login_verify.php

	session_start();

	$error = '';
	$next_action = '';

	if(isset($_POST["action"]))
	{
		if($_POST["action"] == 'email' and 'password')
		{
			if($_POST["user_email"] != '')
			{
				$data = array(
					':user_email'	=>	$_POST["user_email"]
				);

				$query = "
				SELECT * FROM register_user 
				WHERE user_email = :user_email
				";

				$statement = $connect->prepare($query);
				$statement->execute($data);
				$total_row = $statement->rowCount();

				if($total_row == 0)
				{
					$error = 'Email Address not found';
					$next_action = 'email';
				}
				else
				{
					$result = $statement->fetchAll();
					foreach($result as $row)
					{
						$_SESSION["register_user_id"] = $row["register_user_id"];
						$_SESSION["user_name"] = $row["user_name"];
						$_SESSION['user_email'] = $row["user_email"];
						$_SESSION["user_password"] = $row["user_password"];
					}
					$next_action = 'password';
				}
			}
			else
			{
				$error = 'Email Address is Required';
				$next_action = 'email';
			}

			if($_POST["user_password"] != '')
			{
				if(password_verify($_POST["user_password"], $_SESSION["user_password"]))
				{
					$_SESSION['user_id'] = $_SESSION['register_user_id'];
					unset($_SESSION["register_user_id"]);
					unset($_SESSION["user_email"]);
					unset($_SESSION["user_password"]);
					unset($_SESSION["login_otp"]);
				}
				else
				{
					$error = 'Wrong Password';
					$next_action = 'password';
				}
			}
			else
			{
				$error = 'Password is Required';
				$next_action = 'password';
			}
		}
		$output = array(
			'error'			=>	$error,
			'next_action'	=>	$next_action
		);
		
		echo json_encode($output);
	}
?>