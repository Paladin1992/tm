<!-- remove after 2019-01-12 -->
<?php
    $today = new DateTime();
    $startDate = new DateTime('2018-01-12');
    if ($today < $startDate) {
        header('Location: trial.php');
    }
?>
<!-- END OF remove after 2019-01-12 -->

<?php
    include_once("helpers.php");
    $site = (isset($_GET['p']) ? $_GET['p'] : 'kezdo');
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <title><?=print_page_title($site, false);?> &bull; TM Mindenkinek</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Parisienne|Rochester">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="images/favicon.png">
    
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
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
                    echo '<div class="alert alert-danger">A kért oldal tartalma még nem elérhet&odblac;. Addig nézzen meg egy másik menüpontot! :)</div>'.PHP_EOL;
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