<?php

function opendmo_options_get_pages() {

    $getopts = new WP_Query('post_type=opendmo-options');
    $getopts = $getopts->posts;

    $po = 0;
    $zo = 0;
    $co = 0;

    if(isset($getopts[0])) {

        foreach($getopts as $opt) {

            if($opt->post_title == 'opendmo-primary') { $po = $opt->ID; }
            if($opt->post_title == 'opendmo-zip') { $zo = $opt->ID; }
            if($opt->post_title == 'opendmo-post-type') { $co = $opt->ID; }

        }

    }

    return array($po,$zo,$co);


}

function opendmo_options_get() {

    global $opendmo_global;

    $getopts = opendmo_options_get_pages();
    $po = $getopts[0];
    $zo = $getopts[1];
    $co = $getopts[2];

    if($po > 0 && $zo > 0) {

        $opendmo_global['options_meta'] = get_post_meta($po);
        $opendmo_global['zip_meta'] = get_post_meta($zo);
        $opendmo_global['cpt_meta'] = get_post_meta($co);
        $opendmo_global['zipedit'] = $zo;
        $opendmo_global['cptedit'] = $co;
        $opendmo_global['primaryedit'] = $po;

        foreach($opendmo_global['default_limit'] as $d=>$dl) {

            $maxopt = "opt_opendmo_".$d."_total";
            $opendmo_global['set_limit'][$d] = $dl;
            
            if(isset($opendmo_global['options_meta'][$maxopt][0])) {

                $opendmo_global['set_limit'][$d] = $opendmo_global['options_meta'][$maxopt][0];

            }

        }

        for($c=0; $c<$opendmo_global['set_limit']['post_type']; $c++) {

            if(isset($opendmo_global['cpt_meta']["opt_opendmo_cpt_name_$c"][0])) {

                $the_c = $opendmo_global['cpt_meta']["opt_opendmo_cpt_name_$c"][0];
                if(strlen($the_c)>0) { $opendmo_global['cpt_names'][$c] = $the_c; }


            }

            else { 

                if(isset($opendmo_global['default_cpt_names'][$c])) {

                    $opendmo_global['cpt_names'][$c] = $opendmo_global['default_cpt_names'][$c]; 

                }

            }

        }

    }

    //safeout("get options done");

}

function opendmo_options_register() {

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

    if($odocount<3) { add_action('wp_loaded', 'opendmo_options_create'); }

    //safeout("register options done");

}

function opendmo_options_create() {

    $getopts = opendmo_options_get_pages();
    $po = $getopts[0];
    $zo = $getopts[1];
    $co = $getopts[2];

    if(!$po) {

       global $opendmo_global;
       $gpmty = array();

       foreach($opendmo_global['default_limit'] as $odd=>$oddl) {

           $gpmty = array_merge($gpmty, array("opt_opendmo_".$odd."_total" => $oddl));

       }

       $po = wp_insert_post(array (

           'post_type' => 'opendmo-options',
           'post_title' => 'opendmo-primary',
           'post_status' => 'publish',
           //'meta_input' => $gpmty,

       ));

    }

    if(!$zo) {

       $zo = wp_insert_post(array (
           'post_type' => 'opendmo-options',
           'post_title' => 'opendmo-zip',
           'post_status' => 'publish',
        ));

    }

    if(!$co) {

       $co = wp_insert_post(array (
           'post_type' => 'opendmo-options',
           'post_title' => 'opendmo-post-type',
           'post_status' => 'publish',
        ));

    }



}



?>
