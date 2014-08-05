var sds_options_panel = sds_options_panel || {};

/**
 * Custom content layout view
 */
var SDSCustomContentLayoutControlsView = Backbone.View.extend( {
	el: '.sds-custom-content-layout-controls',
	events : {
		'click .sds-theme-options-content-layouts-custom-add' : 'maybeAddCustomContentLayout'
	},
	initialize: function() {
		console.log( 'SDSCustomContentLayoutControlsView init' );
	},
	render: function() {
		this.$el.html( this.template() );

		return this;
	},
	maybeAddCustomContentLayout: function( event ) {
		var field_id = '';

		// Prevent default
		event.preventDefault();

		// Categories
		if ( this.$( '.checkbox-show-hide-content-layouts-custom-type input' ).is( ':checked' ) ) {
			var field_name = this.$('.sds-theme-options-custom-cats-select option:selected' ).text();
			field_id = parseInt( this.$( '.sds-theme-options-custom-cats-select' ).val(), 10 );
			console.log( field_id );

			// Check to make sure the user actually made a choice
			if ( ! field_id || field_id === -1 ) {
				return false;
			}

			// Check to make sure this choice doesn't already exist
			if ( ! sds_options_panel.views['custom-content-layout'].$( '.sds-theme-options-content-layout-category-' + field_id ).length ) {
				sds_options_panel.collections['custom-content-layout'].add( new SDSCustomContentLayoutModel( {
						field_id: field_id,
						field_name: field_name,
						field_type: 'category'
				} ) );
			}
			else {
				console.log( 'category already exists' );
			}

			// Reset the user selection
			this.$( '.sds-theme-options-custom-cats-select' ).val( '-1' );
		}
		// Post Types
		else {
			field_id = this.$( '.sds-theme-options-custom-post-types-select' ).val();
			console.log( field_id );

			// Check to make sure the user actually made a choice
			if ( ! field_id ) {
				return false;
			}

			// Check to make sure this choice doesn't already exist
			if ( ! sds_options_panel.views['custom-content-layout'].$( '.sds-theme-options-content-layout-post_type-' + field_id ).length ) {
				sds_options_panel.collections['custom-content-layout'].add( new SDSCustomContentLayoutModel( {
					field_id: this.$( '.sds-theme-options-custom-post-types-select' ).val(),
					field_type: 'post_type'
				} ) );
			}
			else {
				console.log( 'post type already exists' );
			}

			// Reset the user selection
			this.$( '.sds-theme-options-custom-post-types-select' ).val( '' );
		}
	}
} );

( function ( $ ) {
	"use strict";

	// Document ready
	$( function() {
		sds_options_panel.views['custom-content-layout-controls'] = new SDSCustomContentLayoutControlsView( {} );
	} );

} )( jQuery );