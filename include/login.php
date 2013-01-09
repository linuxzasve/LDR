<?php
	session_start();
	
	require_once("security.php");
//	require_once("include/strings.php");
	$self = $_SERVER['PHP_SELF'];
	
	// 1. Create a database connection
	$connection = mysql_connect(DB_SERVER,DB_USER,DB_PASS);
	if (!$connection) 
	{
		die("Database connection failed: " . mysql_error());
	}
	
	// 2. Select a database to use 
	$db_select = mysql_select_db(DB_NAME,$connection);
	if (!$db_select) 
	{
		die("Database selection failed: " . mysql_error());
	}
	mysql_query("SET NAMES 'utf8'",$connection);
	
	//Login
	if(isset($_POST['username']))
	{
		//login();
		/*echo $_SERVER['HTTP_HOST'];*/
		/*header( "Location: index.php?menu=loginfailed" );*/
		if(isset($_POST['username']) && !isset($_POST['newUser'])) 
		{
			$username=$_POST['username'];
			$queryUsers = "SELECT * FROM tblUser WHERE username='".$username."' LIMIT 1";
			$users = mysql_query($queryUsers,$connection) or die('Error, query failed '.$queryUsers);
			$user=mysql_fetch_array($users);
			
			//echo $username;
			
			if($user['hashPassword']==sha1($_POST['password']))
			{
				$_SESSION['username']=$username;
				$_SESSION['userId']=$user['id'];
				redirect_to("../index.php?menu=home");
			}
			else
			{
				redirect_to("../index.php?menu=loginfailed");
			}
		}
		else
		{
			redirect_to("../index.php?menu=loginfailed");
		}
	}
?>