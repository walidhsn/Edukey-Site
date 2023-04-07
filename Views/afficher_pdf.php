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
	if(isset($_GET['id_pdf']))
    {
        $id_pdf=$_GET['id_pdf'];
        $pdf= $courC->chercher_pdf($id_pdf);
        $count=sizeof($pdf);
    }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Display PDF</title>
    <link rel="shortcut icon" href="img/favicon.png">
    <style media="screen">
      embed{
        border: 3px solid black;
        margin-top: 30px;
      }
      .div1{
        margin-left: 160px;
      }
      body {
        background-color: gray;
        
        }
    </style>
  </head>
  <body>
    <div class="div1">
      <?php for($i=0;$i<$count;$i++) :?>
      <embed type="application/pdf" src="<?=$pdf[$i]['pdf']?>" width="1200" height="1600">
    <?php endfor; ?>
    </div>
  </body>
</html>