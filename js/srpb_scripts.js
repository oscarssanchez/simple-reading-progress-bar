jQuery( document ).on( 'ready', function() {
	'use strict';
	var winHeight = jQuery( window ).height(),
		docHeight = jQuery( document ).height(),
		progressBar = jQuery( 'progress' ),
		max, value;

	/* Set the max scrollable area */
	max = docHeight - winHeight;
	progressBar.attr( 'max', max );

	jQuery( document ).on( 'scroll', function() {
		value = jQuery( window ).scrollTop();
		progressBar.attr( 'value', value );
	} );
});
