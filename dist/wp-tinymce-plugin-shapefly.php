<?php
/** 
 * Plugin Name: Shapefly 
 * Plugin URI: http://github.com/zzzhan/wp-tinymce-plugin-shapefly
 * Description: Inserting ready-make shapes on the web straight-through, such as rectangles and circles, arrows,, lines, flowchart symbols, and callouts.
 * Version: 0.1.0 
 * Author: zzzhan 
 * Author URI: http://github.com/zzzhan/
 * Network: true
 * License: GPL2 
 */
add_action('admin_head', 'shapefly_buttons');
function shapefly_buttons() {
  global $typenow;

  // check user permissions
  if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
    return;
  }
  // verify the post type
  if( ! in_array( $typenow, array( 'post', 'page' ) ) )
    return;

  // check if WYSIWYG is enabled
  if ( get_user_option('rich_editing') == 'true' ) {
    add_filter( "mce_external_plugins", "shapefly_add_buttons" );
    add_filter( 'mce_buttons', 'shapefly_register_buttons' );
  }
}
function shapefly_add_buttons( $plugin_array ) {
    $plugin_array['shapefly'] = plugins_url('/jquery-shapefly-client.js',__FILE__);
    return $plugin_array;
}
function shapefly_register_buttons( $buttons ) {
    array_push( $buttons, 'shapefly');
    return $buttons;
}
function myterminal_css() {
    //wp_enqueue_style('myterminal', plugins_url('myplugin.css', __FILE__));
}
function myterminal_css_admin() {
    //wp_enqueue_style('myterminal', plugins_url('icon.css', __FILE__));
    //wp_enqueue_style('myterminal', plugins_url('editor.css', __FILE__));
}

//add_action('wp_enqueue_scripts', 'myterminal_css');
//add_action('admin_enqueue_scripts', 'myterminal_css_admin');
?>