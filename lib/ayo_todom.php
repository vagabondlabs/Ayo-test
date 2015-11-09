<?php

function cmds_admin_enqueue($hook_suffix) {
  global $ayo_options;

if ($ayo_options['hotkey_home'] == true) {
     wp_enqueue_script( 'cmds_js', plugins_url( '../js/ayo_controls.js', __FILE__ ), array( 'jquery' ));}
if ($ayo_options['hotkey_savepost'] == true) {
     if( 'post.php' == $hook_suffix || 'post-new.php' == $hook_suffix ) {
          wp_enqueue_script( 'cmds_js', plugins_url( '../js/ayo_controls.js', __FILE__ ), array( 'jquery' ));
  }};
};
add_action( 'admin_enqueue_scripts', 'cmds_admin_enqueue' );
