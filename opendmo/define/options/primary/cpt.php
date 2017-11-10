<?php

$optfield = array(field_build_tab('Post Types'));

for($c = 0; $c<$opendmo_global['set_limit']['post_type']; $c++) {

    $dcn = '';
    if(isset($opendmo_global['default_cpt_names'][$c])) { $dcn = $opendmo_global['default_cpt_names'][$c]; }

    $smdri = "(".($c+1).")";    

    $optfield = array_merge($optfield, array(

        field_build_text("opt_opendmo_cpt_name_$c", "Post Type Name $smdri", 'post-type', $dcn),

    ));

}

?>
