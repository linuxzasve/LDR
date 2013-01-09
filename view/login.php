<?php

	echo '<form action="include/login.php" method="post">';

	
	echo '<label>Username</label>';
	echo ' <input type="text" class="form_input" name="username">';


	echo '<label>Password</label>';
	echo ' <input type="password" class="form_input" name="password">';
	
	echo '<input type="submit" class="small secondary button radius" value="Login">';
 
	echo "</form>";
?>