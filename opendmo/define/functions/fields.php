<?php

function fbtc() {

    static $fbtc;
    if( !( isset($fbtc) ) ) { $fbtc = 0; }
    $the_fbtc = $fbtc;
    $fbtc++;
    return $the_fbtc;

}

function fbkey($n,$s) {

    static $fbkeys;
    if( !( isset($fbkeys) ) ) { $fbkeys = array(); }

    $k = "field_opendmo_".$s."_".$n;
    if(in_array($k, $fbkeys)) { $k = $k.fbtc(); }

    $y = count($fbkeys);
    $fbkeys[$y] = $k;

    return $k;

}

function fbname($s) {

    $n = $s;

    if( strpos($s,'opt_opendmo_')===FALSE  ) {

        $n = "postmeta_opendmo_".$s;

    }

    else { 

        $n = strpos($s,'opt_opendmo_');
        $n = substr($s,$n);

    }

    return $n;

}


function opendmo_acf_load() { 

    global $opendmo_global;
    $limit = $opendmo_global['set_limit'];
    $po = $opendmo_global['primaryedit'];
    $zo = $opendmo_global['zipedit'];
    $co = $opendmo_global['cptedit'];

    foreach (glob($opendmo_global['path']."define/options/*.php") as $filename) {

        include $filename;     

    }

    foreach (glob($opendmo_global['path']."define/fields/*.php") as $filename) {

        include $filename;

    }          

    add_filter('the_content', 'acf_content_after', 20);

    //safeout("acf load done");

}

function fields_register($t,$f,$l=0,$i="") {

    static $gn;
    if( !( isset($gn) ) ) { $gn = 0; }
    global $opendmo_global;
    $fl = array();

    foreach($opendmo_global['cpt_names'] as $o=>$odcpt) {

        $fl[$o][0] = array (

            "param" => "post_type",
            "operator" => "==",
            "value" => $odcpt,
            "order_no" => ($l),
            "group_no" => ($gn),

        );        

    }    

    $acfid = $i;
    if(strlen($i)===0) { $acfid = $gn; }

    register_field_group(array (

        "id" => "acf_postmeta_opendmo_$acfid",
        "title" => "OpenDMO $t",
        "fields" => $f,
        "location" => $fl,
        "options" => array (
            "position" => "normal",
            "layout" => "default",
            "hide_on_screen" => array (),
        ),
        "menu_order" => $l,

    ));

    $gn++;

}

function opt_fields_register($f,$l,$nb='no_box',$t='OpenDMO Options',$gn=1) {

    static $of;
    if( !( isset($of) ) ) { $of = 0; }

    register_field_group(array (

        "id" => "acf_opt_opendmo_$of",
        "title" => $t,
        "fields" => $f,
        "location" => array( array( 

            array(

                "param" => "post",
                "operator" => "==",
                "value" => $l,
                "order_no" => $gn,
                "group_no" => $gn,

            ),

        )),
        "options" => array (
            "position" => "normal",
            "layout" => $nb,
            "hide_on_screen" => array (),
        ),
        "menu_order" => $gn,

    ));   

    $of++;

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

?>
