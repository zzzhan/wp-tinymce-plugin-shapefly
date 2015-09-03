<?php
/** 
 * Plugin Name: Shapefly 
 * Plugin URI: http://github.com/zzzhan/wp-tinymce-plugin-shapefly
 * Description: Inserting ready-make shapes with a click of button on TinyMCE, the visual editor in WordPress.It will connect to the shapefly.com service, which enables you to draw any shapes or diagram, such as rectangles and circles, arrows, lines, flowchart symbols, and callouts.
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
    $plugin_array['shapefly'] = plugins_url('/wp-tinymce-plugin-shapefly.min.js',__FILE__);
    return $plugin_array;
}
function shapefly_register_buttons( $buttons ) {
    array_push( $buttons, 'shapefly');
    return $buttons;
}
function shapefly_css() {
    //wp_enqueue_style('myterminal', plugins_url('myplugin.css', __FILE__));
}
function shapefly_css_admin() {
    //wp_enqueue_style('myterminal', plugins_url('icon.css', __FILE__));
    wp_enqueue_style('shapefly', plugins_url('/tinymce-plugin-shapefly.min.css', __FILE__));
}

//add_action('wp_enqueue_scripts', 'myterminal_css');
add_action('admin_enqueue_scripts', 'shapefly_css_admin');
?>