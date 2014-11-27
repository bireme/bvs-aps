<?php global $wp_query; 

load_theme_textdomain('bvsaps', get_stylesheet_directory() . '/languages');

$already_print_thumb = false;
$post_type = ($wp_query->query_vars['post_type'] == 'aps') ? __('SOF', 'bvsaps') : __('PEARL', 'bvsaps');

if(is_tax()) {	
	$taxonomies = get_the_taxonomies(); 
	$taxonomy = $wp_query->query_vars['taxonomy'];

	$taxonomy_title = explode(":", $taxonomies[$taxonomy]);
	$taxonomy_title = $taxonomy_title[0];
}

$feed_url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$feed_url = str_replace("?", "/feed/?", $feed_url);

get_header(); ?>

<!-- <pre><?php var_dump($wp_query); ?></pre> -->

<div class="archive aps">
	
	<div class="container">

		<?php if(is_tax()): ?>
			<h3><?php print $post_type; ?> - <?php print $taxonomy_title; ?></h3>
			<h1>
				<?php single_cat_title(); ?>
				<a href="<?= $feed_url; ?>" target="_blank" title="<?php _e('Assinar Feed RSS', 'bvsaps'); ?>">
					<img src="<?= get_stylesheet_directory_uri(); ?>/img/rss.png" alt="<?php _e('Assinar Feed RSS', 'bvsaps'); ?>">
				</a>
			</h1>
		<?php else: ?>
			<h1>
				<?php _e("SOF", 'bvsaps'); ?>
				<a href="<?= $feed_url; ?>" target="_blank" title="<?php _e('Assinar Feed RSS', 'bvsaps'); ?>">
					<img src="<?= get_stylesheet_directory_uri(); ?>/img/rss.png" alt="<?php _e('Assinar Feed RSS', 'bvsaps'); ?>">
				</a>
			</h1>
		<?php endif; ?>
	
		<?php while(have_posts()): the_post(); ?>
			
			<?php
			if(taxonomy_exists('area-tematica')) {
				$terms = get_the_terms(get_the_ID(), 'area-tematica');
			} else {
				$terms = get_the_terms(get_the_ID(), 'categoria-da-evidencia');
			}
			?>

			<?php if(is_tax() and $already_print_thumb == false): ?>
				<div class="thumb">
					<img src="<?php echo z_taxonomy_image_url($wp_query->queried_object->term_id, 'single-thumb'); ?>" />
					 <?php $already_print_thumb = true; ?>
				</div>
			<?php endif; ?>
			
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