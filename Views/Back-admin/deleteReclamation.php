
<?php
session_start();
if (!isset($_SESSION['logged'])) {
	header('Location: login_admin.php');
	exit;
    }
require_once $_SERVER['DOCUMENT_ROOT'].'\mycruds\config.php';
require_once $_SERVER['DOCUMENT_ROOT'].'\mycruds\Model\reclamation.php';
require_once $_SERVER['DOCUMENT_ROOT'].'\mycruds\Controller\reclamationController.php';
$reclamationC=new reclamationC();
$reclamationC->supprimerReclamation($_GET["id"]);
header('Location:reclamation.php');
?>