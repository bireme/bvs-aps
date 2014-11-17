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
                <a href="#" title="Site em Espanhol">español</a> |
                <a href="#" title="Site em Inglês">english</a>
                <a href="#" class="contato" title="Entre em contato conosco">Contato</a>
            </span>
        </div>

        <div class="banner-container">
            <div class="container">

                <div class="banner">
                    <div class="bvs">
                        <img src="<?= get_stylesheet_directory_uri(); ?>/img/logobvs.gif">
                    </div>

                    <div class="title">
                        <img src="<?= get_stylesheet_directory_uri(); ?>/img/title3.gif">
                    </div>

                    <div class="clear"></div>
                </div>
                
            </div>
        </div>
        
        <?php wp_nav_menu( array('menu' => 'Topo' )); ?>

        <div class="container">
            <div class="search">
                
                <script>
                    function evipnet_search_submit() {
                    $("#searchForm").submit();
                }
                </script>
                
                <form action="http://pesquisa.bvs.br/telessaude/" name="search" method="get" id="searchForm" >
                    <input type="text" name="q">
                    <a href="javascript:search_submit();" id="search-submit"><img src="<?= get_stylesheet_directory_uri(); ?>/img/search-button.jpg"></a>
                    
                    <div style="clear:both"></div>
                    <input type="radio" name="where" value="blog" checked> SOF
                    <input type="radio" name="where" value="literature"> BVS APS

                    <ul class="links">
                        <li><a href="<?= get_permalink( get_page_by_path( 'temas-das-sof' ) ); ?>">Temas da SOF</a></li>
                    </ul>
                </form>
                <div style="clear:both"></div>
            </div>
        </div> 

    </header>
