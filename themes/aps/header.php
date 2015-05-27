<?php load_theme_textdomain('bvsaps', get_stylesheet_directory() . '/languages'); ?>

<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php wp_title('BVS APS |'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="<?= get_stylesheet_directory_uri(); ?>/reset.css" />
    <link rel="stylesheet" type="text/css" href="<?= get_stylesheet_directory_uri(); ?>/style.css" />
    
    <?php wp_head(); ?>

    <script type='text/javascript' src='<?= get_stylesheet_directory_uri(); ?>/scripts.js'></script>
    <link rel="alternate" type="application/rss+xml" title="<?php echo get_bloginfo('name'); ?> Feed" href="<?php echo esc_url(get_feed_link()); ?>">
</head>

<body <?php body_class(); ?>>

    <!--[if lt IE 8]>
        <div class="alert alert-warning">
            <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'roots'); ?>
        </div>
    <![endif]-->

    <header>
        <div class="top">
            <span>
                <?php global $site_lang; ?>
                <?php create_language_list($site_lang); ?>
                <a href="#" class="contato" title="<?php _e('Entre em contato conosco', 'bvsaps'); ?>"><?php _e('Contato', 'bvsaps'); ?></a>
            </span>
        </div>

        <div class="banner-container">
            <div class="container">

                <div class="banner">
                    <div class="bvs">
                        <img src="<?= get_stylesheet_directory_uri(); ?>/img/<?php echo $site_lang; ?>/logo.png">
                    </div>

                    <div class="title">
                        <img src="<?= get_stylesheet_directory_uri(); ?>/img/<?php echo $site_lang; ?>/title.png">
                    </div>

                    <div class="clear"></div>
                </div>
                
            </div>
        </div>
        
        <?php wp_nav_menu( array('theme_location' => 'menu-'. $site_lang)); ?>

        <div class="container">
            <div class="search">
		<form action="http://pesquisa.bvs.br/aps/" name="search" method="get" id="searchForm" >
                    <input type="text" name="q">
                    <input type="hidden" name="lang" value="<?php echo substr($site_lang, 0, 2); ?>">
                    <a href="javascript:search_submit();" id="search-submit"><img src="<?= get_stylesheet_directory_uri(); ?>/img/search-button.jpg"></a>
                    
                    <div style="clear:both"></div>
                    <input type="radio" name="filter[db][]" id="sof" value="SOF" checked> <label for="sof"><?php _e('SOF', 'bvsaps'); ?></label>
                    <input type="radio" name="filter[db][]" id="aps"> <label for="aps"><?php _e('BVS APS', 'bvsaps'); ?></label>

                    <ul class="links">
                        <li><a href="<?= get_permalink( get_page_by_path( 'temas-das-sof' ) ); ?>?l=<?= $site_lang; ?>"><?php _e('Temas das SOF', 'bvsaps'); ?></a></li>
                    </ul>
                </form>
                <div style="clear:both"></div>
            </div>
        </div> 

    </header>
