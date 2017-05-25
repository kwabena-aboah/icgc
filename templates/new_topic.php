<?php
//This page let users create new topics
include('config.php');
if(isset($_GET['parent']))
{
	$id = intval($_GET['parent']);
if(isset($_SESSION['username']))
{
	$dn1 = mysql_fetch_array(mysql_query('select count(c.id) as nb1, c.name from categories as c where c.id="'.$id.'"'));
if($dn1['nb1']>0)
{
?>
<!DOCTYPE html>
<html>
    <head>
    <!-- meta character set -->
    <meta charset="utf-8">
    <!-- Always force latest IE rendering engine or request Chrome Frame -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>ICGC |New Topic - <?php echo htmlentities($dn1['name'], ENT_QUOTES, 'UTF-8'); ?></title>        
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
        	<a href="<?php echo $url_home; ?>"><img src="../images/icgc2.png" alt="Forum" /><span style="color: #004f2f; border-color: #b0931b;font-weight: bold; font-size:30px;">INTERNATIONAL CENTRAL GOSPLE CHURCH</span></a>
	    </div>
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
        <li class="active"><a href="<?php echo $url_home; ?>" style="color:#fcf8e3;">Home</a>
        </li>
        <li><a href="users.php" style="color:#fcf8e3;">All Users</a></li>
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
if(isset($_POST['message'], $_POST['title']) and $_POST['message']!='' and $_POST['title']!='')
{
	include('bbcode_function.php');
	$title = $_POST['title'];
	$message = $_POST['message'];
	if(get_magic_quotes_gpc())
	{
		$title = stripslashes($title);
		$message = stripslashes($message);
	}
	$title = mysql_real_escape_string($title);
	$message = mysql_real_escape_string(bbcode_to_html($message));
	if(mysql_query('insert into topics (parent, id, id2, title, message, authorid, timestamp, timestamp2) select "'.$id.'", ifnull(max(id), 0)+1, "1", "'.$title.'", "'.$message.'", "'.$_SESSION['userid'].'", "'.time().'", "'.time().'" from topics'))
	{
	?>
	<div class="message">The topic have successfully been created.<br />
	<a href="list_topics.php?parent=<?php echo $id; ?>">Go to the topic</a></div>
	<?php
	}
	else
	{
		echo 'An error occurred while creating the topic.';
	}
}
else
{
?>

<section id="contact">
	<div class="container">
		<div class="row">
			<div class="col-md-11 contact-form wow animated fadeInLeft">
			    <form action="new_topic.php?parent=<?php echo $id; ?>" method="post" style="padding-left: 40px; padding-right: 40px; margin-right: 10px; margin-left: 10px;">
					<input type="text" name="title" id="title" placeholder="Title" class="form-control"/><br />
				    <div class="message_buttons">
				        <input type="button" value="Bold" onclick="javascript:insert('[b]', '[/b]', 'message');" class="btn btn-primary" style="background: #917208;"/><!--
				        --><input type="button" value="Italic" onclick="javascript:insert('[i]', '[/i]', 'message');" class="btn btn-primary" style="background: #917208;"/><!--
				        --><input type="button" value="Underlined" onclick="javascript:insert('[u]', '[/u]', 'message');" class="btn btn-primary" style="background: #917208;"/><!--
				        --><input type="button" value="Image" onclick="javascript:insert('[img]', '[/img]', 'message');" class="btn btn-primary" style="background: #917208;"/><!--
				        --><input type="button" value="Link" onclick="javascript:insert('[url]', '[/url]', 'message');" class="btn btn-primary" style="background: #917208;"/><!--
				        --><input type="button" value="Left" onclick="javascript:insert('[left]', '[/left]', 'message');" class="btn btn-primary" style="background: #917208;"/><!--
				        --><input type="button" value="Center" onclick="javascript:insert('[center]', '[/center]', 'message');" class="btn btn-primary" style="background: #917208;"/><!--
				        --><input type="button" value="Right" onclick="javascript:insert('[right]', '[/right]', 'message');" class="btn btn-primary" style="background: #917208;"/>
				    </div>
				    <textarea name="message" id="message" cols="70" rows="6" placeholder="Message" class="form-control"></textarea><br />
				    <input type="submit" value="Send" class="btn btn-primary" style="background: #004f2f;"/>
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
<script src="../js/functions.js"></script>
</body>
</html>
<?php
}
else
{
	echo '<h2>The category you want to add a topic doesn\'t exist.</h2>';
}
}
else
{
?>
<h2>You must be logged to access this page.</h2>
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
else
{
	echo '<h2>The ID of the category you want to add a topic is not defined.</h2>';
}
?>