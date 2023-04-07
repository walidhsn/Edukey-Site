<?php
include_once 'C:\xampp\htdocs\mycruds\config.php';
include_once 'C:\xampp\htdocs\mycruds\Controller\UserC.php';
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit;
}

$userC = new UserC();
$ban_check=$userC->chercher_user($_SESSION['id']);
		if($ban_check['ban'])
		{
			session_start();
			session_unset();
			session_destroy();
			header('Location:page-login.php?error=Your Account Has been Banned by The Admin , Contact us for more information.');
		}
$row = $userC->chercher_user($_SESSION['id']);
$pic = $userC->display_img($_SESSION['id']);
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>My Profile</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
	<!-- style -->
	<link rel="shortcut icon" href="img/favicon.png">
	<link rel="stylesheet" href="css/font-awesome.css">
	<link rel="stylesheet" href="css/select2.css">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="tuner/css/colorpicker.css" />
	<link rel="stylesheet" type="text/css" href="tuner/css/styles.css" />
	<link rel="stylesheet" type="text/css" href="css/jquery.fancybox.css" />
	<link rel="stylesheet" href="css/owl.carousel.css">
	<!--styles -->
	<script src="js/register_formateur.js"></script>
</head>
<body >
	<!-- page header -->
	<header class="only-color">
		<!-- header top panel -->
		<div class="page-header-top">
			<div class="grid-row clear-fix">
				<address>
					<a href="tel:123456" class="phone-number"><i class="fa fa-phone"></i>123456</a>
					<a href="mailto:edukey@gamil.com" class="email"><i class="fa fa-envelope-o"></i>edukey.site@gmail.com</a>
					<?php if (isset($_SESSION['loggedin'])) : ?>
						<p>Welcome <b style="color:yellow;"><?=$_SESSION['ocupation']?></b>,<b> <?=$_SESSION['name']?> </b></p>
					<?php endif; ?>
				</address>
				<div class="header-top-panel">
					<?php if (isset($_SESSION['loggedin'])) : ?>
						<a href="logout.php" style="position: relative; left:30px;" class="cws-button border-radius alt smaller">LOGOUT</a>
					<?php endif; ?>
					<div id="top_social_links_wrapper">
					    <div class="share-toggle-button"><i class="share-icon fa fa-share-alt"></i></div>
					    <div class="cws_social_links"><a href="https://plus.google.com/" class="cws_social_link" title="Google +"><i class="share-icon fa fa-google-plus" style="transform: matrix(0, 0, 0, 0, 0, 0);"></i></a><a href="http://twitter.com/" class="cws_social_link" title="Twitter"><i class="share-icon fa fa-twitter"></i></a><a href="http://facebook.com" class="cws_social_link" title="Facebook"><i class="share-icon fa fa-facebook"></i></a><a href="http://dribbble.com" class="cws_social_link" title="Dribbble"><i class="share-icon fa fa-dribbble"></i></a></div>
					</div>
					<a href="#" class="search-open"><i class="fa fa-search"></i></a>
					<form enctype="multipart/form-data" action="#" class="clear-fix">
						<input type="text" placeholder="Search" class="clear-fix">
					</form>
					
				</div>
			</div>
		</div>
		<!-- / header top panel -->
		<!-- sticky menu -->
		<div class="sticky-wrapper">
			<div class="sticky-menu">
				<div class="grid-row clear-fix">
					<!-- logo -->
					<a href="index.php" class="logo">
						<img src="img/logo.png"  data-at2x="img/logo@2x.png" alt>
						<h1>EduKey</h1>
					</a>
					<!-- / logo -->
				</div>
			</div>
		</div>
		<div class="page-title">
			<div class="grid-row">
				<h1>Profile</h1>
				<nav class="bread-crumb">
					<a href="index.php">Home</a>
					<i class="fa fa-long-arrow-right"></i>
					<a href="profil.php">Profile</a>
				</nav>
			</div>
		</div>
    </header>
   
	<?php if (!$pic) : ?>
	<div class="img-float-right" style="position: relative; right: 180px; top:50px;" ><img src="Users_img\user.png" class="border-img" width="250" height="250"  alt></div>
	<?php else : ?>
	<div class="img-float-right" style="position: relative; right: 180px; top:50px;" ><img src="<?=$pic['img']?>" class="border-img" width="250" height="250"  alt="<?=$pic['name_img']?>"></div>
	<?php endif; ?>			
    <div class="content" style="position: relative; left: 180px; bottom: 210px;">
			<h2>Profile Page</h2>
			<div>
			
			
				<p>Your account details are below:</p>
				<table>
                    <tr>
						<td>CIN :</td>
						<td><?=$row['cin']?></td>
					</tr>
                    <tr>
						<td>Name :</td>
						<td><?=$row['nom']?></td>
					</tr>
                    <tr>
						<td>Name :</td>
						<td><?=$row['prenom']?></td>
					</tr>
					<tr>
						<td>Username :</td>
						<td><?=$_SESSION['name']?></td>
					</tr>
					<tr>
						<td>Password :</td>
						<td><?=$row['pass_word']?></td>
					</tr>
					<tr>
						<td>Email :</td>
						<td><?=$row['email']?></td>
					</tr>
                    <tr>
						<td>Telephone:</td>
						<td><?=$row['telephone']?></td>
					</tr>
                    <tr>
						<td>Date of birth :</td>
						<td><?=$row['date_n']?></td>
					</tr>
                    <tr>
						<td>Sexe :</td>
                        <?php if($row['sexe']=="m") :?>
						<td>Male</td>
                        <?php else : ?>
                        <td>Female</td>
                        <?php endif; ?>
					</tr>
                    <tr>
						<td>Occupation :</td>
                        <?php if($row['choix']=="t") :?>
						<td>Teacher</td>
                        <?php else : ?>
                        <td>Student</td>
                        <?php endif; ?>
					</tr>
				</table>
			</div>
            <br>
            <br>
            <form action="modifier_profil.php" methode="post">
            <button type="submit" name="modifier" class="cws-button bt-color-2 border-radius alt small"> Modifie</button>
            </form>
            <br>
            <form action="modifier_password.php" methode="post">
            <button type="submit" name="modifierpass" class="cws-button bt-color-2 border-radius alt small"> Modifie Password</button>
            </form>
			<br>
			<a href="uploadview.php" class="cws-button bt-color-2 border-radius alt small">Uplaod a Picture</a>
		</div>
        <br>
        <br>
        <hr><hr><br>
	<footer >
		<div class="grid-row">
			<div class="grid-col-row clear-fix">
				
			</div>
		</div>
		<div class="footer-bottom" >
			<div class="grid-row clear-fix">	
				<nav class="footer-nav">
					<ul class="clear-fix">
						<li>
							<a href="index.php">Home</a>
						</li>
						<li>
							<a href="index.php">Features</a>
						</li>
						<li>
							<a href="content-elements.html">Categorie</a>
						</li>
						<li>
							<a href="blog-default.html">offers</a>
						</li>
						<li>
							<a href="mailto:edukey.site@gamil.com">Contact us</a>
						</li>
					</ul>
				</nav>
			</div>
		</div>
	</footer>
   
	<!-- footer -->
	<!-- scripts -->
	<script src="js/jquery.min.js"></script>
	<script type='text/javascript' src='js/jquery.validate.min.js'></script>
	<script src="js/jquery.form.min.js"></script>
	<script src="js/TweenMax.min.js"></script>
	<script src="js/main.js"></script>
	<script src="js/select2.js"></script>
	<script src="js/jquery.isotope.min.js"></script>	
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/jflickrfeed.min.js"></script>
	<script src="js/jquery.tweet.js"></script>
	<script type='text/javascript' src='tuner/js/colorpicker.js'></script>
	<script type='text/javascript' src='tuner/js/scripts.js'></script>
	<script src="js/jquery.fancybox.pack.js"></script>
	<script src="js/jquery.fancybox-media.js"></script>
	<script src="js/retina.min.js"></script>
	<!-- scripts -->
</body>
</html>