<?php
//----Inceput Header Search
 function frontheader() {
   global $ayo_options; // init variabile
?>


 <div id="boxes">
<div class="box1">
    <p class="p_search">
      <input type="mydsearch"  ng-focus="currentPage = 0" name="s" ng-model="search.$"  placeholder= 'search everything / anything / anywere ',"<?php _e( '', 'daif' ); ?>" style="color: white !important;" id="daif_tags" />
  	</p>
      <div class="afisare" >
<?php if ($ayo_options['enable_posts'] == true) {?>
	<ul id="daif_results_posts" class="result666"></ul><? } ?>
<?php if ($ayo_options['enable_pages'] == true) {?>
    <ul id="daif_results_pages"  class="result666"></ul><? } ?>
<?php if (class_exists('Woocommerce')) {?>
<?php if ($ayo_options['enable_produs'] == true) {?>
    <ul id="daif_results_products"  class="result666"></ul> <? }} ?>
    <?php if ($ayo_options['enable_comments'] == true) {?>
        <ul id="daif_results_comments"  class="result666"></ul> <? } ?>
      </div>
    </div>
  </div>
<?php if ($ayo_options['search_float'] == true) {?>
  <!--inceput fixed header -->
  <script type="text/javascript">
  var sticky = document.querySelector('.box1');
  var search_sticky = document.querySelector('p.p_search');

  if (sticky.style.position !== 'sticky') {
    var stickyTop = sticky.offsetTop;

    document.addEventListener('scroll', function () {
      window.scrollY >= stickyTop ?
        sticky.classList.add('fixed') :
        sticky.classList.remove('fixed');
    });
  }
//
if (search_sticky.style.position !== 'search_sticky') {
  var stickyTop = search_sticky.offsetTop;

  document.addEventListener('scroll', function () {
    window.scrollY >= stickyTop ?
      search_sticky.classList.add('search_fixed') :
      search_sticky.classList.remove('search_fixed');
  });
}
  </script>
<?
}};

////----Inceput admin footer
add_action('admin_bar_menu', 'frontheader');
function frontfooter() {
/// de bagat in footer
}
add_action('admin_footer', 'frontfooter');//--------end

/**Load JS--Instand Finder*/
function daif_enqueue_scripts( $hook ) {

	global $wpdb;	$user_ID = get_current_user_id();

	if ( current_user_can( 'edit_others_pages' ) ) {
		$query = 'SELECT ID AS value, post_title AS label, post_type AS type FROM ' . $wpdb->posts .
		        ' WHERE post_status IN ( "publish", "draft" )';
	} elseif ( current_user_can( 'edit_pages' ) ) {
		$query = 'SELECT ID AS value, post_title AS label, post_type AS type FROM ' . $wpdb->posts .
		        ' WHERE post_author = ' . $user_ID . ' post_status IN ( "publish", "draft" )';
	}
	wp_enqueue_script( 'daif', plugin_dir_url( __FILE__ ) . '../js/ayo_search.js',

		array( 'jquery', 'jquery-ui-core', 'jquery-ui-autocomplete' ) );
	$posts = $wpdb->get_results( $query, ARRAY_A );
	if( $posts ) {
		wp_localize_script( 'daif', 'daif_data', $posts );
	} else {
		wp_localize_script( 'daif', 'daif_data', null );
	}
	wp_localize_script( 'daif', 'daif_consts', array(
			'admin_url'         => admin_url(),
			'home_url'          => home_url( '/' ),
      'plugins_url'       =>   plugins_url('', __FILE__),
		'str_nothing_found' => __( "Oops! I couldn't find nothing.", 'daif' )
)
    /*  if ($answer) {
          echo 'did you mean: ' . $answer;
      } else {
          echo 'no suggestion';
      }
		)*/
	);
}
add_action( 'admin_enqueue_scripts', 'daif_enqueue_scripts' );
/*---Inceput meniu sub search

function ms_welcome_panel() {

	$screen = get_current_screen();
	if ( $screen->base == 'dashboard' ) {
?>
<!---->

		<div class="wrap">
			<h2></h2>
			<div id="welcome-panel2" class="welcome-panel2">
				<section class="welcome-panel-content">
				<center>	<h3></h3></center>
					<p class="about-description"chestii trestii socoteli</p>

<!---->
<center>
<div class="main-wrapper">
		<a href="/wp-admin/post-new.php" title="Add new Post"><i class="material-icons" ><span class="dashicons dashicons-admin-post" ></span></i></a>
		<a href="/wp-admin/post-new.php?post_type=page" title="Add new Page"><i class="material-icons"><span class="dashicons dashicons-admin-page"></span></i></a>
		<a href="/wp-admin/plugin-install.php?tab=upload" title="Upload a new Plugin"><i class="material-icons"><span class="dashicons dashicons-admin-plugins"></span></i></a>
		<a href="/wp-admin/plugin-install.php?tab=upload" title="Manage your Menus"><i class="material-icons"><span class="dashicons dashicons-menu"></span></i></a>
		<i class="material-icons"><span class="dashicons dashicons-admin-generic"></span></i></a>
		<i class="material-icons"><span class="dashicons dashicons-admin-settings"></span></i></a>
		<i class="material-icons"><span class="dashicons dashicons-admin-links"></span></i></a>
		<i class="material-icons"><span class="dashicons dashicons-smiley"></span></i></a>
</div>
<!---->
</section>
      <br>
			</div>
      <br>
		</div></center>
<?php
	}
}
//remove_action( 'welcome_panel', 'wp_welcome_panel');
add_action( 'admin_notices', 'ms_welcome_panel' );

//

/*function trazab_admin_bar_form() {

    global $wp_admin_bar;
    $wp_admin_bar->add_menu(array(
        'id' => 'trazab_admin_bar_form',
        'parent' => 'top-secondary',
        'title' => '	<form method="get" action="'.get_site_url().'/wp-admin/edit.php">
<input name="s" type="text" style="height:20px;margin:5px 0;line-height:1em;"/>
<input type="submit" style="height:18px;vertical-align:top;margin:5px 0;padding:0 2px;" value="Go"/>
</form>'
    ));
}
add_action('admin_bar_menu', 'trazab_admin_bar_form');    */
