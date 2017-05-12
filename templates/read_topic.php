<?php
//This page display a topic
include('config.php');
if(isset($_GET['id']))
{
	$id = intval($_GET['id']);
	$dn1 = mysql_fetch_array(mysql_query('select count(t.id) as nb1, t.title, t.parent, count(t2.id) as nb2, c.name from topics as t, topics as t2, categories as c where t.id="'.$id.'" and t.id2=1 and t2.id="'.$id.'" and c.id=t.parent group by t.id'));
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
        <title><?php echo htmlentities($dn1['title'], ENT_QUOTES, 'UTF-8'); ?> - <?php echo htmlentities($dn1['name'], ENT_QUOTES, 'UTF-8'); ?> - Forum</title>
    </head>
            <body id="body">
            
            <div class="header">
                <a href="../index.php"><img src="../images/icgc2.png" alt="Forum" />
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
                    <li><a href="list_topics.php?parent=<?php echo $dn1['parent']; ?>"><?php echo htmlentities($dn1['name'], ENT_QUOTES, 'UTF-8'); ?>List Topics</a></li>
                    <li><a href="read_topic.php?id=<?php echo $id; ?>"><?php echo htmlentities($dn1['title'], ENT_QUOTES, 'UTF-8'); ?></a></li>
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
                    <li><a href="list_topics.php?parent=<?php echo $dn1['parent']; ?>"><?php echo htmlentities($dn1['name'], ENT_QUOTES, 'UTF-8'); ?>List Topics</a></li>
                    <li><a href="read_topic.php?id=<?php echo $id; ?>"><?php echo htmlentities($dn1['title'], ENT_QUOTES, 'UTF-8'); ?></a></li>
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
            <div class="container">
            <header class="panel-heading">
                <h1 class="well"><?php echo $dn1['title']; ?></h1>
            </header>
            <?php
            if(isset($_SESSION['username']))
            {
            ?>
            	<a href="new_reply.php?id=<?php echo $id; ?>" class="btn btn-primary" style="background: #004f2f;">Reply</a>
            <?php
            }
            $dn2 = mysql_query('select t.id2, t.authorid, t.message, t.timestamp, u.username as author, u.avatar from topics as t, users as u where t.id="'.$id.'" and u.id=t.authorid order by t.timestamp asc');
            ?>

            <table class="table">
                <thead>
            	<tr>
                	<th class="author">Author</th>
                	<th>Message</th>
            	</tr>
                </thead>
            <?php
            while($dnn2 = mysql_fetch_array($dn2))
            {
            ?>
            	<tr>
                	<td class="author center"><?php
            if($dnn2['avatar']!='')
            {
            	echo '<img src="'.htmlentities($dnn2['avatar']).'" alt="Image Perso" style="max-width:100px;max-height:100px;" />';
            }
            ?>
            <br /><a href="profile.php?id=<?php echo $dnn2['authorid']; ?>"><?php echo $dnn2['author']; ?></a></td>
                	<td class="left"><?php if(isset($_SESSION['username']) and ($_SESSION['username']==$dnn2['author'] or $_SESSION['username']==$admin)){ ?><div class="edit"><a href="edit_message.php?id=<?php echo $id; ?>&id2=<?php echo $dnn2['id2']; ?>"><img src="<?php echo $design; ?>/images/edit.png" alt="Edit" /></a></div><?php } ?><div class="date">Date sent: <?php echo date('Y/m/d H:i:s' ,$dnn2['timestamp']); ?></div>
                    <div class="clean"></div>
                	<?php echo $dnn2['message']; ?></td>
                </tr>
            <?php
            }
            ?>
            </table>
            <?php
            if(isset($_SESSION['username']))
            {
            ?>
            	<a href="new_reply.php?id=<?php echo $id; ?>" class="btn btn-primary" style="background: #004f2f;">Reply</a>
            <?php
            }
            else
            {
            ?>
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
            </div>
            <br>
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
            <?php
            }
            else
            {
            	echo '<h2>This topic doesn\'t exist.</h2>';
            }
            }
            else
            {
            	echo '<h2>The ID of this topic is not defined.</h2>';
            }
            ?>