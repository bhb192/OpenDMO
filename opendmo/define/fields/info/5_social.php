<?php

$opts = $opendmo_global['options_meta'];
$social_dropdown = array();
$m = 0;

while(strlen($opts["opt_opendmo_social_name_$m"][0]) > 0) {

    $social_name = "opt_opendmo_social_name_$m";
    $social_name = $opts[$social_name][0];

    $social_url = "opt_opendmo_social_url_$m";
    $social_url = $opts[$social_url][0];

    $social_dropdown = array_merge($social_dropdown, array( $social_url => $social_name ) );

    $m++;

}

$info_fields = array(opendmo_field_build_tab('Social'));

for($m=0; $m<$limit['social_links']; $m++) {

    $slrow = opendmo_field_build_row(2);
    $slrowi = "(".($m+1).")";

    $info_fields = array_merge( $info_fields, array (

	    $slrow[0],
        opendmo_field_build_select("social_domain_$m", "Social Network $slrowi", 1, $social_dropdown),
        opendmo_field_build_text("social_url_$m", "Profile URL $slrowi", "VisitNewYork"),
        $slrow[1],

    ));

}


