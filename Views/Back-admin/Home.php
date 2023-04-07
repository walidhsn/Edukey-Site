<?php
session_start();
if (!isset($_SESSION['logged'])) {
	header('Location: login_admin.php');
	exit;
    }
include_once 'C:\xampp\htdocs\mycruds\Controller\formationC.php';
include_once 'C:\xampp\htdocs\mycruds\Controller\categorieC.php';
include_once 'C:\xampp\htdocs\mycruds\Controller\CoursC.php';
include_once 'C:\xampp\htdocs\mycruds\Controller\offerC.php';
$formation = new FormationC();
$cour = new CoursC();
$categorie = new categorieC();
$offer = new offerC();
$liste_f = $formation->afficher_formation();
$liste_c = $cour->afficherCours();
$liste_cat = $categorie->afficher_categorie();
$liste_o = $offer->afficher_offer();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin - Dashboard </title>
    <link rel="shortcut icon" href="../img/favicon.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <!-- https://fonts.google.com/specimen/Roboto -->
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
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
                        <a class="nav-link" href="Reclamation.php">
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
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="text-white mt-5 mb-5">Welcome back, <b  style="color:gold;"><?=$_SESSION['name_admin']?></b></p>
                </div>
            </div>
             <!-- row Categorie-->
             <div class="col-12 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
                        <h2 class="tm-block-title">Categories List</h2>
                        <form action="ajouter_categorie.php" method="post">
                        <button type="submit" class="btn btn-primary btn-block text-uppercase" name="ajouter"> + ADD CATEGORIE</button>
                        </form>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">ICON</th>
                                    <th scope="col">Modification</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
            <!--PHP-->
            <?php
                foreach($liste_cat as $row3)
                { ?>
                                <tr>
                                    <th scope="row"><b>#<?=$row3['id_categorie'] ?></b></th>
                                    <td>
                                        <div class="tm-status-circle moving">
                                        </div><b><?=$row3['nom_categorie'] ?></b>
                                    </td>
                                    <td><b><?=$row3['icon_html'] ?></b></td>                                   
                                    <td>
                                        <form method="POST" action="modifie_categorie.php">    
                                        <i class="fas fa-cog"></i> <input type="submit" name="ModifierCategorie" value="Modify"> <input type="hidden" value=<?= $row3['id_categorie'] ?> name="id_categorie">
                                        </form>
                                    </td>
                                    
                                    
                                    <td>
                                        <a href="supprimer_categorie.php?id_categorie=<?= $row3['id_categorie'] ?>"><i class="far fa-trash-alt tm-product-delete-icon"></i></a>
                                    </td>
                               
                                </tr>
            <?PHP
                }
                ?>
                    </tbody>
                </table>
                 </div>
            </div>
        
             <!-- row Categorie-->

                <!-- row Offer-->
                <div class="col-12 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
                        <h2 class="tm-block-title">OFFERS List</h2>
                        <form action="ajouter_offer.php" method="post">
                        <button type="submit" class="btn btn-primary btn-block text-uppercase" name="ajouter"> + ADD OFFER</button>
                        </form>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID - OFFER</th>
                                    <th scope="col">ID - Formation</th>
                                    <th scope="col">PERCENTAGE</th>
                                    <th scope="col">PRICE Before</th>
                                    <th scope="col">PRICE After</th>
                                    <th scope="col">Modification</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
            <!--PHP-->
            <?php
                foreach($liste_o as $row4)
                { ?>
                                <tr>
                                    <th scope="row"><b>#<?=$row4['id_offer'] ?></b></th>
                                    <td>
                                        <div class="tm-status-circle cancelled">
                                        </div><b>#<?=$row4['id_formation'] ?></b>
                                    </td>
                                    <td><b><?=$row4['pourcentage'] ?> %</b></td>
                                    <td><b><?=$row4['price_before'] ?> .DT</b></td>
                                    <td><b><?=$row4['price_after'] ?> .DT</b></td>                                     
                                    <td>
                                        <form method="POST" action="modifie_offer.php">    
                                        <i class="fas fa-cog"></i> <input type="submit" name="ModifierOffer" value="Modify"> <input type="hidden" value=<?= $row4['id_offer'] ?> name="id_offer">
                                        </form>
                                    </td>
                                    
                                    
                                    <td>
                                        <a href="supprimer_offer.php?id_offer=<?= $row4['id_offer'] ?>"><i class="far fa-trash-alt tm-product-delete-icon"></i></a>
                                    </td>
                               
                                </tr>
            <?PHP
                }
                ?>
                    </tbody>
                </table>
                 </div>
            </div>
        
             <!-- row Offer-->
            <!-- row Formation-->
                <div class="col-12 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
                        <h2 class="tm-block-title">Formations List</h2>
                        <form action="ajouter_formation.php" method="post">
                        <button type="submit" class="btn btn-primary btn-block text-uppercase" name="ajouter"> + ADD FORMATION</button>
                        </form>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Categorie</th>
                                    <th scope="col">Num Courses</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Rate</th>
                                    <th scope="col">Modification</th>
                                    <th scope="col">Delete</th>
                                    <th scope="col">Picture</th>
                                </tr>
                            </thead>
                            <tbody>
            <!--PHP-->
            <?php
                foreach($liste_f as $row)
                { ?>
                                <tr>
                                    <th scope="row"><b>#<?=$row['id_formation'] ?></b></th>
                                    <td>
                                        <div class="tm-status-circle moving">
                                        </div><b><?=$row['nom'] ?></b>
                                    </td>
                                    <td><b><?=$row['categorie'] ?></b></td>
                                    <td><b><?=$row['nb_cour'] ?></b></td>
                                    <td><b><?=$row['temp'] ?> .Hours</b></td>
                                    <td><?=$row['prix'] ?> .Dt</td>
                                    <td><?=$row['taux'] ?> .Stars</td>
                                   
                                    <td>
                                        <form method="POST" action="modif_formation.php">    
                                        <i class="fas fa-cog"></i> <input type="submit" name="ModifierFormation" value="Modify"> <input type="hidden" value=<?= $row['id_formation'] ?> name="id_formation">
                                        </form>
                                    </td>
                                    
                                    
                                    <td>
                                        <a href="supprimer_formation.php?id_formation=<?= $row['id_formation'] ?>"><i class="far fa-trash-alt tm-product-delete-icon"></i></a>
                                    </td>
                                    <td>
                                        <form method="POST" action="upload_imageForma.php">    
                                        </i> <input type="submit" name="upload" value="Upload"> <input type="hidden" value=<?= $row['id_formation'] ?> name="id_picture"></td>
                                        </form>
                                    </td>
                                </tr>
            <?PHP
                }
                ?>
            <!--PHP-->
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                    <!-- row Cours-->
                    <div class="col-12 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
                        <h2 class="tm-block-title">Courses List</h2>
                        <form action="ajouter_cour.php" method="post">
                        <button type="submit" class="btn btn-primary btn-block text-uppercase" name="ajouterCour"> + ADD COURSES</button>
                        </form>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">ID Formation</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Pages</th>
                                    <th scope="col">Date of Creation</th>
                                    <th scope="col">Date of Modif</th>

                                    <th scope="col">Modification</th>
                                    <th scope="col">Delete</th>
                                    <th scope="col">Files</th>
                                </tr>
                            </thead>
                            <tbody>
                         <!--PHP-->
            <?php
                foreach($liste_c as $row2)
                { ?>
                                <tr>
                                    <th scope="row"><b>#<?=$row2['idCours'] ?></b></th>
                                    <th scope="row"><b>#<?=$row2['idFormation'] ?></b></th>
                                    <td>
                                        <div class="tm-status-circle pending">
                                        </div><b><?=$row2['nomCours'] ?></b>
                                    </td>
                                    <td><b><?=$row2['nbrPage'] ?></b></td>
                                    <td><b><?=$row2['dateCreation'] ?></b></td>
                                    <td><b><?=$row2['dateModification'] ?></b></td>
                                   
                                    <td>
                                    <form method="POST" action="modifier_cour.php">    
                                    <i class="fas fa-cog"></i> <input type="submit" name="ModifierCour" value="Modify"> <input type="hidden" value=<?= $row2['idCours'] ?> name="idCours"></td>
                                    </form>
                                    
                                    <td>
                                    <a href="supprimer_cour.php?id_cour=<?= $row2['idCours'] ?>"><i class="far fa-trash-alt tm-product-delete-icon"></i></a>
                                    </td>
                                    <td>
                                    <form method="POST" action="upload_pdf.php">    
                                        </i> <input type="submit" name="uploadFile" value="Upload"> <input type="hidden" value=<?= $row2['idCours'] ?> name="id_file"></td>
                                    </form>
                                    </td>
                                </tr>
            <?PHP
                }
                ?>
            <!--PHP-->
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <footer class="tm-footer row tm-mt-small">
          
        </footer>
    </div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="js/moment.min.js"></script>
    <!-- https://momentjs.com/ -->
    <script src="js/Chart.min.js"></script>
    <!-- http://www.chartjs.org/docs/latest/ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
    <script src="js/tooplate-scripts.js"></script>
    <script>
        Chart.defaults.global.defaultFontColor = 'white';
        let ctxLine,
            ctxBar,
            ctxPie,
            optionsLine,
            optionsBar,
            optionsPie,
            configLine,
            configBar,
            configPie,
            lineChart;
        barChart, pieChart;
        // DOM is ready
        $(function () {
            drawLineChart(); // Line Chart
            drawBarChart(); // Bar Chart
            drawPieChart(); // Pie Chart

            $(window).resize(function () {
                updateLineChart();
                updateBarChart();                
            });
        })
    </script>
</body>

</html>