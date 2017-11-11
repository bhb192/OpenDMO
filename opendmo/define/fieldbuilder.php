<?php

function field_build_boolean($n,$l,$m="") {

   return array (

	    "key" => fbkey($n,"boolean"),
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

	    "key" => fbkey($n,"color"),
	    "label" => $l,
	    "name" => fbname("color_$n"),
	    "type" => "color_picker",
	    "default_value" => "transparent",

    );

}

function field_build_datetime($n,$l) {

    return array (

	    'key' => fbkey($n,"datetime"),
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


function field_build_message($m,$n='') {

    return array (

	    "key" => fbkey($n,"message"),
	    "label" => "",
	    "name" => $n,
	    "type" => "message",
	    "message" => $m,

    ); 

}


function field_build_number($n,$l,$m,$x,$s,$d,$p='',$i='') {

    return array (

	    "key" => fbkey($n,"number"),
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

function field_build_postobj($n,$l,$p='',$m=0) {

    return array (

	    'key' => fbkey($n,"postobj"),
	    'label' => $l,
	    'name' => fbname("postobj_$n"),
	    'type' => 'post_object',
	    'post_type' => $p,
	    'allow_null' => 1,
	    'multiple' => $m,

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

function field_build_select($n,$l,$e,$c,$d='') {

    return array (

	    "key" => fbkey($n,"select"),
	    "label" => $l,
	    "name" => fbname("select_$n"),
	    "type" => "select",
	    "choices" => $c,
	    "default_value" => $d,
	    "allow_null" => $e,
	    "multiple" => 0,

    );

}


function field_build_tab($l) {

    return array (

        "key" => fbkey($n,'tab'),
        "label" => $l,
        "name" => "",
        "type" => "tab",

    );

}

function field_build_text($n,$l='',$p='',$d='',$i='',$x=99) {

    return array (

	    "key" => fbkey($n,"text"),
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

function field_build_textarea($n,$l='',$p='',$d='',$i='',$x=2048) {

    $fbt = field_build_text($n,$l,$p,$d,$i,$x);
    $fbt['type'] = 'textarea';

    return $fbt;

}

function field_build_wysiwyg($n,$l) {

	return array (

		'key' => fbkey($n,'wysiwyg'),
		'label' => $l,
		'name' => fbname("wysiwyg_$n"),
		'type' => 'wysiwyg',
		'default_value' => '',
		'toolbar' => 'full',
		'media_upload' => 'yes',

	);

}



?>
