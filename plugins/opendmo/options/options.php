<?php

register_post_type('opendmo-options', array(
	'labels' => 	array(
		'name'               => 'OpenDMO Options',
		'singular_name'      => 'OpenDMO Options',
		'menu_name'          => 'OpenDMO Options',
		'name_admin_bar'     => 'OpenDMO Options',
		'edit_item'          => 'OpenDMO Options',
	),
	'public' => false,
	'show_ui' => true,
	'_builtin' =>  false,
      'capabilities' => array(
        'create_posts' => 'do_not_allow',
        'delete_posts' => 'do_not_allow',
      ),
      'map_meta_cap' => true,
	'capability_type' => 'post',
	'hierarchical' => false,
	'rewrite' => false,
	'query_var' => "opendmo-options",
	'supports' => array(
		'title',
	),
	'show_in_menu'	=> false,
));

$odocount = wp_count_posts('opendmo-options');
$odocount = $odocount->private;

if($odocount<2) {

    add_action('wp_loaded', 'createoptions');

}

else {

    add_action('plugins_loaded', 'setopts');

}

add_action('admin_head', function() {

    if(get_post_type() == "opendmo-options") {

        echo "<style> #titlediv, #minor-publishing { display: none; }  </style>";

    }

});

function createoptions() {

   $po = wp_insert_post(array (
       'post_type' => 'opendmo-options',
       'post_title' => 'opendmo-primary',
       'post_status' => 'private',
    ));

   $zo = wp_insert_post(array (
       'post_type' => 'opendmo-options',
       'post_title' => 'opendmo-zip',
       'post_status' => 'private',
    ));

    setopts();

}

$primaryediturl = '';
$opendmo_options_meta = '';

function setopts() {

    $getopts = new WP_Query('post_type=opendmo-options');
    $getopts = $getopts->posts;

    foreach($getopts as $opt) {

        if($opt->post_title == 'opendmo-primary') { $po = $opt->ID; }
        if($opt->post_title == 'opendmo-zip') { $zo = $opt->ID; }

    }

    if($po > 0 && $zo > 0) {

        global $primaryediturl;
        global $opendmo_options_meta;

        $opendmo_options_meta = get_post_meta($po);
        $zipedit = get_edit_post_link($zo);
        $primaryediturl = "post.php?post=$po&action=edit";

        function opendmonavmake() {

            global $primaryediturl;

            add_menu_page('OpenDMO Settings', 'OpenDMO', 'manage_options', 'opendmo-settings', '', 'dashicons-location', 5);
            add_submenu_page('opendmo-settings', 'OpenDMO Options', 'OpenDMO Options', 'manage_options', $primaryediturl); 

        }

        function opendmoadminhide() {

            remove_submenu_page( 'opendmo-settings', 'opendmo-settings' );
            remove_submenu_page( 'options-general.php', 'custom-post-type-onomies' );
            remove_submenu_page( 'options-general.php', 'post-content-shortcodes' );
            //remove_menu_page('edit.php?post_type=acf');

        }

        add_action('init','opendmonavmake');
        add_action('admin_init','opendmoadminhide');

        include('options-primary.php');
        include('options-zip.php');

    }

}


?>
