<?php
session_start();
if (!isset($_SESSION['logged'])) {
	header('Location: login_admin.php');
	exit;
    }
require_once $_SERVER['DOCUMENT_ROOT'].'\mycruds\config.php';
require_once $_SERVER['DOCUMENT_ROOT'].'\mycruds\Model\evaluation.php';
require_once $_SERVER['DOCUMENT_ROOT'].'\mycruds\Controller\evaluationController.php';
$evaluation = null;
$evaluationC = new evaluationC();

$id = $_GET["id"];
$evaluation = $evaluationC->recupererEvaluation($id);

$cate = $evaluation['cate'];
$nb_qs = $evaluation['nb_qs'];
$base_qs = $evaluation['base_qs'];

if($_SERVER["REQUEST_METHOD"] == "POST") {
if (
		
	isset($_POST["nom"]) &&		
	isset($_POST["message"]) && 
	isset($_POST["titre"])
) {
	if (
		!empty($_POST["titre"]) && 
		!empty($_POST["nom"]) && 
		!empty($_POST["message"])
	) {
		echo '<script type="text/javascript">alert("Reclamation a ete envoyer!");</script>';
		$evaluation = new evaluation(
			$_POST['nom'],
			$_POST['message'],
			$_POST['titre']
		);
		$evaluationC->modifierEvaluation($evaluation, $id);
		echo '<script type="text/javascript">alert("Reclamation a ete envoyer!");</script>';
		header('Location:evaluation.php');
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
    <title>Modify Reclamation</title>
    <link rel="shortcut icon" href="../img/favicon.png">
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Roboto:400,700"
    />
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
                        <a class="nav-link " href="Reclamation.php">
                        <i class="far fa-file-alt"></i> Reclamations
                        </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link active" href="evaluation.php">
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
                <h2 class="tm-block-title d-inline-block">Modifier l'evaluation</h2>
              </div>
            </div>
            <div class="row tm-edit-product-row">
              <div class="col-xl-6 col-lg-6 col-md-12">
                <form action="" method="post" class="tm-edit-product-form">
                  <div class="form-group mb-3">
                    <label
                      for="name"
                      >Question
                    </label>
                    <input
                    value="<?php echo $base_qs; ?>"
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
                      >Note</label
                    >
                    <input
                    value="<?php echo $nb_qs; ?>"
                    id="message"
                      name="message"
                      class="form-control validate"
                      rows="3"
                      required
                    >
                  </div>
                  <div class="row">
                      <div class="form-group mb-3 col-xs-12 col-sm-6">
                          <label
                            for="expire_date"
                            >Reponse
                          </label>
                          <input
                          value="<?php echo $cate; ?>"
                            id="nom"
                            name="nom"
                            type="text"
                            class="form-control validate"
                            data-large-mode="true"
                          />
</div>
                  </div>
                  
              </div>
              
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block text-uppercase">Modifier reclamation</button>
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
