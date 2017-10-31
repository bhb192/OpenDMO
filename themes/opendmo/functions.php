<?php 

// Useful global constants
define( 'SIGMATHEME_VERSION', '0.1.2' );
date_default_timezone_set('America/New_York');

/**
 * Set up theme defaults and register supported WordPress features.
 * @since 0.1.0
 */
function sigmatheme_setup() {
	
	//Register navigation menu
	register_nav_menu( 'primary', 'Primary Menu' );
	
	//Set content widget - for uploaded images
	if ( ! isset( $content_width ) ) $content_width = 960;
	
	//Theme supports...
	add_theme_support( 'post-thumbnails' );
	
	set_post_thumbnail_size( 700, 250, true );
	
	add_theme_support( 'automatic-feed-links' );
	
	add_theme_support( 'custom-header', array(
		//'default-image'          => get_template_directory_uri() . '/images/sigma.png',
		'random-default'         => false,
		'width'                  => 300,
		'height'                 => 80,
		'flex-height'            => true,
		'flex-width'             => true,
		'default-text-color'     => '',
		'header-text'            => false,
		'uploads'                => true,
		'wp-head-callback'       => '',
		'admin-head-callback'    => '',
		'admin-preview-callback' => '',
	));
	
	add_theme_support( 'custom-background' );
	
	load_theme_textdomain( 'sigmatheme', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'sigmatheme_setup' );


/**
 * Enqueue scripts and styles for front-end.
 *
 * @since 0.1.0
 */
function sigmatheme_enqueue_scripts(){
	
	$postfix = ( defined( 'SCRIPT_DEBUG' ) && true === SCRIPT_DEBUG ) ? '' : '.min';
	
	if ( is_singular() ) 
		wp_enqueue_script( "comment-reply" ); 
}
add_action( 'wp_enqueue_scripts', 'sigmatheme_enqueue_scripts' );


//Returns a "Read more &raquo;" link for excerpts
function sigmatheme_continue_reading_link() {
	return '<p class="read-more"><a href="'. esc_url(get_permalink()) . '">' . __( 'Read more &raquo;', 'sigmatheme' ) . '</a></p>';
}


//Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and sigmatheme_continue_reading_link().
function sigmatheme_auto_excerpt_more( $more ) {
	return ' &hellip;' . sigmatheme_continue_reading_link();
}
add_filter( 'excerpt_more', 'sigmatheme_auto_excerpt_more' );


//Append site title to wp_title.
function sigmatheme_wp_title( $title, $sep, $seplocation ){
	return $title . get_bloginfo('name');	
}
add_filter( 'wp_title', 'sigmatheme_wp_title', 10, 3 );


function sigmatheme_register_widget_sidebars(){

	register_sidebar(array(
		'name' => 'Home Page Events',
		'id' => 'home-widgets-events',
		'description' => 'Widgets in this area will be shown at the top of the home page and span the entire page.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title' => '<h1>',
		'after_title' => '</h1>'
	));

	register_sidebar(array(
		'name' => 'Home Page Attractions',
		'id' => 'home-widgets-attractions',
		'description' => 'Widgets in this area will be shown at the top of the home page and span the entire page.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title' => '<h1>',
		'after_title' => '</h1>'
	));

}
	
add_action( 'widgets_init', 'sigmatheme_register_widget_sidebars' );

//Apply do_shortcode() to widgets so that shortcodes will be executed in widgets
add_filter('widget_text', 'do_shortcode');


function sigmatheme_get_author_id( $post_id = false ){
	
	$post_id = ( $post_id === false ? get_the_ID() : $post_id );
	
	$post_obj = get_post( $post_id );
	
	global $authordata;
	if ( !is_object( $authordata ) )
		return false;
	
	return (int) $authordata->ID;

}

function opendmo_childs() {

	wp_register_style( 'main_style', get_stylesheet_directory_uri() . '/style.css');
	wp_enqueue_style( 'main_style');
	wp_enqueue_script('jquery-ui-datepicker', array('jquery'));

}

function jp_bitly( $post ) {

	//get the shortlink of the post provided by WP Bitly plugin (must be installed) 

	global $post;

	if ( !$post )
		return;

	$post_id = $post->ID;
	return wp_get_shortlink( $post_id );

}

function jp_bitly_enable() {

	//check if Jetpack sharing buttons are present on the page

	if (class_exists( 'Jetpack' ) && method_exists( 'Jetpack', 'get_active_modules' ) && in_array( 'sharedaddy', Jetpack::get_active_modules()) ) {
		
		add_filter( 'sharing_permalink', 'jp_bitly' );
	
	}

}

function jptweak_remove_share() {

	//remove the annoying "Share" links only using the buttons on individual posts

    remove_filter( 'the_content', 'sharing_display',19 );
    remove_filter( 'the_excerpt', 'sharing_display',19 );

    if ( class_exists( 'Jetpack_Likes' ) ) {
	
        remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
	
    }

}

function my_get_posts( $query ) {

	//define how you want queries to be sorted in different views

	if ( is_home() && $query->is_main_query() ) {

		$query->set( 'post_type', array( 'post', 'page', 'attractions', 'eat', 'entertainment', 'meet', 'places','shop','sports','stay' ) );
		$query->set('orderby', 'modified');
		$query->set('order', 'DESC');
		return $query;
	
	}

}

function my_excerpt($ept) {

	if(strpos($ept, '&hellip;') !== false) {
	
		$tpe = explode('&hellip;', $ept);
		return $tpe[0].'&hellip;';
	
	}

	else {

		return $ept;
	
	}

}

function wrap_post_content_shortcode($pcsc, $the_pcsc) {

	$pcsc_id = $the_pcsc->ID;
	$pcsc_name = $the_pcsc->post_title;
	$pcsc_type = $the_pcsc->post_type;
	$pcsc_url = get_permalink($pcsc_id);
	$pcsc_thumb = get_the_post_thumbnail($pcsc_id, 'big-thumb');

	global $post;
	$backup_post = $post;
	$post = get_post($pcsc_id);
	setup_postdata($post);

	$incexc = 1;
	$pcsc_event_time = '';

	if($pcsc_type == "event") { 
	
		include('event-time.php');
					
		if($thestart) {
						
			$pcsc_event_time = "<p><strong>".$etime."</strong></p>"; 
						
		}
			
		else {
					
			$pcsc_event_time = "<p><strong>Date and time to be announced</strong></p>"; 
						
		}
					
		if(get_the_excerpt() == $etime) {
						
			$incexc = 0;
						
		}

	}

	if($incexc) { 
				
		$pcsc_excerpt = get_the_excerpt();
					
	}

	$post = $backup_post;
	unset($backup_post);
	unset($incexc);

	$pcscHead = "<div class='pcsccont'><article><a href='".$pcsc_url."'>";
	$pcscTitle = "<h4>".$pcsc_name."</h4>";
	$pcscText = "<p>".$pcsc_excerpt."</p>";
	$pcscFoot = "<div style='clear:both;'></div></a></article></div>";

	$pcscPost = $pcscHead.$pcsc_thumb.$pcscTitle.$pcsc_event_time.$pcscText.$pcscFoot;

	return $pcscPost;

}

function my_custom_single_popular_post( $post_html, $p, $instance ){    

	$output = '<li class="poptart">';
	$output .= '<a href="' . get_the_permalink($p->id) . '" class="poptartlink" title="' . esc_attr($p->title) . '">';
	$output .= '<div class="hcslimgcont fillbb">';
	$output .= '<div class="hcslimg fillframe" style="background-image: url(\''.get_the_post_thumbnail_url( $p->id, 'big-thumb' ).';\');"></div>';
	$output .= '</div>';
$output .= '<div class="poptarttitle"><h3>' . $p->title . '</h3></div>';
	$output .= '</a></li>';  
    return $output;

}

function alx_embed_html( $html ) {

	return '<p class="noprint"><div class="video-container noprint">' . $html . '</div></p>';

}

function wp_unregister_taxes() {

    register_taxonomy( 'category', array() );
    register_taxonomy( 'post_tag', array() );
    register_taxonomy( 'event-category', array() );

}


function updateviewsajax() {
    
    wp_enqueue_script( 'uvajx', '/updateviews.js', array('jquery'), '1.0', true );

    wp_localize_script( 'uvajx', 'postuvajx', array(
        'ajax_url' => admin_url( 'admin-ajax.php' )
    ));

    $uvajxv = array( 
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'uvid' => get_the_ID(),
        'uvact' => 'uvajxreply',
    );

    wp_enqueue_script( 'my-ajax-request', get_template_directory_uri().'/updateviews.js' );
    wp_localize_script( 'my-ajax-request', 'ViewsAjax', $uvajxv );

}

function updateviewsajaxcb() {

    $odpuv = $_POST['puv'];

    if(metadata_exists('post',$odpuv,'_opendmo_viewcount')) {

        $odvc = get_post_meta($odpuv,'_opendmo_viewcount', true);
        update_post_meta( $odpuv, '_opendmo_viewcount', ($odvc+1), $odvc );
        echo "exists"; echo $odvc+1;

    }

    else{

        add_post_meta($odpuv, '_opendmo_viewcount', 1, true);

    }

}


add_action( 'wp_ajax_uvajxreply', 'updateviewsajaxcb' );
add_action( 'wp_enqueue_scripts', 'updateviewsajax' );
add_action( 'wp_enqueue_scripts', 'opendmo_childs' );
add_action( 'wp', 'jp_bitly_enable' );
add_action( 'loop_start', 'jptweak_remove_share' );
add_action( 'init', 'wp_unregister_taxes' );

add_filter( 'post-content-shortcodes-content', 'wrap_post_content_shortcode', 10, 2 );
add_filter( 'pre_get_posts', 'my_get_posts' );
add_filter( 'get_the_excerpt', 'my_excerpt' );
add_filter( 'wpcf7_support_html5_fallback', '__return_true' );
add_filter( 'wpp_post', 'my_custom_single_popular_post', 10, 3 );
add_filter( 'embed_oembed_html', 'alx_embed_html', 10, 3 );
add_filter( 'video_embed_html', 'alx_embed_html' ); // Jetpack

add_image_size( 'big-thumb', 500, 500, true);

?>
