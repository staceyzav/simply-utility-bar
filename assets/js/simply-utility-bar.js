/**
 * Simply Utility Bar — simply-utility-bar.js
 * Version: 1.0.0
 * Author: Simply Design
 *
 * Handles scroll-away behavior for the utility bar.
 * Adds .scrolled-away to the bar and .scrolled to body when threshold is passed.
 * Theme CSS uses .has-utility-bar.scrolled to slide the header back up.
 *
 * body.has-utility-bar is added server-side (PHP body_class filter) — no JS needed.
 *
 * No jQuery. Vanilla JS only.
 */

( function () {

	'use strict';

	document.addEventListener( 'DOMContentLoaded', function () {

		var bar = document.querySelector( '.simply-utility-bar' );
		if ( ! bar ) return;

		var body      = document.body;
		var THRESHOLD = (
			window.simplyUtilityBarData &&
			window.simplyUtilityBarData.scrollThreshold
		) ? parseInt( window.simplyUtilityBarData.scrollThreshold, 10 ) : 20;

		var ticking    = false;
		var wasScrolled = false;

		function onScroll() {
			var y       = window.scrollY || window.pageYOffset;
			var scrolled = y > THRESHOLD;
			if ( scrolled === wasScrolled ) return;
			wasScrolled = scrolled;
			if ( scrolled ) {
				bar.classList.add( 'scrolled-away' );
				body.classList.add( 'scrolled' );
			} else {
				bar.classList.remove( 'scrolled-away' );
				body.classList.remove( 'scrolled' );
			}
		}

		window.addEventListener( 'scroll', function () {
			if ( ! ticking ) {
				ticking = true;
				requestAnimationFrame( function () { onScroll(); ticking = false; } );
			}
		}, { passive: true } );

		// Run once on load in case page is already scrolled
		onScroll();

	} );

} )();
