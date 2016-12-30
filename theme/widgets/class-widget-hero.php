<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * MB (Modern Business) Hero Widget
 *
 * Description: This Class extends WP_Widget to create a hero widget for display in sidebars.
 *
 * @version 1.0
 */
if ( ! class_exists( 'MB_Hero_Widget' ) ) {
	class MB_Hero_Widget extends WP_Widget {
		private static $instance; // Keep track of the instance

		/**
		 * This function is used to get/create an instance of the class.
		 */
		public static function instance() {
			if ( ! isset( self::$instance ) )
				self::$instance = new MB_Hero_Widget;

			return self::$instance;
		}

		/**
		 * These functions calls and hooks are added on new instance.
		 */
		function __construct() {
			$widget_options = array(
				'classname' => 'widget-mb-hero mb-hero-widget',
				'description' => 'Display a formatted hero block.'
			);

			parent::__construct( 'mb-hero-widget', 'Modern Business - Hero', $widget_options );
		}

		/**
		 * This function controls the widget form in admin.
		 */
		function form( $instance ) {
			// Set up the default widget settings
			$defaults = array(
				'title' => false,
				'content' => array(
					'left' => false,
					'right' => false
				),
				'filter' => array(
					'left' => false,
					'right' => false
				),
			);

			$instance = wp_parse_args( $instance, $defaults );
		?>
			<p>
				<?php // Title ?>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
			</p>

			<p>
				<?php // Left Content ?>
				<label for="<?php echo $this->get_field_id( 'content-left' ); ?>">Left:</label>
				<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id( 'content-left' ); ?>" name="<?php echo $this->get_field_name( 'content-left' ); ?>"><?php echo esc_textarea( $instance['content']['left'] ); ?></textarea>
			</p>

			<p>
				<?php // Filter Left Content (wpautop) ?>
				<input id="<?php echo $this->get_field_id( 'filter-left' ); ?>" name="<?php echo $this->get_field_name( 'filter-left' ); ?>" type="checkbox" <?php checked( isset( $instance['filter']['left'] ) ? $instance['filter']['left'] : false ); ?> />
				&nbsp;
				<label for="<?php echo $this->get_field_id( 'filter-left' ); ?>"><?php _e( 'Automatically add paragraphs', 'modern-business' ); ?></label>
			</p>

			<p>
				<?php // Right Content ?>
				<label for="<?php echo $this->get_field_id( 'content-right' ); ?>">Right:</label>
				<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id( 'content-right' ); ?>" name="<?php echo $this->get_field_name( 'content-right' ); ?>"><?php echo esc_textarea( $instance['content']['right'] ); ?></textarea>
			</p>

			<p>
				<?php // Filter Right Content (wpautop) ?>
				<input id="<?php echo $this->get_field_id( 'filter-right' ); ?>" name="<?php echo $this->get_field_name( 'filter-right' ); ?>" type="checkbox" <?php checked( isset( $instance['filter']['right'] ) ? $instance['filter']['right'] : false ); ?> />
				&nbsp;
				<label for="<?php echo $this->get_field_id( 'filter-right' ); ?>"><?php _e( 'Automatically add paragraphs', 'modern-business' ); ?></label>
			</p>
		<?php
		}

		/**
		 * This function sanitizes user input upon saving widget data.
		 */
		function update( $new_instance, $old_instance ) {
			$new_instance['title'] = sanitize_text_field( $new_instance['title'] );
			$new_instance['content']['left'] = stripslashes( wp_filter_post_kses( addslashes( $new_instance['content-left'] ) ) );
			$new_instance['content']['right'] = stripslashes( wp_filter_post_kses( addslashes( $new_instance['content-right'] ) ) );

			$new_instance['filter']['left'] = isset( $new_instance['filter-left'] );
			$new_instance['filter']['right'] = isset( $new_instance['filter-right'] );

			return $new_instance;
		}

		/**
		 * This function controls the display of the widget on the site.
		 */
		function widget( $args, $instance ) {
			$css_classes = array(
				'left' => '',
				'right' => ''
			);

			extract( $args );

			echo $before_widget;
			
			$title = apply_filters( 'widget_title', ( ! empty( $instance['title'] ) ) ? $instance['title'] : '', $instance );

			if ( ! empty( $instance['title'] ) )
				echo $before_title . $title . $after_title;

			// CSS Classes
			$css_classes['left'] = ( ! empty( $instance['filter']['left'] ) ) ? 'mb-hero-content-has-filter' : 'mb-hero-content-no-filter';
			$css_classes['left'] .= ( ! empty( $instance['content']['left'] ) && empty( $instance['content']['right'] ) ) ? ' mb-hero-content-full-width' : '';
			$css_classes['left'] .= ( empty( $instance['content']['left'] ) && empty( $instance['content']['right'] ) ) ? ' mb-hero-no-content' : '';
			$css_classes['right'] = ( ! empty( $instance['filter']['right'] ) ) ? 'mb-hero-content-has-filter' : 'mb-hero-content-no-filter';
			$css_classes['right'] .= ( ! empty( $instance['content']['left'] ) && empty( $instance['content']['right'] ) ) ? ' mb-hero-no-content' : '';
			$css_classes['right'] .= ( empty( $instance['content']['left'] ) && empty( $instance['content']['right'] ) ) ? ' mb-hero-no-content' : '';
			?>
				<section class="mb-hero-widget-content mb-hero-content mb-hero-widget-left-content mb-hero-left <?php echo $css_classes['left']; ?>">
					<section class="mb-hero-widget-content-inner mb-hero-content-inner">
						<?php echo ( ! empty( $instance['filter']['left'] ) ) ? wpautop( $instance['content']['left'] ) : $instance['content']['left']; ?>
					</section>
				</section>

				<section class="mb-hero-widget-content mb-hero-content mb-hero-widget-right-content mb-hero-right <?php echo $css_classes['right']; ?>">
					<section class="mb-hero-widget-content-inner mb-hero-content-inner">
						<?php echo ( ! empty( $instance['filter']['right'] ) ) ? wpautop( $instance['content']['right'] ) : $instance['content']['right']; ?>
					</section>
				</section>
			<?php

			echo $after_widget;
		}
	}

	function MB_Hero_Widget_Instance() {
		return MB_Hero_Widget::instance();
	}

	// Start Modern Business Hero Widget
	MB_Hero_Widget_Instance();
}