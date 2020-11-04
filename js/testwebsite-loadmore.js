/**
 * testwebsite LoadMore JS
 *
 * @package testwebsite
 *
 * Distributed under the MIT license - http://opensource.org/licenses/MIT
 */
jQuery(function($){
	var canBeLoaded = true;		// this param allows to initiate the AJAX call only if necessary
	var bottomOffset = 2000; 	// the distance (in px) from the page bottom when we want to load more posts
 
	$(window).scroll(function(){
		var data = {
			'action': 'loadmore',
			'query': testwebsite_loadmore_params.posts,
			'page' : testwebsite_loadmore_params.current_page
		};
		if( $(document).scrollTop() > ( $(document).height() - bottomOffset ) && canBeLoaded == true ){
			$.ajax({
				url : testwebsite_loadmore_params.ajaxurl,
				data:data,
				type:'POST',
				beforeSend: function( xhr ){
					// we can also add our own preloader here
					// we see, the AJAX call is in process, we shouldn't run it again until complete
					canBeLoaded = false; 
				},
				success:function(data){
					if( data ) {
						$('#main').find('article:last-of-type').after( data ); // where to insert posts
						canBeLoaded = true; // the ajax is completed, now we can run it again
						testwebsite_loadmore_params.current_page++;
					}
				}
			});
		}
	});
});