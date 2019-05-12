<?php
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
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="images/favicon.png">
    
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <?php
        if ($page == 'kapcsolat') {
            echo '<script src="https://www.google.com/recaptcha/api.js"></script>';
        }
    ?>
</head>

<body>
    <div class="container <?=bs_col(12, 12, 8, 8, true);?> tm-container">
        <header>
            <?php
                if ($page == 'fooldal') {
                    echo '<h1 class="tm-main-title">TM Mindenkinek</h1>';
                } else {
                    echo '<h4 class="tm-main-title">TM Mindenkinek</h4>';
                }
            ?>
        </header>

        <?php
            include("menu.php");
        ?>
    
        <div id="tm-navbar-placeholder"></div>

        <main>
            <?php
                $file_path = "content/".$page.".php";
                if (file_exists($file_path)) {
                    print_page_title($page, true, ['fooldal']);
                    include($file_path);
                } else {
                    header("Location: fooldal");
                }
            ?>
        </main>

        <footer>
            <?php
                $startYear = 2019;
                $currentYear = date("Y");
                echo '&copy;'.$startYear.($currentYear > $startYear ? '-'.$currentYear : '').' TM mindenkinek &ndash; Minden jog fenntartva!<br>';
                echo 'Weblap: <span class="mage">MaGe</span>';
            ?>
        </footer>
    </div>

    <script src="js/script.js"></script>
</body>
</html>