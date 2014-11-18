<?php get_header(); ?>

<div class="archive aps">
	
	<div class="container">

		<h1><?php _e("PEARL"); ?></h1>

			
		<?php while(have_posts()): the_post(); ?>
			
			<?php
			if(taxonomy_exists('area-tematica')) {
				$terms = get_the_terms(get_the_ID(), 'area-tematica');
			} else {
				$terms = get_the_terms(get_the_ID(), 'categoria-da-evidencia');
			}
			?>
			
			<div class="item">
				
				<div class="thumb">
					<?php if(!empty($terms)): foreach($terms as $term): ?>
						<img src="<?php echo z_taxonomy_image_url($term->term_id, 'single-thumb-square'); ?>" />
					<?php break; endforeach; endif; ?>
				</div>
			
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<h3><?php the_terms('area-tematica'); ?><?php the_terms('categoria-da-evidencia'); ?></h3>
				<?= the_post_thumbnail('research-thumb'); ?>
				<p><?php the_excerpt(); ?></p>

			</div>

			<div class="clear"></div>

		<?php endwhile; ?>
	
		<?php kriesi_pagination(); ?>
	</div>
	
</div>

<?php get_footer(); ?>