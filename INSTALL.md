# LDR 0.1 Install guide
### Create the database
As creating an database is different for almost every hosting provider or server, we'll skip this step. 
If you're on a shared hosting, consult your control panel documentation. (Note that LDR supports *only* MySQL)

----------

### Import the database
You need to import the LDR database using PHPMyAdmin or a similar tool, or run a SQL query yourself from the *mysql-data.sql* file.

----------

### Edit the include/security.php file
Open the include/security.php in a text editor. 
It begins with something like this.

         <?php
         // Database Constants
	  define("DB_SERVER", "localhost");
	  define("DB_USER", "pulsir_ldr");
	  define("DB_PASS", "ldrsql");
	  define("DB_NAME", "pulsir_ldr");

	  function is_logged_in()
	       {
		return (isset($_SESSION['username']));
		
		(...)
		
		
Replace *localhost* with your SQL server, the first instance of *pulsir_ldr* with the database user, 
and the second with the database name, and *ldrsql* with your database user's password.

----------

login: root
pass: root
