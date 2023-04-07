<?php
	session_start();
	include_once 'C:\xampp\htdocs\mycruds\Controller\UserC.php';
	include_once 'C:\xampp\htdocs\mycruds\Controller\formationC.php';
	include_once 'C:\xampp\htdocs\mycruds\Controller\categorieC.php';
	include_once 'C:\xampp\htdocs\mycruds\Controller\FormateurC.php';
	$userC = new UserC();
	$formateur = new FormateurC();
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
	$categorieC = new categorieC();
	$result = $formationC->select_lastest_formation();
	//loading images of the latest Courses :
	$img_1=$formationC->display_img($result[0]['id_formation']);
	$img_2=$formationC->display_img($result[1]['id_formation']);
	$img_3=$formationC->display_img($result[2]['id_formation']);
	//*********************************************************** 
	$result_users = $userC->afficher_user();
	$result_categorie = $categorieC->afficher_categorie();
	$t=0;
	$s=0;
	$f=0;
	foreach($result_users as $row)
	{
		if($row['choix'] == "t")
		{
			$t+=1;
		}
		if($row['choix'] == "s")
		{
			$s+=1;
		}
	}
	$result_formation = $formationC->afficher_formation();
	foreach($result_formation as $row2)
	{
		$f++;
	}
    $result_teacher = $userC->select_first_teacher();
	$count=sizeof($result_teacher);
	$img_teacher = array();
	$teacher_categorie = array();
	for($i=0;$i<$count;$i++)
	{
		$img_teacher[$i]= $userC->display_img($result_teacher[$i]['id_user']);
		$teacher_categorie[$i] = $formateur->chercher_formateur($result_teacher[$i]['cin']);
	}
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Edukey </title>
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
	</header>
	<!-- / page header -->
	<!-- revolution slider -->
	<div class="tp-banner-container">
		<div class="tp-banner-slider">
			<ul>
				<li data-masterspeed="700">
					<img src="rs-plugin/assets/loader2.png" data-lazyload="eager" alt>
					<div class="tp-caption sl-content align-left" data-x="['left','center','center','center']" data-hoffset="20" data-y="center" data-voffset="0"  data-width="['720px','600px','500px','300px']" data-transform_in="opacity:0;s:1000;e:Power2.easeInOut;" 
	 data-transform_out="opacity:0;s:300;s:1000;" data-start="400">
						<div class="sl-title">The Other Way To Learn</div>
						<a href="page-register.php" class="cws-button border-radius">Join us <i class="fa fa-angle-double-right"></i></a>
					</div>
   				</li>
   				<li data-masterspeed="700">
					<img src="rs-plugin/assets/loader1.png" data-lazyload="eager" alt>
					<div class="tp-caption sl-content align-right" data-x="['right','center','center','center']" data-hoffset="20" data-y="center" data-voffset="0"  data-width="['720px','600px','500px','300px']" data-transform_in="opacity:0;s:1000;e:Power2.easeInOut;" 
	 data-transform_out="opacity:0;s:300;s:1000;" data-start="400">
						<div class="sl-title">Forward. Thinking.</div>
						<a href="page-register.php" class="cws-button border-radius">Join us <i class="fa fa-angle-double-right"></i></a>
					</div>
   				</li>
   				<li data-masterspeed="700" data-transition="fade">
					<img src="rs-plugin/assets/loader.png" data-lazyload="eager" alt>
					<div class="tp-caption sl-content align-center" data-x="center" data-hoffset="0" data-y="center" data-voffset="0"  data-width="['720px','600px','500px','300px']" data-transform_in="opacity:0;s:1000;e:Power2.easeInOut;" 
	 data-transform_out="opacity:0;s:300;s:1000;" data-start="400">
						<div class="sl-title">Knowledge for life</div>
						<a href="page-register.php" class="cws-button border-radius">Join us <i class="fa fa-angle-double-right"></i></a>
					</div>
   				</li>
   				<li data-masterspeed="700" data-transition="fade">
					<img src="rs-plugin/assets/loader3.png" data-bgposition="center right"  data-lazyload="eager" alt>
					<div class="tp-caption sl-content align-left" data-x="['left','center','center','center']" data-hoffset="20" data-y="center" data-voffset="40" data-width="['720px','600px','500px','300px']" data-transform_in="opacity:0;s:1000;e:Power2.easeInOut;" 
	 data-transform_out="opacity:0;s:300;s:1000;" data-start="400">
						<div class="sl-title">Your revolution starts</div>
						<a href="page-register.php" class="cws-button border-radius">Join us <i class="fa fa-angle-double-right"></i></a>
					</div>
   				</li>
			</ul>
		</div>
	</div>
	<!-- / revolution slider -->
	<hr class="divider-color">
	<!-- content -->
	<div id="home" class="page-content padding-none">
		<!-- section -->
		<section class="padding-section">
			<div class="grid-row clear-fix">
				<h2 class="center-text">Latest Courses</h2>
				<div class="grid-col-row">
					<div class="grid-col grid-col-4">
						<!-- course item -->
						<div class="course-item">
							<div class="course-hover">
								<img src="<?=$img_1['img']?>" data-at2x="<?=$img_1['img']?>" width="370" height="280" alt>
								<div class="hover-bg bg-color-2"></div>
								<a href="display_course.php?id_formation=<?=$result[0]['id_formation']?>">Learn More</a>
							</div>
							<div class="course-name clear-fix">
								<span class="price"><?=$result[0]['prix']?>.DT</span>
							<h3><a href="display_course.php?id_formation=<?=$result[0]['id_formation']?>"><?=$result[0]['nom']?></a></h3>
								</div>
							<div class="course-date bg-color-2 clear-fix">
								<div class="day"><i class="fa fa-calendar"></i><?=$result[0]['date_creation']?></div>
								<div class="divider"></div>
								<div class="description">Categorie : <?=$result[0]['categorie']?> </br> By : <?=$result[0]['editor']?> </br> Description : <?=$result[0]['description']?></div>
							</div>
						</div>
						<!-- / course item -->
					</div>
					<div class="grid-col grid-col-4">
						<!-- course item -->
						<div class="course-item">
							<div class="course-hover">
								<img src="<?=$img_2['img']?>" data-at2x="<?=$img_2['img']?>" width="370" height="280" alt="">
								<div class="hover-bg bg-color-3"></div>
								<a href="display_course.php?id_formation=<?=$result[1]['id_formation']?>">Learn More</a>
							</div>
							<div class="course-name clear-fix">
								<span class="price"><?=$result[1]['prix']?>.DT</span>
							<h3><a href="display_course.php?id_formation=<?=$result[1]['id_formation']?>"><?=$result[1]['nom']?></a></h3>
								</div>
							<div class="course-date bg-color-3 clear-fix">
								<div class="day"><i class="fa fa-calendar"></i><?=$result[1]['date_creation']?></div>
								<div class="divider"></div>
								<div class="description">Categorie : <?=$result[1]['categorie']?> </br> By : <?=$result[1]['editor']?> </br> Description : <?=$result[1]['description']?></div>
							</div>
						</div>
						<!-- / course item -->
					</div>
					<div class="grid-col grid-col-4">
						<!-- course item -->
						<div class="course-item">
							<div class="course-hover">
								<img src="<?=$img_3['img']?>" data-at2x="<?=$img_3['img']?>" width="370" height="280" alt="">
								<div class="hover-bg bg-color-5"></div>
								<a href="display_course.php?id_formation=<?=$result[2]['id_formation']?>">Learn More</a>
							</div>
							<div class="course-name clear-fix">
								<span class="price"><?=$result[2]['prix']?>.DT</span>
							<h3><a href="display_course.php?id_formation=<?=$result[2]['id_formation']?>"><?=$result[2]['nom']?></a></h3>
								</div>
							<div class="course-date bg-color-5 clear-fix">
								<div class="day"><i class="fa fa-calendar"></i><?=$result[2]['date_creation']?>
								<div class="divider"></div>
								<div class="description">Categorie : <?=$result[2]['categorie']?> </br> By : <?=$result[2]['editor']?> </br> Description : <?=$result[2]['description']?></div>
							</div>
						</div>
						<!-- course item -->
					</div>
				</div>
			</div>
		</section>
		<!-- / section -->
		<hr class="divider-color" />
		<!-- section -->
		<section class="fullwidth-background padding-section">
			<div class="grid-row clear-fix">
				<div class="grid-col-row">
					<div class="grid-col grid-col-4 clear-fix">
						<h2>Our Categories</h2>
						<a href="courses-list.php" class="cws-button bt-color-3 border-radius alt icon-left float-left">Learn More<i class="fa fa-angle-right"></i></a>
					</div>
					<div class="grid-col grid-col-5">
						<?php
						$result_categorie = $categorieC->afficher_categorie();
						 foreach($result_categorie as $row3){?>
						<a href="courses-list.php?nom_categorie=<?=$row3['nom_categorie']?>" class="service-icon"><i class="<?= $row3['icon_html']?>"></i><?=$row3['nom_categorie']?></a>
						<?php }?>
					</div>
				</div>
			</div>
		</section>
		<!-- / section -->
		<!-- paralax section -->
		<div class="parallaxed">
			<div class="parallax-image" data-parallax-left="0.5" data-parallax-top="0.3" data-parallax-scroll-speed="0.5">
				<img src="img/parallax.png" alt="">

			</div>
			<div class="them-mask bg-color-3"></div>
			<div class="grid-row">
				<div class="grid-col-row clear-fix">
					<div class="grid-col grid-col-4 alt">
						<div class="counter-block">
							<i class="flaticon-book1"></i>
							<div class="counter" data-count="<?=$f?>">0</div>
							<div class="counter-name">Courses</div>
						</div>
					</div>
					<div class="grid-col grid-col-4 alt">
						<div class="counter-block">
							<i class="flaticon-multiple"></i>
							<div class="counter" data-count="<?=$s?>">0</div>
							<div class="counter-name">Students</div>
						</div>							
					</div>
					<div class="grid-col grid-col-4 alt">
						<div class="counter-block">
							<i class="flaticon-magnifier"></i>
							<div class="counter" data-count="<?=$t?>">0</div>
							<div class="counter-name">Teachers</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- / paralax section -->
		<!-- section -->
		<section class="fullwidth-background padding-section">
			<div class="grid-row">
				<h2 class="center-text">How We Work</h2>
				<!-- time line -->
				<div class="time-line">
					<div class="line-element">
						<div class="action">
							<div class="action-block">
								<span><i class="flaticon-magnifier"></i></span>
								<div class="text">
									<h3>Search your course</h3>
				
								</div>
							</div>
						</div>
						<div class="level">
							<div class="level-block">Step 1</div>
						</div>
					</div>
					<div class="line-element color-2">
						<div class="level">
							<div class="level-block">Step 2</div>
						</div>
						<div class="action">
							<div class="action-block">
								<span><i class="flaticon-computer"></i></span>
								<div class="text">
									<h3>Take A Sample Lesson</h3>
								</div>
							</div>
						</div>
					</div>
					<div class="line-element color-3">
						<div class="action">
							<div class="action-block">
								<span><i class="flaticon-shopping"></i></span>
								<div class="text">
									<h3>Purchase the Course</h3>
								</div>
							</div>
						</div>
						<div class="level">
							<div class="level-block">Step 3</div>
						</div>
					</div>
				</div>
				<!-- / time line -->
			</div>
		</section>
		<!-- / paralax section -->
		<hr class="divider-color" />
		<!-- paralax section -->
		<section class="padding-section">
			<div class="grid-row clear-fix">
				<div class="grid-col-row">
					<div class="grid-col grid-col-6">
						<div class="boxs-tab">
							<div class="animated fadeIn active" data-box="1">
								<img src="pic/better.png" data-at2x="pic/better.png" alt>
							</div>
							<div class="animated fadeIn" data-box="2">
								<img src="pic/better3.png" data-at2x="pic/better3.png" alt>
							</div>
							<div class="animated fadeIn" data-box="3">
								<img src="pic/better1.png" data-at2x="pic/better1.png" alt>
							</div>
						</div>
					</div>
					<div class="grid-col grid-col-6">
						<h2>We Offer</h2>
						<p>A reasonable price, payment is easy which allows you to pay not only through the bank card but also through the student card<br/><br/>Students who encounter deficiencies can file a complaint and receive a response quickly.<br/><br/>Teachers can upload their courses and get paid for it.</p>
						<div class="tabs-box">
							<a href="#vd" data-boxs-tab="1" class="active">Education</a>
							<a href="#dvd" data-boxs-tab="2">Knoweledge</a>
							<a href="#cddv" data-boxs-tab="3">Employment</a>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- / paralax section -->
		<hr class="divider-color"/>
		<!-- paralax section -->
		<section class="fullwidth-background padding-section">
			<div class="grid-row clear-fix">
				<h2 class="center-text">About Us</h2>
				<div class="grid-col-row">
					<div class="grid-col grid-col-6">
						<h3>Why We Are Better</h3>
						<p>EduKey is a massive open online course provider</p>
						<!-- accordions -->
						<div class="accordions">
							<!-- content-title -->
							<div class="content-title">Introduction</div>
							<!--/content-title -->
							<!-- accordions content -->
							<div class="content">it s a learning experience arranges coursework into a series of modules and lessons that can include videos, text notes and assessment tests.</div>
							<!--/accordions content -->
							<!-- content-title -->
							<div class="content-title">Benefits</div>
							<!--/content-title -->
							<!-- accordions content -->
							<div class="content">EduKey doesn't offer accredited degrees or certifications, but it can provide professional development.</div>
							<!--/accordions content -->
							<!-- content-title -->
							<div class="content-title">Price</div>
							<!--/content-title -->
							<!-- accordions content -->
							<div class="content">EduKey is likely cheaper if you're surveying specific subjects or working at a slower pace.</div>
							<!--/accordions content -->
							<!-- content-title -->
							<div class="content-title">Skills</div>
							<!--/content-title -->
							<!-- accordions content -->
							<div class="content">If you want to learn new skills but aren't necessarily looking for a degree or courses affiliated with a college or university, EduKey might be a good fit for you.</div>
							<!--/accordions content -->
						</div>
						<!--/accordions -->
						<a href="about-us.php" class="cws-button bt-color-3 border-radius alt icon-right">View Detail<i class="fa fa-angle-right"></i></a>
					</div>
					<div class="grid-col grid-col-6">
						<div class="owl-carousel full-width-slider">
							<div class="gallery-item picture">
								<img src="pic/edu2.png" data-at2x="pic/edu2.png" alt>
							</div>
							<div class="gallery-item picture">
								<img src="pic/edu1.png" data-at2x="pic/edu1.png" alt>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- paralax section -->
		<!-- parallax section -->
		<div class="parallaxed">
			<div class="parallax-image" data-parallax-left="0.5" data-parallax-top="0.3" data-parallax-scroll-speed="0.5">
				<img src="img/parallax.png" alt="">
			</div>
			<div class="them-mask bg-color-2"></div>
			
			</div>
		</div>
		<!-- parallax section -->
		<!-- section -->
		<section class="grid-row clear-fix padding-section">
			<h2 class="center-text">Our Teachers</h2>
			<div class="grid-col-row">
				<div class="grid-col grid-col-6">
					<?php if($count>0)
					{for($i=0;$i<2;$i++)
							{	?>
					<div class="item-instructor bg-color-<?=$i+1?>">
						<a href="" class="instructor-avatar">
							<img src="<?=$img_teacher[$i]['img'] ?>" data-at2x="<?=$img_teacher[$i]['img'] ?>" width="210" height="220" alt>
						</a>
						<div class="info-box">
							<h3><?=$result_teacher[$i]['nom']?> <?=$result_teacher[$i]['prenom']?></h3>
							<span class="instructor-profession">Professor of <?=$teacher_categorie[$i]['categorie']?></span>
							<div class="divider"></div>
							<div class="social-link"><!-- 
								 --><a href="#" class="fa fa-facebook"></a><!-- 
								 --><a href="#" class="fa fa-google-plus"></a><!-- 
								 --><a href="#" class="fa fa-twitter"></a>
							</div>
						</div>
					</div>
					<?php }?>
				</div>
				<?php 
				if($count>2){
					
					?>
				<div class="grid-col grid-col-6">
					<?php for($i=2;$i<$count;$i++)
						{
						?>
					<div class="item-instructor bg-color-<?=$i+1?>">
					<a href="" class="instructor-avatar">
							<img src="<?=$img_teacher[$i]['img'] ?>" data-at2x="<?=$img_teacher[$i]['img'] ?>" width="210" height="220" alt>
						</a>
						<div class="info-box">
							<h3><?=$result_teacher[$i]['nom']?> <?=$result_teacher[$i]['prenom']?></h3>
							<span class="instructor-profession">Professor of <?=$teacher_categorie[$i]['categorie']?></span>
							<div class="divider"></div>
							<div class="social-link"><!-- 
								 --><a href="#" class="fa fa-facebook"></a><!-- 
								 --><a href="#" class="fa fa-google-plus"></a><!-- 
								 --><a href="#" class="fa fa-twitter"></a>
							</div>
						</div>
					</div>
					<?php } ?>
				</div>
				<?php 
						
					}
				}
				?>
			</div>
		</section>
		<!-- / section -->
		<hr class="divider-color" />
		<!-- section -->
		<section class="padding-section">
			<div class="grid-row clear-fix">
				<div class="grid-col-row">
					<div class="grid-col grid-col-6">
						<div class="video-player">
							<iframe width="560" height="315" src="https://www.youtube.com/embed/EVQS0RQqT1I" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						</div>
					</div>
					<div class="grid-col grid-col-6 clear-fix">
						<h2>Learn More About Us From The Video</h2>
						<p>We are the Team 'Keyboard Crackers' we study at Esprit , we designe this web site for educational purposes.</p>
						<br/>
						<br/>
						<br/>
						<br/>
						<a href="https://www.youtube.com/c/ESPRITEcoleSupPrivéedIngénierieetdeTechnologies/videos" class="cws-button bt-color-3 border-radius alt icon-right float-right">Watch More<i class="fa fa-angle-right"></i></a>
					</div>
				</div>
			</div>
		</section>
		<!-- / section -->
		<!-- parallax section -->
		<div class="parallaxed">
			<div class="parallax-image" data-parallax-left="0.5" data-parallax-top="0.3" data-parallax-scroll-speed="0.5">
				<img src="img/parallax.png" alt="">
			</div>
			<div class="them-mask bg-color-3"></div>
		</div>
		<!-- parallax section -->
		<!-- section -->
		<section class="padding-section">
			<div class="grid-row clear-fix">
				<h2 class="center-text">Community Life</h2>
				<div class="grid-col-row">
					<div class="grid-col grid-col-4">
						<div class="community color-1">
							<h3>Courses List</h3>
							<div class="community-logo">
								<a href="courses-list.php"> <i class="flaticon-book1"></i></a>
							</div>
							<div class="info-block">
							</div>
						</div>
					</div>
					<div class="grid-col grid-col-4">
						<div class="community">
							<h3>Blog</h3>
							<div class="community-logo">
								<a href="blog-default.php"><i class="flaticon-pencil"></i></a>
							</div>
							<div class="info-block">
							</div>
						</div>
					</div>
					<div class="grid-col grid-col-4">
						<div class="community color-2">
							<h3>Courses Onwned</h3>
							<div class="community-logo">
								<a href="#"><i class="flaticon-book"></i></a>
							</div>
							<div class="info-block">
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- / section -->
		<hr class="divider-color" />
		<!-- section -->
		<section class="fullwidth-background testimonial padding-section">
			<div class="grid-row">
				<h2 class="center-text">Develop Team</h2>
				<div class="owl-carousel testimonials-carousel">
					<div class="gallery-item" style="position: relative; left: 376px;">
						<div class="quote-avatar-author clear-fix"><img src="team/walid.png" data-at2x="team/walid.png" alt=""><div class="author-info">Walid B.Hsouna<br><span>2A-3</span></div></div>
					</div>
					<div class="gallery-item" style="position: relative; left: 376px;">
						<div class="quote-avatar-author clear-fix"><img src="team/Rym.png" data-at2x="team/Rym.png" alt=""><div class="author-info">Rym Mrayhi<br><span>2A-3</span></div></div>
					</div>
					<div class="gallery-item" style="position: relative; left: 376px;">
						<div class="quote-avatar-author clear-fix"><img src="team/idriss.png" data-at2x="team/idriss.png" alt=""><div class="author-info">Md.idriss ElBessi<br><span>2A-3</span></div></div>
					</div>
					<div class="gallery-item" style="position: relative; left: 376px;">
						<div class="quote-avatar-author clear-fix"><img src="team/amal.png" data-at2x="team/amal.png" alt=""><div class="author-info">Amal Achour<br><span>2A-3</span></div></div>
					</div>
					<div class="gallery-item" style="position: relative; left: 376px;">
						<div class="quote-avatar-author clear-fix"><img src="team/amina.png" data-at2x="team/amina.png" alt=""><div class="author-info">Amina Attafi<br><span>2A-3</span></div></div>
					</div>
				</div>
			</div>
		</section>
		<!-- / section -->
		<!-- google map -->
		<div class="mapouter"><div class="gmap_canvas"><iframe width="2500" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=esprit%20ecole%20tunis&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.embedgooglemap.net/blog/divi-discount-code-elegant-themes-coupon/">divi discount</a><br><style>.mapouter{position:relative;text-align:right;height:500px;width:2500px;}</style><a href="https://www.embedgooglemap.net">google maps on your website</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:2500px;}</style></div></div>
		<!-- / google map -->
	</div>
	<!-- / content -->
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