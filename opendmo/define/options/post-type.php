<?php

$thecpt = array(array(),array(field_build_tab("+ New")));

for($c = 0; $c<$opendmo_global['set_limit']['post_type']; $c++) {

    $dcn = '';
    $suffix = $c;
    if(isset($opendmo_global['cpt_names'][$c])) { 

        $dcn = $opendmo_global['cpt_names'][$c]; 
        $suffix = $dcn;

    }

    if(strlen($dcn)<1) { 

        $newcptc = count($thecpt[1]);

        $thecpt[1] = array_merge($thecpt[1], array(

            field_build_text("opt_opendmo_cpt_name_$suffix", "New Post Type Name ($newcptc)", 'post-type', ''),

        ));

    }
    
    else {

        $thecpt[0] = array_merge($thecpt[0],array(

            field_build_tab($dcn),
            field_build_text("opt_opendmo_cpt_name_$suffix", "Post Type Name", 'post-type', $dcn),
            field_build_boolean("opt_opendmo_cpt_archive_calendar_$suffix", "Display Calendar on Archive Page"),
            field_build_wysiwyg("opt_opendmo_cpt_archive_body_$suffix", "Archive Page Body"),

        ));  

    }

}

$thecpt = array_merge($thecpt[0],$thecpt[1]);

opt_fields_register($thecpt,$co);     

$primaryedit = "post.php?post=$po&action=edit";
$primaryedit = "<a href='$primaryedit'><h3>&laquo; Return to Primary Options</h3></a>";
$primaryedit = array(field_build_message($primaryedit));
opt_fields_register($primaryedit, $co);

?>
