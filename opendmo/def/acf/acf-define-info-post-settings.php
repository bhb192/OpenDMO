<?php

$info_fields['post-settings'] = array( 

    array (
        "key" => "field_opendmo_info_settings",
        "label" => "Post Settings",
        "name" => "",
        "type" => "tab",
    ),
	array (
		'key' => 'field_57ab4141bee0e',
		'label' => 'Verified Page',
		'name' => 'verified_page',
		'type' => 'true_false',
		'message' => 'Hours and contact information for this location have been verified.',
		'default_value' => 0,
	),
	array (
		'key' => 'field_56df949cb0e5f',
		'label' => 'Pin to Home Page',
		'name' => 'pin_home',
		'type' => 'true_false',
		'instructions' => 'Include this post in the featured section of the home page?',
		'message' => '',
		'default_value' => 0,
	),
	array (
		'key' => 'field_57eb824ae1f2c',
		'label' => 'Is Event Venue',
		'name' => 'is_venue',
		'type' => 'true_false',
		'instructions' => 'Is this an event venue?',
		'message' => '',
		'default_value' => 0,
	),
	array (
		'key' => 'field_574f10ca6858c',
		'label' => 'Home Page Expiration',
		'name' => 'pin_home_expire',
		'type' => 'date_picker',
		'instructions' => 'Will disappear from home page at 12am on date selected. Leave blank to never expire.',
		'conditional_logic' => array (
			'status' => 1,
			'rules' => array (
				array (
					'field' => 'field_56df949cb0e5f',
					'operator' => '==',
					'value' => '1',
				),
			),
			'allorany' => 'all',
		),
		'date_format' => 'yymmdd',
		'display_format' => 'dd/mm/yy',
		'first_day' => 1,
	),
	array (
		'key' => 'field_577321f84a395',
		'label' => 'Hide Author & Date',
		'name' => 'hide_author_date',
		'type' => 'true_false',
		'instructions' => 'Select to hide the author and date of this post ',
		'message' => '',
		'default_value' => 0,
	),
	array (
		'key' => 'field_57b710e509aab',
		'label' => 'Move Author & Date to Bottom',
		'name' => 'bottom_author',
		'type' => 'true_false',
		'instructions' => 'Select to move the author and date of this post to the bottom of the page<br /><small>(Default on Pages, Events and Stay)</small>',
		'conditional_logic' => array (
			'status' => 1,
			'rules' => array (
				array (
					'field' => 'field_577321f84a395',
					'operator' => '!=',
					'value' => '1',
				),
			),
			'allorany' => 'all',
		),
		'message' => '',
		'default_value' => 0,
	),

);

?>
