<?php
//This page display a personnal message
include('config.php');
?>
<!DOCTYPE html>
<html>
    <head>
    <!-- meta character set -->
    <meta charset="utf-8">
    <!-- Always force latest IE rendering engine or request Chrome Frame -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>ICGC | Read Private Message</title>       
    <!-- Meta Description -->
    <meta name="description" content="ICGC Church Management System Template">
    <meta name="keywords" content="mission, vision, objectives, departments, men fellowship, women fellowship, children service, youth service, music team, Pastors and Leaders">
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
if(isset($_SESSION['username']))
{
if(isset($_GET['id']))
{
$id = intval($_GET['id']);
$req1 = mysql_query('select title, user1, user2 from pm where id="'.$id.'" and id2="1"');
$dn1 = mysql_fetch_array($req1);
if(mysql_num_rows($req1)==1)
{
if($dn1['user1']==$_SESSION['userid'] or $dn1['user2']==$_SESSION['userid'])
{
if($dn1['user1']==$_SESSION['userid'])
{
	mysql_query('update pm set user1read="yes" where id="'.$id.'" and id2="1"');
	$user_partic = 2;
}
else
{
	mysql_query('update pm set user2read="yes" where id="'.$id.'" and id2="1"');
	$user_partic = 1;
}
$req2 = mysql_query('select pm.timestamp, pm.message, users.id as userid, users.username, users.avatar from pm, users where pm.id="'.$id.'" and users.id=pm.user1 order by pm.id2');
if(isset($_POST['message']) and $_POST['message']!='')
{
	$message = $_POST['message'];
	if(get_magic_quotes_gpc())
	{
		$message = stripslashes($message);
	}
	$message = mysql_real_escape_string(nl2br(htmlentities($message, ENT_QUOTES, 'UTF-8')));
	if(mysql_query('insert into pm (id, id2, title, user1, user2, message, timestamp, user1read, user2read)values("'.$id.'", "'.(intval(mysql_num_rows($req2))+1).'", "", "'.$_SESSION['userid'].'", "", "'.$message.'", "'.time().'", "", "")') and mysql_query('update pm set user'.$user_partic.'read="yes" where id="'.$id.'" and id2="1"'))
	{
?>
<div class="message">Your reply has successfully been sent.<br />
<a href="read_pm.php?id=<?php echo $id; ?>">Go to the PM</a></div>
<?php
	}
	else
	{
?>
<div class="message">An error occurred while sending the reply.<br />
<a href="read_pm.php?id=<?php echo $id; ?>">Go to the PM</a></div>
<?php
	}
}
else
{
?>
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
        <li class="active"><a href="../index.php">Forum Index</a>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="list_pm.php">Your messages(<?php echo $nb_new_pm; ?>)</a></li>
        <li><a href="profile.php?id=<?php echo $_SESSION['userid']; ?>"><?php echo htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?></a></li>
        <li><a href="login.php">Login</a></li>
      </ul>
       <div class="clean"></div>
    </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
</header>
<?php
}
?>
<h1><?php echo $dn1['title']; ?></h1>
<table class="table">
    <thead>
    	<tr>
        	<th class="author">User</th>
            <th>Message</th>
        </tr>
    </thead>
<?php
while($dn2 = mysql_fetch_array($req2))
{
?>
<thead>
	<tr>
    	<td class="author center"><?php
if($dn2['avatar']!='')
{
	echo '<img src="'.htmlentities($dn2['avatar']).'" alt="Image Perso" style="max-width:100px;max-height:100px;" />';
}
?><br /><a href="profile.php?id=<?php echo $dn2['userid']; ?>"><?php echo $dn2['username']; ?></a></td>
    	<td class="left"><div class="date">Date sent: <?php echo date('Y/m/d H:i:s' ,$dn2['timestamp']); ?></div>
    	<?php echo $dn2['message']; ?></td>
    </tr>
</thead>
<?php
}
?>
</table>

<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-md-11 contact-form wow animated fadeInLeft">
                <form action="read_pm.php?id=<?php echo $id; ?>" method="post" style="padding-left: 40px; padding-right: 40px; margin-right: 10px; margin-left: 10px;">
                    <h2 class="well">Reply</h2>
                    <div class="input-field">
                        <textarea cols="40" rows="5" name="message" id="message" class="form-control" placeholder="Message" required></textarea>
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
	echo '<div class="message">You don\'t have the right to access this page.</div>';
}
}
else
{
	echo '<div class="message">This message doesn\'t exist.</div>';
}
}
else
{
	echo '<div class="message">The ID of this message is not defined.</div>';
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