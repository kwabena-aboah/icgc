<?php
//This page displays a list of all registered members
include('config.php');
?>
<!DOCTYPE html>
<html>
        <meta charset="utf-8">
        <!-- Always force latest IE rendering engine or request Chrome Frame -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>ICGC | Users</title>      
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
    <body id="body">

    <div class="header">
        <a href="../index.php"><img src="../images/icgc2.png" alt="Forum" />
        <span style="color: #004f2f; border-color: #b0931b;font-weight: bold; font-size:30px;">INTERNATIONAL CENTRAL GOSPLE CHURCH</span></a>
    </div>

        <!--
        Fixed Navigation
        ==================================== -->
            <header class="main-header" style="background: #004f2f; border-color: #b0931b; border-width: 2px;">
              <nav class="navbar navbar-static-top">
                <div class="container-fluid">
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                    <i class="fa fa-bars"></i>
                  </button>
                </div>
                <?php
                if(isset($_SESSION['username']))
                {
                $nb_new_pm = mysql_fetch_array(mysql_query('select count(*) as nb_new_pm from pm where ((user1="'.$_SESSION['userid'].'" and user1read="no") or (user2="'.$_SESSION['userid'].'" and user2read="no")) and id2="1"'));
                $nb_new_pm = $nb_new_pm['nb_new_pm'];
                ?>
                <div class="collapse navbar-collapse" id="navbar-collapse">
                  <ul class="nav navbar-nav">
                    <li class="active"><a href="<?php echo $url_home; ?>">Home</a>
                    </li>
                  </ul>
                  <ul class="nav navbar-nav navbar-right">
                    <li><a href="list_pm.php">Your messages(<?php echo $nb_new_pm; ?>)</a></li>
                    <li><a href="profile.php?id=<?php echo $_SESSION['userid']; ?>"><?php echo htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?></a></li>
                    <li><a href="login.php">(Logout)</a></li>
                  </ul>
                </div>
                </div>
              </nav>
            </header>
                <?php
                }
                else
                {
                ?>
                <?php
                }
                ?>
                <div class="container">
                <section class="panel">
                <header class="panel-heading">
                    <h1>User Logs</h1>
                    <small>Lists of all the users:</small>
                </header>
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                    </tr>
                    </thead>
                <?php
                $req = mysql_query('select id, username, email from users');
                while($dnn = mysql_fetch_array($req))
                {
                ?>
                	<tr>
                    	<td><?php echo $dnn['id']; ?></td>
                    	<td><a href="profile.php?id=<?php echo $dnn['id']; ?>"><?php echo htmlentities($dnn['username'], ENT_QUOTES, 'UTF-8'); ?></a></td>
                    	<td><?php echo htmlentities($dnn['email'], ENT_QUOTES, 'UTF-8'); ?></td>
                    </tr>
                <?php
                }
                ?>
                </table>
            </section>
            </div>

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