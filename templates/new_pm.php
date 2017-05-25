<?php
//This page let create a new personnal message
include('config.php');
?>
<!DOCTYPE html>
<html>
    <head>
    <!-- meta character set -->
    <meta charset="utf-8">
	<!-- Always force latest IE rendering engine or request Chrome Frame -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>ICGC | New Private Message</title>		
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
        <li><a href="list_pm.php" style="color:#fcf8e3;">Your messages(<?php echo $nb_new_pm; ?>)</a></li>
        <li><a href="profile.php?id=<?php echo $_SESSION['userid']; ?>" style="color:#fcf8e3;"><?php echo htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?></a></li>
        <li><a href="login.php" style="color:#fcf8e3;">(Logout)</a></li>
      </ul>
       <div class="clean"></div>
    </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
</header>

<?php
if(isset($_SESSION['username']))
{
$form = true;
$otitle = '';
$orecip = '';
$omessage = '';
if(isset($_POST['title'], $_POST['recip'], $_POST['message']))
{
	$otitle = $_POST['title'];
	$orecip = $_POST['recip'];
	$omessage = $_POST['message'];
	if(get_magic_quotes_gpc())
	{
		$otitle = stripslashes($otitle);
		$orecip = stripslashes($orecip);
		$omessage = stripslashes($omessage);
	}
	if($_POST['title']!='' and $_POST['recip']!='' and $_POST['message']!='')
	{
		$title = mysql_real_escape_string($otitle);
		$recip = mysql_real_escape_string($orecip);
		$message = mysql_real_escape_string(nl2br(htmlentities($omessage, ENT_QUOTES, 'UTF-8')));
		$dn1 = mysql_fetch_array(mysql_query('select count(id) as recip, id as recipid, (select count(*) from pm) as npm from users where username="'.$recip.'"'));
		if($dn1['recip']==1)
		{
			if($dn1['recipid']!=$_SESSION['userid'])
			{
				$id = $dn1['npm']+1;
				if(mysql_query('insert into pm (id, id2, title, user1, user2, message, timestamp, user1read, user2read)values("'.$id.'", "1", "'.$title.'", "'.$_SESSION['userid'].'", "'.$dn1['recipid'].'", "'.$message.'", "'.time().'", "yes", "no")'))
				{
	?>
	<div class="message">The PM have successfully been sent.<br />
	<a href="list_pm.php">List of your Personal Messages</a></div>
	<?php
					$form = false;
				}
				else
				{
					$error = 'An error occurred while sending the PM.';
				}
			}
			else
			{
				$error = 'You cannot send a PM to yourself.';
			}
		}
		else
		{
			$error = 'The recipient of your PM doesn\'t exist.';
		}
	}
	else
	{
		$error = 'A field is not filled.';
	}
}
elseif(isset($_GET['recip']))
{
	$orecip = $_GET['recip'];
}
if($form)
{
if(isset($error))
{
	echo '<div class="message">'.$error.'</div>';
}
?>
<div class="content">
<?php
$nb_new_pm = mysql_fetch_array(mysql_query('select count(*) as nb_new_pm from pm where ((user1="'.$_SESSION['userid'].'" and user1read="no") or (user2="'.$_SESSION['userid'].'" and user2read="no")) and id2="1"'));
$nb_new_pm = $nb_new_pm['nb_new_pm'];
?>

<section id="contact">
	<div class="container">
		<div class="row">
			<div class="col-md-11 contact-form wow animated fadeInLeft">
			    <form action="new_pm.php" method="post" style="padding-left: 40px; padding-right: 40px; margin-right: 10px; margin-left: 10px;">
			    	<h1 class="well">New Private Message</h1>
			        <div class="input-field">
			            <input type="text" value="<?php echo htmlentities($otitle, ENT_QUOTES, 'UTF-8'); ?>" id="title" name="title" placeholder="Title" class="form-control" />
			        </div>
			        <div class="input-field">
			            <input type="text" value="<?php echo htmlentities($orecip, ENT_QUOTES, 'UTF-8'); ?>" id="recip" name="recip" placeholder="Recipent:(username)" class="form-control" >
			        </div>
			        <div class="input-field">
			            <textarea cols="40" rows="5" id="message" name="message" placeholder="Message" class="form-control"><?php echo htmlentities($omessage, ENT_QUOTES, 'UTF-8'); ?></textarea>
			        </div>
			            <input type="submit" value="Send" class="btn btn-primary" style="background: #004f2f;">
			    </form>
			</div>
		</div>
	</div>
</section>
</div>
<?php
}
}
else
{
?>
<div class="message">You must be logged to access this page.</div>
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
			            <input type="checkbox" name="memorize" id="memorize" value="yes" /><label>Keep me logged in.</label>
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