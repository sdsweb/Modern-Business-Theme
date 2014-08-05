var sds_options_panel = sds_options_panel || {};

/**
 * Custom content layout view
 */
var SDSCustomContentLayoutView = Backbone.View.extend( {
	el: '.sds-custom-content-layouts',
	collection: sds_options_panel.collections['custom-content-layout'],
	template: wp.template( 'sds-custom-content-layout' ),
	events : {
		'click .remove-sds-theme-options-content-layout': 'removeContentLayout',
		'click .content-layout-label': 'setContentLayout'
	},
	initialize: function() {
		console.log( 'SDSCustomContentLayoutView init' );

		// Re-render whenever the collection changes
		this.listenTo( this.collection, 'add', this.render );
		this.listenTo( this.collection, 'remove', this.render );

		// Determine the number of initial custom content layouts
		this.field_num_offset = this.getFieldNumOffset();
	},
	render: function() {
		var self = this;

		console.log( 'rendering layout view' );

		// Clear the custom fields first
		this.$( '.sds-theme-options-content-layout-wrap-custom' ).remove();

		// Get the field num offset
		this.field_num_offset = this.getFieldNumOffset();

		// Loop through the custom layout models and add them before the controls
		_.each( this.collection.models, function( model ) {
			// Reset the field number before rendering
			model.set( 'field_num', self.field_num_offset + self.collection.indexOf( model ) );

			self.$( '.sds-custom-content-layout-controls' ).before( self.template( model.toJSON() ) );
		} );

		return this;
	},
	// This function sets the content layout on the model when the user clicks on one of the options
	setContentLayout: function( event ) {
		console.log( 'setting content layout on model' );
		console.log( jQuery( event.target ) );

		// Since the event bubbles to the input element inside of the label, make sure this is the click on the label
		if ( ! jQuery( event.target ).is( 'input' ) ) {
			var $label = jQuery( event.currentTarget ), field_num = parseInt( $label.attr( 'data-field-num' ), 10 ),
				selected = $label.find( 'input' ).val(), model = this.collection.findWhere( { 'field_num' : field_num } );

			// Set the selected value on the model
			if ( model ) {
				model.set( 'selected', selected );
			}
			console.log( model );
		}
	},
	// This function removes a content layout from the DOM
	removeContentLayout: function( event ) {
		var self = this, $remove_link = jQuery( event.currentTarget),
			model = this.collection.findWhere( { 'field_num' : parseInt( $remove_link.attr( 'data-field-num' ), 10 ) } );

		// Prevent default
		event.preventDefault();

		console.log( 'removing content layout' );

		// Remove the content layout from the collection
		if ( model ) {
			console.log( 'removing model from collection' );
			console.log( model );
			this.collection.remove( model );
		}
		// Remove the content layout from the view as it does not exist in the collection
		else {
			console.log( 'removing model from DOM' );
			$remove_link.parents( '.sds-theme-options-content-layout-wrap' ).remove();
			this.render(); // Re-render the view now that the content layout has been removed from the view
		}
	},
	// This function gets the starting index for the models in this view's collection
	getFieldNumOffset: function() {
		return this.$( '.sds-theme-options-content-layout-wrap' ).length;
	}
} );

( function ( $ ) {
	"use strict";

	// Document ready
	$( function() {
		sds_options_panel.views['custom-content-layout'] = new SDSCustomContentLayoutView( {} );
	} );

} )( jQuery );