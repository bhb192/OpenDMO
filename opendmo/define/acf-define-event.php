<?php

global $opendmo_options_meta;
global $opendmo_default_limit;

$maxdates = $opendmo_options_meta['opendmo_event_dates_total'][0];
if(!$maxdates > 0) { $maxdates = $opendmo_default_limit['event_date']; } 
$iz = array();
$z = 0;

$build_event_fields = array();
$itef = 0;

for($i=0; $i<$maxdates; $i++) {

    $itef = array();

    if ($i===0) {

        $itef = array_merge($itef, array(

	        field_build_tab("Venue"),
            field_build_postobj("evs","Select Event Venue",$opendmo_cpt_names),

        ));

    }

    if( !( $i%5 ) ) {

        $fivemore = $i+5;

        if( ($i+5) > $maxdates ) { $fivemore = $maxdates; }

        $itef = array_merge($itef, array(

	        field_build_tab("Dates ".($i+1)."-".($fivemore)),

	    ));

    }

    $itefrow = field_build_row(2);

    $itef = array_merge($itef, array(

        $itefrow['open'],
        field_build_datetime("begin_date_$i","Begin Date/Time (".($i+1).")"),
        field_build_datetime("end_date_$i","End Date/Time ".($i+1).")"),
        $itefrow['close'],

    ));

    $build_event_fields = array_merge($build_event_fields, $itef);

}

register_field_group(array (
    'id' => 'acf_event-settings',
    'title' => 'Event Settings',
    'fields' => $build_event_fields,
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
