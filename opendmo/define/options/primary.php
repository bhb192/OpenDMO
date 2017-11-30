<?php

$zipedit = "post.php?post=$zo&action=edit";
$cptedit = "post.php?post=$co&action=edit";
$optfields = array();    

foreach (glob($opendmo_global['path']."define/options/primary/*.php") as $filename) {

    $optfield = array();
    include $filename;
    $optfields = array_merge($optfields, $optfield);

}


opendmo_opt_fields_register($optfields,$po);
opendmo_opt_fields_register(array(

    opendmo_field_build_message(

        "<a href='$zipedit'><h3>Edit Zip Codes &raquo;</h3></a>
        <a href='$cptedit'><h3>Edit Post Types &raquo;</h3></a>"

    ),

),$po);


