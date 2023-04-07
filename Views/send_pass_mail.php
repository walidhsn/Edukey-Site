<?php
include_once 'C:\xampp\htdocs\mycruds\config.php';

if(isset($_POST['sendbutton']))
{
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);
    $url = "http://localhost/mycruds/Views/create_new_password.php?selector=".$selector."&validator=".bin2hex($token);
    //time of expires of the token:
    $expires = date("U")+1800;
    
    //sender : 
    $to = $_POST['email'];
    //connexion
    $db=config::getConnexion();

    //delete if existe:

    $sql="DELETE FROM pwdreset where pwdResetEmail = :pwdResetEmail";
    $req=$db->prepare($sql);
    $req->bindValue(':pwdResetEmail',$to);
    try{
        $req->execute();
        }
    catch (Exception $e){
        die('Erreur: '.$e->getMessage());
    }

    //Stock the token in DB : 
    
    $sql="insert into pwdreset (pwdResetEmail,pwdResetSelector,pwdResetToken,pwdResetExpires) values (:pwdResetEmail,:pwdResetSelector,:pwdResetToken,:pwdResetExpires)";
    $hachedToken = password_hash($token,PASSWORD_DEFAULT);
    try{
        $req=$db->prepare($sql);
        //BIND :
        $req->bindValue(':pwdResetEmail',$to);
        $req->bindValue(':pwdResetSelector',$selector);
        $req->bindValue(':pwdResetToken',$hachedToken);
        $req->bindValue(':pwdResetExpires',$expires);
        $req->execute();
        }catch(Exception $e){
            die('Erreur:'. $e->getMessage());
        }
    //Email Config: 
    include 'mailConfig.php';
    $email_template = 'mail_password/index.html';
    $message = file_get_contents($email_template);
    $actualUrl = '<a href="'.$url.'">'.$url.'</a>';
    $message = str_replace('THE_LINK_OF_USER',$actualUrl,$message);
    $mail->Subject = 'Edukey- Reset Link';
    $mail->AddAddress($to);
    $mail->addReplyTo('edukey.site@gmail.com', 'Edukey site');
    $mail->addCC('');
    $mail->addBCC('');
    $mail->MsgHTML($message);
    if(!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
       }
    header('Location: mail_sent.php');
}
else
{
    header('Location: page-login.php');
}
?>