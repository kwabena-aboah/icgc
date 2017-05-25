<?php
//This page let users sign up
include('config.php');
?>
<!--[if lt IE 7]>      <html lang="en" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html lang="en" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html lang="en" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
    <head>
    <!-- meta character set -->
    <meta charset="utf-8">
	<!-- Always force latest IE rendering engine or request Chrome Frame -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>ICGC | Register User</title>		
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
		<a href="../index.php"><img src="../images/icgc2.png" alt="Forum" /><span style="color: #004f2f; border-color: #b0931b;font-weight: bold; font-size:30px;">INTERNATIONAL CENTRAL GOSPLE CHURCH</span></a>
	</div>

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
        <li class="active"><a href="../index.php" style="color:#fcf8e3;">Forum Index</a>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <!-- <li><a href="list_pm.php">Your messages(<?php echo $nb_new_pm; ?>)</a></li>
        <li><a href="profile.php?id=<?php echo $_SESSION['userid']; ?>"><?php echo htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?></a></li> -->
        <li><a href="login.php" style="color:#fcf8e3;">Login</a></li>
      </ul>
       <div class="clean"></div>
    </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
</header>

<?php
if(isset($_POST['username'], $_POST['password'], $_POST['passverif'], $_POST['email'], $_POST['avatar']) and $_POST['username']!='')
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
				$dn = mysql_num_rows(mysql_query('select id from users where username="'.$username.'"'));
				if($dn==0)
				{
					$dn2 = mysql_num_rows(mysql_query('select id from users'));
					$id = $dn2+1;
					if(mysql_query('insert into users(id, username, password, email, avatar, signup_date) values ('.$id.', "'.$username.'", "'.$password.'", "'.$email.'", "'.$avatar.'", "'.time().'")'))
					{
						$form = false;
?>
<div class="message">You have successfully been signed up. You can now log in.<br />
<!-- <a href="login.php">Log in</a></div> -->
<?php
					}
					else
					{
						$form = true;
						$message = 'An error occurred while signing you up.';
					}
				}
				else
				{
					$form = true;
					$message = 'Another user already use this username.';
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
		echo '<div class="message">'.$message.'</div>';
	}
?>
<section id="contact">
	<div class="container">
		<div class="row">
			<div class="col-md-11 contact-form wow animated fadeInLeft">
			    <form action="register.php" method="post" style="padding-left: 40px; padding-right: 40px; margin-right: 10px; margin-left: 10px;">
			        <div class="input-field">
			            <input type="text" name="username" class="form-control" placeholder="Username" required value="<?php if(isset($_POST['username'])){echo htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8');} ?>" />
			        </div>
			        <div class="input-field">
			            <input type="password" name="password" class="form-control" placeholder="Password" minlength="6 characters" required/>
			        </div>
			        <div class="input-field">
			            <input type="password" name="passverif" class="form-control" required placeholder="Password: (verification)" />
			        </div>
			        <div class="input-field">
			            <input type="text" name="email" class="form-control" placeholder="Email" required value="<?php if(isset($_POST['email'])){echo htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8');} ?>" />
			        </div>
			        <div class="input-field">
			            <input type="text" name="avatar" class="form-control" placeholder="Avatar: (optional)" value="<?php if(isset($_POST['avatar'])){echo htmlentities($_POST['avatar'], ENT_QUOTES, 'UTF-8');} ?>" />
			        </div>
			            <input type="submit" value="Sign Up" class="btn btn-primary" style="background: #004f2f;">
			    </form>
			</div>
		</div>
	</div>
</section>

</main>
<?php
}
?>

	<!-- Main footer here -->
	<footer id="footer">
		<div class="container">
			<div class="row text-center">
				<div class="footer-content">
					<p>Design And developed By <small>Micheal and Dorcas</small>. All rights Reserved</p>
				</div>
			</div>
		</div>
	</footer>
		
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