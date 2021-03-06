<?php

$itef = array();

for($i=0; $i<$limit['event_date']; $i++) {

    $itefrow = opendmo_field_build_row(3);
    $suggestdt = array("Main Festival Date", "Afternoon Show", "Rain Date");
    $the_suggestdt = "Date Description";
    if(isset($suggestdt[$i])) { $the_suggestdt = $suggestdt[$i]; }
    $dateidx = "(".($i+1).")";

    if ($i===0) {

        $itef = array_merge($itef, array(

	        opendmo_field_build_tab("Venue"),
            opendmo_field_build_postobj("evs","Select Event Venue",''),

        ));

    }

    if( !( $i%5 ) ) {

        $fivemore = $i+5;
        if( ($i+5) > $limit['event_date'] ) { $fivemore = $limit['event_date']; }

        $itef = array_merge($itef, array(

	        opendmo_field_build_tab("Dates ".($i+1)."-".($fivemore)),

	    ));

    }

    $itef = array_merge($itef, array(

        $itefrow['open'],
        opendmo_field_build_text("date_label_$i", "Date Label $dateidx", $the_suggestdt),
        opendmo_field_build_datetime("begin_date_$i","Begin Date/Time $dateidx"),
        opendmo_field_build_datetime("end_date_$i","End Date/Time $dateidx"),
        $itefrow['close'],

    ));

}

opendmo_fields_register("Event Info",$itef,2);
add_filter('acf/fields/post_object/query/name=postmeta_opendmo_postobj_evs', 'opendmo_venue_query', 10, 3);

