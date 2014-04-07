<script type="text/template" id="tmpl-sds-custom-content-layout">
		<?php
			$content_layouts = ( function_exists( 'sds_content_layouts' ) ) ? sds_content_layouts() : false;

			if ( ! empty( $content_layouts ) ) :
		?>
			<div class="sds-theme-options-content-layout-wrap sds-theme-options-content-layout-wrap-custom sds-theme-options-content-layout-{{{ data.field_type }}}-{{{ data.field_id }}} {{{ data.field_id }}} {{{ data.field_type }}}">
				<h4 class="sds-theme-options-content-layout-title">{{{ data.field_label }}}</h4>

				<?php foreach( $content_layouts as $name => $atts ) : ?>
					<div class="sds-theme-options-content-layout sds-theme-options-content-layout-<?php echo $name; ?>">
						<label class="content-layout-label" data-field-num="{{{ data.field_num }}}">
							<input type="radio" id="sds_theme_options_content_layouts_name_<?php echo $name; ?>" name="sds_theme_options[content_layouts][custom][{{{ data.field_num }}}][{{{ data.field_type }}}][{{{ data.field_id }}}]" value="<?php echo $name; ?>" <# if ( data.selected === '<?php echo $name; ?>' || ( ! data.selected && <?php echo ( isset( $atts['default'] ) && $atts['default'] ) ? 'true': 'false'; ?> ) ) { #> <?php checked( true ); ?> <# } #> />

							<div class="sds-theme-options-content-layout-preview">
								<?php
								if ( isset( $atts['preview_values'] ) )
									vprintf( $atts['preview'], $atts['preview_values'] );
								else
									echo $atts['preview'];
								?>
							</div>
						</label>
					</div>
				<?php endforeach; ?>
				<a href="#remove" class="remove-sds-theme-options-content-layout" data-field-num="{{{ data.field_num }}}">Remove</a>
			</div>
		<?php
			endif;
		?>
</script>