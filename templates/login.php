<?php
//This page let log in
include('config.php');
if(isset($_SESSION['username']))
{
	unset($_SESSION['username'], $_SESSION['userid']);
	setcookie('username', '', time()-100);
	setcookie('password', '', time()-100);
?>
<!DOCTYPE html>
<html>
    <head>
   	<!-- meta character set -->
    <meta charset="utf-8">
	<!-- Always force latest IE rendering engine or request Chrome Frame -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>ICGC | User Login</title>		
	<!-- Meta Description -->
    <meta name="description" content="ICGC Church Management System Template">
    <meta name="keywords" content="mission, vission, objectives, departments, men fellowship, women fellowship, children service, youth service, music team, Pastors and Leaders">
    <meta name="author" content="Brainstien">
	
	<!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- CSS
	================================================== -->
	
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
	
	<!-- Fontawesome Icon font -->
    <link rel="stylesheet" href="../css/font-awesome.min.css">
	<!-- bootstrap.min -->
    <link rel="stylesheet" href="../css/jquery.fancybox.css">
	<!-- bootstrap.min -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
	<!-- bootstrap.min -->
    <link rel="stylesheet" href="../css/owl.carousel.css">
	<!-- bootstrap.min -->
    <link rel="stylesheet" href="../css/slit-slider.css">
	<!-- bootstrap.min -->
    <link rel="stylesheet" href="../css/animate.css">
	<!-- Main Stylesheet -->
    <link rel="stylesheet" href="../css/main.css">

	<!-- Modernizer Script for old Browsers -->
    <script src="../js/modernizr-2.6.2.min.js"></script>
    </head>
    <body>
    	<div class="header">
        	<a href="<?php echo $url_home; ?>"><img src="../images/icgc2.png" alt="Forum" /><span style="color: #004f2f; border-color: #b0931b;font-weight: bold; font-size:30px;">INTERNATIONAL CENTRAL GOSPLE CHURCH</span></a>
	    </div>
	    <div class="jumboton wow animated fadeInLeft">
			<div class="message wow animated fadeInLeft">You have successfully been logged out.<br />
			<a href="../index.php" class="wow animated fadeInLeft">Home</a></div>
		</div>
<?php
}
else
{
	$ousername = '';
	if(isset($_POST['username'], $_POST['password']))
	{
		if(get_magic_quotes_gpc())
		{
			$ousername = stripslashes($_POST['username']);
			$username = mysql_real_escape_string(stripslashes($_POST['username']));
			$password = stripslashes($_POST['password']);
		}
		else
		{
			$username = mysql_real_escape_string($_POST['username']);
			$password = $_POST['password'];
		}
		$req = mysql_query('select password,id from users where username="'.$username.'"');
		$dn = mysql_fetch_array($req);
		if($dn['password']==sha1($password) and mysql_num_rows($req)>0)
		{
			$form = false;
			$_SESSION['username'] = $_POST['username'];
			$_SESSION['userid'] = $dn['id'];
			if(isset($_POST['memorize']) and $_POST['memorize']=='yes')
			{
				$one_year = time()+(60*60*24*365);
				setcookie('username', $_POST['username'], $one_year);
				setcookie('password', sha1($password), $one_year);
			}
?>
<!DOCTYPE html>
<html>
    <head>
   	<!-- meta character set -->
    <meta charset="utf-8">
	<!-- Always force latest IE rendering engine or request Chrome Frame -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>ICGC | User Login</title>		
	<!-- Meta Description -->
    <meta name="description" content="ICGC Church Management System Template">
    <meta name="keywords" content="mission, vission, objectives, departments, men fellowship, women fellowship, children service, youth service, music team, Pastors and Leaders">
    <meta name="author" content="Brainstien">
	
	<!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- CSS
	================================================== -->
	
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
	
	<!-- Fontawesome Icon font -->
    <link rel="stylesheet" href="../css/font-awesome.min.css">
	<!-- bootstrap.min -->
    <link rel="stylesheet" href="../css/jquery.fancybox.css">
	<!-- bootstrap.min -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
	<!-- bootstrap.min -->
    <link rel="stylesheet" href="../css/owl.carousel.css">
	<!-- bootstrap.min -->
    <link rel="stylesheet" href="../css/slit-slider.css">
	<!-- bootstrap.min -->
    <link rel="stylesheet" href="../css/animate.css">
	<!-- Main Stylesheet -->
    <link rel="stylesheet" href="../css/main.css">

	<!-- Modernizer Script for old Browsers -->
    <script src="../js/modernizr-2.6.2.min.js"></script>
    </head>
    <body>
    	<div class="header">
			<a href="../index.php"><img src="../images/icgc2.png" alt="Forum" />
			<span style="color: #004f2f; border-color: #b0931b;font-weight: bold; font-size:30px;">INTERNATIONAL CENTRAL GOSPLE CHURCH</span></a>
		</div>
		<div class="jumboton wow animated fadeInLeft">
			<div class="message">You have successfully been logged.<br/>
			<a href="<?php echo $url_home; ?>">Yay!!</a></div>
		</div>
<?php
		}
		else
		{
			$form = true;
			$message = 'The username or password you entered are not good.';
		}
	}
	else
	{
		$form = true;
	}
	if($form)
	{
?>
<!DOCTYPE html>
<html>
    <head>
   	<!-- meta character set -->
    <meta charset="utf-8">
	<!-- Always force latest IE rendering engine or request Chrome Frame -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>ICGC | User Login</title>		
	<!-- Meta Description -->
    <meta name="description" content="ICGC Church Management System Template">
    <meta name="keywords" content="mission, vission, objectives, departments, men fellowship, women fellowship, children service, youth service, music team, Pastors and Leaders">
    <meta name="author" content="Brainstien">
	
	<!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- CSS
	================================================== -->
	
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
	
	<!-- Fontawesome Icon font -->
    <link rel="stylesheet" href="../css/font-awesome.min.css">
	<!-- bootstrap.min -->
    <link rel="stylesheet" href="../css/jquery.fancybox.css">
	<!-- bootstrap.min -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
	<!-- bootstrap.min -->
    <link rel="stylesheet" href="../css/owl.carousel.css">
	<!-- bootstrap.min -->
    <link rel="stylesheet" href="../css/slit-slider.css">
	<!-- bootstrap.min -->
    <link rel="stylesheet" href="../css/animate.css">
	<!-- Main Stylesheet -->
    <link rel="stylesheet" href="../css/main.css">

	<!-- Modernizer Script for old Browsers -->
    <script src="../js/modernizr-2.6.2.min.js"></script>
    </head>

    <body id="body">
	<div class="header">
		<a href="../index.php"><img src="../images/icgc2.png" alt="Forum" />
		<span style="color: #004f2f; border-color: #b0931b;font-weight: bold; font-size:30px;">INTERNATIONAL CENTRAL GOSPLE CHURCH</span></a>
	</div>
<?php
if(isset($message))
{
	echo '<div class="message">'.$message.'</div>';
}
?>
<div class="content">
<?php
$nb_new_pm = mysql_fetch_array(mysql_query('select count(*) as nb_new_pm from pm where ((user1="'.$_SESSION['userid'].'" and user1read="no") or (user2="'.$_SESSION['userid'].'" and user2read="no")) and id2="1"'));
$nb_new_pm = $nb_new_pm['nb_new_pm'];
?>

<header class="main-header" style="background: #004f2f; border-color: #b0931b; border-width: 2px;">
  <nav class="navbar navbar-static-top">
    <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
        <i class="fa fa-bars"></i>
      </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="navbar-collapse">
      <ul class="nav navbar-nav">
        <li class="active"><a href="../index.php">Forum Index</a>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <!-- <li><a href="list_pm.php">Your messages(<?php echo $nb_new_pm; ?>)</a></li>
        <li><a href="profile.php?id=<?php echo $_SESSION['userid']; ?>"><?php echo htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?></a></li> -->
        <li><a href="register.php">Register</a></li>
      </ul>
       <div class="clean"></div>
    </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
</header>

<section id="contact">
	<div class="container">
		<div class="row">
			<div class="col-md-11 contact-form wow animated fadeInLeft">
			    <form action="login.php" method="post" style="padding-left: 40px; padding-right: 40px; margin-right: 10px; margin-left: 10px;">
			    	<h1 class="well">Login Page</h1>
			        <div class="input-field">
			            <input type="text" name="username" id="username" placeholder="Username" class="form-control" value="<?php echo htmlentities($ousername, ENT_QUOTES, 'UTF-8'); ?>" />
			        </div>
			        <div class="input-field">
			            <input type="password" name="password" class="form-control" placeholder="Password" minlength="6 characters" required/>
			        </div>
			        <div class="input-field">
			            <input type="checkbox" name="memorize" id="memorize" value="yes"/><label>Keep me logged in.</label>
			        </div>
			            <input type="submit" value="Login" class="btn btn-primary" style="background: #004f2f;">
			    </form>
			</div>
		</div>
	</div>
</section>
<?php
	}
}
?>

<!-- Essential jQuery Plugins
================================================== -->
<!-- Main jQuery -->
<script src="../js/jquery-1.11.1.min.js"></script>
<!-- Twitter Bootstrap -->
<script src="../js/bootstrap.min.js"></script>
<!-- Single Page Nav -->
<script src="../js/jquery.singlePageNav.min.js"></script>
<!-- jquery.fancybox.pack -->
<script src="../js/jquery.fancybox.pack.js"></script>
<!-- Google Map API -->
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<!-- Owl Carousel -->
<script src="../js/owl.carousel.min.js"></script>
<!-- jquery easing -->
<script src="../js/jquery.easing.min.js"></script>
<!-- Fullscreen slider -->
<script src="../js/jquery.slitslider.js"></script>
<script src="../js/jquery.ba-cond.min.js"></script>
<!-- onscroll animation -->
<script src="../js/wow.min.js"></script>
<!-- Custom Functions -->
<script src="../js/main.js"></script>
</body>
</html>