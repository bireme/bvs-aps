<?php 

global $wp_query;

$wp_query->query['post_type'] = "aps";

if(taxonomy_exists('area-tematica')) {
	$areas = get_terms("area-tematica", 'orderby=count');
	$taxonomy = 'area-tematica';
} else {
	$areas = get_terms("categoria-da-evidencia", 'orderby=count');
	$taxonomy = 'categoria-da-evidencia';
}

$profissionais = get_terms('tipo-de-profissional', 'orderby=count');


get_header(); ?>

<div class="temas">
	
	<div class="container">
		
		<div class="block">
			<h2><?php _e("Áreas Temáticas"); ?></h2>
			<ul>
				<?php foreach($areas as $area): ?>
					<?php //print_r($area); ?>
					<li><a href="<?= get_term_link($area, $taxonomy); ?>"><?= $area->name; ?></a></li>
				<?php endforeach; ?>
			</ul>
			<div class="clear"></div>
		</div>

		<div class="block">
			<h2><?php _e("Profissionais"); ?></h2>
			<ul>
				<?php foreach($profissionais as $profissional): ?>
					<?php //print_r($area); ?>
					<li><a href="<?= get_term_link($profissional, $taxonomy); ?>"><?= $profissional->name; ?></a></li>
				<?php endforeach; ?>
			</ul>
			<div class="clear"></div>
		</div>

	</div>
</div>

<?php get_footer(); ?>