<?php
session_start();
if (!isset($_SESSION['logged'])) {
	header('Location: login_admin.php');
	exit;
    }
require_once $_SERVER['DOCUMENT_ROOT'].'\mycruds\config.php';
require_once $_SERVER['DOCUMENT_ROOT'].'\mycruds\Model\reclamation.php';
require_once $_SERVER['DOCUMENT_ROOT'].'\mycruds\Controller\reclamationController.php';
$reclamation = null;
$reclamationC = new reclamationC();
if($_SERVER["REQUEST_METHOD"] == "POST") {
if (
		
	isset($_POST["titre"]) &&		
	isset($_POST["nom"]) &&
	isset($_POST["receive"]) && 
	isset($_POST["message"])
) {
	if (
		!empty($_POST["titre"]) && 
		!empty($_POST["nom"]) &&
		!empty($_POST["receive"]) && 
		!empty($_POST["message"])
	) {
		echo '<script type="text/javascript">alert("Reclamation a ete envoyer!");</script>';
		$reclamation = new reclamation(
			$_POST['titre'],
			$_POST['message'],
			$_POST['nom'], 
			$_POST['receive']
		);
		$reclamationC->ajouterReclamation($reclamation);
		echo '<script type="text/javascript">alert("Reclamation a ete envoyer!");</script>';
		header('Location:reclamation.php');
	}
	else
		$error = "Missing information";
	}
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>ADD reclamation</title>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Roboto:400,700"
    />
    <link rel="shortcut icon" href="../img/favicon.png">
    <!-- https://fonts.google.com/specimen/Roboto -->
    <link rel="stylesheet" href="css/fontawesome.min.css" />
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="jquery-ui-datepicker/jquery-ui.min.css" type="text/css" />
    <!-- http://api.jqueryui.com/datepicker/ -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="css/templatemo-style.css">
    <!--
	Product Admin CSS Template
	https://templatemo.com/tm-524-product-admin
	-->
  </head>

  <body>
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
                        <a class="nav-link active" href="Reclamation.php">
                        <i class="far fa-file-alt"></i> Reclamations
                        </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="evaluation.php">
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
                            <a class="nav-link" href="Accounts.php">
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
    <div class="container tm-mt-big tm-mb-big">
      <div class="row">
        <div class="col-xl-9 col-lg-10 col-md-12 col-sm-12 mx-auto">
          <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
            <div class="row">
              <div class="col-12">
                <h2 class="tm-block-title d-inline-block">Ajouter reclamation</h2>
              </div>
            </div>
            <div class="row tm-edit-product-row">
              <div class="col-xl-6 col-lg-6 col-md-12">
                <form action="" method="post" class="tm-edit-product-form">
                  <div class="form-group mb-3">
                    <label
                      for="name"
                      >Titre
                    </label>
                    <input
                      id="titre"
                      name="titre"
                      type="text"
                      class="form-control validate"
                      required
                    />
                  </div>
                  <div class="form-group mb-3">
                    <label
                      for="description"
                      >Contenue</label
                    >
                    <textarea
                    id="message"
                      name="message"
                      class="form-control validate"
                      rows="3"
                      required
                    ></textarea>
                  </div>
                  <div class="row">
                      <div class="form-group mb-3 col-xs-12 col-sm-6">
                          <label
                            for="expire_date"
                            >Nom d'immuteur
                          </label>
                          <input
                            id="nom"
                            name="nom"
                            type="text"
                            class="form-control validate"
                            data-large-mode="true"
                          />
                        </div>
                        <div class="form-group mb-3 col-xs-12 col-sm-6">
                          <label
                            for="stock"
                            >Nom du recepteur
                          </label>
                          <input
                            id="receive"
                            name="receive"
                            type="text"
                            class="form-control validate"
                            required
                          />
                        </div>
                  </div>
                  
              </div>
              
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block text-uppercase">Ajouter reclamation</button>
              </div>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <footer class="tm-footer row tm-mt-small">
        <div class="col-12 font-weight-light">

        </div>
    </footer> 

    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="jquery-ui-datepicker/jquery-ui.min.js"></script>
    <!-- https://jqueryui.com/download/ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
    <script>
      $(function() {
        $("#expire_date").datepicker();
      });
    </script>
  </body>
</html>
