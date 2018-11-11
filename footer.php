<?php
    $startYear = 2018;
    $currentYear = date("Y");
    echo '&copy; '.$startYear.($currentYear != $startYear ? '-'.$currentYear : '').' Minden jog fenntartva';
?>