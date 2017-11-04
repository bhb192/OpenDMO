<?php

register_field_group(array (
		'id' => 'acf_hotel-options',
		'title' => 'OpenDMO Hotel Options',
		'fields' => array (
			array (
				'key' => 'field_57447e05d1341',
				'label' => 'aRes ID',
				'name' => 'ares_id',
				'type' => 'number',
				'instructions' => 'Enter the 5-digit aRes property ID',
				'default_value' => '',
				'placeholder' => 12345,
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => 99999,
				'step' => '',
			),
		),
		'location' => fields_location(0),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));

?>
