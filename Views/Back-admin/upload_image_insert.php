<?php 
    include_once 'C:\xampp\htdocs\mycruds\Controller\UserC.php';
    session_start();
    if (!isset($_SESSION['logged'])) {
        header('Location: login_admin.php');
        exit;
        }
    $userC = new UserC();
    var_dump($_FILES);
    echo "<br>";
    var_dump(isset($_FILES['upload']));
    echo "<br>";
    var_dump($_POST);
    if(isset($_POST['submit']))
    {
        $id_user = $_POST['id_user'];
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
                    echo " <h3>works4</h3>";
                    $fileNameNew = uniqid('',TRUE).".".$fileActExt;
                    $fileDestination = 'C:/xampp/htdocs/mycruds/Views/Users_img/'.$fileNameNew;
                    $displayDestination = 'Users_img/'.$fileNameNew;
                    if(move_uploaded_file($fileTmpName,$fileDestination))
                    {
                        echo " <h3>works5</h3>";
                        if(!$userC->display_img($id_user))
                        {
                            echo " <h3>works6</h3>";
                            $userC->upload_img($id_user,$fileNameNew,$displayDestination,$fileActExt);
                        }
                        else{
                            $userC->supprimer_img($id_user);
                            $userC->upload_img($id_user,$fileNameNew,$displayDestination,$fileActExt);
                        }
                        header('Location: Accounts.php');
                    }
                }
                else echo "THE File is bigger than 125 MB.";
            }
            else echo " 'ERROR TO UPLOAD THE FILE' ";
        }
        else echo "You can't upload this type of Files.";
    }

?>