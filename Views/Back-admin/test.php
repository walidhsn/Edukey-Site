<?php
/*include_once 'C:\xampp\htdocs\mycruds\config.php';
$sql="SELECT * FROM (SELECT * FROM formations ORDER BY id_formation DESC LIMIT 3 ) as r ORDER BY id_formation";
$db = config::getConnexion();
try{
    $liste_a = $db->query($sql);
    $row=$liste_a->fetchAll();
}
catch(Exception $e){
    die('Erreur:'. $e->getMeesage());
}

    var_dump($row[0]['nom']);
    echo "<br>"*/
    /*include_once 'C:\xampp\htdocs\mycruds\Controller\UserC.php';
    $userc = new UserC();
    $result = $userc->select_first_teacher();
   var_dump($result[0]);
   echo "<br>";
   var_dump($result[1]);
   echo "<br>";
   var_dump($result[2]);
   echo "<br>";
   var_dump($result[4]);
   echo "<br>";
   $count=sizeof($result);
   echo $count;*/
   
include_once 'C:\xampp\htdocs\mycruds\Controller\UserC.php';
session_start();
if (!isset($_SESSION['logged'])) {
	header('Location: login_admin.php');
	exit;
    }
$userC = new UserC();
$content ="";
if(isset($_POST['search']))
{
    $content = $_POST['search'];
}
$result = $userC->search_field($content);
$count = sizeof($result);
for($i=0;$i<$count;$i++){
    echo "<br>";
    
    print_r($result[$i]);
    echo "<br>";
    echo "<br>";
}


?>
