<?php 

load_theme_textdomain('bvsaps', get_stylesheet_directory() . '/languages');

global $site_lang;
get_header(); ?>

<div class="home">
	<div class="container">
		
		<?php dynamic_sidebar( 'homepage-' . strtolower($site_lang) ); ?>
		<div class="clear"></div>

	</div>
</div>

<?php get_footer(); ?>