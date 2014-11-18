<?php 

global $wp_query; 
$post_type = ($wp_query->query_vars['post_type'] == 'aps') ? 'SOF' : 'PEARL';

get_header(); ?>

<div class="single aps">
	
	<div class="container">
			
		<?php while(have_posts()): the_post(); ?>
			
			<div class="item">

				<h3 class="post-type"><?php _e("SOF"); ?></h3>
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				
				<?php // Estes campos são os mesmos. Coloquei os dois pois há ambientes em que a taxonomy foi criada como area-tematica e outros
				// em que a taxonomy foi criada com categoria-da-evidencia; ?>	
				<?php if(taxonomy_exists('area-tematica')): ?>
					<div class="category"><?php the_terms(get_the_ID(), 'area-tematica'); ?></div>
				<?php endif; ?>

				<?php if(taxonomy_exists('categoria-da-evidencia')): ?>
					<div class="category"><?php the_terms(get_the_ID(), 'categoria-da-evidencia'); ?></div>
				<?php endif; ?>
				
				<div class="thumb">
					<?php if(taxonomy_exists('area-tematica')): ?>
						<?php foreach (get_the_terms(get_the_ID(), 'area-tematica') as $cat): ?>
							<img src="<?php echo z_taxonomy_image_url($cat->term_id, 'single-thumb-square'); ?>" />
						<?php break; endforeach; ?>
					<?php endif; ?>

					<?php if(taxonomy_exists('categoria-da-evidencia')): ?>
						<?php foreach (get_the_terms(get_the_ID(), 'categoria-da-evidencia') as $cat): ?>
							<img src="<?php echo z_taxonomy_image_url($cat->term_id, 'single-thumb-square'); ?>" />
						<?php break; endforeach; ?>
					<?php endif; ?>
				</div>
				
				<div class="dados">
					<p>
						<?php $term_content = get_the_terms(get_the_ID(), 'teleconsultor'); if(!empty($term_content)): ?>
							<b><?php _e('Teleconsultor', 'bvsaps'); ?>: </b><?php the_terms(get_the_ID(), 'teleconsultor'); ?><br>
						<?php endif; ?>
						
						<?php $term_content = get_the_terms(get_the_ID(), 'tipo-de-profissional'); if(!empty($term_content)): ?>
							<b><?php _e('Profissional Solicitante', 'bvsaps'); ?>: </b><?php the_terms(get_the_ID(), 'tipo-de-profissional'); ?><br>
						<?php endif; ?>
						
						<?php $term_content = get_the_terms(get_the_ID(), 'ciap2'); if(!empty($term_content)): ?>
							<b><?php _e('CIAP2', 'bvsaps'); ?>: </b><?php the_terms(get_the_ID(), 'ciap2'); ?><br>
						<?php endif; ?>
						
						<?php $term_content = get_the_terms(get_the_ID(), 'decs'); if(!empty($term_content)): ?>
							<b><?php _e('DeCS/MeSH', 'bvsaps'); ?>: </b><?php the_terms(get_the_ID(), 'decs'); ?><br>
						<?php endif; ?>
						
						<?php $term_content = get_the_terms(get_the_ID(), 'grau-da-evidencia'); if(!empty($term_content)): ?>
							<b><?php _e('Grau da Evidência', 'bvsaps'); ?>: </b><?php the_terms(get_the_ID(), 'grau-da-evidencia'); ?><br>
						<?php endif; ?>
					</p>
				</div>

				<div style="clear:both"></div>

				<div class="content">
					<p><?php the_content(); ?></p>
				</div>
				
				<b>Bibliografia Selecionada</b><br>
				<p><?php the_field('bibliografia_selecionada'); ?></p>

				<div class="clear"></div>
			</div>

		<?php endwhile; ?>
	
		<?php kriesi_pagination(); ?>
	</div>
	
</div>

<?php get_footer(); ?>