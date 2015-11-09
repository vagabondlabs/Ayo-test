/* Display and echo mobile specific stuff here */
// MyDash Collapse Menu
jQuery(document).ready(function($) {

    // Defineste functii
    $adminMenuWrap = $('#adminmenuwrap');
    var collapseIt = function($adminMenuWrap) {
        if ( !$(document.body).hasClass('folded') ) {
            $("#collapse-menu").trigger('click');
            $(document.body).toggleClass('expanded');
        }
    };

    var expandIt = function($adminMenuWrap) {
        adminMenuWrap = $('#adminmenuwrap');
        if ( $(document.body).hasClass('folded') ) {
            $("#collapse-menu").trigger('click');
            $(document.body).toggleClass('expanded');
        }
    }
    function detectmob() {
     if(window.innerWidth <= 320 && window.innerHeight <= 240) {
       return true;
     } else {
       return false;
    // here's the magic
    $('#adminmenuwrap, #adminmenuback').mouseenter(function() { if ($(window).width() > 768){ expandIt($adminMenuWrap); }});
    $('#wpcontent , .box').mouseenter(function() { collapseIt($adminMenuWrap); });
    $('img').load(function($){collapseIt($adminMenuWrap);});
  });

}}

// Customizer
jQuery(document).ready(function($) {

    $(".boxes").mouseenter(function() {
        if ( $('.wp-full-overlay').hasClass('collapsed') ) {
            $(".collapse-sidebar").trigger('click');
        }
    });

    $("#customize-preview").mouseover(function() {
        if ( $('.wp-full-overlay').hasClass('expanded') ) {
            $(".collapse-sidebar").trigger('click');
        }
    });


////////////////

//End of document ready
/*
    var $sidebar   = $("#circle, #sub"),
        $window    = $(window),
        offset     = $sidebar.offset(),
        topPadding = 305;

    $window.scroll(function() {
        if ($window.scrollTop() > offset.top) {
            $sidebar.stop().animate({
                marginTop: $window.scrollTop() - offset.top + topPadding
            });
        } else {
            $sidebar.stop().animate({
                marginTop: 20
            });
        }
    });

});*/
});
