<?php
	include_once 'C:\xampp\htdocs\mycruds\config.php';
	session_start();
	$error="";
	if(!empty($_GET["error"]))
	{
		$error=$_GET["error"];
	}
	$con = config::getConnexion();
	$remember=null;
	if (isset($_POST['remember'])){
		$remember=$_POST['remember'];
	}
	
	if (isset($_POST['loginbutton']) && (empty($_POST['username']) &&  empty($_POST['password'])) ) {
		$error="Please fill both the username and password fields";
	}
	else if (isset($_POST['loginbutton']) && (isset($_POST['username'], $_POST['password'])) )
	{
		if ($stmt = $con->prepare('SELECT * FROM users WHERE username = :username')) {
		$stmt->bindValue(':username', $_POST['username']);
		$stmt->execute();
		$count=$stmt->rowCount();
		if ($count > 0) {
				$row = $stmt->fetch();
				if (password_verify($_POST['password'],$row['pass_word'])) {
					$sql="SELECT * FROM verification where username_verif = :username_verif";
					$stmt = $con->prepare($sql);
					$stmt->bindValue(':username_verif',$_POST['username']);
					$stmt->execute();
					$count=$stmt->rowCount();
					if ($count > 0) {
					$row2 = $stmt->fetch();
					if($row2['etat_verif']){
						if(!$row['ban']){
							session_regenerate_id();
							$_SESSION['loggedin'] = TRUE;
							$_SESSION['name'] = $_POST['username'];
							$_SESSION['id'] = $row['id_user'];
							if($row['choix'] == "t")
							{
								$_SESSION['ocupation'] = "Teacher";
							}
							else
							{
								$_SESSION['ocupation'] = "Student";
							}
							if($remember == 1)
							{
								setcookie('uname',$_POST['username'], time()+60*60*24*30,"/");
								setcookie('upass',$_POST['password'], time()+60*60*24*30,"/");
							}
							
							header('Location:index.php');
						}
						else {
							$error ="Your Account Has Been Banned by The Admin, For more informations Contact Us";
						}
						
					}else
					{
						$error ="Please Verifie your Email-Address.";
					}
					
					}
					else $error ="Error in Finding the Username in Email Verification";
				} else {
					// Incorrect password
					$error ="Incorrect username and/or password!";
				}
			} else {
				// Incorrect username
				$error ="Incorrect username and/or password!";
				}
			}
		
		
	}
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>EduKey -Login</title>
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
</head>
<body class="">
<header>
		<div class="page-header-top">
			<div class="grid-row clear-fix">
				<address>
					<a href="tel:123456" class="phone-number"><i class="fa fa-phone"></i>123456</a>
					<a href="mailto:edukey@gmail.com" class="email"><i class="fa fa-envelope-o"></i>edukey@gmail.com</a>
				</address>
				<div class="header-top-panel">
					<a href="page-login.php" class="fa fa-user login-icon"></a>
					<div id="top_social_links_wrapper">
					    <div class="share-toggle-button"><i class="share-icon fa fa-share-alt"></i></div>
					    <div class="cws_social_links"><a href="https://plus.google.com/" class="cws_social_link" title="Google +"><i class="share-icon fa fa-google-plus" style="transform: matrix(0, 0, 0, 0, 0, 0);"></i></a><a href="http://twitter.com/" class="cws_social_link" title="Twitter"><i class="share-icon fa fa-twitter"></i></a><a href="http://facebook.com" class="cws_social_link" title="Facebook"><i class="share-icon fa fa-facebook"></i></a><a href="http://dribbble.com" class="cws_social_link" title="Dribbble"><i class="share-icon fa fa-dribbble"></i></a></div>
					</div>
					<a href="#" class="search-open"><i class="fa fa-search"></i></a>
					<form action="#" class="clear-fix">
						<input type="text" placeholder="Search" class="clear-fix">
					</form>
					
				</div>
			</div>
		</div>
	<main>
		<section class="fullwidth-background bg-2">
			<div class="grid-row">
				<div class="login-block">
					<div class="logo">
					<a href="index.php"><img src="img/logo.png" data-at2x='img/logo@2x.png' alt></a>
						<a href="index.php"><h2>EduKey</h2></a>
					</div>
					<div class="login-or">
						<hr class="hr-or">
						<span class="span-or"></span>
					</div>
					<form  method="post" class="login-form">
						<div class="form-group">
							<input type="text" class="login-input" placeholder="Username" name="username" id="username" value="<?php if(isset($_COOKIE['uname'])) echo $_COOKIE['uname']; ?>">
							<span class="input-icon">
								<i class="fa fa-user"></i>
							</span>
						</div>
						<div class="form-group">
							<input type="password" class="login-input" placeholder="Pasword" name="password" id="password" value="<?php if(isset($_COOKIE['upass'])) echo $_COOKIE['upass']; ?>">
							<span class="input-icon">
								<i class="fa fa-lock"></i>
							</span>
						</div>
						<br>
						
						<div class="checkbox">
								<input type="checkbox" id="remember" value="1" name="remember" >
								<label for="remember"></label>
							<!-- / check box -->
							Keep me Signed in </div>
						<p class="small">
							<a href="password_forget.php">Forgot Password?</a>
						</p>
						<div> <p style="color:red;"><?php echo $error; ?></p></div>
						<br>
						<button class="button-fullwidth cws-button bt-color-3 border-radius alt" type="submit" name="loginbutton">LOG IN</button>
						<a href="page-register.php" class="button-fullwidth cws-button bt-color-3 border-radius">REGISTER</a>
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