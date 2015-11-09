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
//GitHub update
class BFIGitHubPluginUpdater {

    private $slug; // plugin slug
    private $pluginData; // plugin data
    private $username; // GitHub username
    private $repo; // GitHub repo name
    private $pluginFile; // __FILE__ of our plugin
    private $githubAPIResult; // holds data from GitHub
    private $accessToken; // GitHub private repo token

    function __construct( $pluginFile, $gitHubUsername, $gitHubProjectName, $accessToken = '' ) {
        add_filter( "pre_set_site_transient_update_plugins", array( $this, "setTransitent" ) );
        add_filter( "plugins_api", array( $this, "setPluginInfo" ), 10, 3 );
        add_filter( "upgrader_post_install", array( $this, "postInstall" ), 10, 3 );

        $this->pluginFile = $pluginFile;
        $this->username = $gitHubUsername;
        $this->repo = $gitHubProjectName;
        $this->accessToken = $accessToken;
    }

    // Get information regarding our plugin from WordPress
    private function initPluginData() {
        // code here
        $this->slug = plugin_basename( $this->pluginFile );
$this->pluginData = get_plugin_data( $this->pluginFile );
    }

    // Get information regarding our plugin from GitHub
    private function getRepoReleaseInfo() {
        // code here
        // Only do this once
if ( ! empty( $this->githubAPIResult ) ) {
    return;
}
// Query the GitHub API
$url = "https://api.github.com/repos/{$this->username}/{$this->repo}/releases";

// We need the access token for private repos
if ( ! empty( $this->accessToken ) ) {
    $url = add_query_arg( array( "access_token" => $this->accessToken ), $url );
}

// Get the results
$this->githubAPIResult = wp_remote_retrieve_body( wp_remote_get( $url ) );
if ( ! empty( $this->githubAPIResult ) ) {
    $this->githubAPIResult = @json_decode( $this->githubAPIResult );
}
// Use only the latest release
if ( is_array( $this->githubAPIResult ) ) {
    $this->githubAPIResult = $this->githubAPIResult[0];
}
// If we have checked the plugin data before, don't re-check
if ( empty( $transient->checked ) ) {
    return $transient;
}
// Get plugin & GitHub release information
$this->initPluginData();
$this->getRepoReleaseInfo();
// Check the versions if we need to do an update
$doUpdate = version_compare( $this->githubAPIResult->tag_name, $transient->checked[$this->slug] );
// Update the transient to include our updated plugin data
if ( $doUpdate == 1 ) {
    $package = $this->githubAPIResult->zipball_url;
 
    // Include the access token for private GitHub repos
    if ( !empty( $this->accessToken ) ) {
        $package = add_query_arg( array( "access_token" => $this->accessToken ), $package );
    }

    $obj = new stdClass();
    $obj->slug = $this->slug;
    $obj->new_version = $this->githubAPIResult->tag_name;
    $obj->url = $this->pluginData["PluginURI"];
    $obj->package = $package;
    $transient->response[$this->slug] = $obj;
}

return $transient;
    }//----

    // Push in plugin version information to get the update notification
    public function setTransitent( $transient ) {
        // code here
        return $transient;
    }

    // Push in plugin version information to display in the details lightbox
    public function setPluginInfo( $false, $action, $response ) {
        // code ehre
        return $response;
    }

    // Perform additional actions to successfully install our plugin
    public function postInstall( $true, $hook_extra, $result ) {
        // code here
        return $result;
    }
}
