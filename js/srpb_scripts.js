let simpleProgressBar = document.addEventListener( 'DOMContentLoaded', function() {
	'use strict';
	let winHeight   = window.innerHeight,
		docHeight   = document.body.clientHeight,
		progressBar = document.getElementById( 'progressBar' ),
		max, value;

	/* Set the max scrollable area */
	max = docHeight - winHeight;
	progressBar.setAttribute( 'max', max );

	document.addEventListener( 'scroll', function() {
		value = jQuery( window ).scrollTop();
		progressBar.setAttribute( 'value', value );
	} );
} ) ;
