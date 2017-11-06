<?php

$acfoutput = array('post-before','post-after','meta-before','meta','meta-after','cpt-before','cpt','cpt-after');
$acfoutput = array_fill_keys($acfoutput,'');

$venuequeryi = 0;
$opendmo_postmeta = array();

add_action('init', 'acf_filters');
add_action('init', 'opendmo_acf_load');
add_action('wp', 'prepare_meta');

function acf_filters() {

    add_filter('acf/fields/post_object/query/name=opendmo_evs', 'venue_query', 10, 3);
    add_filter('the_content', 'acf_content_after', 20);

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

function safeoutput($s) {

    echo "<pre>";print_r($s);echo "</pre>";

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

function prepare_meta() {

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

function opendmo_add_meta($m,$h='post-after') {

    global $acfoutput;
    $acfoutput[$h] = $acfoutput[$h].$m;

}

function acf_content_after($content) {

    global $opendmo_path;
    global $opendmo_postmeta;
    global $opendmo_cpt_names;
    global $acfoutput;

    include($opendmo_path.'post/acf-post-meta.php');

    $fullpost = $acfoutput['post-before'].$content.$acfoutput['post-after'];
    $fullmeta = $acfoutput['meta-before'].$acfoutput['meta'].$acfoutput['meta-after'];
    $fullcpt = $acfoutput['cpt-before'].$acfoutput['cpt'].$acfoutput['cpt-after'];
    $fullcontent = $fullpost.$fullmeta.$fullcpt;

    return $fullcontent;

}

?>
