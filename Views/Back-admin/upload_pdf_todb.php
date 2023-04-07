<?php 
    include_once 'C:\xampp\htdocs\mycruds\Controller\CoursC.php';
    session_start();
    if (!isset($_SESSION['logged'])) {
        header('Location: login_admin.php');
        exit;
        }
    $CoursC = new CoursC();
    
    var_dump($_FILES);
    echo "<br>";
    var_dump(isset($_FILES['upload']));
    echo "<br>";
    var_dump($_POST);
    if(isset($_POST['submit']))
    {
        $id_pdf = $_POST['id_Cour'];
       
        $fileName = $_FILES['upload']['name'];
        $fileTmpName = $_FILES['upload']['tmp_name'];
        $fileSize = $_FILES['upload']['size'];
        $fileType = $_FILES['upload']['type'];
        $fileError = $_FILES['upload']['error'];
      
        $fileExt = explode('.',$fileName);
        $fileActExt = strtolower(end($fileExt));
        $allowed = array('pdf');
      
        if(in_array($fileActExt,$allowed))
        {
            
            if(!$fileError)
            {
                if($fileSize < 1000000000)
                {
                   
                    $fileDestination = 'C:/xampp/htdocs/mycruds/Views/cour_pdf/'.$fileName;
                    $displayDestination = 'cour_pdf/'.$fileName;
                    if(!$CoursC->find_pdf_name($fileName))
                    {
                        if(move_uploaded_file($fileTmpName,$fileDestination))
                        {
                                $CoursC->upload_pdf($id_pdf,$fileName,$displayDestination,$fileActExt);
                                header('Location: Home.php');
                            
                        }
                    }
                    else echo "> Please change the file name because there's one with the same name and try again ..!";
                }
                else echo "THE File is bigger than 125 MB.";
            }
            else echo " 'ERROR TO UPLOAD THE FILE' ";
        }
        else echo "You can't upload this type of Files Only '.PDF'.";
    }

?>