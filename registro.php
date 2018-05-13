<?php
require_once 'db/dbcon.php';
if(isset($_POST['btn-signup'])) {
 $uname = strip_tags($_POST['username']);
 $email = strip_tags($_POST['email']);
 $upass = strip_tags($_POST['password']);
 $uname = $DBcon->real_escape_string($uname);
 $email = $DBcon->real_escape_string($email);
 $upass = $DBcon->real_escape_string($upass);
 $hashed_password = password_hash($upass, PASSWORD_DEFAULT); // this function works only in PHP 5.5 or latest version
 $check_email = $DBcon->query("SELECT email FROM tbl_users WHERE email='$email'");
 $count=$check_email->num_rows;
 if ($count==0) {
  $query = "INSERT INTO tbl_users(username,email,password) VALUES('$uname','$email','$hashed_password')";
  if ($DBcon->query($query)) {
   $msg = "<div class='alert alert-success'>
      <span class='glyphicon glyphicon-info-sign'></span> &nbsp; ¡Registro exitoso!, ya puedes iniciar sesion
     </div>";
  }else {
   $msg = "<div class='alert alert-danger'>
      <span class='glyphicon glyphicon-info-sign'></span> &nbsp; error al registrar
     </div>";
  }
 } else {
  $msg = "<div class='alert alert-danger'>
     <span class='glyphicon glyphicon-info-sign'></span> &nbsp; esta direccion de correo ya ha sido registrada
    </div>";
 }
 $DBcon->close();
}
?>






<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registro</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="assets/scss/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body class="bg-dark">


    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="index.html">
                    </a>
                </div>
                <div class="login-form">
                <form class="form-signin" method="post" id="register-form">

                    <h2 class="form-signin-heading">Registro</h2><hr />

                    <?php
                    if (isset($msg)) {
                    echo $msg;
                    }
                    ?>

                    <div class="form-group">
                    <input type="text" class="form-control" placeholder="nombre" name="username" required  />
                    </div>

                    <div class="form-group">
                    <input type="email" class="form-control" placeholder="Email" name="email" required  />
                    <span id="check-e"></span>
                    </div>

                    <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" name="password" required  />
                    </div>

                    <hr />

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30" name="btn-signup">
                    <span class="glyphicon glyphicon-log-in"></span> &nbsp; Registrar
                    </button>

                        <div class="register-link m-t-15 text-center">
                            <p>si ya tienes cuenta,<a href="login.php"> Inicia sesion</a></p>
                        </div>
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>


</body>
</html>
