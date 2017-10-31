<?php
/*
 Post Content Shortcodes 1.0 by cgrymala http://ten-321.com/

*/
/**
 * Pull in the post_content_shortcodes class definition file
 */
if( ! class_exists( '\Post_Content_Shortcodes' ) )
	require_once( plugin_dir_path( __FILE__ ) . '/classes/class-post-content-shortcodes-admin.php' );
if( ! class_exists( '\PCS_Widget' ) )
	require_once( plugin_dir_path( __FILE__ ) . '/classes/class-post-content-widgets.php' );

global $post_content_shortcodes_obj;
if ( is_admin() ) {
	$post_content_shortcodes_obj = \Post_Content_Shortcodes_Admin::instance();
} else {
	$post_content_shortcodes_obj = \Post_Content_Shortcodes::instance();
}
