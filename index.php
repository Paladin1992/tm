﻿<?php
    include_once("helpers.php");
    $page = (isset($_GET['p']) ? $_GET['p'] : 'fooldal');
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <title><?=print_page_title($page);?> &bull; TM Mindenkinek</title>

    <meta charset="UTF-8">
    <meta name="keywords" content="<?=get_menu_item_data($page)['keywords']?>">
    <meta name="description" content="<?=get_menu_item_data($page)['description']?>">
    <meta name="author" content="MaGe">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
                $file_path = "content/".$page.".php";
                if (file_exists($file_path)) {
                    include($file_path);
                } else {
                    header("Location: index.php?p=fooldal");
                }
            ?>
        </main>

        <?php include("footer.php"); ?>
    </div>

    <script src="js/script.js"></script>
</body>
</html>