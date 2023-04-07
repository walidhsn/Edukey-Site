<?php
include_once 'C:\xampp\htdocs\mycruds\Controller\UserC.php';
include_once 'C:\xampp\htdocs\mycruds\Controller\EtudiantC.php';
include_once 'C:\xampp\htdocs\mycruds\Controller\FormateurC.php';
include_once 'C:\xampp\htdocs\mycruds\config.php';
session_start();
$userC = new UserC();
$formaC = new FormateurC();
$etudC = new EtudiantC();
$db = config::getConnexion();
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
$stmt = $db->prepare('SELECT * FROM users WHERE id_user = :id_user');
$stmt->bindValue(':id_user',$_SESSION['id']);
$stmt->execute();
$count=$stmt->rowCount();
		if ($count > 0) {
            $row = $stmt->fetch();
			$verification= $userC->retrun_etat_verif($row['username']);
        }
        if($row['choix'] == "s"){
            $liste_e = $etudC->chercher_etudiant($row['cin']);
        }
        if($row['choix'] == "t"){
            $liste_f = $formaC->chercher_formateur($row['cin']);
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
                    if(isset($_POST['cin']) && isset($_POST['name']) && isset($_POST['lname']) && isset($_POST['date']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['sexe']) && isset($_POST['username']))
                    {
                        if(!empty($_POST['cin']) && !empty($_POST['name']) && !empty($_POST['lname']) && !empty($_POST['date']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['sexe']) && !empty($_POST['username']))
                        {
								$user = new User($_POST['cin'],$_POST['name'] ,$_POST['lname'] ,$_POST['email'],$_POST['phone'],$_POST['sexe'] ,$_POST['date'] ,$_POST['username'] ,$row['pass_word'],$row['choix'],0);
								if(($row['choix'] == "t"))
								{
									$forma = new Formateur($_POST['cin'],0.0,$liste_f['categorie'],0.0);
									$formaC->modifier_formateur($liste_f['id_formateur'],$forma);
								}
								else if($row['choix'] == "s")
								{
									$etud = new Etudiant($_POST['cin'],0.0,0);
									$etudC->modifier_etudiant($liste_e['id_etudiant'],$etud);
								}
								$userC->modifier_user($_SESSION['id'],$user);
								$_SESSION['name'] = $_POST['username'];
								//update verifivation:
								try {
									$query = $db->prepare(
										'UPDATE verification SET  
											username_verif= :username_verif,
											email_verif= :email_verif
											WHERE id_verif= :id_verif'
									);
									$query->execute([
										'username_verif' => $user->get_username(),
										'email_verif' => $user->get_email(),
										'id_verif' => $verification['id_verif']
									]);
									
								} catch (PDOException $e) {
									$e->getMessage();
								}
								////////////////////////////////////////////
								header('Location:profil.php');	
                        }
                        else 
                        {
                            $error= "Missing information";
                        }
                    }
                }
                else  $error= "Wrong Password";
            } 
        }
?>

<!DOCTYPE HTML>
<html>
<head>
	<title>Modifier Profile</title>
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
					<a href="mailto:edukey@gamil.com" class="email"><i class="fa fa-envelope-o"></i>edukey@gamil.com</a>
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
							<input type="text" class="login-input" placeholder="CIN" id="cin" name="cin" required minlength="8" maxlength="20" size="20" value=<?php echo $row['cin'] ?>>
							<span class="input-icon">
								<i class="fa fa-user"></i>
							</span>
						</div>
						<div class="form-group">
							<input type="text" class="login-input" placeholder="Name" id="name" name="name" required minlength="4" maxlength="25" size="20" value=<?php echo $row['nom'] ?>>
							<span class="input-icon">
								<i class="fa fa-user"></i>
							</span>
						</div>
						<div class="form-group">
							<input type="text" class="login-input" placeholder="Last-name" id="lname" name="lname" required minlength="4" maxlength="20" value=<?php echo $row['prenom'] ?>>
							<span class="input-icon">
								<i class="fa fa-user"></i>
							</span>
						</div>

						<div class="form-group">
							<div > Birth Date :
							</div>
							<input type="date" class="login-block"  name="date" id="date" value=<?php echo $row['date_n'] ?>>
						</div>
						<div class="form-group">
							<input type="text" class="login-input" placeholder="Email" id="email" name="email" required minlength="5" maxlength="30" value=<?php echo $row['email'] ?>>
							<span class="input-icon">
								<i class="fa fa-envelope-o"></i>
							</span>
						</div>
						<div class="form-group">
							<input type="tel" class="login-block" placeholder="+216 :" id="phone" name="phone" required value=<?php echo $row['telephone'] ?> >
							<span class="input-icon">
								<i class="fa fa-phone"></i>
							</span>
						</div>
						<div class="form-group">
							<div > You Are A:
							</div>
							<!-- check box -->
							<div class="checkbox" required>
								<input type="checkbox" id="1" value="m" name="sexe" onclick="checking(this.id,1,2)" <?php if($row['sexe'] == "m") : ?> checked <?php endif; ?> >
								<label for="1"></label>
							<!-- / check box -->
							Male</div>
								<!-- check box -->
								<div class="checkbox" style="position: relative; left: 20px;">
									<input type="checkbox" id="2" value="f" name="sexe"  onclick="checking(this.id,1,2)" <?php if($row['sexe'] == "f") : ?> checked <?php endif; ?> >
									<label for="2" ></label>
								<!-- / check box -->
								Female</div>
						</div>
						<div class="form-group">
							<input type="text" class="login-input" placeholder="Username" id="username" name="username" required minlength="4" maxlength="25"value=<?php echo $_SESSION['name'] ?> >
							<span class="input-icon">
								<i class="fa fa-user"></i>
							</span>
						</div>
							
                        <h6> YOUR Password To Confirm Modification :</h6>
                        <div class="form-group">
	
							<input type="password" class="login-input" placeholder="Pasword" id="oldpassw" name="oldpassw" required minlength="4" maxlength="40">
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