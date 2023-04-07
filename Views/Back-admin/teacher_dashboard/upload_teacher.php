<?php 
    include_once 'C:\xampp\htdocs\mycruds\Controller\formationC.php';
    session_start();
    if (!isset($_SESSION['loggedin'])) {
        header('http://localhost/mycruds/Views/index.php');
        exit;
        }
    $formationC = new FormationC();
    
    var_dump($_FILES);
    echo "<br>";
    var_dump(isset($_FILES['upload']));
    echo "<br>";
    var_dump($_POST);
    if(isset($_POST['submit']))
    {
        $id_img = $_POST['id_Forma'];
        
       

        $fileName = $_FILES['upload']['name'];
        $fileTmpName = $_FILES['upload']['tmp_name'];
        $fileSize = $_FILES['upload']['size'];
        $fileType = $_FILES['upload']['type'];
        $fileError = $_FILES['upload']['error'];
      
        $fileExt = explode('.',$fileName);
        $fileActExt = strtolower(end($fileExt));
        $allowed = array('png','jpg','jpeg');
      
        if(in_array($fileActExt,$allowed))
        {
            
            if(!$fileError)
            {
                if($fileSize < 1000000000)
                {
                   
                    $fileNameNew = uniqid('',TRUE).".".$fileActExt;
                    $fileDestination = 'C:/xampp/htdocs/mycruds/Views/formation_images/'.$fileNameNew;
                    $displayDestination = 'formation_images/'.$fileNameNew;
                    if(move_uploaded_file($fileTmpName,$fileDestination))
                    {
                        
                        if(!$formationC->display_img($id_img))
                        {
                            
                            $formationC->upload_img($id_img,$fileNameNew,$displayDestination,$fileActExt);
                        }
                        else{
                            $formationC->supprimer_img($id_img);
                            $formationC->upload_img($id_img,$fileNameNew,$displayDestination,$fileActExt);
                        }
                        header('Location: Home_teacher.php');
                    }
                }
                else echo "THE File is bigger than 125 MB.";
            }
            else echo " 'ERROR TO UPLOAD THE FILE' ";
        }
        else echo "You can't upload this type of Files.";
    }

?>