( function ( blocks, element, blockEditor ) {
	var el = element.createElement;

	var useBlockProps = blockEditor.useBlockProps;

	blocks.registerBlockType( 'contact-form-query/contact-form', {
		edit: function ( props ) {
			return el(
				'p',
				useBlockProps( { className: props.className } ),
				'[contact_form_query]'
			);
		},
		save: function () {
			return null;
		}
	} );
} )(
	window.wp.blocks,
	window.wp.element,
	window.wp.blockEditor
);
