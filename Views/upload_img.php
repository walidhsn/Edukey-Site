<?php 
    include_once 'C:\xampp\htdocs\mycruds\Controller\UserC.php';
    session_start();
    $userC = new UserC();
    if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit;
    }
    $ban_check=$userC->chercher_user($_SESSION['id']);
		if($ban_check['ban'])
		{
            session_start();
			session_unset();
			session_destroy();
			header('Location:page-login.php?error=Your Account Has been Banned by The Admin , Contact us for more information.');
		}
    var_dump($_FILES);
    echo "<br>";
    var_dump(isset($_FILES['upload']));
    echo "<br>";
    var_dump($_POST);
    if(isset($_POST['submit']))
    {
        
       

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
                        if(!$userC->display_img($_SESSION['id']))
                        {
                            echo " <h3>works6</h3>";
                            $userC->upload_img($_SESSION['id'],$fileNameNew,$displayDestination,$fileActExt);
                        }
                        else{
                            $userC->supprimer_img($_SESSION['id']);
                            $userC->upload_img($_SESSION['id'],$fileNameNew,$displayDestination,$fileActExt);
                        }
                        header('Location: profil.php');
                    }
                }
                else echo "THE File is bigger than 125 MB.";
            }
            else echo " 'ERROR TO UPLOAD THE FILE' ";
        }
        else echo "You can't upload this type of Files.";
    }

?>