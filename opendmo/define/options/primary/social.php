<?php

$optfield = array(field_build_tab('Social'));

for($s = 0; $s<$opendmo_set_limit['social_links']; $s++) {

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

    $optfield = array_merge($optfield, array(

        $smdefine[0]['open'],
        $smdefine[1],
        $smdefine[2],
        $smdefine[0]['close'],

    ));

}

?>
