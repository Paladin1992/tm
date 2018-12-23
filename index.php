<?php
    include_once("helpers.php");
    $site = (isset($_GET['p']) ? $_GET['p'] : 'fooldal');
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <title><?=print_page_title($site, false);?> &bull; TM Mindenkinek</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="img-src 'self' data:">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="images/favicon.png">
    
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body>
    <div class="container <?=bs_col(12, 12, 8, 8, true);?> tm-container">
        <?php
            include("header.php");
            include("menu.php");
        ?>
    
        <div id="tm-navbar-placeholder"></div>

        <main>

            <?php
                $file_path = "content/".$site.".php";
                if (file_exists($file_path)) {
                    include($file_path);
                } else {
                    echo '<div class="alert alert-danger" style="display: block;">A kért oldal tartalma még nem elérhet&odblac;. Addig nézzen meg egy másik menüpontot! :)</div>'.PHP_EOL;
                }
            ?>
        </main>

        <footer>
            <?php include("footer.php"); ?>
        </footer>
    </div>

    <script src="js/script.js"></script>
</body>
</html>