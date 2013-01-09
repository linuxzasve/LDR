<?php
	// Database Constants
	define("DB_SERVER", "localhost");
	define("DB_USER", "pulsir_ldr");
	define("DB_PASS", "ldrsql");
	define("DB_NAME", "pulsir_ldr");

	function is_logged_in()
	{
		return (isset($_SESSION['username']));
	}

	function user_id()
	{
		global $connection;
		if(isset($_SESSION['username'])) 
		{
			$username=$_SESSION['username'];
			$queryUsers = "SELECT * FROM tblUser WHERE username='".$username."' LIMIT 1";
			$users = mysql_query($queryUsers,$connection) or die('Error, query failed '.$queryUsers);
			$user=mysql_fetch_array($users);
			
			return $user['id'];
		}
		return -1;
	}
	
	function redirect_to($url)
	{
		header( 'Location:'.$url );
	}
?>