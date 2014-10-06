<?php get_header(); ?>

<div class="archive">
	
	<div class="container">
			
		<?php while(have_posts()): the_post(); ?>
			
			<div class="item">
			
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<?= the_post_thumbnail('research-thumb'); ?>
				<p><?php the_excerpt(); ?></p>

			</div>

		<?php endwhile; ?>
	
		<?php kriesi_pagination(); ?>
	</div>
	
</div>

<?php get_footer(); ?>