<?php get_header(); ?>

<div class="archive">
	
	<div class="container">

		<h1><?php single_cat_title(); ?></h1>

		<?php if(is_tax()): ?>
			<div class="thumb">
				<img src="<?php echo z_taxonomy_image_url($cat->term_id, 'medium'); ?>" />
			</div>
		<?php endif; ?>
			
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