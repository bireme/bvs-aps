<?php get_header(); ?>

<div class="single pearl">
	
	<div class="container">
			
		<?php while(have_posts()): the_post(); ?>
			
			<div class="item">

				<h3 class="post-type"><?php _e("SOF"); ?></h3>
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(''); ?></a></h2>
				<div class="category"><a href="<?php the_permalink(); ?>"><?php the_field('numero_data_autoria'); ?></a></div>

				<!--
				<div class="thumb">
					<?php foreach (get_the_terms(get_the_ID(), 'area-tematica') as $cat): ?>
						<img src="<?php echo z_taxonomy_image_url($cat->term_id, 'single-thumb'); ?>" />
					<?php break; endforeach; ?>

					<?php foreach (get_the_terms(get_the_ID(), 'categoria-da-evidencia') as $cat): ?>
						<img src="<?php echo z_taxonomy_image_url($cat->term_id, 'single-thumb'); ?>" />
					<?php break; endforeach; ?>
				</div>
				-->
				
				<div class="area_tematica">
					<h3 class="title"><?php _e("Área Temática", 'bvsaps'); ?></h3>
					
					<?php if(taxonomy_exists('area-tematica')): ?>
						<div class="content"><?php the_terms(get_the_ID(), 'area-tematica'); ?></div>
					<?php endif; ?>

					<?php if(taxonomy_exists('categoria-da-evidencia')): ?>
						<div class="content"><?php the_terms(get_the_ID(), 'categoria-da-evidencia'); ?></div>
					<?php endif; ?>
				</div>

				<div class="questao_clinica">
					<h3 class="title"><?php _e("Questão Clínica", 'bvsaps'); ?></h3>
					<div class="content"><?php the_field('questao_clinica'); ?></div>
				</div>

				<div class="resposta_baseada_em_evidencia">
					<h3 class="title"><?php _e("Resposta Baseada em Evidência", 'bvsaps'); ?></h3>
					<div class="content"><?php the_field('resposta_baseada_em_evidencia'); ?></div>
				</div>

				<div class="alertas">
					<h3 class="title"><?php _e("Alertas", 'bvsaps'); ?></h3>
					<div class="content"><?php the_field('alertas'); ?></div>
				</div>

				<div class="contexto">
					<h3 class="title"><?php _e("Contexto", 'bvsaps'); ?></h3>
					<div class="content"><?php the_field('contexto'); ?></div>
				</div>
				
				<div class="comentarios">
					<h3 class="title"><?php _e("Comentários sobre a aplicabilidade do estudo para APS no contexto do SUS, sob o ponto de vista clínico, de gestão da saúde e para o público em geral", 'bvsaps'); ?></h3>
					<div class="content"><?php the_field('comentarios'); ?></div>
				</div>

				<div class="referencia">
					<h3 class="title"><?php _e("Referências bibliográficas", 'bvsaps'); ?></h3>
					<div class="content"><?php the_field('referencia'); ?></div>
				</div>



				<div class="clear"></div>
			</div>

		<?php endwhile; ?>
	
		<?php kriesi_pagination(); ?>
	</div>
	
</div>

<?php get_footer(); ?>