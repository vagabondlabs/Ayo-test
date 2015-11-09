jQuery(window).bind('keydown', function(event) {
	if (event.ctrlKey || event.metaKey) {
		if(String.fromCharCode(event.which).toLowerCase() == 'd') {
			// stop the page from trying to download
			event.preventDefault();
			// trigger page update or page publish
      window.open("/wp-admin/index.php","_self")
	}};
// Ctrl + s to save the posts

    if (event.ctrlKey || event.metaKey) {
  		if(String.fromCharCode(event.which).toLowerCase() == 's') {
  			// stop the page from trying to download
  			event.preventDefault();
  			// trigger page update or page publish
//  window.open("/wp-admin/index.php","_self")
  			jQuery('#publish').click();
  		}};


//$( '#close-modal' ).on( 'click', function( ev ) {
//  $( '#boxes, #modal-background' ).fadeOut();
//  ev.preventDefault();
//} );
});
