<?php

//global variables

$opendmo_cpt_names = array('attractions', 'culture', 'eat', 'event', 'meet', 'places', 'shop', 'sports', 'stay');
$default_social_media = array("Twitter", "Facebook", "YouTube", "Instagram", "Pinterest", "AirBnB", "TripAdvisor");
$acfoutput = array('post-before','post-after','meta-before','meta','meta-after','cpt-before','cpt','cpt-after');
$acfoutput = array_fill_keys($acfoutput,'');

$opendmo_default_limit = array(

    "address" => 3,
    "phone" => 3,
    "gps_pair" => 5,
    "event_date" => 15,
    "ext_links" => 3,
    "social_links" => 10,
    "zipcode" => 20,

);

$po = 0;
$zo = 0;
$fbtc = 0;
$venuequeryi = 0;
$primaryediturl = '';
$zipediturl = '';
$opendmo_options_meta = array();
$opendmo_options_zip_meta = array();
$opendmo_postmeta = array();
$opendmo_set_limit = array();

add_action('plugins_loaded', 'opendmo_get_options');
add_action('init', 'opendmo_register_options');
add_action('init', 'opendmo_register_cpt');
add_action('init', 'opendmo_acf_load');
add_action('wp_loaded', 'opendmo_cpt_load');
add_action('wp', 'opendmo_post_load');
add_action('admin_menu','opendmo_admin_menu');
add_action('admin_head', 'opendmo_admin_head');

function opendmo_register_options() {

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

    //count how many posts are in opendmo options post type

    $odocount = wp_count_posts('opendmo-options');
    $odocount = $odocount->private;

    if($odocount<2) { add_action('wp_loaded', 'createoptions'); }

}

function opendmo_register_cpt() {

    global $opendmo_cpt_names;

    foreach($opendmo_cpt_names as $od_cpt) {

        $cptsingle = ucfirst($od_cpt);

        register_post_type($od_cpt, array(

           'labels'  => array(

               'name'           => __($od_cpt),
               'singular_name'  => __($cptsingle),
               'menu_name'      =>   $cptsingle,
		       'edit_item'      => "Edit $cptsingle",

           ),

           'public'      => true,
           'has_archive' => true,
           'show_in_menu'=>'opendmo-settings',


       ));

        add_post_type_support( $od_cpt, 'excerpt' );
        add_post_type_support( $od_cpt, 'thumbnail' );

    }

}

function opendmo_get_options() {

    global $po;
    global $zo;

    $getopts = new WP_Query('post_type=opendmo-options');
    $getopts = $getopts->posts;

    if(isset($getopts[0])) {

        foreach($getopts as $opt) {

            if($opt->post_title == 'opendmo-primary') { $po = $opt->ID; }
            if($opt->post_title == 'opendmo-zip') { $zo = $opt->ID; }

        }

    }

    if($po > 0 && $zo > 0) {

        global $opendmo_path;
        global $primaryediturl;
        global $zipediturl;
        global $opendmo_default_limit;
        global $opendmo_set_limit;
        global $opendmo_options_meta;
        global $opendmo_options_zip_meta;
        global $default_social_media;

        $opendmo_options_meta = get_post_meta($po);
        $opendmo_options_zip_meta = get_post_meta($zo);
        $zipediturl = "post.php?post=$zo&action=edit";
        $primaryediturl = "post.php?post=$po&action=edit";

        foreach($opendmo_default_limit as $d=>$dl) {

            $maxopt = "opt_opendmo_$dl_total";
            $opendmo_set_limit[$d] = $dl;
            
            if(isset($opendmo_options_meta[$maxopt])) {

                $opendmo_set_limit[$d] = $opendmo_options_meta[$maxopt];

            }

        }

    }

}

function opendmo_acf_load() {

    global $po;
    global $zo;
    global $opendmo_options_meta;
    global $opendmo_options_zip_meta;
    global $opendmo_set_limit;
    global $opendmo_path;
    global $default_social_media;
    global $zipediturl;
    global $primaryediturl;

    foreach (glob($opendmo_path."define/options/*.php") as $filename) {

        include $filename;

    } 

    foreach (glob($opendmo_path."define/fields/*.php") as $filename) {

        include $filename;

    }          

    add_filter('acf/fields/post_object/query/name=opendmo_evs', 'venue_query', 10, 3);
    add_filter('the_content', 'acf_content_after', 20);

}

function opendmo_cpt_load() {

   global $cpt_onomies_manager;
   if ( $cpt_onomies_manager ) {
      
        global $opendmo_cpt_names;

        foreach($opendmo_cpt_names as $od_cpt) {

            $cpt_onomies_manager->register_cpt_onomy( 

                $od_cpt, 
                $opendmo_cpt_names, 
                array('restrict_user_capabilities' => array( 

                    'administrator', 'editor', 'author' 

                ))

            );

        }

   }

}

function opendmo_post_load() {

    global $opendmo_postmeta;

    $infos = get_fields(get_post()->ID);
    $info = array();
    foreach($infos as $in=>$fo) {

        if(strpos($in, 'postmeta_opendmo')===0 && isset($fo)) {

            if(strlen($fo.'') > 0 && $fo !== 'null') {

                $newin = str_replace("postmeta_opendmo_","",$in);
                $info = array_merge($info, array($newin=>$fo));

                if(strpos($in, 'postmeta_opendmo_select')===0) {

                    $fin = get_field_object($in);
                    $fin = $fin['choices'][$fo];

                    $info = array_merge($info, array($newin."_display"=>$fin));

                }


            }

        }



    }

    ksort($info);
    $opendmo_postmeta = $info;

}

function add_cpt_to_menu($cpt) {

    add_submenu_page(

        'opendmo-settings', ucfirst($cpt), ucfirst($cpt), 
        'manage_options', 'edit.php?post_type='.$cpt

    ); 

}

function opendmo_admin_menu() {

    global $primaryediturl;

    add_menu_page(

        'OpenDMO', 'OpenDMO', 'manage_options', 
        'opendmo-settings', '', 'dashicons-location', 4

    );

    add_submenu_page(

        'options-general.php', 'OpenDMO Options', 'OpenDMO', 
        'manage_options', $primaryediturl

    ); 

    remove_submenu_page( 'opendmo-settings', 'opendmo-settings' );
    remove_submenu_page( 'options-general.php', 'custom-post-type-onomies' );
    remove_submenu_page( 'options-general.php', 'post-content-shortcodes' );
    //remove_menu_page('edit.php?post_type=acf');

}

function opendmo_admin_head() {

    global $opendmo_cpt_names;
    global $opendmo_options_meta;

    if(get_post_type() == "opendmo-options") {

        // hide post options on options pages
        echo "<style type='text/css'> #titlediv, #minor-publishing { display: none; }  </style>";

    }

    echo "<style type='text/css'>";

        foreach($opendmo_cpt_names as $odcpt) {

            echo "#custom-post-type-onomies-$odcpt { display: none; }";

        }

    echo "</style>";          
    echo "<script> (function($) { $(document).ready(function(){";

        foreach($opendmo_cpt_names as $odcpt) {
                
            echo "$('#acf-cpt_tax_content_$odcpt').append( $('#taxonomy-$odcpt') );";
                
        }
            
    echo "}); })(jQuery); </script>";

}



//nonprimary action queue

function fields_location($gn) {

    global $opendmo_cpt_names;

    $fl = array();
    foreach($opendmo_cpt_names as $o=>$odcpt) {

        $fl[$o][0] = array (

            "param" => "post_type",
            "operator" => "==",
            "value" => $odcpt,
            "order_no" => ($gn),
            "group_no" => ($gn),
        );

    }

    return $fl;

}

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

}

function safeoutput($s) {

    echo "<pre>";print_r($s);echo "</pre>";

}

function venue_query( $args, $field, $post_id ) {

    global $opendmo_cpt_names;
    global $venuequeryi;
    $thecptname = $opendmo_cpt_names[$venuequeryi];

     $args = array(
    'post_type'	=> $thecptname,
    'meta_query' => array(
        array(
	        'key' => 'is_venue',
	        'value' => '1',
	        'compare' => '=='
	        )
        )
    );

    $venuequeryi++;
    return $args;

}

function opendmo_add_meta($m,$h='post-after') {

    global $acfoutput;
    $acfoutput[$h] = $acfoutput[$h].$m;

}

function acf_content_after($content) {

    global $opendmo_path;
    global $opendmo_postmeta;
    global $opendmo_cpt_names;
    global $acfoutput;

    include($opendmo_path.'post/meta.php');

    $fullpost = $acfoutput['post-before'].$content.$acfoutput['post-after'];
    $fullmeta = $acfoutput['meta-before'].$acfoutput['meta'].$acfoutput['meta-after'];
    $fullcpt = $acfoutput['cpt-before'].$acfoutput['cpt'].$acfoutput['cpt-after'];
    $fullcontent = $fullpost.$fullmeta.$fullcpt;

    return $fullcontent;

}

?>
