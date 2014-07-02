<?php
/*
 * This template is used for the display of single pages.
 */

get_header(); ?>

	<?php get_template_part( 'yoast', 'breadcrumbs' ); // Yoast Breadcrumbs ?>

	<section class="content-wrapper page-content cf">
		<article class="blog-content content cf">
			<?php get_template_part( 'loop', 'page' ); // Loop - Page ?>

			<section class="clear"></section>

			<?php comments_template(); // Comments ?>
		</article>

		<?php get_sidebar(); ?>
	</section>

<?php get_footer(); ?>