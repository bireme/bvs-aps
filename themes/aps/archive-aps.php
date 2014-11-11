<?php get_header(); ?>

<div class="archive aps">
	
	<div class="container">
			
		<?php while(have_posts()): the_post(); ?>
			
			<div class="item">

				<div class="thumb">
					<?php foreach (get_the_terms(get_the_ID(), 'area-tematica') as $cat): ?>
						<img src="<?php echo z_taxonomy_image_url($cat->term_id, 'medium'); ?>" />
					 <?php break; endforeach; ?>
				</div>
					
				<div class="category"><?php the_terms(get_the_ID(), 'area-tematica'); ?></div>

				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<?= the_post_thumbnail('research-thumb'); ?>
				<p><?php the_excerpt(); ?></p>

				<div class="clear"></div>
			</div>

		<?php endwhile; ?>
	
		<?php kriesi_pagination(); ?>
	</div>
	
</div>

<?php get_footer(); ?>