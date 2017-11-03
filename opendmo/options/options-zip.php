<?php


$thezo = get_post_meta($po);
$max_zip = $thezo['opendmo_zip_total'][0];
if(!$max_zip > 0) { $max_zip = $opendmo_default_limit['zipcode']; } 
$iz = array();
$z = 0;

for($mz=0; $mz<$max_zip; $mz++) {

    $iz[$z] = array (

	    'key' => "field_ziprowo$mz",
	    'label' => "f$mzo",
	    'name' => "f$mzo",
	    'type' => 'row',
	    'row_type' => 'row_open',
	    'col_num' => 3,

    );

    $iz[$z+1] = array (

        "key" => "field_zipcity$mz",
        "label" => "USPS Place ".($mz+1),
        "name" => "opendmo_zip_city_$mz",
		'type' => 'text',
		'default_value' => '',
		'placeholder' => 'Schenectady',
		'prepend' => '',
		'append' => '',
		'formatting' => 'html',
		'maxlength' => '99',
    );

    $iz[$z+2] = array (

        "key" => "field_zipstate$mz",
        "label" => "State",
        "name" => "opendmo_zip_state_$mz",
		'type' => 'text',
		'default_value' => '',
		'placeholder' => 'NY',
		'prepend' => '',
		'append' => '',
		'formatting' => 'html',
		'maxlength' => '2',
    );

    $iz[$z+3] = array (

        "key" => "field_zipcode$mz",
        "label" => "Zip Code",
        "name" => "opendmo_zip_code_$mz",
		'type' => 'text',
		'default_value' => '',
		'placeholder' => '12345',
		'prepend' => '',
		'append' => '',
		'formatting' => 'html',
		'maxlength' => '5',
    );

    $iz[$z+4] = array (

	    'key' => "field_ziprowc$mz",
	    'label' => "f$mzc",
	    'name' => "f$mzc",
	    'type' => 'row',
	    'row_type' => 'row_close',
	    'col_num' => 3,

    );

    $z = count($iz);

}

register_field_group(array (

    "id" => "acf_opendmo-zip",
    "title" => "OpenDMO Zip Codes",
    "fields" => $iz,
    "location" => array( array( 

        array(

            "param" => "post_type",
            "operator" => "==",
            "value" => "opendmo-options",
            "order_no" => 1,
            "group_no" => 1,

        ),

        array(

            "param" => "post",
            "operator" => "==",
            "value" => $zo,
            "order_no" => 1,
            "group_no" => 1,

        ),


    )),
    "options" => array (
        "position" => "normal",
        "layout" => "no_box",
        "hide_on_screen" => array (),
    ),
    "menu_order" => 1,

));        

$returnlink = get_edit_post_link($po);

register_field_group(array (

    "id" => "acf_opendmo-zip-primary-return",
    "title" => "opendmo-return",
    "fields" => array(

        array(

			'key' => 'field_derkh3uhdi23',
			'label' => 'opendmoreturn',
			'name' => 'opendmoreturn',
			'type' => 'message',
            "message" => "<a href='$returnlink'><h3>&laquo; Return to Primary Options</h3></a>"

        )

    ),
    "location" => array( array( 

        array(

            "param" => "post_type",
            "operator" => "==",
            "value" => "opendmo-options",
            "order_no" => 1,
            "group_no" => 1,

        ),

        array(

            "param" => "post",
            "operator" => "==",
            "value" => $zo,
            "order_no" => 1,
            "group_no" => 1,

        ),


    )),
    "options" => array (
        "position" => "normal",
        "layout" => "no_box",
        "hide_on_screen" => array (),
    ),
    "menu_order" => 0,

));    


?>
