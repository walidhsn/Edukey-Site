<?php
include_once 'C:\xampp\htdocs\mycruds\config.php';
include_once 'C:\xampp\htdocs\mycruds\Controller\UserC.php';
session_start();
if (!isset($_SESSION['logged'])) {
	header('Location: login_admin.php');
	exit;
    }
$userC = new UserC();
$result= $userC->afficher_user();
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
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="text-white mt-5 mb-5">Welcome back, <b  style="color:gold;"><?=$_SESSION['name_admin']?></b></p>
                </div>
            </div>
            <!-- row -->
            <div class="row tm-content-row">
               
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-overflow">
                        <form action="search_user.php" methode="post">
                            <h2 class="tm-block-title" style="color:cyan;">Search for User</h2>
                            <div>
                             <input type="text" name="search" id="search" class="form-control validate">
                             <div class="form-group mt-4"><button type="submit" class="btn btn-primary btn-block text-uppercase" name="searchbutton">Search</button></div>
                             
                            </div>
                        </form>
                    </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
                
            </div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-overflow">
                        <h2 class="tm-block-title"  style="color:blue;">Students List </h2>
                        <div class="tm-notification-items">
                            <?php foreach($result as $row2){
                                if($row2['choix'] == "s"){
                                    $pic = $userC->display_img($row2['id_user']); ?>
                            <div class="media tm-notification-item">
                                <?php if($pic != FALSE){?>
                                <div class="tm-gray-circle"><img src="../<?=$pic['img']?>" width="80" height="80" alt="Avatar Image" class="rounded-circle"></div>
                                <?php }else{?>
                                    <div class="tm-gray-circle"><img src="../Users_img/user.png" width="80" height="80"  alt="Avatar Image" class="rounded-circle"></div>
                                <?php }?>
                                <div class="media-body">
                                    <p class="mb-2"><b><?=$row2['nom']?></b><b> <?=$row2['prenom']?></b> <a href="inscpect_user.php?id_user=<?=$row2['id_user']?>"
                                            class="tm-notification-link"> | Inspect</a></p>
                                    <span class="tm-small tm-text-color-secondary">Email : <?=$row2['email']?></span>
                                </div>
                            </div>
                            <?php }
                        }?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-overflow">
                        <h2 class="tm-block-title"  style="color:blue;">Teachers List</h2>
                        <div class="tm-notification-items">
                        <?php 
                        $result= $userC->afficher_user();
                        foreach($result as $row3){
                                if($row3['choix'] == "t"){ 
                                    $pic = $userC->display_img($row3['id_user']);?>
                            <div class="media tm-notification-item">
                            <?php if($pic != FALSE){?>
                                <div class="tm-gray-circle"><img src="../<?=$pic['img']?>" width="80" height="80" alt="Avatar Image" class="rounded-circle"></div>
                                <?php }else{?>
                                    <div class="tm-gray-circle"><img src="../Users_img/user.png" width="80" height="80" alt="Avatar Image" class="rounded-circle"></div>
                                <?php }?>
                                <div class="media-body">
                                    <p class="mb-2"><b><?=$row3['nom']?></b> <b><?=$row3['prenom']?></b> <a href="inscpect_user.php?id_user=<?=$row3['id_user']?>"
                                            class="tm-notification-link"> | Inspect</a></p>
                                    <span class="tm-small tm-text-color-secondary">Email : <?=$row2['email']?></span>
                                </div>
                            </div>
                            <?php }
                        }?>
                        </div>
                    </div>
                </div>
                
                 <!-- row user-->
                 <div class="col-12 tm-block-col ">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
                        <h2 class="tm-block-title" style="color:cyan;">Users List</h2>
                        <form action="ajouter_user.php" method="post">
                        <button type="submit" class="btn btn-primary btn-block text-uppercase" name="ajouter"> + ADD User</button>
                        </form>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">CIN</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Last_Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Telephone</th>
                                    <th scope="col">Sexe</th>
                                    <th scope="col">DATE_OF_Birth</th>
                                    <th scope="col">User_Name</th>
                                    <th scope="col">OCCUPATION</th>
                                    <th scope="col">Email-Verify Statut</th>
                                    <th scope="col">Verify</th>
                                    <th scope="col">Modify</th>
                                    <th scope="col">DELETE</th>
                                    <th scope="col">BAN</th>
                                    <th scope="col">UNBAN</th>
                                    <th scope="col">Picture</th>
                                </tr>
                            </thead>
                            <tbody>
            <!--PHP-->
            <?php
            $result= $userC->afficher_user();
                foreach($result as $row)
                { 
                    $verif=$userC->retrun_etat_verif($row['username']);
                    ?>
                                <tr>
                                    <th scope="row"><b>#<?=$row['id_user'] ?></b></th>
                                    <td>
                                        <?php if($row['ban']) :?>
                                        <div class="tm-status-circle cancelled">
                                        <?php
                                        else : ?>
                                        <div class="tm-status-circle moving">
                                            <?php endif;?>
                                        </div><b><?=$row['cin'] ?></b>
                                    </td>
                                    <td><b><?=$row['nom'] ?></b></td>
                                    <td><b><?=$row['prenom'] ?></b></td>
                                    <td><b><?=$row['email'] ?></b></td>
                                    <td><?=$row['telephone'] ?></td>
                                    <td><?=$row['sexe'] ?></td>
                                    <td><?=$row['date_n'] ?></td>
                                    <td><?=$row['username'] ?></td>
                                    <td><?=$row['choix'] ?></td>
                                    <td><?php
                                    if(!$verif['etat_verif']):
                                    ?>
                                    <div class="tm-status-circle cancelled"></div>
                                    <?php
                                    else :
                                    ?>
                                    <div class="tm-status-circle moving"></div>
                                    <?php endif; ?>
                                    <?=$verif['etat_verif']?>
                                    </td>
                                    <td>
                                        <form method="POST" action="verif_useremail.php">    
                                        <i class="fas fa-cog"></i> <input type="submit" name="VerifUser" value="Verify"  > <input type="hidden" value=<?= $row['username'] ?> name="username">
                                        </form>
                                    </td>
                                    <td>
                                        <form method="POST" action="modif_user.php">    
                                        <i class="fas fa-cog"></i> <input type="submit" name="ModifierUser" value="Modify"  > <input type="hidden" value=<?= $row['id_user'] ?> name="id_user">
                                        </form>
                                    </td>
                                    <td>
                                        <a href="supprimer_user.php?id_user=<?= $row['id_user'] ?>"><i class="far fa-trash-alt tm-product-delete-icon"></i></a>
                                    </td>
                                    <td>
                                        <form method="POST" action="ban.php">    
                                        <input type="submit" name="ban" value="BAN" class="btn btn-primary btn-block"> <input type="hidden" value=<?= $row['id_user'] ?> name="id_user">
                                        </form>
                                    </td>
                                    <td>
                                        <form method="POST" action="unban.php">    
                                         <input type="submit" name="unban" value="UN-BAN" class="btn btn-primary btn-block"> <input type="hidden" value=<?= $row['id_user'] ?> name="id_user">
                                        </form>
                                    </td>
                                    <td>
                                        <form method="POST" action="upload_image_user.php">    
                                         <input type="submit" name="upload" value="Upload"> <input type="hidden" value=<?= $row['id_user'] ?> name="id_picture"></td>
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