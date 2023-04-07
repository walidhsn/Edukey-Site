<?php
session_start();
if (!isset($_SESSION['logged'])) {
	header('Location: login_admin.php');
	exit;
    }
include_once 'C:\xampp\htdocs\mycruds\Controller\CoursC.php';
$cour = new CoursC();
$id_cour= $_GET['id_cour'];
$cour->supprimerCours($id_cour);
header('Location: Home.php');
?>