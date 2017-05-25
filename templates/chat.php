<?php
//This page displays the list of the forum's categories
include('config.php');
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
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="list_pm.php" style="color:#fcf8e3;">Your messages(<?php echo $nb_new_pm; ?>)</a></li>
        <li><a href="profile.php?id=<?php echo $_SESSION['userid']; ?>" style="color:#fcf8e3;"><?php echo htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?></a></li>
        <li><a href="login.php" style="color:#fcf8e3;">(Logout)</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
</header>

<div class="content">
<?php
if(isset($_SESSION['username']))
{
$nb_new_pm = mysql_fetch_array(mysql_query('select count(*) as nb_new_pm from pm where ((user1="'.$_SESSION['userid'].'" and user1read="no") or (user2="'.$_SESSION['userid'].'" and user2read="no")) and id2="1"'));
$nb_new_pm = $nb_new_pm['nb_new_pm'];
?>

<?php
}
else
{
?>
<div class="header">
    <a href="<?php echo $url_home; ?>"><img src="../images/icgc2.png" alt="Forum" /></a>
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
        <li class="active"><a href="<?php echo $url_home; ?>" style="color:#fcf8e3;">Home</a>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="list_pm.php" style="color:#fcf8e3;">Your messages(<?php echo $nb_new_pm; ?>)</a></li>
        <li><a href="profile.php?id=<?php echo $_SESSION['userid']; ?>" style="color:#fcf8e3;"><?php echo htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?></a></li>
        <li><a href="login.php" style="color: #fcf8e3;">(Logout)</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
</header>
<?php
}
if(isset($_SESSION['username']) and $_SESSION['username']==$admin)
{
?>
    <div class="container">
    <a href="new_category.php" class="btn btn-success" style="background: #004f2f;">New Group</a>
<?php
}
?>
<table class="table">
<thead>
    <tr>
        <th class="forum_cat">Group</th>
        <th class="forum_ntop">Topics</th>
        <th class="forum_nrep">Replies</th>
<?php
if(isset($_SESSION['username']) and $_SESSION['username']==$admin)
{
?>
        <th class="forum_act">Action</th>
<?php
}
?>
    </tr>
</thead>
<?php
$dn1 = mysql_query('select c.id, c.name, c.description, c.position, (select count(t.id) from topics as t where t.parent=c.id and t.id2=1) as topics, (select count(t2.id) from topics as t2 where t2.parent=c.id and t2.id2!=1) as replies from categories as c group by c.id order by c.position asc');
$nb_cats = mysql_num_rows($dn1);
while($dnn1 = mysql_fetch_array($dn1))
{
?>
    <thead>
    <tr>
        <td class="forum_cat"><a href="list_topics.php?parent=<?php echo $dnn1['id']; ?>" class="title"><?php echo htmlentities($dnn1['name'], ENT_QUOTES, 'UTF-8'); ?></a>
        <div class="description"><?php echo $dnn1['description']; ?></div></td>
        <td><?php echo $dnn1['topics']; ?></td>
        <td><?php echo $dnn1['replies']; ?></td>
<?php
if(isset($_SESSION['username']) and $_SESSION['username']==$admin)
{
?>
        <td><a href="delete_category.php?id=<?php echo $dnn1['id']; ?>" class="fa fa-minus-circle" style="background: #d0524f; color: white; size:20px; font-size: 20px;">Delete</a>
        <?php if($dnn1['position']>1){ ?><a href="move_category.php?action=up&id=<?php echo $dnn1['id']; ?>" class="glyphicon glyphicon-move"></a><?php } ?>
        <?php if($dnn1['position']<$nb_cats){ ?><a href="move_category.php?action=down&id=<?php echo $dnn1['id']; ?>" class="glyphicon glyphicon-move"></a><?php } ?>
        <a href="edit_category.php?id=<?php echo $dnn1['id']; ?>" class="fa fa-plus-circle" style="background: #004f2f; color: white; size:20px; font-size: 20px;">Edit</a></td>
<?php
}
?>
    </tr>
    </thead>
<?php
}
?>
</table>

<?php
if(isset($_SESSION['username']) and $_SESSION['username']==$admin)
{
?>
    <!-- <a href="new_category.php" class="btn btn-success" style="background: #004f2f;">New Category</a> -->
<?php
}
if(!isset($_SESSION['username']))
{
?>
<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-md-11 contact-form wow animated fadeInLeft">
                <form action="login.php" method="post" style="padding-left: 40px; padding-right: 40px; margin-right: 10px; margin-left: 10px;">
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
</div>
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
