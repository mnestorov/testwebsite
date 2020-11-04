/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.mn-site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.mn-site-description' ).text( to );
		} );
	} );
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.mn-site-title a, .mn-site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.mn-site-title a, .mn-site-description' ).css( {
					'clip': 'auto',
					'color': to,
					'position': 'relative'
				} );
			}
		} );
	} );

	// Header background color
	wp.customize( 'testwebsite_header_bg', function( value ) {
		value.bind( function( to ) {
			if ( 'mn-white' === to ) {
				$( '#mn-masthead' ).addClass('mn-white');
			} else {
				$( '#mn-masthead' ).removeClass('mn-white');
			}
		} );
	} );

	// Slider Caption Text
	wp.customize( 'testwebsite_slider_title1', function( value ) {
		value.bind( function( to ) {
			$( '.mn-slide-count1 .mn-slide-cap-title' ).text( to );
		} );
	} );

	wp.customize( 'testwebsite_slider_title2', function( value ) {
		value.bind( function( to ) {
			$( '.mn-slide-count2 .mn-slide-cap-title' ).text( to );
		} );
	} );

	wp.customize( 'testwebsite_slider_title3', function( value ) {
		value.bind( function( to ) {
			$( '.mn-slide-count3 .mn-slide-cap-title' ).text( to );
		} );
	} );

	wp.customize( 'testwebsite_slider_subtitle1', function( value ) {
		value.bind( function( to ) {
			$( '.mn-slide-count1 .mn-slide-cap-desc' ).text( to );
		} );
	} );

	wp.customize( 'testwebsite_slider_subtitle2', function( value ) {
		value.bind( function( to ) {
			$( '.mn-slide-count2 .mn-slide-cap-desc' ).text( to );
		} );
	} );

	wp.customize( 'testwebsite_slider_subtitle3', function( value ) {
		value.bind( function( to ) {
			$( '.mn-slide-count3 .mn-slide-cap-desc' ).text( to );
		} );
	} );

	// Featured Post Icons
	wp.customize( 'testwebsite_featured_page_icon1', function( value ) {
		value.bind( function( to ) {
			$('.mn-featured-post1 i').removeClass().addClass('fa '+to);
		} );
	} );

	wp.customize( 'testwebsite_featured_page_icon2', function( value ) {
		value.bind( function( to ) {
			$('.mn-featured-post2 i').removeClass().addClass('fa '+to);
		} );
	} );

	wp.customize( 'testwebsite_featured_page_icon3', function( value ) {
		value.bind( function( to ) {
			$('.mn-featured-post3 i').removeClass().addClass('fa '+to);
		} );
	} );

	wp.customize( 'testwebsite_tab_title1', function( value ) {
		value.bind( function( to ) {
			$( '.mn-tab-list1 span' ).text( to );
		} );
	} );

	wp.customize( 'testwebsite_tab_title2', function( value ) {
		value.bind( function( to ) {
			$( '.mn-tab-list2 span' ).text( to );
		} );
	} );

	wp.customize( 'testwebsite_tab_title3', function( value ) {
		value.bind( function( to ) {
			$( '.mn-tab-list3 span' ).text( to );
		} );
	} );

	wp.customize( 'testwebsite_tab_title4', function( value ) {
		value.bind( function( to ) {
			$( '.mn-tab-list4 span' ).text( to );
		} );
	} );

	wp.customize( 'testwebsite_tab_title5', function( value ) {
		value.bind( function( to ) {
			$( '.mn-tab-list5 span' ).text( to );
		} );
	} );

	wp.customize( 'testwebsite_tab_icon1', function( value ) {
		value.bind( function( to ) {
			$('.mn-tab-list1 i').removeClass().addClass('fa '+to);
		} );
	} );

	wp.customize( 'testwebsite_tab_icon2', function( value ) {
		value.bind( function( to ) {
			$('.mn-tab-list2 i').removeClass().addClass('fa '+to);
		} );
	} );

	wp.customize( 'testwebsite_tab_icon3', function( value ) {
		value.bind( function( to ) {
			$('.mn-tab-list3 i').removeClass().addClass('fa '+to);
		} );
	} );

	wp.customize( 'testwebsite_tab_icon4', function( value ) {
		value.bind( function( to ) {
			$('.mn-tab-list4 i').removeClass().addClass('fa '+to);
		} );
	} );

	wp.customize( 'testwebsite_tab_icon5', function( value ) {
		value.bind( function( to ) {
			$('.mn-tab-list5 i').removeClass().addClass('fa '+to);
		} );
	} );

	wp.customize( 'testwebsite_logo_title', function( value ) {
		value.bind( function( to ) {
			$( '#mn-logo-section .mn-section-title' ).text( to );
		} );
	} );

	wp.customize( 'testwebsite_social_facebook', function( value ) {
		value.bind( function( to ) {
			$( '.mn-facebook' ).attr( 'href', to );
		} );
	} );

	wp.customize( 'testwebsite_social_twitter', function( value ) {
		value.bind( function( to ) {
			$( '.mn-twitter' ).attr( 'href', to );
		} );
	} );

	wp.customize( 'testwebsite_social_google_plus', function( value ) {
		value.bind( function( to ) {
			$( '.mn-googleplus' ).attr( 'href', to );
		} );
	} );

	wp.customize( 'testwebsite_social_pinterest', function( value ) {
		value.bind( function( to ) {
			$( '.mn-pinterest' ).attr( 'href', to );
		} );
	} );

	wp.customize( 'testwebsite_social_youtube', function( value ) {
		value.bind( function( to ) {
			$( '.mn-youtube' ).attr( 'href', to );
		} );
	} );

	wp.customize( 'testwebsite_social_linkedin', function( value ) {
		value.bind( function( to ) {
			$( '.mn-linkedin' ).attr( 'href', to );
		} );
	} );
	
} )( jQuery );
