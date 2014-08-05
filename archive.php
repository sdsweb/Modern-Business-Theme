<?php
/*
 * This template is used for the display of archives.
 */

get_header(); ?>

	<?php get_template_part( 'yoast', 'breadcrumbs' ); // Yoast Breadcrumbs ?>

	<section class="content-wrapper archive-content archives cf">
		<article class="blog-content content cf">
			<?php
				get_template_part( 'loop', 'archive' ); // Loop - Archive
				get_template_part( 'post', 'navigation' ); // Post Navigation
			?>
		</article>

		<?php get_sidebar(); ?>
	</section>

<?php get_footer(); ?>