<?php
session_start();
if (!isset($_SESSION['logged'])) {
	header('Location: login_admin.php');
	exit;
    }
    include_once 'C:\xampp\htdocs\mycruds\Controller\UserC.php';
    $userC = new UserC();
    if(isset($_POST['id_user']))
    {
        if(!empty($_POST['id_user']))
        {
            $id= $_POST['id_user'];
            $userC->unban_user($id);
        }
    } 
    header('Location: Accounts.php');
?>