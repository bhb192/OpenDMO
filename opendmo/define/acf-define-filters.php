<?php


$venuequeryi = 0;
add_filter('the_content', 'acf_content_after');
add_action('plugins_loaded', 'myAcfFilters');
add_action('admin_init', 'opendmo_acf_load');

function myAcfFilters() {

    function venue_query( $args, $field, $post_id ) {

        global $opendmo_cpt_names;
        global $venuequeryi;
        $thecptname = $opendmo_cpt_names[$venuequeryi];
	
         $args = array(
        'post_type'		=> $thecptname,
        'meta_query'		=> array(
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

    add_filter('acf/fields/post_object/query/name=opendmo_evs', 'venue_query', 10, 3);

}

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

function opendmo_acf_load() {

    global $opendmo_path;

    $acf_def = array('info', 'cpt', 'event');

    foreach($acf_def as $acfdef) {

        include($opendmo_path.'define/acf-define-'.$acfdef.'.php');

    }

}

function acf_content_after($content) {

    global $opendmo_path;

    $acfoutput = ''; 
    $infos = get_post_meta(get_post()->ID); 

    echo "<pre>";print_r($infos);die;
    include($opendmo_path.'post/acf-post-meta.php');

    $fullcontent = $content . $acfoutput;
    return $fullcontent;

}

?>
