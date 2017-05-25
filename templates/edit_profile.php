<?php
//This page let an user edit his profile
include('config.php');
?>
<!DOCTYPE html>
<html>
    <head>
    <!-- meta character set -->
    <meta charset="utf-8">
    <!-- Always force latest IE rendering engine or request Chrome Frame -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>ICGC | Edit your profile</title>        
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
	        <a href="<?php echo $url_home; ?>"><img src="../images/icgc2.png" alt="Forum" />
	        <span style="color: #004f2f; border-color: #b0931b;font-weight: bold; font-size:30px;">INTERNATIONAL CENTRAL GOSPLE CHURCH</span></a>
	    </div>
    <div class="content"> 
<?php
if(isset($_SESSION['username']))
{
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
        <li class="active"><a href="<?php echo $url_home; ?>" style="color:#fcf8e3;">Forum Index</a>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="list_pm.php" style="color:#fcf8e3;">Your messages(<?php echo $nb_new_pm; ?>)</a></li>
        <li><a href="profile.php?id=<?php echo $_SESSION['userid']; ?>" style="color:#fcf8e3;"><?php echo htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?></a></li>         
        <li><a href="register.php" style="color:#fcf8e3;">Register</a></li>
      </ul>
       <div class="clean"></div>
    </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
</header>
<?php
	if(isset($_POST['username'], $_POST['password'], $_POST['passverif'], $_POST['email'], $_POST['avatar']))
	{
		if(get_magic_quotes_gpc())
		{
			$_POST['username'] = stripslashes($_POST['username']);
			$_POST['password'] = stripslashes($_POST['password']);
			$_POST['passverif'] = stripslashes($_POST['passverif']);
			$_POST['email'] = stripslashes($_POST['email']);
			$_POST['avatar'] = stripslashes($_POST['avatar']);
		}
		if($_POST['password']==$_POST['passverif'])
		{
			if(strlen($_POST['password'])>=6)
			{
				if(preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',$_POST['email']))
				{
					$username = mysql_real_escape_string($_POST['username']);
					$password = mysql_real_escape_string(sha1($_POST['password']));
					$email = mysql_real_escape_string($_POST['email']);
					$avatar = mysql_real_escape_string($_POST['avatar']);
					$dn = mysql_fetch_array(mysql_query('select count(*) as nb from users where username="'.$username.'"'));
					if($dn['nb']==0 or $_POST['username']==$_SESSION['username'])
					{
						if(mysql_query('update users set username="'.$username.'", password="'.$password.'", email="'.$email.'", avatar="'.$avatar.'" where id="'.mysql_real_escape_string($_SESSION['userid']).'"'))
						{
							$form = false;
							unset($_SESSION['username'], $_SESSION['userid']);
?>
<div class="message">Your profile have successfully been edited. You must login again.<br />
<a href="login.php">Login</a></div>
<?php
						}
						else
						{
							$form = true;
							$message = 'An error occured while editing your profile.';
						}
					}
					else
					{
						$form = true;
						$message = 'Another user already uses this username.';
					}
				}
				else
				{
					$form = true;
					$message = 'The email you typed is not valid.';
				}
			}
			else
			{
				$form = true;
				$message = 'Your password must have a minimum of 6 characters.';
			}
		}
		else
		{
			$form = true;
			$message = 'The passwords you entered are not identical.';
		}
	}
	else
	{
		$form = true;
	}
	if($form)
	{
		if(isset($message))
		{
			echo '<strong>'.$message.'</strong>';
		}
		if(isset($_POST['username'],$_POST['password'],$_POST['email']))
		{
			$username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8');
			if($_POST['password']==$_POST['passverif'])
			{
				$password = htmlentities($_POST['password'], ENT_QUOTES, 'UTF-8');
			}
			else
			{
				$password = '';
			}
			$email = htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8');
			$avatar = htmlentities($_POST['avatar'], ENT_QUOTES, 'UTF-8');
		}
		else
		{
			$dnn = mysql_fetch_array(mysql_query('select username,email,avatar from users where username="'.$_SESSION['username'].'"'));
			$username = htmlentities($dnn['username'], ENT_QUOTES, 'UTF-8');
			$password = '';
			$email = htmlentities($dnn['email'], ENT_QUOTES, 'UTF-8');
			$avatar = htmlentities($dnn['avatar'], ENT_QUOTES, 'UTF-8');
		}
?>
<section id="contact">
	<div class="container">
		<div class="row">
			<div class="col-md-11 contact-form wow animated fadeInLeft">
			<form action="edit_profile.php" method="post" style="padding-left: 40px; padding-right: 40px; margin-right: 10px; margin-left: 10px;">
		        <h1 class="well">You can edit your informations:</h1>
		        <div class="input-field">
		            <input type="text" name="username" id="username" placeholder="Username" class="form-control" value="<?php echo $username; ?>" required/>
		        </div>
		        <div class="input-field">
		        	<input type="password" placeholder="Password" class="form-control" name="password" id="password" value="<?php echo $password; ?>" required min-length="6" />
		        </div>
		        <div class="input-field">
		            <input type="password" placeholder="Password(verification)" class="form-control" name="passverif" id="passverif" value="<?php echo $password; ?>" required min-length="6" />
		        </div>
		        <div class="input-field">
		            <input type="text" name="email" placeholder="Email Address" class="form-control" id="email" value="<?php echo $email; ?>" required/>
		        </div>
		        <div class="input-field">
		            <input type="text" name="avatar" placeholder="Avatar(optional)" class="form-control" id="avatar" value="<?php echo $avatar; ?>" />
		        </div>
		            <input type="submit" value="Submit" class="btn btn-primary" style="background: #004f2f;"/>
		        </div>
		    </form>
			</div>
		</div>
	</div>
</section>		
<?php
	}
}
else
{
?>
<h2>You must be logged to access this page:</h2>
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
?>
</div>
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