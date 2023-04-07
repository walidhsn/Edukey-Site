<?php
include_once 'C:\xampp\htdocs\mycruds\Controller\UserC.php';
include_once 'C:\xampp\htdocs\mycruds\config.php';
session_start();
$userC = new UserC();
$con = config::getConnexion();
$error="";
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit;
}
$ban_check=$userC->chercher_user($_SESSION['id']);
		if($ban_check['ban'])
		{
			session_start();
			session_unset();
			session_destroy();
			header('Location:page-login.php?error=Your Account Has been Banned by The Admin , Contact us for more information.');
		}
$stmt = $con->prepare('SELECT * FROM users WHERE id_user = :id_user');
$stmt->bindValue(':id_user',$_SESSION['id']);
$stmt->execute();
$count=$stmt->rowCount();
		if ($count > 0) {
            $row = $stmt->fetch();
        }
        if(isset($_POST['create']))
        {
            if(empty($_POST['oldpassw'])){
                $error="please Enter the Old Password to confirme";
            }
            else{
                $password=$_POST['oldpassw'];
                $hash = password_hash($password, PASSWORD_DEFAULT);
                if(password_verify($password,$row['pass_word']))
                {
                    if(isset($_POST['passw']) && isset($_POST['cpassw']))
                    {
                        if(!empty($_POST['passw']) && !empty($_POST['cpassw']))
                        {
                            $new=$_POST['passw'];
                            $Cnew=$_POST['cpassw'];
                            if($new == $Cnew)
                            {
                                $new_hash = password_hash($new, PASSWORD_DEFAULT);
                                $user = new User($row['cin'],$row['nom'] ,$row['prenom'] ,$row['email'],$row['telephone'],$row['sexe'] ,$row['date_n'] ,$row['username'] ,$new_hash,$row['choix']);
                                $userC->modifier_user($_SESSION['id'],$user);
                                header('Location:profil.php');
                            }
                            else
                            {
                                $error="Two Password are diffrent";
                            }
                        }
                    }
                }
            }
        }
?>

<!DOCTYPE HTML>
<html>
<head>
	<title>Modifier Password</title>
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
						<p>Welcome back, <?=$_SESSION['name']?>!</p>
					<?php endif; ?>
				</address>
				<div class="header-top-panel">
					<?php if (isset($_SESSION['loggedin'])) : ?>
						<a href="logout.php" class="cws-button border-radius alt smaller">Logout</a>
					<?php endif; ?>
					<div id="top_social_links_wrapper">
					    <div class="share-toggle-button"><i class="share-icon fa fa-share-alt"></i></div>
					    <div class="cws_social_links"><a href="https://plus.google.com/" class="cws_social_link" title="Google +"><i class="share-icon fa fa-google-plus" style="transform: matrix(0, 0, 0, 0, 0, 0);"></i></a><a href="http://twitter.com/" class="cws_social_link" title="Twitter"><i class="share-icon fa fa-twitter"></i></a><a href="http://facebook.com" class="cws_social_link" title="Facebook"><i class="share-icon fa fa-facebook"></i></a><a href="http://dribbble.com" class="cws_social_link" title="Dribbble"><i class="share-icon fa fa-dribbble"></i></a></div>
					</div>
					<a href="#" class="search-open"><i class="fa fa-search"></i></a>
					<form action="#" class="clear-fix">
						<input type="text" placeholder="Search" class="clear-fix">
					</form>
					<?php if (isset($_SESSION['loggedin'])) : ?>
					<a href="profil.php" class="cws-button bt-color-2 border-radius alt small">My Profile</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<!-- / header top panel -->

	<main>
		<section class="fullwidth-background bg-2">
			<div class="grid-row">
				<div class="login-block">
					<div class="logo">
						<a href="index.php"><img src="img/logo.png" data-at2x='img/logo@2x.png' alt></a>
						<a href="index.php"><h2>Edukey</h2></a>
					</div>
					<form method="post" class="login-form">
						
						<div class="form-group">
							<input type="password" class="login-input" placeholder="New Pasword" id="passw" name="passw" required minlength="4" maxlength="20">
							<span class="input-icon">
								<i class="fa fa-lock"></i>
							</span>
						</div>
						<div class="form-group">
							<input type="password" class="login-input" placeholder="Confirm pasword" id="cpassw" name="cpassw" required minlength="4" maxlength="20">
							<span class="input-icon">
								<i class="fa fa-lock"></i>
							</span>
						</div>	
                        <h6> Old Password To Confirm Modification :</h6>
                        <div class="form-group">
	
							<input type="password" class="login-input" placeholder="Pasword" id="oldpassw" name="oldpassw" required minlength="4" maxlength="20">
							<span class="input-icon">
								<i class="fa fa-lock"></i>
							</span>
						</div>
						<div><p><?php echo $error;?></p></div>
                        <br>
					<button class="button-fullwidth cws-button bt-color-3 border-radius" type="submit" name="create">Modifie</button>
					</form>
				</div>
			</div>
		</section>
	</main>
	<footer>
		<div class="grid-row">
			<div class="grid-col-row clear-fix">
				
			</div>
		</div>
		<div class="footer-bottom">
			<div class="grid-row clear-fix">	
			<nav class="footer-nav">
					<ul class="clear-fix">
						<li>
							<a href="index.php">Home</a>
						</li>
						<li>
							<a href="courses-list">Courses</a>
						</li>
						<li>
							<a href="about-us.php">Pages</a>
						</li>
						<li>
							<a href="mailto:edukey.site@gamil.com">Contact</a>
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