<?php

$opendmo_psph = field_build_boolean('pin_home', 'Pin to Home Page', 'Include this post in the featured section of the home page?');
$opendmo_psph_e = field_build_datetime('pin_home_expire', 'Home Page Expiration');
$opendmo_psph_e['conditional_logic'] = array(

	'status' => 1,
	'rules' => array (
		array (
			'field' => $opendmo_psph['key'],
			'operator' => '==',
			'value' => '1',
		),
	),
	'allorany' => 'all',

);

//echo("<pre>");print_r($opendmo_psph);print_r($opendmo_psph_e);die;

$psrow = array(field_build_row(2),field_build_row(2),field_build_row(2));

$info_fields['post-settings'] = array( 

    field_build_tab('Post Settings'),
    $psrow[0][0],
    $opendmo_psph, 
    $opendmo_psph_e,
    $psrow[0][1],
    $psrow[1][0],
    field_build_boolean('verified_page', 'Verified Page', 'Hours and contact information for this location have been verified.'),
    field_build_boolean('is_venue', 'Is Event Venue', 'Is this an event venue?'),
    $psrow[1][1],
    $psrow[2][0],
    field_build_boolean('hide_author_date', 'Hide Author & Date', 'Select to hide the author and date of this post.'),
    field_build_boolean('bottom_author', 'Move Author & Date to Bottom', 'Select to move the author and date of this post to the bottom of this post.'),
    $psrow[2][1],

);

?>
