/*
 * Dashboard Instant Finder
 *
 */
( function( $ ) {

	$( document ).on( 'keyup', '#daif_tags', function(event) {
		if( $( "#daif_tags" ).val() == '' ) {
			$( "#daif_results" ).empty();
		}
	} );

	$.widget( "app.autocomplete", $.ui.autocomplete, {
		options: {
			suggest: false
		},
		_suggest: function( items ) {
			if ( $.isFunction( this.options.suggest ) ) {
				return this.options.suggest( items );
			}
			this._super( items );
		},
	});

	$( function() {
		$( "#daif_tags" ).autocomplete( {
			minLength: 1,
			source: function( request, response ) {
				var results = $.ui.autocomplete.filter( daif_data, request.term );
				if( results.length == 0 ) {
					$( "#daif_results" ).html( daif_consts.str_nothing_found );
				}
				response( results.slice( 0, 50 ) );
    		},
			suggest: function( items ) {
				var $container = $( "#daif_results" );
				$container.empty();
				$.each( items, function() {
					var str = '<li>' + this.label + '  <a href="' + daif_consts.home_url + '?p=' + this.value +
					          '"><img src="http://www.vagabondlabs.com/mydashboard/wp-content/plugins/wp-mydash2/img/view.png" hspace="200"></a><a href="' + daif_consts.admin_url + 'post.php?post=' + this.value + '&amp;action=edit"><img src="http://www.vagabondlabs.com/mydashboard/wp-content/plugins/wp-mydash2/img/edit.png" hspace="10"><img src="http://www.vagabondlabs.com/mydashboard/wp-content/plugins/wp-mydash2/img/pin.png" hspace="10"></a></li>';
					$container.append( str );
				});
			}
		});
	});



/**/
//auto-hide-placeholder-text-upon-focus
window.onload = function() {
 $("input").each(
    function(){
      $(this).data('holder',$(this).attr('placeholder'));
      $(this).focusin(function(){
          $(this).attr('placeholder','');
      });
      $(this).focusout(function(){
          $(this).attr('placeholder',$(this).data('holder'));
      });

  });
}
/**/
})( jQuery );
