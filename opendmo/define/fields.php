<?php

function fbtc() {

    global $fbtc;
    $the_fbtc = $fbtc;
    $fbtc++;
    return $the_fbtc;

}

function fbkey($s) {

    $k = "field_opendmo_".$s."_".fbtc();
    return $k;

}

function fbname($s) {

    $n = "postmeta_opendmo_".$s;
    return $n;

}

function field_build_tab($l) {

    return array (

        "key" => fbkey('tab'),
        "label" => $l,
        "name" => "",
        "type" => "tab",

    );

}

function field_build_message($m,$n='') {

    return array (

	    "key" => fbkey("message"),
	    "label" => "",
	    "name" => $n,
	    "type" => "message",
	    "message" => $m,

    ); 

}

function field_build_row($c) {

    $rows = array();

    if(is_array($c)) { $cc = $c; }
    else { $cc = array($c); }

    foreach($cc as $i=>$col) {

        $tr = fbtc();

        $rows[$i] = array (

            'open' => array(

	            "key" => "field_opendmo_row_open_".$tr,
	            "label" => "",
	            "name" => "opendmo_row_open_".$tr,
	            "type" => "row",
	            "row_type" => "row_open",
	            "col_num" => $col,

            ),

            'close' => array(

	            "key" => "field_opendmo_row_close_".$tr,
	            "label" => "",
	            "name" => "opendmo_row_close_".$tr,
	            "type" => "row",
	            "row_type" => "row_close",
	            "col_num" => $col,

            ),

        );

        $rows[$i][0] = $rows[$i]['open'];
        $rows[$i][1] = $rows[$i]['close'];

    }

    if(count($rows)===1) { return $rows[0]; }
    else { return $rows; }

}

function field_build_text($n,$l='',$p='',$d='',$i='',$x=99) {

    return array (

	    "key" => fbkey("text"),
	    "label" => $l,
	    "name" => fbname("text_$n"),
	    "type" => "text",
        "instructions" => $i,
	    "default_value" => $d,
	    "placeholder" => $p,
	    "prepend" => "",
	    "append" => "",
	    "formatting" => "html",
	    "maxlength" => $x,

    );

}

function field_build_textarea($n,$l='',$p='',$d='') {

    $fbt = field_build_text($n,$l,$p,$d);
    $fbt['type'] = 'textarea';

    return $fbt;

}

function field_build_number($n,$l,$m,$x,$s,$d,$p='',$i='') {

    return array (

	    "key" => fbkey("number"),
	    "label" => $l,
	    "name" => fbname("number_$n"),
	    "type" => "number",
	    "default_value" => $d,
	    "placeholder" => $p,
        "instructions" => $i,
	    "prepend" => "",
	    "append" => "",
	    "min" => $m,
	    "max" => $x,
	    "step" => $s,

    );

}

function field_build_boolean($n,$l,$m="") {

   return array (

	    "key" => fbkey("boolean"),
	    "label" => $l,
	    "name" => fbname("boolean_$n"),
	    "type" => "true_false",
	    "required" => 0,
	    "message" => $m,
	    "default_value" => 0,

    );

}

function field_build_color($n,$l) {

    return array (

	    "key" => fbkey("color"),
	    "label" => $l,
	    "name" => fbname("color_$n"),
	    "type" => "color_picker",
	    "default_value" => "transparent",

    );

}

function field_build_select($n,$l,$e,$c,$d='',$k=0) {

    $fbs = array (

	    "key" => fbkey("select"),
	    "label" => $l,
	    "name" => fbname("select_$n"),
	    "type" => "select",
	    "choices" => $c,
	    "default_value" => $d,
	    "allow_null" => $e,
	    "multiple" => 0,

    );

    if($k > 0) { return array($fbs['key'], $fbs); }
    else { return $fbs; }

}

function field_build_postobj($n,$l,$p) {

    return array (

	    'key' => fbkey("postobj"),
	    'label' => $l,
	    'name' => fbname("postobj_$n"),
	    'type' => 'post_object',
	    'post_type' => $p,
	    'allow_null' => 1,
	    'multiple' => 1,

    );

}

function field_build_datetime($n,$l) {

    return array (

	    'key' => fbkey("datetime"),
	    'label' => $l,
	    'name' => fbname("datetime_$n"),
	    'type' => 'date_time_picker',
	    'field_type' => 'date_time',
	    'date_format' => 'yy-mm-dd',
	    'time_format' => 'hh:mm tt',
	    'past_dates' => 'yes',
	    'time_selector' => 'select',
	    'first_day' => 1,   

    );

}

?>
