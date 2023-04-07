<?php
session_start();
if (!isset($_SESSION['logged'])) {
	header('Location: login_admin.php');
	exit;
    }
include_once 'C:\xampp\htdocs\mycruds\Controller\formationC.php';
include_once 'C:\xampp\htdocs\mycruds\Controller\categorieC.php';
include_once 'C:\xampp\htdocs\mycruds\Controller\CoursC.php';
$cour = new CoursC();
$formation = new FormationC();
$categorie = new categorieC();
$liste_f = $formation->afficher_formation();
$liste_c = $cour->afficherCours();
$id_categorie= $_GET['id_categorie'];
$result = $categorie->chercher_categorie($id_categorie);
$ids = array();
$i=0;

if($result != false)
{
    foreach($liste_f as $row)
    {
      
        if($result['nom_categorie']==$row['categorie'])
        {
            $ids[$i]=$row['id_formation'];
            $formation->supprimer_formation($ids[$i]);
            $formation->supprimer_img($ids[$i]);
            $i+=1;
        }
    }
    foreach($liste_c as $row3)
    {
        foreach($ids as $row2)
        {
            if($row2 === $row3['idFormation'])
            {
                $cour->supprimerCours($row3['idCours']);
            }
        }
    }
    $categorie->supprimer_categorie($id_categorie);
}
header('Location: Home.php');

?>