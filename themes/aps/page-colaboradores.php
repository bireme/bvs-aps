<?php // template name: Colaboradores 

load_theme_textdomain('bvsaps', get_stylesheet_directory() . '/languages');

?>
<?php get_header(); ?>

<div class="single colab">
	
	<div class="container">
			
		<?php while(have_posts()): the_post(); ?>
			
			<div class="item">

				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<div class="content"><p><?php the_content(); ?></p></div>

				<ul>
					<?php foreach(get_terms('teleconsultor') as $term): ?>
						<li><a href="<?php print_r(get_term_link($term)); ?>" title="<?php print $term->name; ?>"><?php print $term->name; ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>

		<?php endwhile; ?>
	</div>
</div>

<?php get_footer(); ?>