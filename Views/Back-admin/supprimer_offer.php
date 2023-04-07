<?php
session_start();
if (!isset($_SESSION['logged'])) {
	header('Location: login_admin.php');
	exit;
    }
include_once 'C:\xampp\htdocs\mycruds\Controller\offerC.php';
$offer = new offerC();
$id_offer= $_GET['id_offer'];
$offer->supprimer_offer($id_offer);
header('Location: Home.php');
?>