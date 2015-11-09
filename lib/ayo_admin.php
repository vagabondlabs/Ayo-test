<?php
//Setup the admin pages/sub-pages
function ayo_plugin_top_menu(){
  global $ayo_options;
   add_menu_page('AdminYo ', 'AdminYo!', 'manage_options', __FILE__, 'ayo_render_plugin_page', plugins_url('/img/icon.png',__DIR__));
if ($ayo_options['brand_init'] == true) {
   add_submenu_page(__FILE__, 'Brand Options', 'Branding Options ', 'manage_options', __FILE__.'/custom', 'ayo_render_custom_page');
  // add_submenu_page(__FILE__, 'Search Options', 'Pins Options', 'manage_options', __FILE__.'/about', 'ayo_render_about_page');
}}
add_action('admin_menu','ayo_plugin_top_menu');

//Registering the plugin settings
function ayo_register_settings(){
    register_setting('ayo_settings_group','ayo_settings');
    //  register_setting('ayo_drag_group','ayo_drag_settings');
  }
add_action('admin_init','ayo_register_settings');

//default settings
register_activation_hook(__FILE__, 'plugin_init');
function plugin_init() {
//Remove the woocommerce popup message on the admin page
/*if ( is_plugin_page() ) {
?>
  <style>
    .woocommerce-message {
    display: none;
}
  </style>
<?
}
	//Method 1: simple string value assignment
  @$ayo_options = array(
      ['enable_posts'] => true,
      ['enable_pages'] => true,
      ['enable_produs'] => true,

  );
  update_option( 'ayo_settings_group', $ayo_options );
};
add_action('admin_init','plugin_init');
*/};
//Rendering the BRANDING admin page
function ayo_render_custom_page(){
?>
<body bgColor="#F9F9F9">
<!---START DANI COD --->
<div class="top-bg">
  <div class="skewed-bg">
    <link href='http://fonts.googleapis.com/css?family=Questrial' rel='stylesheet' type='text/css'>
<div id="ayo-general">
  <div id="logo-text">
    <div id="logo">
    <img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'img/admin/logo-ayo.png'; ?>" alt="" title="" border=0 style="
    max-height: 50px;">
    </div>

  <div id="text-intro" class="clearfix">
    </br></br>
    <h4>do more in less time!</h4>
    The plugin is the tool you need if you would like to speed up your interaction with the WordPress Admin Iterface. We have createrd adminyo! so we can deliver the websites we created faster to clients so we can cash in asap :).<br>
    <h4>Please select the options that fit your needs perfectly and then hit save button!</h4>
  </div>
 </div>
<!--Starting the options form -->
<form method="post" action="options.php">
  <?php settings_fields('ayo_settings_group'); ?>
<p class="submit">
  <input type="submit" class="button-primary" value="<?php _e('Save Options','ayo_domain'); ?>" />
</p>
<div class="boxes-row"> <!-- Start First Row -->
<!-- Start Branding stuff -->
  <div class="box-ayo-settings"> <!--Search -->
    <div class="card2">
      <div class="card-header ayo-search" style="color: #FFF">
        <h2> General Search <br>
          <small> This search allows you to Edit, View or Pin to DashBoard, from anywhere any Posts, Pages or Products</small>
        </h2>

      </div>
      <div class="card-container-ayo-search">
        <!--inceput php-->
        <!--  <h4>Input shit</h4>
          <p>
            <label class="description" for="ayo_settings[bara]"><?php _e('Input shit aici','ayo_domain'); ?></label>
            <input id="ayo_settings[bara]" name="ayo_settings[bara]" type="text" value="<?php echo $ayo_options['bara']; ?>"/>
          </p>-->
        <br>
      <p class="card-footer">If you have a question or a problem or an sugestion, please do not hesitate to Contact Us!</p>
    </div>
  </div> <!-- End First Row -->
<?
};

//Rendering the MAIN admin page
function ayo_render_plugin_page(){
  global $ayo_options; // init variabile
  global $ayo_drag_options; // init variabile
//$checked = $ayo_options['enable_posts'];

?>
<body bgColor="#F9F9F9">
<!---Header settings --->
<div class="top-bg">
  <div class="skewed-bg">
    <link href='http://fonts.googleapis.com/css?family=Questrial' rel='stylesheet' type='text/css'>
    <div id="ayo-general">
      <div id="logo-text">
        <div id="logo">
          <img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'img/admin/logo-ayo.png'; ?>" alt="" title="" border=0 style="
          max-height: 50px;">
        </div>
<!--Header text -->
      <div id="text-intro" class="clearfix">
        </br></br>
        <h4>do more in less time!</h4>
        The plugin is the tool you need if you would like to speed up your interaction with the WordPress Admin Iterface. We have createrd adminyo! so we can deliver the websites we created faster to clients so we can cash in asap :).<br>
        <h4>Please select the options that fit your needs perfectly and then hit save button!</h4>
      </div>
    </div>
<!-- Starting the form action method -->
<form method="post" action="options.php">
  <?php settings_fields('ayo_settings_group'); ?>
  <p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save Options','ayo_domain'); ?>" />
  </p>
<!-- Start First Row -->
<div class="boxes-row">
<!-- Pin to DashBoard CARD-->
  <div class="box-ayo-settings">
    <div class="card2">
      <div class="card-header ayo-pin-to-dashboard" style="color: #FFF">
        <h2> Pin to DashBoard <br>
          <small> This tool allow you to reorder the left menu, in real time, with drag & drop function. Also allow you to auto collapse the menu on mouse out. It is build with the need of reaching as fast as possible to where you need to. </small>
        </h2>
      </div>
      <div class="card-container-ayo-pin-to-dashboard">
        <p>Dashbord Pin Zone:
           <label class="toggleSwitch nolabel" for="ayo_settings[dash_pin]"><?php _e('', 'ayo_domain');?>
            <input id="ayo_settings[dash_pin]" name="ayo_settings[dash_pin]" type="checkbox" value="1" <?php checked('1',$ayo_options['dash_pin']);?> />
            <span>   <span>OFF</span><span>ON</span> </span> </label>
        </p>
<!-- Pins filter -->
        <p>Pins Filter:
          <label class="toggleSwitch nolabel" for="ayo_settings[pins_filter]"><?php _e('', 'ayo_domain');?>
          <input id="ayo_settings[pins_filter]" name="ayo_settings[pins_filter]" type="checkbox" value="1" <?php checked('1',$ayo_options['pins_filter']);?> />
          <span>   <span>OFF</span><span>ON</span> </span> </label>
        </p><br><br>
          <p class="card-footer">If you have a question or a problem or an sugestion, please do not hesitate to Contact Us!</p>
<!-- Ignore -->
<p>
  <label  class="toggleSwitch nolabel" for="ayo_settings[ignore_this]"><?php _e('', 'ayo_domain');?>
  <input  id="ayo_settings[ignore_this]" name="ayo_settings[ignore_this]" type="checkbox" value="1" <?php checked('1',$ayo_options['ignore_this']);?> />
  <span>   <span>OFF</span><span>ON</span> </span> </label>
</p>
      </div>
    </div>
  </div>
<!--End of the Pin to Dashboard card -->

<!-- General Search CARD-->
  <div class="box-ayo-settings">
    <div class="card2">
      <div class="card-header ayo-search" style="color: #FFF">
        <h2> General Search <br>
          <small> This search allows you to Edit, View or Pin to DashBoard, from anywhere any Posts, Pages or Products</small>
        </h2>
      </div>

    <div class="card-container-ayo-search">
      <div class="tooltip-container"><span class="tooltip">This will allow our EPIC search engine to look for your posts in real time! like hyperspace!</span></div>
<!-- Enable posts -->
        <p>Posts:
          <label  class="toggleSwitch nolabel" for="ayo_settings[enable_posts]"><?php _e('', 'ayo_domain');?>
          <input  id="ayo_settings[enable_posts]" name="ayo_settings[enable_posts]" type="checkbox" value="1" <?php checked('1',$ayo_options['enable_posts']);?> />
          <span title="It will search inside your posts">   <span>OFF</span><span>ON</span> </span></label>
        </p>
<!--Enable pages -->
        <p>Pages:
          <label class="toggleSwitch nolabel" for="ayo_settings[enable_pages]"><?php _e('', 'ayo_domain');?>
          <input id="ayo_settings[enable_pages]" name="ayo_settings[enable_pages]" type="checkbox" value="1" <?php checked('1',$ayo_options['enable_pages']);?> />
          <span title="It will search inside your pages">   <span>OFF</span><span>ON</span> </span> </label>
        </p>
<!--Enable products -->
<? if (class_exists('Woocommerce')) { ?>
        <p>Products:
          <label class="toggleSwitch nolabel" for="ayo_settings[enable_produs]"><?php _e('', 'ayo_domain');?>
          <input id="ayo_settings[enable_produs]" name="ayo_settings[enable_produs]" type="checkbox" value="1" <?php checked('1',$ayo_options['enable_produs']);?> />
          <span title="It will search inside your Woo products">   <span>OFF</span><span>ON</span> </span> </label>
        </p>
<? } else printf("You need to have WooCommerce installed to search for products");?><br>
<!--Make the search follow the screen-->
        <p>Make search float:
          <label class="toggleSwitch nolabel" for="ayo_settings[search_float]"><?php _e('', 'ayo_domain');?>
          <input id="ayo_settings[search_float]" name="ayo_settings[search_float]" type="checkbox" value="1" <?php checked('1',$ayo_options['search_float']);?> />
          <span title="It will make the search bar follow the screen">   <span>OFF</span><span>ON</span> </span> </label><br>
        </p>
          <p class="card-footer">If you have a question or a problem or an sugestion, please do not hesitate to Contact Us!</p>
    </div>
  </div>
</div>
<!--End of the General search card -->

<!--Start of the left menu options card -->
  <div class="box-ayo-settings">
    <div class="card2">
      <div class="card-header ayo-drag-and-drop-menu" style="color: #FFF">
        <h2> Left Menu Reorder <br>
          <small> This tool allow you to reorder the left menu, in real time, with drag & drop function. Also allow you to auto collapse the menu on mouse out. It is build with the need of reaching as fast as possible to where you need to. </small>
        </h2>
      </div>
    <div class="card-container-ayo-drag-and-drop-menu">
<!--Re-Order your menu-->
        <p>Re-Order Menu:
          <label class="toggleSwitch nolabel" for="ayo_settings[menu_order]"><?php _e('', 'ayo_domain');?>
          <input id="ayo_settings[menu_order]" name="ayo_settings[menu_order]" type="checkbox" value="1" <?php checked('1',$ayo_options['menu_order']);?> />
          <span>   <span>OFF</span><span>ON</span> </span> </label>
        </p>
<!--Auto-Collapse your menu-->
        <p>Auto-Collapse Menu:
            <label class="toggleSwitch nolabel" for="ayo_settings[menu_collapse]"><?php _e('', 'ayo_domain');?>
            <input id="ayo_settings[menu_collapse]" name="ayo_settings[menu_collapse]" type="checkbox" value="1" <?php checked('1',$ayo_options['menu_collapse']);?> />
            <span>   <span>OFF</span><span>ON</span> </span> </label>
        </p>
<!--Hide Menu-->
        <p>Hide Menu:
          <label class="toggleSwitch nolabel" for="ayo_settings[hide_menu]"><?php _e('', 'ayo_domain');?>
          <input id="ayo_settings[hide_menu]" name="ayo_settings[hide_menu]" type="checkbox" value="1" <?php checked('1',$ayo_options['hide_menu']);?> />
          <span>   <span>OFF</span><span>ON</span> </span> </label>
        </p>   <br><br>
          <p class="card-footer">If you have a question or a problem or an sugestion, please do not hesitate to Contact Us!</p>
    </div>
  </div>
</div>
<!--End of the left menu settings -->

<!--Start Floatable Action Card -->
  <div class="box-ayo-settings">
    <div class="card2">
      <div class="card-header ayo-drag-and-drop-pages" style="color: #FFF">
        <h2> Floatable Action Button Settings <br>
          <small> This floatable action button is placed at the bottom right, in Pages, Posts or Products editing page, so you can Preview, Update and Delete the page you are working at, INSTANTLY, no matter how long is the page, post or product description.</small>
        </h2>
      </div>
      <div class="card-container-ayo-drag-and-drop-pages">
        <p>Posts/Pages plus button:
          <label class="toggleSwitch nolabel" for="ayo_settings[menu_post_plus]"><?php _e('', 'ayo_domain');?>
          <input id="ayo_settings[menu_post_plus]" name="ayo_settings[menu_post_plus]" type="checkbox" value="1" <?php checked('1',$ayo_options['menu_post_plus']);?> />
          <span>   <span>OFF</span><span>ON</span> </span> </label>
        </p>  <br><br>
          <p class="card-footer">If you have a question or a problem or an sugestion, please do not hesitate to Contact Us!</p>
   </div>
 </div>
</div>
</div><!-- End First Row -->
<div class="boxes-row"> <!-- Start Second Row -->
<!--Media Library - CATEGORY - Settings -->
  <div class="box-ayo-settings">
    <div class="card2">
      <div class="card-header ayo-media-library" style="color: #FFF">
        <h2> Media Library Categories (FOLDERS) <br>
          <small> On short, this tool helps anyone who work with a lot of pictures. Now you can simply arrange your pictures in Folders.</small>
        </h2>
     </div>
     <div class="card-container-ayo-media-library">
<!--Show the media folders-->
        <p>Media Folders:
           <label class="toggleSwitch nolabel" for="ayo_settings[media_folders]"><?php _e('', 'ayo_domain');?>
           <input id="ayo_settings[media_folders]" name="ayo_settings[media_folders]" type="checkbox" value="1" <?php checked('1',$ayo_options['media_folders']);?> />
           <span>   <span>OFF</span><span>ON</span> </span> </label>
        </p>
<!--Dimensions column in media library -->
        <p>Media Dimensions Filter:
            <label class="toggleSwitch nolabel" for="ayo_settings[media_dimensions]"><?php _e('', 'ayo_domain');?>
            <input id="ayo_settings[media_dimensions]" name="ayo_settings[media_dimensions]" type="checkbox" value="1" <?php checked('1',$ayo_options['media_dimensions']);?> />
            <span>   <span>OFF</span><span>ON</span> </span> </label>
        </p> <br><br>
          <p class="card-footer">If you have a question or a problem or an sugestion, please do not hesitate to Contact Us!</p>
      </div>
   </div>
</div>
<!-- Arrange with Drag and Drop the (Post, Pages, Products) -->
  <div class="box-ayo-settings">
    <div class="card2">
      <div class="card-header ayo-reorder-lists" style="color: #FFF">
        <h2> Reorder your Lists <br>
          <small> This tool allow you to reorder in the lists, all your ( Posts, Pages, Products ) with drag & drop function. </small>
        </h2>
      </div>
      <div class="card-container-ayo-reorder-lists">
<!--Posts re-order option-->
    <p>Re-Order Posts:
        <label class="toggleSwitch nolabel" for="ayo_settings[menu_post_drag]"><?php _e('', 'ayo_domain');?>
        <input id="ayo_settings[menu_post_drag]" name="ayo_settings[menu_post_drag]" type="checkbox" value="1" <?php checked('1',$ayo_options['menu_post_drag']);?> />
        <span>   <span>OFF</span><span>ON</span> </span> </label>
    </p>
<!--Posts navigation option-->
     <p>Posts navigation:
        <label class="toggleSwitch nolabel" for="ayo_settings[menu_post_nav]"><?php _e('', 'ayo_domain');?>
        <input id="ayo_settings[menu_post_nav]" name="ayo_settings[menu_post_nav]" type="checkbox" value="1" <?php checked('1',$ayo_options['menu_post_nav']);?> />
        <span>   <span>OFF</span><span>ON</span> </span> </label>
     </p> <br><br>
        <p class="card-footer">If you have a question or a problem or an sugestion, please do not hesitate to Contact Us!</p>
      </div>
    </div>
  </div>
<!-- Simple Branging Settings -->
  <div class="box-ayo-settings">
    <div class="card2">
      <div class="card-header ayo-simple-branding" style="color: #FFF">
        <h2> Simple Branding <br>
          <small> This area is for uploading the logos you need to brand the admin, login and footer area. </small>
        </h2>
      </div>
      <div class="card-container-ayo-simple-branding">
<!--Branding ON / OFF -->
      <p>Branding ON/OFF:
         <label class="toggleSwitch nolabel" for="ayo_settings[brand_init]"><?php _e('', 'ayo_domain');?>
         <input id="ayo_settings[brand_init]" name="ayo_settings[brand_init]" type="checkbox" value="1" <?php checked('1',$ayo_options['brand_init']);?> />
         <span>   <span>OFF</span><span>ON</span> </span> </label>
      </p>
<!--The customize button-->
<? if ($ayo_options['brand_init'] == true) {?>
      <button  class="button-primary">Customize</button>
<?} else {?>
      <p>To start branding your wordpress please activate this option </p>
<?}?><br><br>
        <p class="card-footer">If you have a question or a problem or an sugestion, please do not hesitate to Contact Us!</p>
      </div>
    </div>
  </div>
<!-- Extra Widgets CARD -->
  <div class="box-ayo-settings">
    <div class="card2">
      <div class="card-header ayo-extra-widgets" style="color: #FFF">
        <h2> Extra Widgets <br>
          <small> In this area you find all kind of useful widgets.</small>
        </h2>
      </div>
      <div class="card-container-ayo-extra-widgets">
<!--Show the picture thumbnail -->
      <p>Show picture thumbnail:
          <label class="toggleSwitch nolabel" for="ayo_settings[show_picture_column]"><?php _e('', 'ayo_domain');?>
          <input id="ayo_settings[show_picture_column]" name="ayo_settings[show_picture_column]" type="checkbox" value="1" <?php checked('1',$ayo_options['show_picture_column']);?> />
          <span>   <span>OFF</span><span>ON</span> </span> </label>
      </p><br><br>
<!--Get back to dashboard hotkey-->
      <p>CTRL+D -Return Home:
        <label class="toggleSwitch nolabel" for="ayo_settings[hotkey_home]"><?php _e('', 'ayo_domain');?>
        <input id="ayo_settings[hotkey_home]" name="ayo_settings[hotkey_home]" type="checkbox" value="1" <?php checked('1',$ayo_options['hotkey_home']);?> />
        <span>   <span>OFF</span><span>ON</span> </span> </label>
      </p>
<!--Save your post hotkey-->
      <p>CTRL+S -Auto saving post
        <label class="toggleSwitch nolabel" for="ayo_settings[hotkey_savepost]"><?php _e('', 'ayo_domain');?>
        <input id="ayo_settings[hotkey_savepost]" name="ayo_settings[hotkey_savepost]" type="checkbox" value="1" <?php checked('1',$ayo_options['hotkey_savepost']);?> />
        <span>   <span>OFF</span><span>ON</span> </span> </label>
      </p>    <br><br>
        <p class="card-footer">If you have a question or a problem or an sugestion, please do not hesitate to Contact Us!</p>
      </div>
    </div>
  </div>
</div> <!-- End Second Row -->
<!-- Bottom submit button -->
      <p class="submit">
        <input type="submit" class="button-primary" value="<?php _e('Save Options','ayo_domain'); ?>" />
      </p>
    </form>
  </div>
</div>
</div>
<?
};
//<!---END CODE --->
