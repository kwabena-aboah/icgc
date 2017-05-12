<?php
//This page display the profile of an user
include('config.php');
?>
<!DOCTYPE html>
<html>
    <head>
    <!-- meta character set -->
    <meta charset="utf-8">
    <!-- Always force latest IE rendering engine or request Chrome Frame -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>ICGC | Profile</title>        
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
           <a href="<?php echo $url_home; ?>"><img src="../images/icgc2.png" alt="Forum" /><span style="color: #004f2f; border-color: #b0931b;font-weight: bold; font-size:30px;">INTERNATIONAL CENTRAL GOSPLE CHURCH</span>
           </a>
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
        <li class="active"><a href="<?php echo $url_home; ?>">Home</a>
        </li>
        <li><a href="users.php">All Users</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="list_pm.php">Your messages(<?php echo $nb_new_pm; ?>)</a></li>
        <li><a href="profile.php?id=<?php echo $_SESSION['userid']; ?>"><?php echo htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?></a></li>
        <li><a href="login.php">(Logout)</a></li>
      </ul>
       <div class="clean"></div>
    </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
</header>

<?php
}
else
{
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
        <li class="active"><a href="<?php echo $url_home; ?>">Home</a>
        </li>
        <li><a href="users.php">All Users</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="register.php">Sign Up</a></li>
        <li><a href="login.php">Login</a></li>
      </ul>
       <div class="clean"></div>
    </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
</header>

<?php
}
if(isset($_GET['id']))
{
	$id = intval($_GET['id']);
	$dn = mysql_query('select username, email, avatar, signup_date from users where id="'.$id.'"');
	if(mysql_num_rows($dn)>0)
	{
		$dnn = mysql_fetch_array($dn);
?>
<small style="padding-left: 40px; padding-right: 40px; margin-right: 10px; margin-left: 10px;">This is the profile of "<?php echo htmlentities($dnn['username']); ?>" :</small>
<?php
if($_SESSION['userid']==$id)
{
?>
<br /><div class="well" style="padding-left: 40px; padding-right: 40px; margin-right: 10px; margin-left: 10px;"><a href="edit_profile.php" class="button">Edit my profile</a></div>
<?php
}
?>
<table class="table">
    <thead>
	<tr>
    	<td><?php
if($dnn['avatar']!='')
{
	echo '<img src="'.htmlentities($dnn['avatar'], ENT_QUOTES, 'UTF-8').'" alt="Avatar" style="max-width:100px;max-height:100px;" />';
}
else
{
	echo 'This user has no avatar.';
}
?></td>
    	<td><h1><?php echo htmlentities($dnn['username'], ENT_QUOTES, 'UTF-8'); ?></h1>
    	Email: <?php echo htmlentities($dnn['email'], ENT_QUOTES, 'UTF-8'); ?><br />
        This user joined the website on <?php echo date('Y/m/d',$dnn['signup_date']); ?></td>
    </tr>
    </thead>
</table>
<?php
if(isset($_SESSION['username']) and $_SESSION['username']!=$dnn['username'])
{
?>
<br /><a href="new_pm.php?recip=<?php echo urlencode($dnn['username']); ?>" class="big">Send Message to:"<?php echo htmlentities($dnn['username'], ENT_QUOTES, 'UTF-8'); ?>"</a>
<?php
}
	}
	else
	{
		echo 'This user doesn\'t exist.';
	}
}
else
{
	echo 'The ID of this user is not defined.';
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