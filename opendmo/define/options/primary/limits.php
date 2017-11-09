<?php

$optfield = array(field_build_tab("Limits"));

foreach($opendmo_set_limit as $odd=>$oddl) {

    $ofn = field_build_text("",ucfirst($odd),'',$oddl);
    $ofn['name'] = "opt_opendmo_".$odd."_total";
    $optfield = array_merge($optfield, array($ofn));

}

?>
