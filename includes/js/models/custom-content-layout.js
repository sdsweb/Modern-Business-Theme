var sds_options_panel = sds_options_panel || {};

/**
 * Custom content layout model
 */
var SDSCustomContentLayoutModel = Backbone.Model.extend( {
	defaults: {
		field_id: '',
		field_type: '',
		field_num: 0,
		field_label: '',
		selected: false
	},
	initialize: function() {
		console.log( 'SDSCustomContentLayoutModel init' );

		// Clear memory by destroying this model when it is removed from the collection
		this.listenTo( this, 'remove', function() { this.destroy() } );

		// Set up the field label
		this.set( 'field_label', this.createLabel() );
	},
	// ucwords() javascript equivalent
	ucwords: function( str ) {
		// discuss at: http://phpjs.org/functions/ucwords/
		// original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
		// improved by: Waldo Malqui Silva
		// improved by: Robin
		// improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// bugfixed by: Onno Marsman

		return ( str + '' ).replace( /^([a-z\u00E0-\u00FC])|\s+([a-z\u00E0-\u00FC])/g, function( $1 ) {
			return $1.toUpperCase();
		} );
	},
	// This function creates a label for this model based on the field type and id
	createLabel: function() {
		var field_id = this.get( 'field_id' ), field_type = this.get( 'field_type');

		// Categories
		if ( field_type === 'category' ) {
			label = this.ucwords( field_type.replace( '_', ' ' ) ) + ' - ' + this.ucwords( this.get( 'field_name' ) );
		}
		// Post Types
		else {
			label = this.ucwords( field_type.replace( '_', ' ' ) ) + ' - ' + this.ucwords( field_id );
		}

		return label;
	}
} );

sds_options_panel.models['custom-content-layout'] = new SDSCustomContentLayoutModel( {} );
//sds_options_panel.models['custom-content-layouts'] = []; // "Collection" of layouts


/**
 * Custom content layout collection
 */
var SDSCustomContentLayoutCollection = Backbone.Collection.extend( {
	model: SDSCustomContentLayoutModel,
	initialize: function() {
		console.log( 'SDSCustomContentLayoutCollection init' );
	}
} );

sds_options_panel.collections['custom-content-layout'] = new SDSCustomContentLayoutCollection();