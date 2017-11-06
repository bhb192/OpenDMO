<?php

$maxsocial = $opendmo_options_meta['opendmo_social_links_total'][0];
if(!$maxsocial > 0) { $maxsocial = $opendmo_default_limit['social_links']; } 

$social_dropdown = array();
$m = 0;

while(strlen($opendmo_options_meta["opt_opendmo_social_name_$m"][0]) > 0) {

    $social_name = "opt_opendmo_social_name_$m";
    $social_name = $opendmo_options_meta[$social_name][0];

    $social_url = "opt_opendmo_social_url_$m";
    $social_url = $opendmo_options_meta[$social_url][0];

    $social_dropdown = array_merge($social_dropdown, array( $social_url => $social_name ) );

    $m++;

}

$is = array();
$s = 0;

$info_fields['social'] = array(field_build_tab('Social'));

for($m=0; $m<$maxsocial; $m++) {

    $slrow = field_build_row(2);
    $slrowi = "(".($m+1).")";

    $is = array (

	    $slrow[0],
        field_build_select("social_domain_$m", "Social Network $slrowi", 1, $social_dropdown),
        field_build_text("social_url_$m", "Profile URL $slrowi", "VisitNewYork"),
        $slrow[1],

    );

    $info_fields['social'] = array_merge( $info_fields['social'], $is);

}


?>
