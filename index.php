<?php
    include_once("helpers.php");

    // $site = '';
    // if (!isset($_GET['p'])) {
    //     $_GET['p'] = 'kezdo';
    // }
    // $site = $_GET['p'];

    $site = (isset($_GET['p']) ? $_GET['p'] : 'kezdo');
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <title>Transzcendentális Meditáció Mindenkinek</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Petit+Formal+Script&amp;subset=latin-ext">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="images/favicon.ico">
    
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container <?=bs_col(12, 8, 8, 8);?> tm-container">
    <!-- col-xs-12 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 -->

        <?php
            include("header.php");
            include("menu.php");
        ?>
    
        <main>
            <?php
                $file_path = "content/".$site.".php";
                if (file_exists($file_path)) {
                    include($file_path);
                } else {
                    echo '<div class="alert alert-danger">Az oldal tartalma még nem elérhet&odblac;! Addig nézz meg egy másik menüpontot! :)</div>'.PHP_EOL;
                }
            ?>
        </main>

        <footer>
            <?php include("footer.php"); ?>
        </footer>
    </div>
</body>
</html>