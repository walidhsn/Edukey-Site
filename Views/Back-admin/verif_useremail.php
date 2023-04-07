<?php
session_start();
if (!isset($_SESSION['logged'])) {
	header('Location: login_admin.php');
	exit;
    }
    include_once 'C:\xampp\htdocs\mycruds\Controller\UserC.php';
    $userC = new UserC();
    if(isset($_POST['username']))
    {
        if(!empty($_POST['username']))
        {
            $username= $_POST['username'];
            $userC->verif_email($username);
        }
    } 
    header('Location: Accounts.php');
?>