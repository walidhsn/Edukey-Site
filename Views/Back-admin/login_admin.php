<?php
 include_once 'C:\xampp\htdocs\mycruds\config.php';
 session_start();
 $error="";
 if(!empty($_GET["error"]))
 {
     $error=$_GET["error"];
 }
 $con = config::getConnexion();
 $remember=null;
 if (isset($_POST['remember'])){
     $remember=$_POST['remember'];
 }
 
 if (isset($_POST['loginbutton']) && (empty($_POST['username']) &&  empty($_POST['password'])) ) {
     $error="Please fill both the username and password fields";
 }
 else if (isset($_POST['loginbutton']) && (isset($_POST['username'], $_POST['password'])) )
 {
     if ($stmt = $con->prepare('SELECT username, pass_word FROM admins WHERE username = :username')) {
     $stmt->bindValue(':username', $_POST['username']);
     $stmt->execute();
     $count=$stmt->rowCount();
     if ($count > 0) {
             $row = $stmt->fetch();
             if ($_POST['password'] == $row['pass_word'] ) {
                 session_regenerate_id();
                 $_SESSION['logged'] = TRUE;
                 $_SESSION['name_admin'] = $_POST['username'];
                 $_SESSION['id_admin'] = $row['id_admin'];
                 if($remember == 1)
                 {
                     setcookie('adminname',$_POST['username'], time()+60*60*24*30,"/");
                     setcookie('adminpass',$_POST['password'], time()+60*60*24*30,"/");
                 }
                 header('Location:Home.php');
             } else {
                 // Incorrect password
                 $error ="Incorrect username and/or password!";
             }
         } else {
             // Incorrect username
             $error ="Incorrect username and/or password!";
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
    <title>Login Page -Admin</title>
    <link rel="shortcut icon" href="../img/favicon.png">
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Roboto:400,700"
    />
    <!-- https://fonts.google.com/specimen/Open+Sans -->
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

  <body>
    <div>
      <nav class="navbar navbar-expand-xl">
        <div class="container h-100">
        <a href="../index.php">
			<img src="../img/logo.png"  alt height="90" style="position: relative; right: 120px; top:25px;">
            <h2 class="tm-block-title" style="position: relative; right: 5px; bottom:20px;"> EduKey</h2>
		</a>
          <button
            class="navbar-toggler ml-auto mr-0"
            type="button"
            data-toggle="collapse"
            data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <i class="fas fa-bars tm-nav-icon"></i>
          </button>

         
        </div>
      </nav>
    </div>

    <div class="container tm-mt-big tm-mb-big">
      <div class="row">
        <div class="col-12 mx-auto tm-login-col">
          <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
            <div class="row">
              <div class="col-12 text-center">
                <h2 class="tm-block-title mb-4">Welcome to EduKey-Dashboard</h2>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-12">
                <form method="post" class="tm-login-form">
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input
                      name="username"
                      type="text"
                      class="form-control validate"
                      id="username"
                      placeholder="Username"
                      value="<?php if(isset($_COOKIE['adminname'])) echo $_COOKIE['adminname']; ?>"
                      required
                    />
                  </div>
                  <div class="form-group mt-3">
                    <label for="password">Password</label>
                    <input
                      name="password"
                      type="password"
                      class="form-control validate"
                      id="password"
                      placeholder="Password"
                      value="<?php if(isset($_COOKIE['adminpass'])) echo $_COOKIE['adminpass']; ?>"
                      required
                    />
                  </div>
                  <div>
					<label for="remember"><input type="checkbox" id="remember" value="1" name="remember" ></label>
							<!-- / check box -->
						Keep me Signed in </div>
                        <div> <p style="color:yellow;"><?php echo $error; ?></p></div>
                  <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary btn-block text-uppercase" name="loginbutton">Login</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <footer class="tm-footer row tm-mt-small">
      <div class="col-12 font-weight-light">
        
      </div>
    </footer>
    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
  </body>
</html>
