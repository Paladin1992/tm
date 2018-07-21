<?php
    include_once("helpers.php");

    $site = (isset($_GET['p']) ? $_GET['p'] : 'kezdo');
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <title>TM Mindenkinek</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Dancing+Script|Italianno|Lobster|Petit+Formal+Script|Sriracha">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="images/favicon.png">
    
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container <?=bs_col(12, 8, 8, 8, true);?> tm-container">
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
                    echo '<div class="alert alert-danger">A kért oldal tartalma még nem elérhet&odblac;! Addig nézz meg egy másik menüpontot! :)</div>'.PHP_EOL;
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