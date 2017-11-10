<?php

$tif = array();

foreach (glob($opendmo_global['path']."define/fields/info/*.php") as $filename) {

    $info_fields = array();
    include $filename;
    $tif = array_merge($tif, $info_fields);

}

fields_register("Page Info",$tif,1);

?>
