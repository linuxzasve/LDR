<?php

	session_start();

	//Menu handling
	if(!isset($_GET['menu']))
	{
		$redirectURL="http://pulsir.vlexofree.com/ldr/index.php?menu=home";
		header("Location: {$redirectURL}");
		exit;
	}
	else
	{
		$menu=$_GET['menu'];
	}
	
	
	require_once("include/security.php");
	//require_once("include/strings.php");
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
	
	//Logout
	if($menu=="logout")
	{
		$_SESSION=array();
		if(isset($_COOKIE[session_name()]))
		{
			setcookie(session_name(),'',time()-42000,'/');
		}
		session_destroy();
	}
?>
<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8" />

  <!-- Set the viewport width to device width for mobile -->
  <meta name="viewport" content="width=device-width" />

  <title>LinuxZaSve.com - Recenzije Linux distribucija</title>
  
  <!-- Included CSS Files (Uncompressed) -->
  <!--
  <link rel="stylesheet" href="stylesheets/foundation.css">
  -->
  
  <!-- Included CSS Files (Compressed) -->
   <link rel="stylesheet" href="stylesheets/foundation.min.css">
  <link rel="stylesheet" href="stylesheets/app.css">
  <link rel="stylesheet" href="butterfly/butterfly.css">


  <script src="javascripts/modernizr.foundation.js"></script>

  <!-- IE Fix for HTML5 Tags -->
  <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->

<script src="js/jquery-1.8.0.min.js"></script>
<script src="js/jquery-ui-1.8.23.custom.min.js"></script>
<link rel="stylesheet" href="stylesheets/smoothness/jquery-ui-1.8.23.custom.css">


</head>
<?php
$title='';
$activeMenu='';
$includeFile="empty.php";
switch($menu)
{
	case "home":
		$includeFile="view/home.php";
		$activeMenu='home';
		break;
	case "compare":
		$includeFile="view/compare.php";
		$activeMenu='compare';
		break;
	case "distro":
		$includeFile="view/distribution.php";
                $activeMenu = 'distro';
		break;
	case "version":
		$includeFile="view/version.php";
		$activeMenu = 'version';
		break;
	case "login":
		$includeFile="view/login.php";
		$activeMenu='login';
		break;
	case "loginfailed":
		$includeFile="view/loginfailed.php";
		break;
	case "logout":
		$includeFile="view/logout.php";
		break;
	case "profile":
		$includeFile="edit/edit_profile.php";
		$activeMenu='profile';
		break;
	case "admin":
		$includeFile="edit/admin_panel.php";
		$activeMenu='admin';
		break;
	case "editdistro":
		$includeFile="edit/edit_distribution.php";
		$activeMenu = 'editdistro';
		break;
	case "editversion":
		$includeFile="edit/edit_version.php";
		$activeMenu = 'editversion';
		break;
	case "editrating":
		$includeFile="edit/edit_rating.php";
		$activeMenu= 'editrating';
		break;
	case "upload":
		$includeFile="view/upload.php";
		$activeMenu='upload';
		break;
	default:
		$includeFile="view/empty.php";
}
?>
<body>
  <div class="row">
    <div class="twelve columns">

      <h2><a href="http://linuxzasve.com"><img src="http://www.linuxzasve.com/wp-content/uploads/2012/02/site_logo.png" alt="Linux za Sve" _title="Povratak na Naslovnicu" /></a> Linux za Sve</h2>
<ul class="nav-bar">
<li><a href="http://linuxzasve.com">Naslovnica</a></li>
  <li class="active" class="support tag"><a href="index.php?menu=home">Distribucije</a></li>
<li><a href="http://www.linuxzasve.com/category/aplikacije">Linux aplikacije</a></li>
<li><a href="http://www.linuxzasve.com/category/tekstovi">Tekstovi</a></li>
<li><a href="http://www.linuxzasve.com/forum">Forum</a></li>
<li><a href="http://wiki.linuxzasve.com/">Wiki stranice</a></li>
<li><a href="http://www.linuxzasve.com/linux-za-sve-impressum">O nama</a></li>
</ul>
      <hr />
    </div>
  </div>
  <div class="row">
    <div class="eight columns">
      <dl class="tabs">
        <dd<?php if($activeMenu=='home')echo ' class="active"';?>><a href="?menu=home">Popis distribucija</a></dd>
        <dd<?php if($activeMenu=='compare')echo ' class="active"';?>><a href="?menu=compare">Usporedi distribucije</a></dd>
        <?php if($activeMenu=='distro')echo '<dd class="active"><a href="">O distribuciji</a></dd>'; ?>
        <?php if($activeMenu=='version')echo '<dd class="active"><a href="">Ocjene verzije</a></dd>'; ?>
        <?php if($activeMenu=='editrating')echo '<dd class="active"><a href="">Ocijeni distribuciju</a></dd>'; ?>
        <?php if($activeMenu=='admin')echo '<dd class="active"><a href="">Administracija</a></dd>'; ?>
        <?php if($activeMenu=='editversion')echo '<dd class="active"><a href="">Administracija</a></dd>'; ?>
        <?php if($activeMenu=='editdistro')echo '<dd class="active"><a href="">Administracija</a></dd>'; ?>
        <?php if($activeMenu=='upload')echo '<dd class="active"><a href="">Administracija</a></dd>'; ?>
        <?php if($activeMenu=='profile')echo '<dd class="active"><a href="">Profil</a></dd>'; ?>









	      </dl>
 
<?php
  include($includeFile);
?>             

      
  
      
    </div>
  
<div class="four columns">
<h2>Korisnici</h2>
<?php if(is_logged_in()){?><dd<?php if($activeMenu=='admin')echo ' class="active"';?>><a href="?menu=admin"><img src="icons/Box.png" />Administracija</a></dd><?php }?>
	<?php if(is_logged_in()){?><dd><dd<?php if($activeMenu=='profile')echo ' class="active"';?>><a href="?menu=profile"><img src="icons/Person.png" />Profil</a></dd></dd><?php }?>
	<?php if(is_logged_in()){?><dd><dd<?php if($activeMenu=='login')echo ' class="active"';?>><a href="?menu=logout"><img src="icons/Key.png" />Odjava</a><br><a href="http://bugs.plsr.tk/thebuggenie/ldr/issues/new"><img src="icons/Lightning.png" /> Prijavite problem</a></dd></dd><?php }else{?>
	<?php if($activeMenu=='login')echo ' class="active"';?><p><img src="icons/Key.png" />Prijava</p><?php include 'view/login.php'; ?><?php }?>
</div>
</div>
<?php
if(is_logged_in())
{
}
?>
<!-- Included JS Files (Uncompressed) -->
  
  <script src="javascripts/modernizr.foundation.js"></script>
  
  <script src="javascripts/jquery.js"></script>
  
  <script src="javascripts/jquery.foundation.mediaQueryToggle.js"></script>
  
  <script src="javascripts/jquery.foundation.reveal.js"></script>
  
  <script src="javascripts/jquery.foundation.orbit.js"></script>
  
  <script src="javascripts/jquery.foundation.navigation.js"></script>
  
  <script src="javascripts/jquery.foundation.buttons.js"></script>
  
  <script src="javascripts/jquery.foundation.tabs.js"></script>
  
  <script src="javascripts/jquery.foundation.forms.js"></script>
  
  <script src="javascripts/jquery.foundation.tooltips.js"></script>
  
  <script src="javascripts/jquery.foundation.accordion.js"></script>
  
  <script src="javascripts/jquery.placeholder.js"></script>
  
  <script src="javascripts/jquery.foundation.alerts.js"></script>
  
 
  
  <!-- Included JS Files (Compressed) -->
  <script src="javascripts/foundation.min.js"></script>
  
  <!-- Initialize JS Plugins -->
  <script src="javascripts/app.js"></script>

</body>
</html>