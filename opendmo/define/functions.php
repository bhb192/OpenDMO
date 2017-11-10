<?php

function opendmo_get_options() {

    global $opendmo_global;

    $getopts = new WP_Query('post_type=opendmo-options');
    $getopts = $getopts->posts;

    if(isset($getopts[0])) {

        foreach($getopts as $opt) {

            if($opt->post_title == 'opendmo-primary') { $po = $opt->ID; }
            if($opt->post_title == 'opendmo-zip') { $zo = $opt->ID; }

        }

    }

    if($po > 0 && $zo > 0) {

        $opendmo_global['options_meta'] = get_post_meta($po);
        $opendmo_global['zip_meta'] = get_post_meta($zo);
        $opendmo_global['zipedit'] = $zo;
        $opendmo_global['primaryedit'] = $po;

        foreach($opendmo_global['default_limit'] as $d=>$dl) {

            $maxopt = "opt_opendmo_".$d."_total";
            $opendmo_global['set_limit'][$d] = $dl;
            
            if(isset($opendmo_global['options_meta'][$maxopt][0])) {

                $opendmo_global['set_limit'][$d] = $opendmo_global['options_meta'][$maxopt][0];

            }

        }

        for($c=0; $c<$opendmo_global['set_limit']['post_type']; $c++) {

            if(isset($opendmo_global['options_meta']["opt_opendmo_cpt_name_$c"][0])) {

                $the_c = $opendmo_global['options_meta']["opt_opendmo_cpt_name_$c"][0];
                if(strlen($the_c)>0) { $opendmo_global['cpt_names'][$c] = $the_c; }

            }

        }

    }

    //safeout("get options done");

}

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
    $odocount = $odocount->publish;

    if($odocount<2) { add_action('wp_loaded', 'createoptions'); }

    //safeout("register options done");

}

function opendmo_register_cpt() {

    global $opendmo_global;

    foreach($opendmo_global['cpt_names'] as $c) {

        $t = ucfirst($c);

        register_post_type($c, array(

           'labels'  => array(

               'name'           => __($c),
               'singular_name'  => __($t),
               'menu_name'      => $t,
		       'edit_item'      => "Edit $t",

           ),

           'public'      => true,
           'has_archive' => true,
           'show_in_menu'=>'opendmo-settings',


       ));

        add_post_type_support( $c, 'thumbnail' );

    }

    add_action( 'add_meta_boxes', 'cpt_add_excerpt' );

    //safeout("register cpt done");

}

function opendmo_acf_load() { 

    global $opendmo_global;
    $limit = $opendmo_global['set_limit'];
    $po = $opendmo_global['primaryedit'];
    $zo = $opendmo_global['zipedit'];

    foreach (glob($opendmo_global['path']."define/options/*.php") as $filename) {

        include $filename;     

    }

    foreach (glob($opendmo_global['path']."define/fields/*.php") as $filename) {

        include $filename;

    }          

    add_filter('acf/fields/post_object/query/name=postmeta_opendmo_postobj_evs', 'venue_query', 10, 3);
    add_filter('the_content', 'acf_content_after', 20);

    //safeout("acf load done");

}

function opendmo_cpt_load() {

    global $cpt_onomies_manager;
    global $opendmo_global;

    if ( $cpt_onomies_manager ) {
      
        foreach($opendmo_global['cpt_names'] as $od_cpt) {

            $cpt_onomies_manager->register_cpt_onomy( 

                $od_cpt, 
                $opendmo_global['cpt_names'], 
                array('restrict_user_capabilities' => array( 

                    'administrator', 'editor', 'author' 

                ))

            );

        }

    }

    //safeout("cpt load done");

}

function opendmo_load_meta() {

    global $opendmo_global;
    $opendmo_global['postmeta'] = opendmo_clean_meta(get_post()->ID);

}

function add_cpt_to_menu($cpt) {

    add_submenu_page(

        'opendmo-settings', ucfirst($cpt), ucfirst($cpt), 
        'manage_options', 'edit.php?post_type='.$cpt

    ); 

}

function opendmo_admin_menu() {

    global $opendmo_global;

    add_menu_page(

        'OpenDMO', 'OpenDMO', 'manage_options', 
        'opendmo-settings', '', 'dashicons-location', 4

    );

    add_submenu_page(

        'options-general.php', 'OpenDMO Options', 'OpenDMO', 
        'manage_options', $opendmo_global['primaryediturl']

    ); 

    remove_submenu_page( 'opendmo-settings', 'opendmo-settings' );
    remove_submenu_page( 'options-general.php', 'custom-post-type-onomies' );
    remove_submenu_page( 'options-general.php', 'post-content-shortcodes' );
    //remove_menu_page('edit.php?post_type=acf');

}

function opendmo_admin_head() {

    global $opendmo_global;

    if(get_post_type() == "opendmo-options") {

        // hide post options on options pages
        echo "<style type='text/css'> #titlediv, #minor-publishing { display: none; }  </style>";

    }

    //hide cpt metaboxes

    echo "<style type='text/css'>";

        foreach($opendmo_global['cpt_names'] as $odcpt) {

            echo "#custom-post-type-onomies-$odcpt { display: none; }";

        }

        echo "#postbox-container-2 { display: none; }";
        echo "#postdivrich { display: none; }";

        echo "#titlediv { 

            padding-bottom: 5em;
            background-image: url('/wp-includes/images/spinner-2x.gif') ;
            background-repeat: no-repeat;
            background-position: bottom left;

        }";

    echo "</style>";          

    //move the inner select box from the hidden cpt metabox into the acf created tab

    echo "<script> 

        (function($) { 

            $(document).ready(function(){";

                foreach($opendmo_global['cpt_names'] as $odcpt) {
                        
                    echo "$('#acf-cpt_tax_content_$odcpt').append( $('#taxonomy-$odcpt') );";
                        
                }

            echo "});

            $(window).load(function(){
   
                $('#titlediv').css('background-image','url()');
                $('#titlediv').css('padding-bottom','0');
                $('#postdivrich').slideDown();
                $('#postbox-container-2').slideDown();

            });

        })(jQuery); 

    </script>";

}


function cpt_add_excerpt ( $post_type ) {

    global $opendmo_global;

    if ( in_array( $post_type, $opendmo_global['cpt_names'] ) ) {

        add_meta_box(

            'oz_postexcerpt',
            'Excerpt',
            'post_excerpt_meta_box',
            $post_type,
            'side',
            'low'

        );

    }

}

function createoptions() {

   global $opendmo_global;
   $gpmty = array();

   foreach($opendmo_global['default_limit'] as $odd=>$oddl) {

       $gpmty = array_merge($gpmty, array("opt_opendmo_".$odd."_total" => $oddl));

   }

   $po = wp_insert_post(array (

       'post_type' => 'opendmo-options',
       'post_title' => 'opendmo-primary',
       'post_status' => 'publish',
       'meta_input' => $gpmty,

   ));

   $zo = wp_insert_post(array (
       'post_type' => 'opendmo-options',
       'post_title' => 'opendmo-zip',
       'post_status' => 'publish',
    ));

}

function safeout($s,$d=0) {

    echo "<pre>";print_r($s);echo "</pre>";    
    if($d===1) { die; }

}

function venue_query( $args, $field, $post_id ) {

    global $opendmo_global;
    static $vq;
    if( !( isset($vq) ) ) { $vq = 0; }

    $thecptname = $opendmo_global['cpt_names'][$vq];

    $args = array(
    'post_type'	=> $thecptname,
    'meta_query' => array(
        array(
	        'key' => 'postmeta_opendmo_boolean_is_venue',
	        'value' => '1',
	        'compare' => '=='
	        )
        )
    );

    $vq++;
    return $args;

}

function opendmo_add_meta($m,$h='post-after') {

    global $opendmo_global;
    $opendmo_global['acfoutput'][$h] = $opendmo_global['acfoutput'][$h].$m;

}

function acf_content_after($content) {

    global $opendmo_global;
    $meta = $opendmo_global['postmeta'];

    foreach (glob($opendmo_global['path']."post/*.php") as $filename) {

        include $filename;

    }       

    $allafter = implode(array_slice($opendmo_global['acfoutput'], 1));
    $fullpost = $opendmo_global['acfoutput']['post-before'].$content.$allafter;

    return $fullpost;

}

function opendmo_clean_meta($id) { 

    global $opendmo_global;
    $gpt = get_post_type($id);

    //This function loads the OpenDMO post info so it can only happen on posts

    if(in_array($gpt,$opendmo_global['cpt_names'])) { 

        // get the custom fields set by ACF and remove any blank fields

        $infos = array_filter(get_fields($id));

        if(count($infos)>0) {

            //only process fields if there are any set for the post

            $info = array();
            foreach($infos as $in=>$fo) {

                //limit fields only to postmeta - this prefix is set in fields.php

                if(strpos($in, 'postmeta_opendmo')===0 && isset($fo)) {

                    //limit fields only to those that have a value set

                    if(count($fo) > 0) {

                        //remove the postmeta header in the new fields list

                        $newin = str_replace("postmeta_opendmo_","",$in);
                        $info = array_merge($info, array($newin=>$fo));

                        //if field is select then add a new meta entry 
                        //for the display name of the selected item

                        if(strpos($in, 'postmeta_opendmo_select')===0) {

                            $fin = get_field_object($in);
                            $fin = $fin['choices'][$fo];

                            $info = array_merge($info, array($newin."_display"=>$fin));

                        }


                    }

                }

            }

            //sort fields by type

            ksort($info);    
            return $info;

        }

    }

}

?>
