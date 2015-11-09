/*
 * Dashboard Instant Finder
 *
 */

( function( $ ) {

	$( document ).on( 'keyup', '#daif_tags', function(event) {
		if( $( "#daif_tags" ).val() == '' ) {
			$( "#daif_results_posts" ).empty();
			$( "#daif_results_pages" ).empty();
			$( "#daif_results_products" ).empty();
			$( "#daif_results_comments" ).empty();
		}
	} );

//	$( "#daif_results_posts" ).substr(0, 10);

//var longText = $('#daif_results_posts');
//longText.text(longText.text().substr(0, 1));


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
					$( "#daif_results_posts" ).html( daif_consts.str_nothing_found );
						$( "#daif_results_pages" ).html( daif_consts.str_nothing_found );
							$( "#daif_results_products" ).html( daif_consts.str_nothing_found );
							$( "#daif_results_comments" ).html( daif_consts.str_nothing_found );
				}
				response( results.slice( 0, 200 ) );
    		},
			suggest: function( items ) {

				var $container_posts = $( "#daif_results_posts" );
				var $container_pages = $( "#daif_results_pages" );
				var $container_products = $( "#daif_results_products" );
				var $container_comments = $( "#daif_results_comments" );

				$container_posts.empty();
				$container_pages.empty();
				$container_products.empty();
				$container_comments.empty();

				/*
				.text($(this).text().substr(0, 15)+'...');


				Default Post Types
					-Post (Post Type: 'post')
					-Page (Post Type: 'page')
					-Attachment (Post Type: 'attachment')
					-Revision (Post Type: 'revision')
					-Navigation menu (Post Type: 'nav_menu_item')
				*/
				String.prototype.trunc = String.prototype.trunc ||
				      function(n){
				          return this.length>n ? this.substr(0,n-1)+'&hellip;' : this;
				      };
				//Example - With hidden label

				var str_posts = ''+'<center><b>POSTS</b></center>';
				var str_pages = ''+'<center><b>PAGES</b></center>';
				var str_product = ''+'<center><b>PRODUCTS</b></center>';
				var str_comments = ''+'<center><b>COMMENTS</b></center>';
				//var length = 6;
				$.each( items, function() {
					$('#id li:not([title])').append('<ul />');
					$('#id li[title]').each(function() {
							console.log($(this).attr('title'))
							$(this).appendTo('#id li:contains(' + $(this).attr('title') + ') ul');
					});
///
$('str_posts').append('<link rel="stylesheet" href="/wp-content/plugins/wp-mydash2/css/ayo_visual.css" type="text/css" />');
					if(this.type=='post')  {

//innerHtml = '<b>POSTURI</b>';
						//  var trimmedString = str_posts.substring(0, length);
//edit view pin  ||  view edit

					str_posts +='<li class="lis">' + this.label.trunc(25) + '<a href="' + daif_consts.admin_url + 'post.php?post=' + this.value + '&amp;action=edit"><img src="'+ daif_consts.plugins_url +'/../img/edit.png" hspace="6"></a>'+'  <a href="' + daif_consts.home_url + '?p=' + this.value + '"><img src="'+ daif_consts.plugins_url +'/../img/view.png" hspace="10"></a>'+'<img src="'+ daif_consts.plugins_url +'/../img/pin.png" hspace="6"></a></li>';

				}
					else if(this.type=='page'){
				////	str_pages='<li>PAGINI</li>';
						str_pages += '<li class="lis">' + this.label.trunc(25) +  '<a href="' + daif_consts.admin_url + 'post.php?post=' + this.value + '&amp;action=edit"><img src="'+ daif_consts.plugins_url +'/../img/edit.png" hspace="6"></a>'+'  <a href="' + daif_consts.home_url + '?p=' + this.value + '"><img src="'+ daif_consts.plugins_url +'/../img/view.png" hspace="6"></a>'+'<img src="'+ daif_consts.plugins_url +'/../img/pin.png" hspace="6"></a></li>';
					}
					else if(this.type=='product'){
					//	str_product='<li>POSTURI</li>';
						str_product += '<li class="lis">' + this.label.trunc(25) + '<a href="' + daif_consts.admin_url + 'post.php?post=' + this.value + '&amp;action=edit"><img src="'+ daif_consts.plugins_url +'/../img/edit.png" hspace="6"></a>'+'  <a href="' + daif_consts.home_url + '?p=' + this.value + '"><img src="'+ daif_consts.plugins_url +'/../img/view.png" hspace="6"></a>'+'<img src="'+ daif_consts.plugins_url +'/../img/pin.png" hspace="6"></a></li>';
					}
					else if(this.type=='comments_template'){
					//	str_product='<li>POSTURI</li>';
						str_comments += '<li class="lis">' + this.label.trunc(25) + '<a href="' + daif_consts.admin_url + 'post.php?post=' + this.value + '&amp;action=edit"><img src="'+ daif_consts.plugins_url +'/../img/edit.png" hspace="6"></a>'+'  <a href="' + daif_consts.home_url + '?p=' + this.value + '"><img src="'+ daif_consts.plugins_url +'/../img/view.png" hspace="6"></a>'+'<img src="'+ daif_consts.plugins_url +'/../img/pin.png" hspace="6"></a></li>';
					}
				});



				/* Aici trebuie sa append-ui fiecare in ce container/coloana vrei, le pun toate la un loc si te descurci tu... */
			//	var str_posts = $("box box3");
				$container_posts.append(str_posts);
				$container_pages.append(str_pages);
				$container_products.append(str_product);
				$container_comments.append(str_comments);
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
