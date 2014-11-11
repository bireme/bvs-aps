<?php get_header(); ?>

<div class="single pearl">
	
	<div class="container">
			
		<?php while(have_posts()): the_post(); ?>
			
			<div class="item">

				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<div class="category"><?php the_terms(get_the_ID(), 'area-tematica'); ?></div>
				
				<div class="thumb">
					<?php foreach (get_the_terms(get_the_ID(), 'area-tematica') as $cat): ?>
						<img src="<?php echo z_taxonomy_image_url($cat->term_id, 'single-thumb'); ?>" />
					<?php break; endforeach; ?>
				</div>
				
				<div class="numero_data_autoria">
					<h3><?php _e("Número, data e Autoria", 'bvsaps'); ?></h3>
					<div class="content"><?php the_field('numero_data_autoria'); ?></div>
				</div>

				<div class="area_tematica">
					<h3><?php _e("Área Temática", 'bvsaps'); ?></h3>
					<div class="content"><?php the_terms(get_the_ID(), 'area-tematica'); ?></div>
				</div>

				<div class="questao_clinica">
					<h3><?php _e("Questão Clínica", 'bvsaps'); ?></h3>
					<div class="content"><?php the_field('questao_clinica'); ?></div>
				</div>

				<div class="resposta_baseada_em_evidencia">
					<h3><?php _e("Resposta Baseada em Evidência", 'bvsaps'); ?></h3>
					<div class="content"><?php the_field('resposta_baseada_em_evidencia'); ?></div>
				</div>

				<div class="alertas">
					<h3><?php _e("Alertas", 'bvsaps'); ?></h3>
					<div class="content"><?php the_field('alertas'); ?></div>
				</div>

				<div class="contexto">
					<h3><?php _e("Contexto", 'bvsaps'); ?></h3>
					<div class="content"><?php the_field('contexto'); ?></div>
				</div>
				
				<div class="comentarios">
					<h3><?php _e("Comentários sobre a aplicabilidade do estudo para APS no contexto do SUS, sob o ponto de vista clínico, de gestão da saúde e para o público em geral", 'bvsaps'); ?></h3>
					<div class="content"><?php the_field('comentarios'); ?></div>
				</div>

				<div class="referencia">
					<h3><?php _e("Referências bibliográficas", 'bvsaps'); ?></h3>
					<div class="content"><?php the_field('referencia'); ?></div>
				</div>



				<div class="clear"></div>
			</div>

		<?php endwhile; ?>
	
		<?php kriesi_pagination(); ?>
	</div>
	
</div>

<?php get_footer(); ?>