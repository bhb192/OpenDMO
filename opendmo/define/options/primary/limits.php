<?php

$optfield = array(opendmo_field_build_tab("Limits"));

foreach($opendmo_global['set_limit'] as $odd=>$oddl) {

    $nicelabel = ucwords(str_replace("_"," ",$odd));
    $ofn = opendmo_field_build_text("opt_opendmo_".$odd."_total",$nicelabel,'',$oddl);
    $optfield = array_merge($optfield, array($ofn));

}

