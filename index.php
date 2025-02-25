<?php
    ob_start();
    session_start();
    require("adatok.php");
    require("databaseClass.php");
    $db = new db($dbhost, $dbname, $dbuser, $dbpass);
?>
<!doctype html>
<html lang="hu">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?php echo $pagename ?></title>

        <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/fullcalendar.main.min.css" rel="stylesheet">
        <link href="css/dataTables.bootstrap4.min.css" rel="stylesheet">
        <link href="css/cms.css" rel="stylesheet">

</head>
<body>
        <?php
            // ha létezik a süti, akkor létrehoza a munkamenet változókat
            if (isset($_COOKIE['uid']) && !isset($_SESSION['uID']))
            {
                $_SESSION['uID'] = $_COOKIE['uid'];
                $_SESSION['uname'] = $_COOKIE['uname'];
                $_SESSION['umail'] = $_COOKIE['umail'];
                $_SESSION['ureg'] = $_COOKIE['ureg'];
                $_SESSION['ulast'] = $_COOKIE['ulast'];
                $_SESSION['urights'] = $_COOKIE['urights'];
            }
            
        ?>
        <div class="container">
                <header class="blog-header py-3">
                        <div class="row flex-nowrap justify-content-between align-items-center">
                                <div class="col-4 pt-1">
                                       <br>
                                </div>
                                <div class="col-4 text-center">
                                        <a class="blog-header-logo text-dark" href="index.php">CMS</a>
                                </div>
                                <div class="col-4 d-flex justify-content-end align-items-center">
                                        <?php
                                                if(!isset($_SESSION['uID']))
                                                {
                                                        echo'<a class="btn btn-sm btn-secondary" href="index.php?pg='.base64_encode('users_regisztracio').'">Regisztráció</a>';
                                                }
                                        ?>
                                </div>
                        </div>
                </header>

                <div class="nav-scroller py-1 mb-2">
                        <?php include("categories/categories_menu.php"); ?>
                </div>
        </div>

        <main role="main" class="container">
                <div class="row">
                        <div class="col-md-9 blog-main">
                                <?php include("loader.php") ?>
                        </div>
                        
                        <!-- /.blog-main -->
                        <aside class="col-md-3 blog-sidebar">
                                <?php 
                                        include("search.php");                            
                                        include("users/users_login.php");
                                ?>
        </main>
        
        <!-- /.container -->

        <footer class="blog-footer">
                <p><?php echo $company.' - '.$author?></p>
                <p>
                        <a href="index.php" class="btn btn-outline-secondary" >Vissza a főoldalra</a>
                </p>
        </footer>

        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/canvasjs.min.js"></script>
        <script src="js/jquery.dataTables.min.js"></script>
        <script src="js/dataTables.bootstrap4.min.js "></script>
        <script src="js/fullcalendar.main.min.js"></script>
        <script src="js/fullcalendar.locales-all.min.js"></script>
        <script src="js/tinymce.min.js" referrerpolicy="origin"></script>
        <script src="js/app.js"></script>

</body>
</html>
