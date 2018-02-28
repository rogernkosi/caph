<?php

  define("PATH_ROOT", realpath($_SERVER["DOCUMENT_ROOT"]) );
  require_once(PATH_ROOT.'/caphleave/utils/Utils.php');
  require_once PATH_ROOT.'/caphleave/controller/index.php';
  Utils::startSession();
  $controller = new Controller();

  if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email != '' && $password != '') {
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "
            <script type=\"text/javascript\">
            alert(\"Invalid email, please verify\");

            </script>
        "; 
      }else{
        $data = array('email' => $email, 'pass' => $password);
        if ($controller->login($data)) {

          if ($controller->isManager($_SESSION['user_id']) || $controller->isAdmin($_SESSION['user_id'])) {
            header("Location: http://127.0.0.1:90/caphleave/view/employer/dashboard/");
          }else if($controller->isEmployee($_SESSION['user_id'])){
            header("Location: http://127.0.0.1:90/caphleave/view/employee/dashboard/");
          }

        }else{
          echo "
            <script type=\"text/javascript\">
            alert(\"Login invalid.\");
            </script>
        ";        }
      }
    }else{
       echo "
            <script type=\"text/javascript\">
            alert(\"Please fill in your credentials.\");

            </script>
        "; 
    }

  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../assets/brand/favicon.ico">

    <title>Sign In</title>

    <link href="../../assets/css/bootstrap.css" rel="stylesheet">
    <link href="../../assets/css/mdb.css" rel="stylesheet">
    <link href="../assets/css/bootstrap-year-calendar.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../../assets/fonts/flaticon/flaticon.css" rel="stylesheet">
    <link href="../../assets/css/app.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .row-centered{
            text-align: center;
          }
          .col-centered{
            display: inline-block;
            float: none;
            text-align: left;
            margin-right: -4px;
          }
    </style>
</head>

<body style="background: #fff;">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false"
                    aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
                <a class="navbar-brand" href="#"><img src="../../assets/brand/33-1.png" width="30"/></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href=""><img src="../../assets/brand/help.svg" width="20"></a>
                    </li>
                    
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </nav>
    <div class="container">
            <div class="row row-centered">
              <div class="col-md-5 col-xs-12 col-centered">
		<center><h3>Sign In</h3></center>
		<br>
		<br>
                  <form action="index.php" method="POST">
                      <div class="form-group">
                          <label for="email-input">Email address</label>
                          <input type="email" name="email" class="form-control no-radius" id="email-input" placeholder="Email">
                      </div>
                      <div class="form-group">
                          <label for="password-input">Password</label>
                          <input type="password" name="password" class="form-control no-radius" id="password-input" placeholder="Password">
                      </div>
                      <div class="form-group">
                        <label class="control control--checkbox" for="keep-me-in-input" class="small-heading"> <span style="font-size: .8rem;">Keep me signed in</span>
                          <input type="checkbox" id="keep-me-in-input"/>
                          <div class="control__indicator"></div>
                        </label>
                      </div>
                      <!-- <a href="../../employer/dashboard/index.html" class="btn btn-primary btn-block no-radius">Sign in</a> -->
                      <input type="submit" name="login" class="btn btn-primary btn-block no-radius" value="Sign in" />
                  </form>
                  <br>
                  <center><label class="label-heading">Don't have an account? <a href="../../auth/as-admin/signup/index.php">Create one!</a></label></center>
                  <br>
                  <center><label class="label-heading"><a href="../../recover-account/">Forgot my password.</a></label></center>
              </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <p class="text-muted">Cap &copy; <?php echo(date('Y')) ?> </p>
        </div>
    </footer>
    <script src="../../assets/js/jquery.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/jquery.js"><\/script>')</script>
    <script src="../../assets/js/bootstrap.js"></script>
    <script src="../../assets/js/mdb.js"></script>
    <script src="../../assets/js/bootstrap-year-calendar.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/src/ie10-viewport-bug-workaround.js"></script>
</body>


</html>
