<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('http://localhost/mycruds/Views/index.php');
	exit;
    }
include_once 'C:\xampp\htdocs\mycruds\Controller\CoursC.php';
$cour = new CoursC();
$id_cour= $_GET['id_cour'];
$cour->supprimerCours($id_cour);
header('Location: Home_teacher.php');
?>