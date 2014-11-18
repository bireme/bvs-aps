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
$ciap2 = get_terms('ciap2', 'orderby=count');
$grau_da_evidencia = get_terms('grau-da-evidencia', 'orderby=count');


get_header(); ?>

<div class="temas">
	
	<div class="container">
		
		<div class="block">
			<h2><?php _e("Áreas Temáticas"); ?></h2>
			<ul>
				<?php foreach($areas as $area): ?>
					
					<?php 
					$total = 0;
					$args = array(
						'post_type' => 'aps',
						'tax_query' => array(
							array(
								'taxonomy' => $taxonomy,
								'field' => 'id',
								'terms' => $area->term_id
							)
						)
					);
					$query = get_posts($args);
					$total = count($query);

					if($total <= 0) continue;
					
					?>
					<li><a href="<?= get_term_link($area, $taxonomy); ?>"><?= $area->name; ?> (<?= $total; ?>)</a></li>
				<?php endforeach; ?>
			</ul>
			<div class="clear"></div>
		</div>

		<div class="block">
			<h2><?php _e("Profissionais"); ?></h2>
			<ul>
				<?php foreach($profissionais as $profissional): ?>
					<?php 
					$total = 0;
					$args = array(
						'post_type' => 'aps',
						'tax_query' => array(
							array(
								'taxonomy' => 'tipo-de-profissional',
								'field' => 'id',
								'terms' => $profissional->term_id
							)
						)
					);
					$query = get_posts($args);
					$total = count($query);

					if($total <= 0) continue;
					?>
					<li><a href="<?= get_term_link($profissional, $taxonomy); ?>"><?= $profissional->name; ?> (<?= $total; ?>)</a></li>
				<?php endforeach; ?>
			</ul>
			<div class="clear"></div>
		</div>

		<div class="block">
			<h2><?php _e("CIAP2"); ?></h2>
			<ul>
				<?php foreach($ciap2 as $item): ?>
					<?php 
					$total = 0;
					$args = array(
						'post_type' => 'aps',
						'tax_query' => array(
							array(
								'taxonomy' => 'ciap2',
								'field' => 'id',
								'terms' => $item->term_id
							)
						)
					);
					$query = get_posts($args);
					$total = count($query);

					if($total <= 0) continue;
					?>
					<li><a href="<?= get_term_link($item, $taxonomy); ?>"><?= ttruncat($item->name, 35); ?> (<?= $total; ?>)</a></li>
				<?php endforeach; ?>
			</ul>
			<div class="clear"></div>
		</div>

		<div class="block">
			<h2><?php _e("Grau da Evidência"); ?></h2>
			<ul>
				<?php foreach($grau_da_evidencia as $item): ?>
					<?php 
					$total = 0;
					$args = array(
						'post_type' => 'aps',
						'tax_query' => array(
							array(
								'taxonomy' => 'grau-da-evidencia',
								'field' => 'id',
								'terms' => $item->term_id
							)
						)
					);
					$query = get_posts($args);
					$total = count($query);

					if($total <= 0) continue;
					?>
					<li><a href="<?= get_term_link($item, $taxonomy); ?>"><?= ttruncat($item->name, 35); ?> (<?= $total; ?>)</a></li>
				<?php endforeach; ?>
			</ul>
			<div class="clear"></div>
		</div>

	</div>
</div>

<?php get_footer(); ?>