<?php

// THIS THEME USES wp_nav_menu() IN TWO LOCATIONS FOR CUSTOM MENU.
if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus(
        array(
            'menu-pt_BR' => 'Menu pt_BR',
            'menu-en_US' => 'Menu en_US',
            'menu-es_ES' => 'Menu es_ES'
        )
	);
}

$wpdecs_array_locale = array(
    'pt_BR' => 'pt',
    'en_US' => 'en',
    'es_ES' => 'es'
);

wp_enqueue_script("jquery");

// LANGUAGE 
global $site_lang;
function my_theme_localized( $locale )
{
        if ( isset( $_GET['l'] ) )
        {
            $locale = esc_attr( $_GET['l'] );
            return $locale;
        } else {
            return 'pt_BR';
        }
}
add_filter( 'locale', 'my_theme_localized' );
$site_lang = get_locale($locale);


function create_language_list($current_lang){
    echo '<ul id="languages_list">';
        
    if (strpos($_SERVER['REQUEST_URI'], "l=") === false) {
        if (strpos($_SERVER['REQUEST_URI'], "?") === false) {
            $current_url = $_SERVER['REQUEST_URI'] . "?l=" . $current_lang;
        } else {
            $current_url = $_SERVER['REQUEST_URI'] . "&l=" . $current_lang;
        }
    } else {
        $current_url = $_SERVER['REQUEST_URI'];
    }

    switch ($current_lang) {
        case "pt_BR":
            echo '<li><a href="' . preg_replace("/l=[a-zA-Z_]{5}/", "l=es_ES", $current_url)  . '">' . __('Espanol','bvsaps') . '</a></li>';
            echo '<li><a href="' . preg_replace("/l=[a-zA-Z_]{5}/", "l=en_US", $current_url)  . '">' . __('English','bvsaps') . '</a></li>';
            break;
        case "es_ES":
            echo '<li><a href="' .  preg_replace("/l=[a-zA-Z_]{5}/", "l=pt_BR", $current_url) . '">' . __('Portugues','bvsaps') . '</a></li>';
            echo '<li><a href="' .  preg_replace("/l=[a-zA-Z_]{5}/", "l=en_US", $current_url) . '">' . __('English','bvsaps') . '</a></li>';
            break;
        case "en_US":
            echo '<li><a href="' .  preg_replace("/l=[a-zA-Z_]{5}/", "l=es_ES", $current_url) . '">' . __('Espanol','bvsaps') . '</a></li>';
            echo '<li><a href="' .  preg_replace("/l=[a-zA-Z_]{5}/", "l=pt_BR", $current_url) . '">' . __('Portugues','bvsaps') . '</a></li>';
            break;
    }
    echo '</ul>';
}


add_action( 'widgets_init', 'aps_widgets_init' );
function aps_widgets_init() {
	
	if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => "Home",
		'id' => 'home',
	    'before_widget' => '<div id="%1$s" class="widget %2$s">',
	    'after_widget' => '</div>',
	    'before_title' => '<h2>',
	    'after_title' => '</h2>',
	)); 

	if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => "Footer",
		'id' => 'carousel',
	    'before_widget' => '',
	    'after_widget' => '',
	    'before_title' => '<h2>',
	    'after_title' => '</h2>',
	)); 
}

function kriesi_pagination($pages = '', $range = 2) {  
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<div class='pagination'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</div>\n";
     }
}

function term_link_filter( $url, $term, $taxonomy ) {
    
    global $wp_query;
    
    $post_type = $wp_query->query['post_type'];
    if(strpos($url, "?") === false) {
        return $url . "?post_type=" . $post_type;
    } else {
        return $url . "&post_type=" . $post_type;
    }
   
}
add_filter('term_link', 'term_link_filter', 10, 3);

function ttruncat($text,$numb) {
    if (strlen($text) > $numb) { 
        $text = substr($text, 0, $numb); 
        $text = substr($text,0,strrpos($text," ")); 
        $etc = " ...";  
        $text = $text.$etc; 
    }
    return $text; 
}

function append_query_string() {
    global $site_lang, $wp_query;

    $query_args = array();
    
    $post_type = $wp_query->query['post_type'];

    $query_args['post_type'] = $post_type;
    
    $query_args["l"] = $site_lang;
    
    if ( isset( $_GET['s'] ) ) {
        $query_args["se"] = $_GET['s'];
    }
    if (is_category()) {
        global $ct_nm;
        $query_args["ct"] = $ct_nm;
    }
    
    return add_query_arg($query_args, get_permalink());
}
add_filter('the_permalink','append_query_string');

function append_l_menu_link($sorted_menu_items) {
    global $site_lang;
    foreach ($sorted_menu_items as $item) {
        $item->url = add_query_arg("l", $site_lang, $item->url);
    }
    return $sorted_menu_items;
}
add_filter('wp_nav_menu_objects', 'append_l_menu_link');

// FUNÇÕES DE TRANSLATION
// ----------------------

function extract_text_by_language_markup($text, $shortcode="") {
    //If the title or the text has language markup like [pt_BR][/pt_BR], this function recognizes the tag and returns the corresponding text. 
    global $site_lang;
    if ( $shortcode == '' ){
        $language = $site_lang;
    } else {
        $language = $shortcode;
    }
    $pattern_start = '/\[' . $language  . ']/';
    $pattern_end = '/\[\/' . $language . ']/';
    if (preg_match($pattern_start, $text) && preg_match($pattern_end, $text)) {
        $extracted_text = explode("[/" . $language . "]", $text);
        $extracted_text = explode("[" . $language . "]", $extracted_text[0]);
        return $extracted_text[1];
    } else {
        $extracted_text = preg_split('/\[\/(pt_BR|en_US|es_ES)]/', $text);
        if (count($extracted_text) > 1) {
            $extracted_text = preg_split('/\[(pt_BR|en_US|es_ES)]/', $extracted_text[0]);
            return $extracted_text[1];
        } else {
            return $text;
        }
    }
}
function fix_wp_title($text) {
    $title = extract_text_by_language_markup($text);
    if (is_single() && $title != $text)
        return $title . " | ";
    else
        return $title;
}
function fix_permalink($ID){
    $short_codes = array ('pt_br', 'en_us', 'es_es');
    list($permalink, $post_name) = get_sample_permalink($ID, null, null);
    $original_slug = $post_name;
    if ( ! wp_is_post_revision( $post_id ) ){
        remove_action('save_post', 'fix_permalink');
        foreach ($short_codes as $sc) {
            $pos_sc = strpos($original_slug, $sc);
            if ($pos_sc === FALSE) {
                //avoid return 0 as a valid position
                $found_short_codes[] = 10000;
            } else {
                $found_short_codes[] = $pos_sc;
            }
        }
        if (array_sum($found_short_codes) < 30000) {
            array_multisort($found_short_codes, $short_codes);
            $extracted_text = explode($short_codes[0], $original_slug);
            $new_slug = $extracted_text[1];
        } else {
            $new_slug = $original_slug;
        }
        $update_slug = array (
            'ID'          => $ID,
            'post_name'   => $new_slug
        );
        wp_update_post($update_slug);
        add_action('save_post','fix_permalink');
    }
}
function update_translated_title_fields($ID){
    if ( !wp_is_post_revision( $post_id ) ){
        remove_action('save_post', 'update_translated_title_fields');
        remove_filter('the_title','extract_text_by_language_markup');
    
        $title_with_shortcodes = get_the_title($ID);
        $titles['pt'] = trim(extract_text_by_language_markup($title_with_shortcodes, "pt_BR"));
        $titles['es'] = trim(extract_text_by_language_markup($title_with_shortcodes, "es_ES"));
        $titles['en'] = trim(extract_text_by_language_markup($title_with_shortcodes, "en_US"));
/*
        $no_empty_titles = array_filter($titles);
        $empty_titles = array_diff($titles, $no_empty_titles);
        if ($empty_titles) {
            foreach ($empty_titles as $et) {
                $titles[key($et)] = $no_empty_titles[0];
            }
        }       
*/      
        update_post_meta($ID, 'title_pt', $titles['pt']);
        update_post_meta($ID, 'title_es', $titles['es']);
        update_post_meta($ID, 'title_en', $titles['en']);
        
                add_action('save_post','update_translated_title_fields');
        add_filter('the_title','extract_text_by_language_markup');
    }
    
}

add_filter('wp_nav_menu_objects', 'append_l_menu_link');

function update_translated_categories($ID) {
    
    if (!wp_is_post_revision($post_id)){
        remove_action('save_post', 'update_translated_title_fields');
        remove_filter('the_category','extract_text_by_language_markup');
        
        $categories = get_the_category($ID);
        if ($categories){
            foreach ($categories as $cat) {
                $category['pt'] .= trim(extract_text_by_language_markup($cat->name, "pt_BR"));
                $category['es'] .= trim(extract_text_by_language_markup($cat->name, "es_ES"));
                $category['en'] .= trim(extract_text_by_language_markup($cat->name, "en_US"));
                if (end($categories) != $cat) {
                    $category['pt'] .= ", ";                                        
                    $category['es'] .= ", ";                                        
                    $category['en'] .= ", ";                                        
                                }
            }
            update_post_meta($ID, 'category_pt', $category['pt']);
            update_post_meta($ID, 'category_es', $category['es']);
            update_post_meta($ID, 'category_en', $category['en']);
        } else {
            update_post_meta($ID, 'category_pt', '');
            update_post_meta($ID, 'category_es', '');
            update_post_meta($ID, 'category_en', '');
        }
        add_action('save_post','update_translated_title_fields');
        add_filter('the_category','extract_text_by_language_markup');
    }
}

function update_translated_terms($ID) {
    
    if (!wp_is_post_revision($post_id)){
        remove_action('save_post', 'update_translated_title_fields');
        remove_filter('the_category','extract_text_by_language_markup');
        
        $categories = get_the_category($ID);
        if ($categories){
            foreach ($categories as $cat) {
                $category['pt'] .= trim(extract_text_by_language_markup($cat->name, "pt_BR"));
                $category['es'] .= trim(extract_text_by_language_markup($cat->name, "es_ES"));
                $category['en'] .= trim(extract_text_by_language_markup($cat->name, "en_US"));
                if (end($categories) != $cat) {
                    $category['pt'] .= ", ";                                        
                    $category['es'] .= ", ";                                        
                    $category['en'] .= ", ";                                        
                                }
            }
            update_post_meta($ID, 'category_pt', $category['pt']);
            update_post_meta($ID, 'category_es', $category['es']);
            update_post_meta($ID, 'category_en', $category['en']);
        } else {
            update_post_meta($ID, 'category_pt', '');
            update_post_meta($ID, 'category_es', '');
            update_post_meta($ID, 'category_en', '');
        }
        add_action('save_post','update_translated_title_fields');
        add_filter('the_category','extract_text_by_language_markup');
    }
}

function append_language_category_link ($categories){
    global $site_lang;
    preg_match_all('/http\S+/', $categories, $matches);
    foreach ($matches[0] as $mt) {
        $new_url = str_replace('"', '', $mt) . "?l=" . $site_lang;
        $categories = str_replace($mt, $new_url . '"', $categories);
    }
    return $categories;
}

function translate_categories_edit_post($categories){
    if (is_array($categories)) {
        foreach ($categories as $cat) {
            if (isset($cat->name)) { //when the term is parent
                $cat->name = extract_text_by_language_markup($cat->name);
                $translated_categories[] = $cat;
            }
        }
    } else {
        $translated_categories = extract_text_by_language_markup($categories);
    }
    return $translated_categories;
}

function fix_taxonomy_slug($slug){
    echo '<script type="text/javascript">
        function createSlug() {
            var tagName = jQuery("#tag-name").val();
            var extractedSlug = tagName.split(/\[\/(pt_BR|en_US|es_ES)]/);
            if (extractedSlug.length > 1) {
                var newSlug = extractedSlug[0].split(/\[(pt_BR|en_US|es_ES)]/);
                return newSlug[2];
            } else {
                return tagName;
            }
        }
        
        jQuery(function(){
            jQuery("#tag-name").change(
                function() { 
                    alert();
                    jQuery("#tag-slug").val(createSlug());  
                }
            );
        });
        </script>';
}
add_filter('widget_text','extract_text_by_language_markup');
add_filter('widget_title','extract_text_by_language_markup');
add_filter('the_title','extract_text_by_language_markup');
add_filter('wp_title','fix_wp_title');
add_action('save_post','fix_permalink');
add_action('save_post','update_translated_title_fields');
add_action('save_post','update_translated_categories');
add_filter('wp_list_categories','append_language_category_link');
add_filter('the_category','extract_text_by_language_markup');
if (preg_match('/edit-tags.php/', $_SERVER['PHP_SELF']) && ($_GET['action'] != 'edit')) {
    add_action('admin_head', 'fix_taxonomy_slug');
}

// apply translate function in admin panel
function translate_term_name($term){
    return extract_text_by_language_markup($term);
}
add_filter('term_name', 'translate_term_name');


add_image_size( 'single-thumb', 500, 100, true ); // (cropped)
add_image_size( 'single-thumb-square', 500, 300, true ); // (cropped)

