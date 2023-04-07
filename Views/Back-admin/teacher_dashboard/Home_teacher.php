<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('http://localhost/mycruds/Views/index.php');
	exit;
    }
include_once 'C:\xampp\htdocs\mycruds\Controller\formationC.php';
include_once 'C:\xampp\htdocs\mycruds\Controller\CoursC.php';

$formation = new FormationC();
$cour = new CoursC();
$liste_f = $formation->afficher_formation();
$liste_c = $cour->afficherCours();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin - Dashboard </title>
    <link rel="shortcut icon" href="../../img/favicon.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <!-- https://fonts.google.com/specimen/Roboto -->
    <link rel="stylesheet" href="../css/fontawesome.min.css">
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="../css/templatemo-style.css">
    <!--
	Product Admin CSS Template
	https://templatemo.com/tm-524-product-admin
	-->
</head>

<body id="reportsPage">
    <div class="" id="home">
        <nav class="navbar navbar-expand-xl">
            <div class="container h-100">
                <a class="navbar-brand" href="Home_teacher.php">
                    <h1 class="tm-site-title mb-0">Teacher- Dashboard</h1>
                </a>
                <button class="navbar-toggler ml-auto mr-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars tm-nav-icon"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto h-100">
                        <li class="nav-item">
                            <a class="nav-link active" href="Home_teacher.php">
                                <i class="fas fa-tachometer-alt"></i>
                                Dashboard
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link d-block" href="http://localhost/mycruds/Views/logout.php">
                            <button class="btn btn-primary btn-block text-uppercase"><?=$_SESSION['name']?> | <b>Logout</b></button>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </nav>
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="text-white mt-5 mb-5">Welcome back, <b  style="color:gold;"><?=$_SESSION['name']?></b></p>
                </div>
                <div class="col"><a href="../../index.php">
			    <img src="../../img/logo.png"  alt height="90" style="position: relative; right: 74px; top:20px;">
                 <h2 class="tm-block-title" style="position: relative; right: 49px; top:20px;"> EduKey</h2>
		        </a></div>
            </div>
             
            <!-- row Formation-->
                <div class="col-12 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
                        <h2 class="tm-block-title">Formations List</h2>
                        <form action="ajouter_formation_teacher.php" method="post">
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
                                        <form method="POST" action="modif_formation_teacher.php">    
                                        <i class="fas fa-cog"></i> <input type="submit" name="ModifierFormation" value="Modify"> <input type="hidden" value=<?= $row['id_formation'] ?> name="id_formation">
                                        </form>
                                    </td>
                                    
                                    
                                    <td>
                                        <a href="supprimer_formation_teacher.php?id_formation=<?= $row['id_formation'] ?>"><i class="far fa-trash-alt tm-product-delete-icon"></i></a>
                                    </td>
                                    <td>
                                        <form method="POST" action="upload_imageForma_teacher.php">    
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
                        <form action="ajouter_cour_teacher.php" method="post">
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
                                    <form method="POST" action="modifier_cour_teacher.php">    
                                    <i class="fas fa-cog"></i> <input type="submit" name="ModifierCour" value="Modify"> <input type="hidden" value=<?= $row2['idCours'] ?> name="idCours"></td>
                                    </form>
                                    
                                    <td>
                                    <a href="supprimer_cour_teacher.php?id_cour=<?= $row2['idCours'] ?>"><i class="far fa-trash-alt tm-product-delete-icon"></i></a>
                                    </td>
                                    <td>
                                    <form method="POST" action="">    
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

    <script src="../js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="../js/moment.min.js"></script>
    <!-- https://momentjs.com/ -->
    <script src="../js/Chart.min.js"></script>
    <!-- http://www.chartjs.org/docs/latest/ -->
    <script src="../js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
    <script src="../js/tooplate-scripts.js"></script>
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