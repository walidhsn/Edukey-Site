<?php
	session_start();
	include_once 'C:\xampp\htdocs\mycruds\Controller\UserC.php';
	include_once 'C:\xampp\htdocs\mycruds\Controller\formationC.php';
    include_once 'C:\xampp\htdocs\mycruds\Controller\categorieC.php';
	include_once 'C:\xampp\htdocs\mycruds\Controller\CoursC.php';
	$userC = new UserC();
    $categorieC = new categorieC();
	$courC = new CoursC();
	if (isset($_SESSION['loggedin'])) {
	$pic = $userC->display_img($_SESSION['id']);
	$ban_check=$userC->chercher_user($_SESSION['id']);
		if($ban_check['ban'])
		{
			session_start();
			session_unset();
			session_destroy();
			header('Location:page-login.php?error=Your Account Has been Banned by The Admin , Contact us for more information.');
		}
	}
	$formationC = new FormationC();
	$result_categorie = $categorieC->afficher_categorie();
	$result = $formationC->select_lastest_formation();
	//loading images of the latest Courses :
	$img_1=$formationC->display_img($result[0]['id_formation']);
	$img_2=$formationC->display_img($result[1]['id_formation']);
	$img_3=$formationC->display_img($result[2]['id_formation']);
	//*********************************************************** 
	
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Edukey - Course </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
	<!-- style -->
	<link rel="shortcut icon" href="img/favicon.png">
	<link rel="stylesheet" href="css/font-awesome.css">
	<link rel="stylesheet" href="fi/flaticon.css">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="tuner/css/colorpicker.css" />
	<link rel="stylesheet" type="text/css" href="tuner/css/styles.css" />
	<link rel="stylesheet" type="text/css" href="css/jquery.fancybox.css" />
	<link rel="stylesheet" href="css/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="rs-plugin/css/settings.css" media="screen">
	<link rel="stylesheet" href="css/animate.css">
	<!--styles -->
</head>
<body>
	<!-- page header -->
	<header class="only-color">
		<!-- header top panel -->
		<div class="page-header-top">
			<div class="grid-row clear-fix">
			<?php if (isset($_SESSION['loggedin'])) : ?>
					<div style="position: relative; right:80px;">
					<?php if (!$pic) : ?>
					<img src="Users_img\user.png" data-at2x="Users_img\user.png" class="avatar">
					<?php else : ?>
					<img src="<?=$pic['img']?>" data-at2x="<?=$pic['img']?>" class="avatar">
					<?php endif; ?>
					<a href="profil.php" style="position: relative; top:10px;" class="cws-button bt-color-2 border-radius alt small">My Profile</a>
					<?php if ($_SESSION['ocupation'] == "Teacher") : ?>
					<a href="http://localhost/mycruds/Views/Back-admin/teacher_dashboard/Home_teacher.php" style="position: relative; top:10px;" class="cws-button bt-color-2 border-radius alt small">ADD Courses & Content</a>
					<?php endif; ?>
					</div>
				<?php endif; ?>
				<address>
				<?php if (!isset($_SESSION['loggedin'])) : ?>
					<a href="tel:123456" class="phone-number"><i class="fa fa-phone"></i>123456</a>
					<a href="mailto:edukey.site@gamil.com" class="email"><i class="fa fa-envelope-o"></i>edukey.site@gmail.com</a>
					<?php endif; ?>
					<?php if (isset($_SESSION['loggedin'])) : ?>
						<p style="position: relative; right:80px; top:10px;">Welcome <b style="color:yellow;"><?=$_SESSION['ocupation']?></b>, <b><?=$_SESSION['name']?></b> </p>
					<?php endif; ?>
				</address>
				<div class="header-top-panel">
					<?php if (!isset($_SESSION['loggedin'])) : ?>
						<a href="page-login.php" class="fa fa-user login-icon"></a>
					<?php else : ?>
						<a href="logout.php"  style="position: relative; left:30px;" class="cws-button border-radius alt smaller">LOGOUT</a>
					<?php endif; ?>
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
					<nav class="main-nav">
						<ul class="clear-fix">
							<li>
								<a href="index.php" class="active">Home</a>
								<!-- sub menu -->
								
								<!-- / sub menu -->
							</li>
							<li class="megamenu">
							<a href="about-us.php">Features</a>
								<!-- sub mega menu -->
								<ul class="clear-fix">
									<li><div class="header-megamenu">Pages</div>
										<ul>
											<li><a href="about-us.php">About Us</a></li>
											<li><a href="page-our-staff.php">Our Staff</a></li>
											<li><a href="page-sitemap.php">Site-Map</a></li>
										</ul>
									</li>
									<?php if(!isset($_SESSION['loggedin'])){?>
									<li><div class="header-megamenu">My Account</div>
										<ul>
											<li><a href="page-login.php">Login</a></li>
										</ul>
										<img src="pic/login.png" alt>
									</li>
									<?php }?>
									<li><div class="header-megamenu">Blog</div>
										<ul>
											<li><a href="blog-default.php">All Blogs</a></li>
											<?php
										if(isset($_SESSION['loggedin'])) {
											if(($_SESSION['ocupation'] == "Teacher")){
											echo '<li><a href="creat-blog.php">Add a blog</a></li>';
											echo '<li><a href="myblogs.php">My blogs</a></li>';
												}
											}
											?>
										</ul>
										<img src="pic/blog.png" alt>
									</li>
									<li><div class="header-megamenu">All Courses</div>
										<ul>
											<li><a href="courses-list.php">List</a></li>
										</ul>
										<img src="pic/courses.png" alt>
									</li>
								</ul>
								<!-- / sub mega menu -->
							</li>
							<li class="megamenu">
								<a href="courses-list.php">Categorie</a>
								<!-- sub mega menu -->
								<ul class="clear-fix">
								<?php foreach($result_categorie as $tab){?>
									<li><div class="header-megamenu"><?=$tab['nom_categorie']?></div>
										<ul>
											<li><a href="courses-list.php?nom_categorie=<?=$tab['nom_categorie']?>">Courses</a></li>
										</ul>
									</li>
									<?php }?>
									<!--<li><div class="header-megamenu">Programming</div>
										<ul>
											<li><a href="courses-list.html">Courses</a></li>
										</ul>
										<img src="img/c3.png" alt>
									</li>
									<li><div class="header-megamenu">Web-Development</div>
										<ul>
											<li><a href="courses-list.html">Courses</a></li>
										</ul>
										<img src="img/c2.png" alt>
									</li>-->
								</ul>
								<!-- / sub mega menu -->
							</li>
							<li>
								<a href="events-single-item.html">Offers</a>
								<!-- sub menu -->
								<!-- / sub menu -->
							</li>
							<li>
							<a href="mailto:edukey.site@gamil.com" class="email">Contact Us</a>
							</li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
		<!-- sticky menu -->
        <div class="page-title">
			<div class="grid-row">
				<h1>Single-item</h1>
				<nav class="bread-crumb">
					<a href="index.php">Home</a>
					<i class="fa fa-long-arrow-right"></i>
					<a href="courses-list.php">Courses - Liste</a>
					<i class="fa fa-long-arrow-right"></i>
					<a href="#">Single-item</a>
				</nav>
			</div>
		</div>
	</header>
	<!-- / page header -->
    <!-- / CONTENT -->
    <div class="page-content">
		<div class="container clear-fix">
			<div class="grid-col-row">
				<div class="grid-col grid-col-9">
					<!-- main content -->
					<main>
                        <?php 
                        if(isset($_GET['id_formation'])) :
                        
                            $id=$_GET['id_formation'];
                            $row=$formationC->chercher_formation($id);
                            $tab=$courC->chercher_all_cour($row['id_formation']);
							$count=sizeof($tab);
							for($i=0;$i<$count;$i++) :
                        ?>
						<section>
							<div><a href="afficher_pdf.php?id_pdf=<?=$tab[$i]['idCours']?>"><h2><?=$tab[$i]['nomCours']?></h2></a></div>
							<!-- /tabs -->
						</section>
						<hr class="divider-color" />
						<?php 
						endfor;
					endif; ?>
					</main>
					<!-- / main content -->
				</div>
			</div>
		</div>
	</div>
	<!-- / content -->
	<!-- / CONTENT-->
	<!-- footer -->
	<footer>
		<div class="grid-row">
			<div class="grid-col-row clear-fix">
				<section class="grid-col grid-col-4 footer-about">
					<h2 class="corner-radius">About Us</h2>
					<div>
						<h3>EduKey is a massive open online course provider</h3>
						<p>,and it s a learning experience arranges coursework into a series of modules and lessons that can include videos, text notes and assessment tests.</p>
					</div>
					<address>
						<p></p>
						<a href="tel:123456" class="phone-number">123456</a>
						<br />
						<a href="mailto:edukey@gamil.com" class="email">edukey@gamil.com</a>
					</address>
					<div class="footer-social">
						<a href="" class="fa fa-facebook"></a>
						<a href="" class="fa fa-google-plus"></a>
						<a href="" class="fa fa-youtube"></a>
					</div>
				</section>
				</section>
				<section class="grid-col grid-col-4 footer-latest">
					<h2 class="corner-radius">Latest courses</h2>
					
					<article>
					<a href="display_course.php?id_formation=<?=$result[0]['id_formation']?>">
						<img src="<?=$img_1['img']?>" data-at2x="<?=$img_1['img']?>" alt>
						<h3><?=$result[0]['nom']?></h3>
						<div class="course-date">
							<div><?=$result[0]['prix']?><sup>.DT</sup></div>
							<div><?=$result[0]['date_creation']?></div>
						</div>
						<p>Categorie : <?=$result[0]['categorie']?> </br> By : <?=$result[0]['editor']?> </br> Description : <?=$result[0]['description']?></p>
						</a>
					</article>
					
					
					<article>
					<a href="display_course.php?id_formation=<?=$result[1]['id_formation']?>">
						<img src="<?=$img_2['img']?>" data-at2x="<?=$img_2['img']?>" alt>
						<h3><?=$result[1]['nom']?></h3>
						<div class="course-date">
							<div><?=$result[1]['prix']?><sup>.DT</sup></div>
							<div><?=$result[1]['date_creation']?></div>
						</div>
						<p>Categorie : <?=$result[1]['categorie']?> </br> By : <?=$result[1]['editor']?> </br> Description : <?=$result[1]['description']?></p>
						</a>
					</article>
					
				</section>
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
	<!-- / footer -->
	<script src="js/jquery.min.js"></script>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
	<script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/infobox/src/infobox_packed.js"></script>
	<script type='text/javascript' src='js/jquery.validate.min.js'></script>
	<script src="js/jquery.form.min.js"></script>
	<script src="js/TweenMax.min.js"></script>
	<script src="js/main.js"></script>
	<!-- jQuery REVOLUTION Slider  -->
	<script type="text/javascript" src="rs-plugin/js/jquery.themepunch.tools.min.js"></script>
	<script type="text/javascript" src="rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
	<script type="text/javascript" src="rs-plugin/js/extensions/revolution.extension.video.min.js"></script>
	<script type="text/javascript" src="rs-plugin/js/extensions/revolution.extension.slideanims.min.js"></script>
	<script type="text/javascript" src="rs-plugin/js/extensions/revolution.extension.actions.min.js"></script>
	<script type="text/javascript" src="rs-plugin/js/extensions/revolution.extension.layeranimation.min.js"></script>
	<script type="text/javascript" src="rs-plugin/js/extensions/revolution.extension.kenburn.min.js"></script>
	<script type="text/javascript" src="rs-plugin/js/extensions/revolution.extension.navigation.min.js"></script>
	<script type="text/javascript" src="rs-plugin/js/extensions/revolution.extension.migration.min.js"></script>
	<script type="text/javascript" src="rs-plugin/js/extensions/revolution.extension.parallax.min.js"></script>		
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
</body>
</html>