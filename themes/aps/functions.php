<?php

// THIS THEME USES wp_nav_menu() IN TWO LOCATIONS FOR CUSTOM MENU.
if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus(
		array(
		  'primary' => 'Topo',
		)
	);
}

wp_enqueue_script("jquery");

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

add_filter('term_link', 'term_link_filter', 10, 3);
function term_link_filter( $url, $term, $taxonomy ) {
    
    global $wp_query;
    
    $post_type = $wp_query->query['post_type'];
    return $url . "?post_type=" . $post_type;
   
}


add_image_size( 'single-thumb', 500, 100, true ); // (cropped)
add_image_size( 'single-thumb-square', 500, 300, true ); // (cropped)

