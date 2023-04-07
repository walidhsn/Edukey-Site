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
$error = "";
    if(isset($_POST['modifier_user']))
    {
        $id_hidden = $_POST['hidden_id'];
        $old_user = $userC->chercher_user($id_hidden);
        $verification= $userC->retrun_etat_verif($old_user['username']);
        if($old_user['choix'] == "s"){
            $liste_e = $etudC->chercher_etudiant($old_user['cin']);
        }
        if($old_user['choix'] == "t"){
            $liste_f = $formaC->chercher_formateur($old_user['cin']);
        }
        if(isset($_POST['cin']) && isset($_POST['name']) && isset($_POST['lname']) && isset($_POST['date']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['sexe']) && isset($_POST['username']) && isset($_POST['passw']) && isset($_POST['cpassw']))
        {
            if(!empty($_POST['cin']) && !empty($_POST['name']) && !empty($_POST['lname']) && !empty($_POST['date']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['sexe']) && !empty($_POST['username']) && !empty($_POST['passw']) && !empty($_POST['cpassw']))
            {
                if($liste_e || $liste_f){
                if($_POST['passw'] == $_POST['cpassw'])
                {
                    $new_hash = password_hash($_POST['passw'],PASSWORD_DEFAULT);
                    $user = new User($_POST['cin'],$_POST['name'] ,$_POST['lname'] ,$_POST['email'],$_POST['phone'],$_POST['sexe'] ,$_POST['date'] ,$_POST['username'] ,$new_hash,$old_user['choix'],0);
                                if(($old_user['choix'] == "t"))
								{
									$forma = new Formateur($_POST['cin'],0.0,$liste_f['categorie'],0.0);
									$formaC->modifier_formateur($liste_f['id_formateur'],$forma);
								}
								else if($old_user['choix'] == "s")
								{
									$etud = new Etudiant($_POST['cin'],0.0,0);
									$etudC->modifier_etudiant($liste_e['id_etudiant'],$etud);
								}
                    $userC->modifier_user($old_user['id_user'],$user);
                    //update verifivation:
								try {
                                    $db = config::getConnexion();
									$query = $db->prepare(
										'UPDATE verification SET  
											username_verif= :username_verif,
											email_verif= :email_verif
											WHERE id_verif= :id_verif'
									);
									$query->execute([
										'username_verif' => $user->get_username(),
										'email_verif' => $user->get_email(),
										'id_verif' => $verification['id_verif']
									]);
									
								} catch (PDOException $e) {
									$e->getMessage();
								}
								////////////////////////////////////////////
					header('Location:Accounts.php');
                    }
                    else 
                    {
                        $error = "Please make sure that the two passwords are the same.";
                    }
                }
                else $error = "Error : We Can't find this Student or Teacher for the Moment...";
            }
            else 
            {
                $error = "Missing Information.";
            }
        }
        else 
        {
            $error = "Error of Modification";
        }
    }
   
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Modify - User</title>
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
        <!-- $old_user -->
          <div class="tm-block-col tm-col-account-settings">
            <div class="tm-bg-primary-dark tm-block tm-block-settings">
              <h2 class="tm-block-title">User Settings</h2>
            <form action="" method="post">
            <?php
                if(isset($_POST['id_user']))
                {
                    $id = $_POST['id_user'];
                    $tab = $userC->chercher_user($id);
                }
                ?>
                <input type="hidden" name="hidden_id" value="<?=$id?>">
                <div class="form-group col-lg-6">
                  <label for="Cin">CIN</label>
                  <input
                    id="cin"
                    name="cin"
                    type="text"
                    class="form-control validate"
                    placeholder="Enter CIN (8 digits)"
                    required minlength="8" maxlength="20" size="20"
                    value="<?=$tab['cin']?>"
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
                    value="<?=$tab['nom']?>"
                   />
                </div>
                <div class="form-group col-lg-6">
                  <label for="name">Last-Name</label>
                  <input id="lname" name="lname" type="text" placeholder="Last Name" class="form-control validate" required minlength="2" maxlength="35" value="<?=$tab['prenom']?>" />
                </div>
                <div class="form-group col-lg-6">
                  <label for="Birth">Birth-date  </label>
                  <input id="date" name="date" type="date" class="form-control validate" required value="<?=$tab['date_n']?>" />
                </div>
                <div class="form-group col-lg-6">
                  <label for="Email">E-Mail  </label>
                  <input id="email" name="email" type="text" placeholder="info@gmail.com" class="form-control validate" required minlength="5" maxlength="30" value="<?=$tab['email']?>" />
                </div>
                <div class="form-group col-lg-6" >
                  <label for="Telephone">Telephone  </label>
                  <input type="tel" placeholder="+216 :" id="phone" name="phone" value="<?=$tab['telephone']?>" required>
                </div>
                <div class="form-group col-lg-6">
                  <label for="Sexe">He/She is A :  </label>
                    <select name="sexe" id="sexe" required >
                        <option value="">--Please choose an option--</option>
                        <option value="m" <?php if($tab['sexe'] == "m") echo "selected"; ?> >Male</option>
                        <option value="f" <?php if($tab['sexe'] == "f") echo "selected"; ?> >Female</option>
                    </select>
                </div>
                <div class="form-group col-lg-6">
                  <label for="Username">UserName</label>
                  <input id="username" name="username" type="text" placeholder="UserName" class="form-control validate" value="<?=$tab['username']?>" required minlength="4" maxlength="25"  />
                </div>
                <div class="form-group col-lg-6">
                  <label for="Username">Change Password</label>
                  <input id="passw" name="passw" type="password" placeholder="New Password" class="form-control validate" required minlength="4" maxlength="40" />
                </div>
                <div class="form-group col-lg-6">
                  <label for="Username">Confirm Password</label>
                  <input id="cpassw" name="cpassw" type="password" placeholder="Confirm Password" class="form-control validate" required minlength="4" maxlength="40" />
                </div>
                <div class="form-group col-lg-8" style="position: relative; top:40px;"><p style="color:red;"><?php echo $error;?></p></div>
                <div class="form-group col-lg-6 ">
                  <label class="tm-hide-sm">&nbsp;</label>
                  <button type="submit" class="btn btn-primary btn-block text-uppercase" name="modifier_user">+ Save</button>
                </div>
            </form>
            </div>
          </div>
        </div>
       
      </div>
      <footer class="tm-footer $old_user tm-mt-small">
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