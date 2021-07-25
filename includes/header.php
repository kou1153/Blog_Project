<?php
include './includes/connection.php';
session_start();

if(!isset($_SESSION['loggedin'])) {
    $_SESSION['loggedin'] = false;
  }
$current_page = basename($_SERVER['SCRIPT_NAME'],".php");
        function cssCase($current_page) {
          $cssName = "";
          switch ($current_page) {
            case 'index':
                $cssName = 'index.css';
                break;
            case 'signup':
                $cssName = 'signup.css';
                break;
            case 'login':
                $cssName = 'login.css';
                break;
            case 'create':
                $cssName = 'index.css';
                break;
            case 'post':
                $cssName = 'index.css';
                break;
            case 'account':
                $cssName = 'index.css';
                break;
          }
          echo $cssName;
        }
?>

<!doctype html>
<html lang="en">

<head>

    <title>A Schiit Blog</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
        integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link rel="icon" href="../favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="../loginStyle/vendor/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="../loginStyle/fonts/font-awesome-4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="../loginStyle/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">

    <link rel="stylesheet" href="../loginStyle/vendor/animate/animate.css">

    <link rel="stylesheet" href="../loginStyle/vendor/css-hamburgers/hamburgers.min.css">

    <link rel="stylesheet" href="../loginStyle/vendor/animsition/css/animsition.min.css">

    <link rel="stylesheet" href="../loginStyle/vendor/select2/select2.min.css">

    <link rel="stylesheet" href="../loginStyle/vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="./css/<?php cssCase($current_page);?>">
    <script type="application/x-javascript">
    addEventListener("load", function() {
        setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
        window.scrollTo(0, 1);
    }
    </script>

    <!-- web font -->
    <link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">
    <!-- //web font -->
    <!-- Icons font CSS-->
    <link href="../signupStyle/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="../signupStyle/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="../signupStyle/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="../signupStyle/vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">


</head>

<body>
    <!-- fixed-top | sticky-top | fixed-bottom -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Blog</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php"><i class="fas fa-home"></i> Home <span
                                class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="create.php"><i class="fas fa-pen"></i> Create Post</a>
                    </li>
                </ul>

                <ul class="navbar-nav">
                    <?php if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])):?>
                    <li class="nav-item active">
                        <a class="nav-link" href="account.php"><i class="fa fa-user"></i> Hello,
                            <?php echo($_SESSION['name']);?></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="logout.php"><i class="fa fa-door"></i> Logout<span
                                class="sr-only">(current)</span></a>
                    </li>
                    <?php else: ?>
                    <li class="row nav-item active justify-content-center">
                        <a class="nav-link" href="login.php"><i class="fa fa-user"></i> LogIn</a>
                        <a class="nav-link" href="signup.php"><i class="fa fa-user"></i> SignUp</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>