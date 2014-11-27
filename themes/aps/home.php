<?php 

load_theme_textdomain('bvsaps', get_stylesheet_directory() . '/languages');

get_header(); ?>

<div class="home">
	<div class="container">
		
		<?php dynamic_sidebar( 'home' ); ?>
		<div class="clear"></div>

	</div>
</div>

<?php get_footer(); ?>