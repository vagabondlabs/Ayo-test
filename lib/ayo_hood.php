<?php
/*function add_post_type($new_status, $old_status, $post ) {
//  echo ("hello");
  if ( $old_status == 'publish'  &&  $new_status != 'pin_featured' ) {
       // A function to perform actions when a post status changes from publish to any non-public status.
   }
  };
add_action('transition_post_status','add_post_type',10,3);
 Display custom column */

/////// buton plus material thing
class UpdatefromBottom {

    protected $allowed_types;

    function __construct() {

        # Load plugin text domain
        add_action( 'init', array( $this, 'plugin_textdomain' ) );

        # Register admin styles and scripts
        add_action( 'admin_print_styles', array( $this, 'register_admin_styles' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts' ) );

    }

    public function plugin_textdomain() {

        $domain = 'updatefrombottom';
        $locale = apply_filters( 'plugin_locale', get_locale(), $domain );
      //  load_textdomain( $domain, WP_LANG_DIR.'/'.$domain.'/'.$domain.'-'.$locale.'.mo' );

    }

    public function x_get_current_post_type() {

        global $post, $typenow, $pagenow;

        if( $post && $post->post_type && $pagenow == 'post-new.php' || $pagenow == 'post.php' ) :
            $post_type = $post->post_type;
        else :
            return false;
        endif;

        return $post_type;
        //second

    }

    public function register_admin_styles() {

        # Only load js css we are are editing a post (build in or custom post type) or page
        if($this->x_get_current_post_type()) :

          //  wp_enqueue_style( 'updatefrombottom-plugin-styles', plugins_url( 'update-from-bottom/css/update-from-bottom.admin.css' ) );

        endif;

    }

    public function register_admin_scripts() {

        # Only load js if we are are editing a post (build in or custom post type) or page
        if($this->x_get_current_post_type()) :

		//	wp_enqueue_script( 'updatefrombottom-admin-script', plugins_url( 'wp-mydash2/js/mfb.js' ), array('jquery') );
    function publish_post(){
      wp_localize_script('updatefrombottom-admin-script', 'updatefrombottomParams', 'update');
//  submit_button( $text = NULL, $type = 'primary', $name = 'submit', $wrap = true, $other_attributes = NULL );
    // add_action( 'post_submitbox_start', function() {
      //   print '<button>Hey!</button>';
    // });

    }


    //http://codepen.io/naveens/pen/pJjGyL <--sageti
    //http://codepen.io/bcapp/pen/bNYEvv <-draggable
    function pin_the_post($views){
  //      header('Content-Type: application/json');
  $post_type = ((isset($_GET['post_type']) && $_GET['post_type'] != "") ? $_GET['post_type'] : 'post');
//  $count = $this->total_featured($post_type);
  $class = $_GET['post_status'] == 'pin_featured' ? "current" : '';
  $views['pin_featured'] = "<a class=\"" . $class . "\" id=\"featured-post-filter\" href=\"edit.php?&post_status=pin_featured&post_type={$post_type}\">Pins <span class=\"count\">({$count})</span></a>";
  return $views;

    //  die();
    //  update_post_meta($post_id, '_is_featured', 'yes');
//  update_post_meta( $post_id, 'key_2', 'Hans' );
    /*  $args = array(
        'post_type'      => 'post',
      	'post_status'    => 'pin_featured',
      	'orderby'        => 'date',
      	'order'          => 'DESC',
      	'meta_query' => array(
      			array(
      					'key' => '_is_featured',
      					'value' => 'yes'
      			)
      	) ,

);

$the_query = new WP_Query( $args );

*/
};
  //  add_action('wp_enqueue_scripts','pin_the_post');
    //http://codepen.io/joshgjohnson/pen/dPBKMq <-folosit plus btn
    function the_action()
    {
    do_action('the_action_hook');
    }
add_action('the_action_hook', 'pin_the_post');
    //http://codepen.io/joshgjohnson/pen/dPBKMq <-folosit plus btn

global $ayo_options;
 if ($ayo_options['menu_post_plus'] == true) {

?>
<!-- Make the menu icon-->
<div id="circularMenu" class="circular-menu">
  <a class="floating-btn" onclick="document.getElementById('circularMenu').classList.toggle('active');"><div class="dash_icon_menu"><span class="dashicons dashicons-menu"></div></span>
    <i class="fa fa-plus"></i>
  </a>
  <menu class="items-wrapper">
<!--Update the post-->
    <a href="javascript:updatepost()" class="menu-item" title="Publish/Update Post"><div class="dash_icon_update"><span class="dashicons dashicons-update"></span></div></a>
<!-- View your post-->
    <a href="<?php echo esc_url( get_permalink($post_id,$status) ); ?>" class="menu-item" title="Preview Post"><div class="dash_icon_view"><span class="dashicons dashicons-visibility"></span></div></a>
    <!--Pin your post-->
     <a href="<?php do_action('the_action_hook'); ?>" class="menu-item" title="Pin your Post" ><div class="dash_icon_pin"><span class="dashicons dashicons-admin-post"></span></div></a>
<!--Scroll to top-->
<a href="#" id="backtotop" class="menu-item" title="Scroll to TOP"><div class="dash_icon_top"><span class="dashicons dashicons-arrow-up-alt2"></span></div></a>
  </menu>

</div>
<script>
////////////////////////
function updatepost() {

    jQuery('#publish').click();

};
//function toppost() {


//jQuery('#publish').click();
$(document).ready(function()
{
	$(window).scroll(function()
	{
		if ($(this).scrollTop() > 100)
			$('#backtotop').fadeIn();
		else
			$('#backtotop').fadeOut();
	});

	$('#backtotop').click(function()
	{
		$('html, body').animate({ scrollTop : 0 }, 800);
		return false;
	});

});
//};
//

</script>
<?php
};
endif;

    }
}

# Only use in wp-admin
if (is_admin()):
	$ufb = new UpdatefromBottom();
endif;
