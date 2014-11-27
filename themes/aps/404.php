<?php 

load_theme_textdomain('bvsaps', get_stylesheet_directory() . '/languages');

get_header(); ?>

<div class="intern">
	<div class="container">

		<div class="left">
			<div class="breadcrumb"><?php if(function_exists('bcn_display')) bcn_display(); ?></div>
			
			<h2><?php _e('Erro: Página não encontrada', 'bvsaps'); ?></h2>
			<p><?php _e('A Página que você procura não foi encontrada, por favor verifique e tente novamente.', 'bvsaps'); ?></p>

		</div>


		<div class="right side">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar') ) {}; ?>
		</div>
		<div style="clear:both"></div>
	</div>
</div>

<?php get_footer(); ?>