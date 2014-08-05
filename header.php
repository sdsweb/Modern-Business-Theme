<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8"> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html><!--<![endif]-->
	<head>
		<title><?php wp_title( '| ', true, 'right' ); ?></title>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
			
		<?php wp_head(); ?>
	</head>

	<body <?php language_attributes(); ?> <?php body_class(); ?>>
		<!-- Header	-->
		<header class="cf">
			<!-- Top Navigation  -->
			<?php if( has_nav_menu( 'top_nav' ) ) : // Top Navigation Area ?>
				<nav class="nav-container top-nav">
					<div class="in">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'top_nav',
								'container' => false,
								'menu_class' => 'top-nav secondary-nav menu',
								'menu_id' => 'top-nav',
							) );
						?>
					</div>
				</nav>

				<section class="clear"></section>
			<?php endif; ?>

			<div class="in">
				<!--  Logo 	-->
				<section class="logo-box <?php echo ( is_active_sidebar( 'header-call-to-action-sidebar' ) ) ? 'logo-box-header-cta': 'logo-box-no-header-cta'; ?> <?php echo ( ! is_active_sidebar( 'header-call-to-action-sidebar' ) && ! has_nav_menu( 'top_nav' ) ) ? 'logo-box-full-width': false; ?>">
					<?php sds_logo(); ?>
					<?php sds_tagline(); ?>
				</section>

				<!--  Header Call to Action -->
				<aside class="header-cta-container header-call-to-action">
					<?php sds_header_call_to_action_sidebar(); // Header CTA Sidebar ?>
				</aside>

				<section class="clear"></section>

				<!-- Primary Navigation -->
				<nav class="primary-nav-container">
					<?php
						wp_nav_menu( array(
							'theme_location' => 'primary_nav',
							'container' => false,
							'menu_class' => 'primary-nav menu',
							'menu_id' => 'primary-nav',
							'fallback_cb' => 'sds_primary_menu_fallback'
						) );
					?>

					<?php $nav_menu_locations = get_nav_menu_locations(); // Get navigation menu locations ?>
					<button class="mobile-nav-button">
						<img src="<?php echo get_template_directory_uri(); ?>/images/menu-icon-large.png" alt="<?php esc_attr_e( 'Toggle Navigation', 'modern-business' ); ?>" />
						<img class="close-icon" src="<?php echo get_template_directory_uri(); ?>/images/close-icon-large.png" alt="<?php esc_attr_e( 'Close Navigation', 'modern-business' ); ?>" />
						<?php _e( 'Navigation', 'modern-business' ); ?>
					</button>
					<?php mb_mobile_menu(); ?>
				</nav>
			</div>
		</header>

		<!-- Content -->
		<div class="in">