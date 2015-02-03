<?php
	global $multipage;

	// Loop through posts
	if ( have_posts() ) :
		while ( have_posts() ) : the_post();
?>
	<section id="post-<?php the_ID(); ?>" <?php post_class( 'post cf' ); ?>>
		<article class="post-content">
			<section class="post-title-wrap cf <?php echo ( has_post_thumbnail() ) ? 'post-title-wrap-featured-image' : 'post-title-wrap-no-image'; ?>">
				<p class="post-date"><?php the_time( get_option( 'date_format' ) ); ?></p>
				<h1 class="post-title page-title"><?php the_title(); ?></h1>
			</section>

			<?php sds_featured_image(); ?>

			<?php the_content(); ?>

			<section class="clear"></section>

			<?php edit_post_link( __( 'Edit Post', 'modern-business' ) ); // Allow logged in users to edit ?>

			<section class="clear"></section>

			<?php if ( $multipage ) : ?>
				<section class="single-post-navigation single-post-pagination wp-link-pages">
					<?php wp_link_pages(); ?>
				</section>
			<?php endif; ?>

			<?php if ( $post->post_type !== 'attachment' ) : // Post Meta Data (tags, categories, etc...) ?>
				<section class="post-meta">
					<?php sds_post_meta(); ?>
				</section>
			<?php endif ?>
		</article>
		<?php sds_single_post_navigation(); ?>
	</section>

	<?php get_template_part( 'post', 'author' ); // Author Details ?>

	<section class="clear"></section>

	<section class="after-posts-widgets <?php echo ( is_active_sidebar( 'after-posts-sidebar' ) ) ? 'after-posts-widgets-active cf widgets' : 'no-widgets'; ?>">
		<?php sds_after_posts_sidebar(); ?>
	</section>
<?php
		endwhile;
	endif;
?>