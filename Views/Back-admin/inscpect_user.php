<?php
include_once 'C:\xampp\htdocs\mycruds\Controller\UserC.php';
session_start();
if (!isset($_SESSION['logged'])) {
	header('Location: login_admin.php');
	exit;
    }
$userC = new UserC();
$id_user= $_GET['id_user'];
$user=$userC->chercher_user($id_user);
$image=$userC->display_img($id_user);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="widtd=device-widtd, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Inspect User</title>
    <link rel="shortcut icon" href="../img/favicon.png">
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Roboto:400,700"
    />
    <!-- https://fonts.google.com/specimen/Roboto -->
    <link rel="stylesheet" href="css/fontawesome.min.css" />
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="css/templatemo-style.css">
    <!--
	Product Admin CSS Template
	https://templatemo.com/tm-524-product-admin
	-->
  </head>

  <body id="reportsPage">
    <div class="" id="home">
    <nav class="navbar navbar-expand-xl">
            <div class="container h-100">
           
                <a class="navbar-brand" href="Home.php">
                    <h1 class="tm-site-title mb-0">Admin- Dashboard</h1>
                </a>
                <button class="navbar-toggler ml-auto mr-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars tm-nav-icon"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto h-100">
                        <li class="nav-item">
                            <a class="nav-link " href="Home.php">
                                <i class="fas fa-tachometer-alt"></i>
                                Dashboard
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link " href="Reclamation.php">
                        <i class="far fa-file-alt"></i> Reclamations
                        </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link " href="evaluation.php">
                            <i class="fas fa-address-book"></i> Evaluation
                        </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-shopping-cart"></i>
                                Buyers
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link active" href="Accounts.php">
                                <i class="far fa-user"></i>
                                Accounts
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link d-block" href="logout_admin.php">
                            <button class="btn btn-primary btn-block text-uppercase"><?=$_SESSION['name_admin']?> | <b>Logout</b></button>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
    </nav>
     
        <!--CONTENT -->
        <div class="col-12 tm-block-col ">
            <div class="tm-bg-primary-dark tm-block tm-block-settings  tm-block-overflow">
              <h2 class="tm-block-title"><?=$user['nom'] ?> <?=$user['prenom']?></h2>
              <br>
              <?php if($image!=FALSE) : ?>
              <a href="modifier_user_inspect.php?id_user=<?=$user['id_user'] ?>"><div class="tm-gray-circle"><img src="../<?=$image['img']?>" widtd="150" height="150" alt="Avatar Image" class="rounded-circle"></div></a>
              <?php else : ?>
            <a href="modifier_user_inspect.php?id_user=<?=$user['id_user'] ?>"><div class="tm-gray-circle"><img src="../Users_img/user.png" widtd="150" height="150" alt="Avatar Image" class="rounded-circle"></div></a>
              <?php endif; ?>
              <table class="table" style="position: relative; left:200px; bottom:50px;">
                  <tr>
                      <td><b style="color:blue;"> ID :</b></td>
                      <td><?=$user['id_user']?></td>
                  </tr>
                  <tr>
                      <td><b style="color:blue;">CIN :</b></td>
                      <td><?=$user['cin']?></td>
                  </tr>
                  <tr>
                      <td><b style="color:blue;">Name :</b></td>
                      <td><?=$user['nom']?></td>
                  </tr>
                  <tr>
                      <td><b style="color:blue;">Last Name :</b></td>
                      <td><?=$user['prenom']?></td>
                  </tr>
                  <tr>
                      <td><b style="color:blue;">Date of Birth :</b></td>
                      <td><?=$user['date_n']?></td>
                  </tr>
                  <tr>
                      <td><b style="color:blue;">Sexe :</b></td>
                      <td><?php if($user['sexe'] == "m") echo "Male";
                      else echo "Female";
                       ?>
                       </td>
                  </tr>
                  <tr>
                      <td><b style="color:blue;">Occupation :</b></td>
                      <td><?php if($user['choix'] == "t") echo "Teacher";
                      else echo "Student";
                       ?></td>
                  </tr>
                  <tr>
                      <td><b style="color:blue;">Phone :</b></td>
                      <td><?=$user['telephone']?></td>
                  </tr>
                  <tr>
                      <td><b style="color:blue;">Email :</b></td>
                      <td><?=$user['email']?></td>
                  </tr>
                  <tr>
                      <td><b style="color:blue;">Username :</b></td>
                      <td><?=$user['username']?></td>
                  </tr>
              </table>
            </div>
          </div>
        </div>

        <!--CONTENT -->
      </div>
      <footer class="tm-footer row tm-mt-small">
        <div class="col-12 font-weight-light">
        
        </div>
      </footer>
    </div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
  </body>
</html>
