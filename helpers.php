<?php
    $menu = json_decode(file_get_contents("menu.json"), true);
    $menu_count = count($menu);

    function bs_col($xs, $sm, $md, $lg, $use_offset) {
        $xs_offset = (12 - $xs) / 2;
        $sm_offset = (12 - $sm) / 2;
        $md_offset = (12 - $md) / 2;
        $lg_offset = (12 - $lg) / 2;

        $result = 'col-xs-'.$xs;
        if ($use_offset && $xs_offset != 0) {
            $result .= ' col-xs-offset-'.$xs_offset;
        }

        $result .= ' col-sm-'.$sm;
        if ($use_offset && $sm_offset != 0) {
            $result .= ' col-sm-offset-'.$sm_offset;
        }

        $result .= ' col-md-'.$md;
        if ($use_offset && $md_offset != 0) {
            $result .= ' col-md-offset-'.$md_offset;
        }

        $result .= ' col-lg-'.$lg;
        if ($use_offset && $lg_offset != 0) {
            $result .= ' col-lg-offset-'.$lg_offset;
        }

        return $result;
    }

    function get_menu_item_data($url) {
        global $menu, $menu_count;

        for ($i = 0; $i < $menu_count && $menu[$i]['url'] != $url; $i++) {}

        return ($i < $menu_count ? $menu[$i] : null);
    }

    function get_menu_item($current_site, $is_active) {
        $menu_item_data = get_menu_item_data($current_site);
        $caption = $menu_item_data['caption'];
        $url = $menu_item_data['url'];
        $active_class = ($is_active ? ' class="active"' : '');

        $img_left = '<img src="images/margareta.png" class="menu-flower-left">';
        $img_right = '<img src="images/margareta.png" class="menu-flower-right">';
        if ($active_class != '') {
            $caption = $img_left.$caption.$img_right;
        }
        
        echo '<li'.$active_class.'><a href="index.php?p='.$url.'">'.$caption.'</a></li>';
    }

    function get_menu($current_site) {
        global $menu, $menu_count;

        for ($i = 0; $i < $menu_count; $i++) {
            $url = $menu[$i]['url'];
            get_menu_item($url, $url == $current_site);
        }
    }

    function print_page_title($site) {
        echo '<h2>'.get_menu_item_data($site)['caption'].'</h2>';
    }
?>