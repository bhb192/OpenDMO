<?php

$opendmo_opt["social"] = array(field_build_tab('Social'));

$default_social_media = array("Twitter", "Facebook", "YouTube", "Instagram", "Pinterest", "AirBnB", "TripAdvisor");

$thepo = get_post_meta($po);
$max_social = $thepo['opendmo_social_links_total'][0];
if(!$max_social > 0) { $max_social = $opendmo_default_limit['social_links']; } 

for($s = 0; $s<$max_social; $s++) {

    $default_nn = '';
    $default_nu = '';

    if(isset($default_social_media[$s])) {

        $default_nn = $default_social_media[$s];
        $default_nu = "https://".strtolower($default_nn).".com/";

    } 

    $smdri = "(".($s+1).")";    
    $smdefine[0] = field_build_row(2);
    $smdefine[1] = field_build_text("", "Network Name $smdri", 'Twitter', $default_nn);
    $smdefine[1]['name'] = "opt_opendmo_social_name_$s";
    $smdefine[2] = field_build_text("", "URL Prefix $smdri", 'https://www.twitter.com/', $default_nu);
    $smdefine[2]['name'] = "opt_opendmo_social_url_$s";

    $opendmo_opt["social"] = array_merge($opendmo_opt["social"], array(

        $smdefine[0]['open'],
        $smdefine[1],
        $smdefine[2],
        $smdefine[0]['close'],

    ));
}

?>
