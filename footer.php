<?php
    $currentYear = date("Y");
    echo '&copy; 2018'.($currentYear != 2018 ? '-'.$currentYear : '');
?>