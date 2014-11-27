<?php global $wp_query; 

load_theme_textdomain('bvsaps', get_stylesheet_directory() . '/languages');

$already_print_thumb = false;
$post_type = ($wp_query->query_vars['post_type'] == 'aps') ? __('SOF', 'bvsaps') : __('PEARL', 'bvsaps');

$feed_url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$feed_url = str_replace("?", "/feed/?", $feed_url);

get_header(); ?>

<?php 
// print "<pre>";
// print_r($wp_query); 
?>


<div class="archive">
	
	<div class="container">

		<h1>
			<?php print $post_type . ": "; single_cat_title(); ?>
			<a href="<?= $feed_url; ?>" target="_blank" title="<?php _e('Assinar Feed RSS', 'bvsaps'); ?>">
				<img src="<?= get_stylesheet_directory_uri(); ?>/img/rss.png" alt="<?php _e('Assinar Feed RSS', 'bvsaps'); ?>">
			</a>
		</h1>

			
		<?php while(have_posts()): the_post(); ?>
			
			<?php if(is_tax() and $already_print_thumb == false): ?>
				<div class="thumb">
					<img src="<?php echo z_taxonomy_image_url($wp_query->queried_object->term_id, 'single-thumb'); ?>" />
					 <?php $already_print_thumb = true; ?>
				</div>
			<?php endif; ?>
			
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