<?php
session_start();
if (!isset($_SESSION['logged'])) {
	header('Location: login_admin.php');
	exit;
    }
include_once 'C:\xampp\htdocs\mycruds\Controller\categorieC.php';

$categorieC = new categorieC();
$icon_tab = array('flaticon-award','flaticon-award1','flaticon-book1','flaticon-book','flaticon-calendar','flaticon-camera','flaticon-clipboard','flaticon-college','flaticon-computer','flaticon-configuration','flaticon-graduate','flaticon-hotel','flaticon-keyboard','flaticon-magnifier','flaticon-medical','flaticon-multiple','flaticon-pencil','flaticon-people','flaticon-pie','flaticon-pin','flaticon-restaurant','flaticon-shopping','flaticon-sign','flaticon-smartphone','flaticon-speech','flaticon-twitter','flaticon-university','flaticon-users','flaticon-web-programming','flaticon-website');
    if(isset($_POST['submitAjoute']))
    {
        
        if(isset($_POST['name']) && isset($_POST['icon_html']))
        {
            
            if(!empty($_POST['name']) && !empty($_POST['icon_html']) )
            {
               
                $categorie = new categorie($_POST['name'],$_POST['icon_html']);
                $categorieC->ajouter_categorie($categorie);
                
                header('Location: Home.php');
            }
            else echo "MISSING INFO";
        }
    }


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>ADD-Categorie</title>
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
                            <a class="nav-link active" href="Home.php">
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
                            <a class="nav-link " href="Accounts.php">
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
     
        <!-- row -->
          <div class="tm-block-col tm-col-account-settings">
            <div class="tm-bg-primary-dark tm-block tm-block-settings">
              <h2 class="tm-block-title">Categorie Settings</h2>
              <form action="" class="tm-signup-form row" method="POST">
                <div class="form-group col-lg-6">
                  <label for="name">Name :</label>
                  <input
                    id="name"
                    name="name"
                    type="text"
                    class="form-control validate"
                    required
                    maxlength="30"
                    maxlength="2"
                  />
                </div>
                <div class="form-group col-lg-6"  >
                  <label for="Icon">Choose an ICON :</label>
                    <select name="icon_html" id="icon_html" required>
                        <option value="">--Please choose an option--</option>
                        <?php foreach($icon_tab as $row){ ?>
                        <option value="<?= $row ?>">- <?=$row?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-lg-6">
                  <label class="tm-hide-sm">&nbsp;</label>
                  <button type="submit" class="btn btn-primary btn-block text-uppercase" name="submitAjoute">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
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
