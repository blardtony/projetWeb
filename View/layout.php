<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MPP - Jeu entre amis consentants</title>
        <link href="<?php echo BASE_IMG?>favicon.png" rel="icon" type="image/icon type">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cabin:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
        <link href="<?php echo BASE_CSS?>layout.css" rel="stylesheet" type="text/css">
        <?php
            session_start();
            unset($_SESSION['errors']);
        ?>
    </head>
    <body>
        <?php
        $pageNoBg = array('login','signup','reset-password');
        if ($_GET['url'] == "") {
            echo "<div class='home-img'>";
        }elseif (in_array($_GET['url'],$pageNoBg) || strpos($_GET['url'], 'token') !== false) {
            echo "<div>";
        }elseif (strpos($_GET['url'],'admin') !== false) {
            echo "<div style='background-color: #f0a416c0;'>";
        }else {
            echo "<div style='background-color: #215ab0bf;'>";
        }
        ?>
        <nav class="navbar navbar-expand-lg navbar-color">
            <div class="container-fluid row justify-content-start">
                <div class="col-3"></div>
                <div class="col-3">
                    <a class="navbar-brand" href="/DiamondDogsProject/">
                        <img type="image/png" class="img-fluid logo" src="<?php echo BASE_IMG?>mpp-logo.png">
                    </a>
                </div>
                <div class="col-3 btn-col d-flex">
                    <?php
                    if (in_array($_GET['url'],array("","signup"))) {
                        echo "<a class='btn navbar-btn btn-primary btn-login' href='/DiamondDogsProject/login'>Log in</a>";
                    }
                    if ($_GET['url'] == "login") {
                        echo "<a class='btn navbar-btn btn-primary btn-login' href='/DiamondDogsProject/signup'>Sign in</a>";
                    }
                    ?>
                </div>
            </div>
        </nav>
        <?= $content ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <?php if (in_array($_GET['url'],array("","dashboard"))) {
            echo "</div>";
        }
        ?>
    </body>
</html>