<?php
/**
 * Plugin Name:   -= AdminŸo 0.19 ! =-
 * Description: Making the backend more intuitive and more flexible to suit your needs biitch.
 * Version: 0.1.9
 * Author: VaGaBond-LaBs
 * Author URI:  http://temirice.ro
 *License:     GPL2
 *License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */



//

define( 'AdminYo__MINIMUM_WP_VERSION', '4.0' );
define( 'AdminYo__PINS_SLUG', 'admin-bookmarks'  );
define( 'AdminYo__VERSION',            '0.1.9' );
define( 'AdminYo_MASTER_USER',         true );
define( 'AdminYo__API_VERSION',        1 );
define( 'AdminYo__PLUGIN_DIR',         plugin_dir_path( __FILE__ ) );
define( 'AdminYo__PLUGIN_FILE',        __FILE__ );
define('AdminYo_URL',                  plugins_url('', __FILE__));


////// register variables
//$ayo_options=get_option('ayo_settings_group', $defaults);
$ayo_options = update_option('ayo_settings_group',  array(
    'ignore_this'=> true,));
//$ayo_drag_options = get_option('ayo_drag_settings', $defaults);
/*register_activation_hook( __FILE__, 'plugin_activated' );
    function plugin_activated(){
    //  global $ayo_options;
      $ayo_options = get_option('ayo_settings_group',  array(
          'ignore_this'=> true,
      ));
    }
*/
//register_activation_hook( __FILE__, array('MyClass', 'plugin_activated' ));
// Iclude files
include_once( AdminYo__PLUGIN_DIR . 'lib/ayo_content.php'         );
include_once( AdminYo__PLUGIN_DIR . 'lib/ayo_trunk.php'           );
include_once( AdminYo__PLUGIN_DIR . 'lib/ayo_hood.php'            );
include_once( AdminYo__PLUGIN_DIR . 'lib/ayo_cockpit.php'         );
include_once( AdminYo__PLUGIN_DIR . 'lib/ayo_wheel.php'           );
include_once( AdminYo__PLUGIN_DIR . 'lib/ayo_elements.php'        );
include_once( AdminYo__PLUGIN_DIR . 'lib/ayo_bag.php'             );
include_once( AdminYo__PLUGIN_DIR . 'lib/ayo_posts.php'           );
include_once( AdminYo__PLUGIN_DIR . 'lib/ayo_admin.php'           );
//include_once( AdminYo__PLUGIN_DIR . 'lib/ayo_brand.php'           );
include_once( AdminYo__PLUGIN_DIR . 'lib/ayo_todom.php'           );
include_once( AdminYo__PLUGIN_DIR . 'lib/ayo_tracking.php'           );

// >>>>  Inceput load-uit fisierele >>>>
 add_action( 'admin_enqueue_scripts', 'load_ayo_collapse' ) ;
//  if ($ayo_options['brand_init'] == true) {
add_action( 'admin_enqueue_scripts', 'load_ayo_scripts' ) ;//}
add_action( 'admin_enqueue_scripts', 'load_ayo_visual' ) ;


function load_ayo_collapse() {
//Init the globals for the options
global $ayo_options;
//Setting admin columns
if ($ayo_options['menu_collapse'] == true) {
  wp_register_script( 'ayo_autocollapse', plugin_dir_url( __FILE__ ) . 'js/ayo_autocollapse.js' );
  wp_enqueue_script(  'ayo_autocollapse', plugin_dir_url( __FILE__ ) . 'js/ayo-autocollapse.js', array( 'jquery' ) );
  }
}
function load_ayo_scripts() {

  // Set hide menu on
  global $ayo_options;
 if ($ayo_options['hide_menu'] == true ) {

if ($ayo_options['menu_collapse'] == false) {
wp_register_script( 'ayo_autocollapse', plugin_dir_url( __FILE__ ) . 'js/ayo_autocollapse.js' );
wp_enqueue_script(  'ayo_autocollapse', plugin_dir_url( __FILE__ ) . 'js/ayo-autocollapse.js', array( 'jquery' ) );
}
//load hide css
   wp_register_style( 'ayo_hidemenu_style', plugin_dir_url( __FILE__ ) . 'css/ayo_hide.css' );
   wp_enqueue_style('ayo_hidemenu_style');
 }

    wp_register_style( 'ayo_autocollapse_style', plugin_dir_url( __FILE__ ) . 'css/ayo_style.css' );
    wp_enqueue_style('ayo_autocollapse_style');

    wp_register_style( 'ayo_visual_style', plugin_dir_url( __FILE__ ) . 'css/ayo_visual.css' );
    wp_enqueue_style('ayo_visual_style');

    wp_register_style( 'ayo_wnav_style', plugin_dir_url( __FILE__ ) . 'css/ayo_wnav.css' );
    wp_enqueue_style('ayo_wnav_style');

    wp_register_style( 'ayo_wnav_style', plugin_dir_url( __FILE__ ) . 'css/ayo_widget.css' );
    wp_enqueue_style('ayo_wnav_widget');

    wp_register_style( 'ayo_admin_style', plugin_dir_url( __FILE__ ) . 'css/ayo_admin_style.css' );
    wp_enqueue_style('ayo_admin_style');

    wp_register_style( 'ayo_pins_style', plugin_dir_url( __FILE__ ) . 'css/ayo_pins_style.css' );
    wp_enqueue_style('ayo_pins_style');

    wp_register_style( 'ayo_login_style', plugin_dir_url( __FILE__ ) . 'css/ayo_login.css' );
    wp_enqueue_style('ayo_login_style');
///////////// LOAD JS
  wp_register_script( 'ayo_autocollapse', plugin_dir_url( __FILE__ ) . 'js//modernizr.custom.39460.js' );
  // wp_register_script( 'ayo_autocollapse', plugin_dir_url( __FILE__ ) . 'js/mfb.js' );
    wp_register_script( 'ayo_autocollapse', plugin_dir_url( __FILE__ ) . 'js/ayo_taxes.min.js' );
    wp_register_script( 'ayo_brand', plugin_dir_url( __FILE__ ) . 'js/ayo_brand_style.js' );
    wp_register_script( 'ayo_order', plugin_dir_url( __FILE__ ) . 'js/ayo_order.js' );
//wp_register_script( 'ayo_autocollapse', plugin_dir_url( __FILE__ ) . 'js/ayo_gridster.js' );

}
function load_ayo_visual(){
  wp_register_style( 'ayo_plus_style', plugin_dir_url( __FILE__ ) . 'css/ayo_plus.css' );
  wp_enqueue_style('ayo_plus_style');
}
