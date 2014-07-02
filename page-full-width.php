<?php
/*
 * Template Name: Full Width
 * This template is used for the display of full width single pages.
 */

get_header(); ?>

	<?php get_template_part( 'yoast', 'breadcrumbs' ); // Yoast Breadcrumbs ?>

	<section class="content-wrapper page-content full-content-wrapper cf">
		<article class="page-content full-content content cf">
			<?php get_template_part( 'loop', 'page-full-width' ); // Loop - Full Width ?>

			<section class="clear"></section>

			<?php comments_template(); // Comments ?>
		</article>
	</section>

<?php get_footer(); ?>