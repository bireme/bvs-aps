<?php load_theme_textdomain('bvsaps', get_stylesheet_directory() . '/languages'); 

global $site_lang;
global $LANGS;

$lang_title = $LANGS[$site_lang];

?>

<footer>
	<div class="container">
		<?php if ( ! dynamic_sidebar() ) : ?>
			<div><?php dynamic_sidebar("footer-page-" . strtolower($site_lang)); ?></div>
		<?php endif; ?>
	</div>
</footer>


<?php wp_footer(); ?>
</body>
</html>