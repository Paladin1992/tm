<?php
    include('helpers.php');

    $page = $_REQUEST['p'];

    switch ($page) {
        case 'hatasok':
            insert_video('https://www.youtube.com/embed/XMgvyFL6t-E', 'Rehabilitáció, meditáció és agy');
            insert_video('https://www.youtube.com/embed/XfjUJ4Gx4Y4', 'Egy iskolaigazgató beszél a TM hatásáról az oktatásban');
            insert_video('https://www.youtube.com/embed/bRyL5gQhdCE', 'Szív- és érrendszeri betegségek és a TM');
            insert_video('https://www.youtube.com/embed/82VZunyYWZ0', 'A TM hatása az autizmusra');
            insert_video('https://www.youtube.com/embed/zLxEdaRYHQ8', 'Hiperaktivitás és a TM'); // ez az a videó?
            insert_video('https://www.youtube.com/embed/WbU67boq958', 'TM és a menedzsment');
            insert_video('https://www.youtube.com/embed/Mjm73GYEBOM', 'TM az ingatlanfejlesztésben');
            break;
        default:
            break;
    }
?>