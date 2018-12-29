<footer>
    <?php
        $startYear = 2019;
        $currentYear = date("Y");
        echo '&copy; '.$startYear.($currentYear > $startYear ? '-'.$currentYear : '').' Minden jog fenntartva<br>';
        echo 'Weblap: MaGe';
    ?>
</footer>