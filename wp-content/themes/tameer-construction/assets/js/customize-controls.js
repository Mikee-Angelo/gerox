( function( api ) {

	// Extends our custom "tameer-construction" section.
	api.sectionConstructor['tameer-construction'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );