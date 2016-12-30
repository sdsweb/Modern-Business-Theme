<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * MB (Modern Business) CTA Widget
 *
 * Description: This Class extends WP_Widget to create a call to action widget for display in sidebars.
 *
 * @version 1.0
 */
if ( ! class_exists( 'MB_CTA_Widget' ) ) {
	class MB_CTA_Widget extends WP_Widget {
		private static $instance; // Keep track of the instance

		/**
		 * This function is used to get/create an instance of the class.
		 */
		public static function instance() {
				if ( ! isset( self::$instance ) )
					self::$instance = new MB_CTA_Widget;

			return self::$instance;
		}

		/**
		 * These functions calls and hooks are added on new instance.
		 */
		function __construct() {
			$widget_options = array(
				'classname' => 'widget-mb-cta mb-cta-widget',
				'description' => 'Display a formatted call to action block.'
			);

			parent::__construct( 'mb-cta-widget', 'Modern Business - CTA', $widget_options );
		}

		/**
		 * This function controls the widget form in admin.
		 */
		function form( $instance ) {
			// Set up the default widget settings
			$defaults = array(
				'title' => false,
				'cta' => false,
				'filter' => false
			);

			$instance = wp_parse_args( $instance, $defaults );
		?>
			<p>
				<?php // Title ?>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
			</p>

			<p>
				<?php // CTA ?>
				<label for="<?php echo $this->get_field_id( 'cta' ); ?>">CTA:</label>
				<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id( 'cta' ); ?>" name="<?php echo $this->get_field_name( 'cta' ); ?>"><?php echo esc_textarea( $instance['cta'] ); ?></textarea>
			</p>

			<p>
				<?php // Filter Content (wpautop) ?>
				<input id="<?php echo $this->get_field_id( 'filter' ); ?>" name="<?php echo $this->get_field_name( 'filter' ); ?>" type="checkbox" <?php checked( isset( $instance['filter'] ) ? $instance['filter'] : false ); ?> />
				&nbsp;
				<label for="<?php echo $this->get_field_id( 'filter' ); ?>"><?php _e( 'Automatically add paragraphs', 'modern-business' ); ?></label>
			</p>
		<?php
		}

		/**
		 * This function sanitizes user input upon saving widget data.
		 */
		function update( $new_instance, $old_instance ) {
			$new_instance['title'] = sanitize_text_field( $new_instance['title'] );
			$new_instance['cta'] = stripslashes( wp_filter_post_kses( addslashes( $new_instance['cta'] ) ) );

			$new_instance['filter'] = isset( $new_instance['filter'] );

			return $new_instance;
		}

		/**
		 * This function controls the display of the widget on the site.
		 */
		function widget( $args, $instance ) {
			extract( $args );
				
			echo $before_widget;
			
			$title = apply_filters( 'widget_title', ( ! empty( $instance['title'] ) ) ? $instance['title'] : '', $instance );

			if ( ! empty( $instance['title'] ) )
				echo $before_title . $title . $after_title;

			?>
				<section class="mb-cta-widget-cta mb-cta <?php echo ( ! empty( $instance['filter'] ) ) ? 'mb-cta-has-filter' : 'mb-cta-no-filter'; ?>">
					<?php echo ! ( empty( $instance['filter'] ) ) ? wpautop( $instance['cta'] ) : $instance['cta']; ?>
				</section>
			<?php

			echo $after_widget;
		}
	}

	function MB_CTA_Widget_Instance() {
		return MB_CTA_Widget::instance();
	}

	// Start Modern Business Call to Action Widget
	MB_CTA_Widget_Instance();
}