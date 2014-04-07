<?php
/*
 * This template is used for the display of blog posts (archive; river).
 */

get_header(); ?>

	<?php get_template_part( 'yoast', 'breadcrumbs' ); // Yoast Breadcrumbs ?>

	<section class="content-wrapper home-content home cf">
		<article class="blog-content content cf">
			<?php
				get_template_part( 'loop', 'home' ); // Loop - Home
				get_template_part( 'post', 'navigation' ); // Post Navigation
			?>
		</article>

		<?php get_sidebar(); ?>
	</section>

<?php get_footer(); ?>