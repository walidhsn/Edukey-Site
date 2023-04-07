<?php
session_start();
if (!isset($_SESSION['logged'])) {
	header('Location: login_admin.php');
	exit;
    }
    include_once 'C:\xampp\htdocs\mycruds\Controller\UserC.php';
    include_once 'C:\xampp\htdocs\mycruds\Controller\FormateurC.php';
    include_once 'C:\xampp\htdocs\mycruds\Controller\EtudiantC.php';
    include_once 'C:\xampp\htdocs\mycruds\config.php';
    $userC = new UserC();
    $formateurC = new FormateurC();
    $etudiantC = new EtudiantC();
    $id = $_GET['id_user'];
    $user = $userC->chercher_user($id);
    if($user != false)
    {
        if($user['choix'] == "s")
        {
            $etudiantC->supprimer_etudiant($user['cin']);
        }
        else if($user['choix'] == "t")
        {
            $formateurC->supprimer_formateur($user['cin']);
        }
            //supprision de verif
            $sql="DELETE FROM verification where username_verif=:username_verif";
            $db = config::getConnexion();
            $req=$db->prepare($sql);
            $req->bindValue(':username_verif',$user['username']);
            try{
                $req->execute();
            }
            catch (Exception $e){
                die('Erreur: '.$e->getMessage());
            }
            //********** 
        $userC->supprimer_img($id);  
        $userC->supprimer_user($id);
        header('Location: Accounts.php');
    }
?>