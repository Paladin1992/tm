<?php
    $menu = json_decode(file_get_contents("menu.json"), true);
    $menu_count = count($menu);

    function bs_col($xs, $sm, $md, $lg, $use_offset) {
        $xs_offset = (12 - $xs) / 2;
        $sm_offset = (12 - $sm) / 2;
        $md_offset = (12 - $md) / 2;
        $lg_offset = (12 - $lg) / 2;
        $result = '';

        if ($xs != 0) {
            $result .= 'col-xs-'.$xs;
            if ($use_offset && $xs_offset != 0) {
                $result .= ' col-xs-offset-'.$xs_offset;
            }
        }

        if ($sm != 0) {
            $result .= ' col-sm-'.$sm;
            if ($use_offset && $sm_offset != 0) {
                $result .= ' col-sm-offset-'.$sm_offset;
            }
        }

        if ($md != 0) {
            $result .= ' col-md-'.$md;
            if ($use_offset && $md_offset != 0) {
                $result .= ' col-md-offset-'.$md_offset;
            }
        }

        if ($lg != 0) {
            $result .= ' col-lg-'.$lg;
            if ($use_offset && $lg_offset != 0) {
                $result .= ' col-lg-offset-'.$lg_offset;
            }
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
        $active_class = ($is_active ? 'active' : '');

        $img_left = '<img src="images/margareta.png" class="menu-flower-left">';
        $img_right = '<img src="images/margareta.png" class="menu-flower-right">';
        $caption = $img_left.'<span class="inner-caption">'.$caption.'</span>'.$img_right;
        
        echo '<li class="menu '.$active_class.'"><a href="index.php?p='.$url.'">'.$caption.'</a></li>';
    }

    function get_menu($current_site) {
        global $menu, $menu_count;

        for ($i = 0; $i < $menu_count; $i++) {
            $url = $menu[$i]['url'];
            get_menu_item($url, $url == $current_site);
        }
    }

    function print_page_title($site, $wrap_in_h2 = true) {
        $title = get_menu_item_data($site)['caption'];
        
        if ($wrap_in_h2) {
            echo '<h2>'.$title.'</h2>';
        } else {
            echo $title;
        }
    }

    // $orientation : "portrait" | "landscape"
    // $float       : "none" | "left" | "right"
    function insert_figure($src, $orientation, $float, $alt, $title, $figcaption, $classes = "", $styles = "") {
        $class = $classes == '' ? '' : ' '.$classes;
        $style = $styles == '' ? '' : ' style="'.$styles.'"';

        echo '<figure class="'.$orientation.' '.$float.' clearfix'.$class.'"'.$style.'>';
            echo '<a href="'.$src.'" target="_blank">';
                echo '<img src="'.$src.'" class="tm-thumbnail '.$orientation.'" alt="'.$alt.'" title="'.$title.'">';
            echo '</a>';
            echo '<figcaption>'.$figcaption.'</figcaption>';
        echo '</figure>';
    }

    function insert_video($url, $title = "", $closable = false, $tooltip = "Kattintson a gombra a videó betöltéséhez") {
        if ($closable) {
            echo '<div class="video-group">';
                echo '<button class="video-button button" onclick="getVideo(\''.$url.'\', this)" title="'.$tooltip.'">';
                    echo '<i class="material-icons">ondemand_video</i> '.$title;
                echo '</button>';

                echo '<div class="video-container">';
                    echo '<div class="video-header">';
                        echo '<div class="video-title">'.$title.'</div>';
                        echo '<div class="video-close" onclick="closeVideo(this)">&times;</div>';
                    echo '</div>';
                    echo '<div class="video-content">';
                        echo '<iframe class="video" width="560" height="315" src="" frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        } else {
            echo '<div class="video-container">';
                echo '<div class="video-header">';
                    echo '<div class="video-title">'.$title.'</div>';
                echo '</div>';
                echo '<div class="video-content visible">';
                     echo '<iframe class="video" width="560" height="315" src="'.$url.'?rel=0"'.
                          'frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                echo '</div>';
            echo '</div>';
        }
    }

    function get_email_from_template($template_file_path, $data) {
        $template = file_get_contents($template_file_path);

        foreach ($data as $key => $value)
        {
            $template = str_replace('%'.$key.'%', $value, $template);
        }

        return $template;
    }
?>