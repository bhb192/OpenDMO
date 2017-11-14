<?php

$optfield = array(field_build_tab('Social'));

for($s = 0; $s<$opendmo_global['set_limit']['social_links']; $s++) {

    $default_nn = '';
    $default_nu = '';

    if(isset($opendmo_global['default_social_media'][$s])) {

        $default_nn = $opendmo_global['default_social_media'][$s];
        $default_nu = "https://".strtolower($default_nn).".com/";

    }

    $smdri = "(".($s+1).")";    
    $smrow = field_build_row(2);

    $optfield = array_merge($optfield, array(

        $smrow['open'],
        field_build_text("opt_opendmo_social_name_$s", "Network Name $smdri", 'Twitter', $default_nn),
        field_build_text("opt_opendmo_social_url_$s", "URL Prefix $smdri", 'https://www.twitter.com/', $default_nu),
        $smrow['close'],

    ));

}

?>
