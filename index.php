<?php
/*
 * This template is used for the display of all post types that do not have templates (used as a fallback).
 */

get_header(); ?>

	<?php get_template_part( 'yoast', 'breadcrumbs' ); // Yoast Breadcrumbs ?>

	<section class="content-wrapper index-content index cf">
		<article class="blog-content content cf">
			<?php get_template_part( 'loop' ); // Loop ?>

			<?php comments_template(); // Comments ?>
		</article>

		<?php get_sidebar(); ?>
	</section>

<?php get_footer(); ?>