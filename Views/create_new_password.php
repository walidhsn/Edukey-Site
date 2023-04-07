
<!DOCTYPE HTML>
<html>
<head>
	<title>Create New Password</title>
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
<body>
<!-- page header -->
<header class="only-color">
		<!-- header top panel -->
		<div class="page-header-top">
			<div class="grid-row clear-fix">
				<address>
					<a href="tel:123456" class="phone-number"><i class="fa fa-phone"></i>123456</a>
					<a href="mailto:edukey@gamil.com" class="email"><i class="fa fa-envelope-o"></i>edukey.site@gmail.com</a>
				</address>
                <div class="header-top-panel">
					<a href="page-login.php" class="fa fa-user login-icon"></a>	
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

                    <?php
                        $selector = $_GET['selector'];
                        $validator = $_GET['validator'];

                        if(empty($selector) || empty($validator) )
                        {
                            echo "Couldn't Validate Your Request .";
                        }else
                        {
                            if(ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false)
                            {
                                ?>
                    
					<form method="post" class="login-form" action="reset_password.php">
                        <input type="hidden" name="selector" value="<?= $selector ?>">
                        <input type="hidden" name="validator" value="<?= $validator ?>">
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
					<button class="button-fullwidth cws-button bt-color-3 border-radius" type="submit" name="create">Submit</button>
					</form>

                    <?php
                            }
                        }
                    ?>
				</div>
			</div>
		</section>
	</main>
    <br><br><br><br>
	<footer>
		<div class="grid-row">
			<div class="grid-col-row clear-fix">
				
			</div>
		</div>
		<div class="footer-bottom">
			<div class="grid-row clear-fix">	
				
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