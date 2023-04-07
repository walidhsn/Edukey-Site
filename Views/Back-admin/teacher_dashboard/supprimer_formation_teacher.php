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
$result = $cour->afficherCours();
$id_formation = $_GET['id_formation'];
$formation->supprimer_formation($id_formation);
$formation->supprimer_img($id_formation);

foreach($result as $row)
{
	if($row['idFormation'] == $id_formation)
	{
		$cour->supprimerCours($row['idCours']);
	}
}
header('Location: Home_teacher.php');
?>