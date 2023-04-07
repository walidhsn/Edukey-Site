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
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Upload- IMAGE</title>
    <link rel="shortcut icon" href="img/favicon.png">
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Roboto:400,700"
    />
    <!-- https://fonts.google.com/specimen/Roboto -->
    <link rel="stylesheet" href="Back-admin/css/fontawesome.min.css" />
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="Back-admin/css/bootstrap.min.css" />
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="Back-admin/css/templatemo-style.css">
    <!--
	Product Admin CSS Template
	https://templatemo.com/tm-524-product-admin
	-->
  </head>

  <body id="reportsPage">
    <div class="" id="home">
      <nav class="navbar navbar-expand-xl">
        <div class="container h-100">
          
          </div>
        </div>
      </nav>
     
        <!-- row -->
          <div class="tm-block-col tm-col-account-settings">
            <div class="tm-bg-primary-dark tm-block tm-block-settings">
              <h2 class="tm-block-title">ADD IMAGE</h2>
              <form enctype="multipart/form-data" method="post" action="upload_img.php" class="tm-signup-form row">
                <div class="form-group col-lg-6">
                  <label for="name">+ Upload</label>
                  <input
                    id="upload"
                    name="upload"
                    type="file"
                    class="form-control validate"
                  />
                </div>
                <div class="form-group col-lg-6">
                  <label class="tm-hide-sm">&nbsp;</label>
                  <button type="submit" class="btn btn-primary btn-block text-uppercase" name="submit">Save</button>
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

    <script src="Back-admin/js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="Back-admin/js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
  </body>
</html>
