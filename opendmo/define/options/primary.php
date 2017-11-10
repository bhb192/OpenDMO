<?php

$zipedit = "post.php?post=$zo&action=edit";
$optfields = array();    

foreach (glob($opendmo_global['path']."define/options/primary/*.php") as $filename) {

    $optfield = array();
    include $filename;
    $optfields = array_merge($optfields, $optfield);

}


opt_fields_register($optfields,$po);
opt_fields_register(array(field_build_message("<a href='".$zipedit."'>Edit Zip Codes &raquo;</a>")),$po);


?>
