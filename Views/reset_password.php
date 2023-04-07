<?php
include_once 'C:\xampp\htdocs\mycruds\config.php';

if(isset($_POST['create']))
{
    $selector = $_POST['selector'];
    $validator = $_POST['validator'];
    $passw = $_POST['passw'];
    $cpassw = $_POST['cpassw'];

    if(empty($passw ) || empty($cpassw))
    {
        header('Location: page-login.php?error=the Password field are empty in the reset password section try again later');
    }
    else if($passw != $cpassw)
    {
        header('Location: page-login.php?error=the two Passwords u Enter not the Same try again');
    }

    $currentDate = date("U");

    $sql="SELECT * FROM pwdreset where pwdResetSelector = :pwdResetSelector	AND pwdResetExpires >= :pwdResetExpires";
	$db = config::getConnexion();
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':pwdResetSelector',$selector);
    $stmt->bindValue(':pwdResetExpires',$currentDate);
    $stmt->execute();
	$count=$stmt->rowCount();
	if ($count > 0) {
    $row = $stmt->fetch();
    
    $tokenBin = hex2bin($validator);
    $tokenCheck = password_verify($tokenBin,$row['pwdResetToken']);

        if($tokenCheck === false)
        {
            header('Location: page-login.php?error=You need to Resend your Reset Password Request , cause it expires.');
        }
        else if($tokenCheck === true)
        {
            $tokenEmail = $row['pwdResetEmail'];
            $sql="SELECT * FROM users where email = :email";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':email',$tokenEmail);
            $stmt->execute();
            $count=$stmt->rowCount();
            if ($count > 0) {
            $row = $stmt->fetch();
                $passwordHash = password_hash($passw,PASSWORD_DEFAULT);
                try {
                    $query = $db->prepare(
                        'UPDATE users SET 
                            pass_word= :pass_word
                            WHERE 	email= :email'
                    );
                    $query->execute([
                        'pass_word' => $passwordHash,
                        'email' => $tokenEmail
                    ]);
                } catch (PDOException $e) {
                    $e->getMessage();
                }

                $sql="DELETE FROM pwdreset where pwdResetEmail = :pwdResetEmail";
                $req=$db->prepare($sql);
                $req->bindValue(':pwdResetEmail',$tokenEmail);
                try{
                    $req->execute();
                    }
                catch (Exception $e){
                    die('Erreur: '.$e->getMessage());
                }
                header('Location: page-login.php?error=the Password Updated.');
            }
            else
            {
                echo "User Not Found try again..";
            }
        }
    }
    else echo "Not Found..";
}
else
{
    header('Location: index.php');
}
?>