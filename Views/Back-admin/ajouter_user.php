<?php
session_start();
if (!isset($_SESSION['logged'])) {
	header('Location: login_admin.php');
	exit;
    }
include_once 'C:\xampp\htdocs\mycruds\Controller\UserC.php';
include_once 'C:\xampp\htdocs\mycruds\Controller\EtudiantC.php';
include_once 'C:\xampp\htdocs\mycruds\Controller\FormateurC.php';
include_once 'C:\xampp\htdocs\mycruds\Controller\categorieC.php';
include_once 'C:\xampp\htdocs\mycruds\config.php';
$userC = new UserC();
$formaC = new FormateurC();
$etudC = new EtudiantC();
$categorie = new categorieC();
$liste_c = $categorie->afficher_categorie();
$error= "";
    if(isset($_POST['submit']))
    {
        echo "works";
        if(isset($_POST['cin']) && isset($_POST['name']) && isset($_POST['lname']) && isset($_POST['date']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['sexe']) && isset($_POST['username']) && isset($_POST['passw']) && isset($_POST['choix']))
		{
            echo "works2";
			if(!empty($_POST['cin']) && !empty($_POST['name']) && !empty($_POST['lname']) && !empty($_POST['date']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['sexe']) && !empty($_POST['username']) && !empty($_POST['passw']) && !empty($_POST['choix']))
			{
                echo "works3";
				$sql="SELECT * FROM users where username = :username";
				$db = config::getConnexion();
				$stmt = $db->prepare($sql);
				$stmt->bindValue(':username',$_POST['username']);
				$stmt->execute();
				$count=$stmt->rowCount();
				if ($count == 0) {
					$sql="SELECT * FROM users where email = :email";
					$stmt = $db->prepare($sql);
					$stmt->bindValue(':email',$_POST['email']);
					$stmt->execute();
					$count=$stmt->rowCount();
					if ($count == 0) {
						$sql="SELECT * FROM users where cin = :cin";
						$stmt = $db->prepare($sql);
						$stmt->bindValue(':cin',$_POST['cin']);
						$stmt->execute();
						$count=$stmt->rowCount();
						if ($count == 0) {
							if($_POST['passw'] == $_POST['cpassw']){
								$password=$_POST['passw'];
								$hash = password_hash($password, PASSWORD_DEFAULT);
								$user = new User($_POST['cin'],$_POST['name'] ,$_POST['lname'] ,$_POST['email'],$_POST['phone'],$_POST['sexe'] ,$_POST['date'] ,$_POST['username'] ,$hash,$_POST['choix'],0);
								if(($_POST['choix'] == "t") && !empty($_POST['checkbox3']))
								{
									$forma = new Formateur($_POST['cin'],0.0,$_POST['checkbox3'],0.0);
									$formaC->ajouter_formateur($forma);
								}
								else if($_POST['choix'] == "s")
								{
									$etud = new Etudiant($_POST['cin'],0.0,0);
									$etudC->ajouter_etudiant($etud);
								}
								$userC->ajouter_user($user);
								$selector = bin2hex(random_bytes(8));
								$token = random_bytes(16);
								$url = "http://localhost/mycruds/Views/mail_got_verif.php?selector=".$selector."&token=".bin2hex($token);
								$to = $_POST['email'];
								$state = 0;
								$user_name= $_POST['username'];
								$tokenHash = password_hash($token,PASSWORD_DEFAULT);
								//Stock the token in DB : 
								
								$sql="insert into verification (username_verif,email_verif,selector_verif,token_verif,etat_verif) values (:username_verif,:email_verif,:selector_verif,:token_verif,:etat_verif)";
								try{
									$req=$db->prepare($sql);
									//BIND :
									$req->bindValue(':username_verif',$user_name);
									$req->bindValue(':email_verif',$to);
									$req->bindValue(':selector_verif',$selector);
									$req->bindValue(':token_verif',$tokenHash);
									$req->bindValue(':etat_verif',$state);
									$req->execute();
									}catch(Exception $e){
										die('Erreur:'. $e->getMessage());
									}
									//Email Config: 
									include '../mailConfig.php';
									$email_template = '../email_verification/index.html';
									$message = file_get_contents($email_template);
									$actualUrl = '<a href="'.$url.'">'.$url.'</a>';
									$message = str_replace('USER_NAME_HERE',$user_name,$message);
									$message = str_replace('THE_LINK_TO_CONFIRM',$actualUrl,$message);
									$mail->Subject = 'Edukey- Email Verification';
									$mail->AddAddress($to);
									$mail->addReplyTo('edukey.site@gmail.com', 'Edukey site');
									$mail->addCC('');
									$mail->addBCC('');
									$mail->MsgHTML($message);
									if(!$mail->Send()) {
										echo "Mailer Error: " . $mail->ErrorInfo;
									}
								header('Location:Accounts.php');
							}
							else
							{
								$error= "Please Check that The two Password are the Same.";
							}
						}
						else 
						{
							$error= "CIN already Taken, Please enter another Cin";
						}
					}
					else
					{
						$error= "Email already Taken";
					}
				}
				else
				{
					$error= "Username already Taken";
				}
			}
			else 
			{
			$error= "Missing information";
			}
		}
    }


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>ADD - User</title>
    <link rel="shortcut icon" href="../img/favicon.png">
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Roboto:400,700"
    />
    <!-- https://fonts.google.com/specimen/Roboto -->
    <link rel="stylesheet" href="css/fontawesome.min.css" />
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="css/templatemo-style.css">
    <!--
	Product Admin CSS Template
	https://templatemo.com/tm-524-product-admin
	-->
  </head>

  <body id="reportsPage">
    <div class="" id="home">
    <nav class="navbar navbar-expand-xl">
            <div class="container h-100">
           
                <a class="navbar-brand" href="Home.php">
                    <h1 class="tm-site-title mb-0">Admin- Dashboard</h1>
                </a>
                <button class="navbar-toggler ml-auto mr-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars tm-nav-icon"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto h-100">
                        <li class="nav-item">
                            <a class="nav-link " href="Home.php">
                                <i class="fas fa-tachometer-alt"></i>
                                Dashboard
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link " href="Reclamation.php">
                        <i class="far fa-file-alt"></i> Reclamations
                        </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link " href="evaluation.php">
                            <i class="fas fa-address-book"></i> Evaluation
                        </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-shopping-cart"></i>
                                Buyers
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link active" href="Accounts.php">
                                <i class="far fa-user"></i>
                                Accounts
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link d-block" href="logout_admin.php">
                            <button class="btn btn-primary btn-block text-uppercase"><?=$_SESSION['name_admin']?> | <b>Logout</b></button>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
    </nav>
     
        <!-- row -->
          <div class="tm-block-col tm-col-account-settings">
            <div class="tm-bg-primary-dark tm-block tm-block-settings">
              <h2 class="tm-block-title">User Settings</h2>
            <form action="" class="tm-signup-form row" method="post">
                <div class="form-group col-lg-6">
                  <label for="Cin">CIN</label>
                  <input
                    id="cin"
                    name="cin"
                    type="text"
                    class="form-control validate"
                    placeholder="Enter CIN (8 digits)"
                    required minlength="8" maxlength="20" size="20"
                   />
                </div>
                <div class="form-group col-lg-6">
                  <label for="Name">Name</label>
                  <input
                    id="name"
                    name="name"
                    type="text"
                    placeholder="Name"
                    class="form-control validate"
                    required minlength="3" maxlength="35"
                   />
                </div>
                <div class="form-group col-lg-6">
                  <label for="name">Last-Name</label>
                  <input id="lname" name="lname" type="text" placeholder="Last Name" class="form-control validate" required minlength="2" maxlength="35" />
                </div>
                <div class="form-group col-lg-6">
                  <label for="Birth">Birth-date  </label>
                  <input id="date" name="date" type="date" class="form-control validate" required />
                </div>
                <div class="form-group col-lg-6">
                  <label for="Email">E-Mail  </label>
                  <input id="email" name="email" type="text" placeholder="info@gmail.com" class="form-control validate" required minlength="5" maxlength="30" />
                </div>
                <div class="form-group col-lg-6" >
                  <label for="Telephone">Telephone  </label>
                  <input style="position: relative; right: 65px; top:45px;" type="tel" placeholder="+216 :" id="phone" name="phone" required>
                </div>
                <div class="form-group col-lg-6">
                  <label for="Sexe">He/She is A :  </label>
                    <select name="sexe" id="sexe" required style="position: relative; right: 90px; top:45px;">
                        <option value="">--Please choose an option--</option>
                        <option value="m">Male</option>
                        <option value="f">Female</option>
                    </select>
                </div>
                <div class="form-group col-lg-6">
                  <label for="Username">UserName</label>
                  <input id="username" name="username" type="text" placeholder="UserName" class="form-control validate" required minlength="4" maxlength="25" />
                </div>
                <div class="form-group col-lg-6">
                  <label for="Username">Password</label>
                  <input id="passw" name="passw" type="password" placeholder="Password" class="form-control validate" required minlength="4" maxlength="40" />
                </div>
                <div class="form-group col-lg-6">
                  <label for="Username">Confirm Password</label>
                  <input id="cpassw" name="cpassw" type="password" placeholder="Confirm Password" class="form-control validate" required minlength="4" maxlength="40" />
                </div>
                <div class="form-group col-lg-6">
                Add As :   <label for="3"><input type="checkbox" id="3" value="t" name="choix" onclick="checking(this.id,3,4)" onchange="show_hide()" >Teacher</label>
                <label for="3"><input type="checkbox" id="4" value="s" name="choix" onclick="checking(this.id,3,4)" onchange="show_hide()">Student</label>
                </div>
                <div class="form-group col-lg-6" id="choice" style="display: none;">
                  <label for="Categorie">Choose a Categorie:</label>
                    <select name="checkbox3" id="checkbox3" >
                        <option value="">--Please choose an option--</option>
                        <?php foreach($liste_c as $row2){ ?>
                        <option value="<?= $row2['nom_categorie'] ?>"><?= $row2['nom_categorie'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-lg-8" style="position: relative; top:40px;"><p style="color:red;"><?php echo $error;?></p></div>
                <div class="form-group col-lg-6 ">
                  <label class="tm-hide-sm">&nbsp;</label>
                  <button type="submit" class="btn btn-primary btn-block text-uppercase" name="submit">+ Save</button>
                </div>
            </form>
            </div>
          </div>
        </div>
       
      </div>
      <footer class="tm-footer row tm-mt-small">
        <div class="col-12 font-weight-light">
        
        </div>
      </footer>
    </div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="js/bootstrap.min.js"></script>
    <script src="../js/register_formateur.js"></script>
    <!-- https://getbootstrap.com/ -->
  </body>
</html>
