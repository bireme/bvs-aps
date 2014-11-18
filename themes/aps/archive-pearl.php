<?php global $wp_query; 

$already_print_thumb = false;
$post_type = ($wp_query->query_vars['post_type'] == 'aps') ? __('SOF') : __('PEARL');

if(is_tax()) {	
	$taxonomies = get_the_taxonomies(); 
	$taxonomy = $wp_query->query_vars['taxonomy'];

	$taxonomy_title = explode(":", $taxonomies[$taxonomy]);
	$taxonomy_title = $taxonomy_title[0];
}

get_header(); ?>

<div class="archive aps">
	
	<div class="container">

		<?php if(is_tax()): ?>
			<h3><?php print $post_type; ?> - <?php print $taxonomy_title; ?></h3>
			<h1><?php single_cat_title(); ?></h1>
		<?php else: ?>
			<h1><?php _e("SOF"); ?></h1>
		<?php endif; ?>
			
		<?php while(have_posts()): the_post(); ?>
			
			<?php
			if(taxonomy_exists('area-tematica')) {
				$terms = get_the_terms(get_the_ID(), 'area-tematica');
			} else {
				$terms = get_the_terms(get_the_ID(), 'categoria-da-evidencia');
			}
			?>
			
			<div class="item">
				
				<?php if(!is_tax()): ?>
					<div class="thumb">
						<?php if(!empty($terms)): foreach($terms as $term): ?>
							<img src="<?php echo z_taxonomy_image_url($term->term_id, 'single-thumb-square'); ?>" />
						<?php break; endforeach; endif; ?>
					</div>
	
					<h3><?php the_terms(get_the_ID(), 'area-tematica'); ?><?php the_terms(get_the_ID(), 'categoria-da-evidencia'); ?></h3>
				<?php endif; ?>
			
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<?= the_post_thumbnail('research-thumb'); ?>
				<p><?php the_excerpt(); ?></p>

			</div>

			<div class="clear"></div>

		<?php endwhile; ?>
	
		<?php kriesi_pagination(); ?>
	</div>
	
</div>

<?php get_footer(); ?>