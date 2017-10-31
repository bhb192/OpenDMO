<?php

$maxdates = 15;
$insert_these_event_fields = array();
$itef = 0;

for($i=0; $i<$maxdates; $i++) {

    if ($i===0) {

		$insert_these_event_fields[$itef] = array (
			'key' => 'field_59f5a7c13bee8',
			'label' => 'Venue',
			'name' => '',
			'type' => 'tab',
		); 

		$insert_these_event_fields[$itef+1] = array (
			'key' => 'field_59f2bbcc751f3',
			'label' => 'Select Event Venue',
			'name' => 'opendmo_evs',
			'type' => 'post_object',
			'post_type' => $opendmo_cpt_names,
			'allow_null' => 1,
			'multiple' => 1,
		);

        $itef = $itef+2;

    }

    if( !( $i%5 ) ) {

        $insert_these_event_fields[$itef] = array (

			'key' => "field_59f5a6c0b84a1".$i.$itef,
			'label' => "Dates ".($i+1)."-".($i+5),
			'name' => '',
			'type' => 'tab',
		);

        $itef++;

    }

	$insert_these_event_fields[$itef] = array (

		'key' => "field_59f5ab9bb5b7c$i",
		'label' => "f$io",
		'name' => "f$io",
		'type' => 'row',
		'row_type' => 'row_open',
		'col_num' => 2,
	);

	$insert_these_event_fields[$itef+1] = array (

		'key' => "field_59f5a56b46984".$i."begin",
		'label' => "Begin Date/Time ".($i+1),
		'name' => "begin_date_$i",
		'type' => 'date_time_picker',
		'field_type' => 'date_time',
		'date_format' => 'yy-mm-dd',
		'time_format' => 'hh:mm tt',
		'past_dates' => 'yes',
		'time_selector' => 'select',
		'first_day' => 1,
	);

	$insert_these_event_fields[$itef+2] = array (

		'key' => "field_59f5a56b46984".$i."end",
		'label' => "End Date/Time ".($i+1),
		'name' => "end_date_$i",
		'type' => 'date_time_picker',
		'field_type' => 'date_time',
		'date_format' => 'yy-mm-dd',
		'time_format' => 'hh:mm tt',
		'past_dates' => 'yes',
		'time_selector' => 'select',
		'first_day' => 1,
	);

	$insert_these_event_fields[$itef+3] = array (

		'key' => "field_59f5ab9bb5b7c$icl",
		'label' => "f$ic",
		'name' => "f$ic",
		'type' => 'row',
		'row_type' => 'row_close',
		'col_num' => 2,
	);

    $itef = $itef+4;

}

register_field_group(array (
	'id' => 'acf_event-settings',
	'title' => 'Event Settings',
	'fields' => $insert_these_event_fields,
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'event',
				'order_no' => 0,
				'group_no' => 0,
			),
		),
	),
	'options' => array (
		'position' => 'normal',
		'layout' => 'default',
		'hide_on_screen' => array (
		),
	),
	'menu_order' => 0,
));

?>
