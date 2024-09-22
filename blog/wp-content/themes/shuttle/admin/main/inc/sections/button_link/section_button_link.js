( function( api ) {

	// Extends our custom "shuttle-button-link" section.
	api.sectionConstructor['shuttle-button-link'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
