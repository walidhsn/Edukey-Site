
<?php
session_start();
if (!isset($_SESSION['logged'])) {
	header('Location: login_admin.php');
	exit;
    }
require_once $_SERVER['DOCUMENT_ROOT'].'\mycruds\config.php';
require_once $_SERVER['DOCUMENT_ROOT'].'\mycruds\Model\evaluation.php';
require_once $_SERVER['DOCUMENT_ROOT'].'\mycruds\Controller\evaluationController.php';
$evaluationC=new evaluationC();
$evaluationC->supprimerEvaluation($_GET["id"]);
header('Location:evaluation.php');
?>