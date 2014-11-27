<?php 

load_theme_textdomain('bvsaps', get_stylesheet_directory() . '/languages');

get_header(); ?>

<div class="single aps">
	
	<div class="container">
			
		<?php while(have_posts()): the_post(); ?>
			
			<div class="item">

				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				
				<div class="content"><p><?php the_content(); ?></p></div>
			</div>

		<?php endwhile; ?>
	</div>
</div>

<?php get_footer(); ?>