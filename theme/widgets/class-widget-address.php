<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * MB (Modern Business) Address Widget
 *
 * Description: This Class extends WP_Widget to create a business address widget for display in sidebars.
 *
 * @version 1.0
 */
if ( ! class_exists( 'MB_Address_Widget' ) ) {
	class MB_Address_Widget extends WP_Widget {
		private static $instance; // Keep track of the instance

		/**
		 * This function is used to get/create an instance of the class.
		 */
		public static function instance() {
				if ( ! isset( self::$instance ) )
					self::$instance = new MB_Address_Widget;

			return self::$instance;
		}

		/**
		 * These functions calls and hooks are added on new instance.
		 */
		function __construct() {
			$widget_options = array(
				'classname' => 'widget-mb-address mb-address-widget',
				'description' => 'Display a formatted address block.'
			);

			parent::__construct( 'mb-address-widget', 'Modern Business - Address', $widget_options );
		}

		/**
		 * This function controls the widget form in admin.
		 */
		function form( $instance ) {
			// Set up the default widget settings
			$defaults = array(
				'title' => false,
				'address' => false,
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
				<?php // Address ?>
				<label for="<?php echo $this->get_field_id( 'address' ); ?>">Address:</label>
				<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id( 'address' ); ?>" name="<?php echo $this->get_field_name( 'address' ); ?>"><?php echo esc_textarea( $instance['address'] ); ?></textarea>
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
			$new_instance['address'] = stripslashes( wp_filter_post_kses( addslashes( $new_instance['address'] ) ) );

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
				<section class="mb-address-widget-address mb-address <?php echo ( ! empty( $instance['filter'] ) ) ? 'mb-address-has-filter' : 'mb-address-no-filter'; ?>">
					<?php echo ! empty( $instance['filter'] ) ? wpautop( $instance['address'] ) : $instance['address']; ?>
				</section>
			<?php

			echo $after_widget;
		}
	}

	function MB_Address_Widget_Instance() {
		return MB_Address_Widget::instance();
	}

	// Start Modern Business Address Widget
	MB_Address_Widget_Instance();
}