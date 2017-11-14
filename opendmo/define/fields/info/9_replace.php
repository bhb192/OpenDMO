<?php

$info_fields = array(field_build_tab('Content Replacement'));

$suggest_link_labels = array('<content to replace>', 'replace-this-text-here');
$the_suggestll = '';

for($xxu = 0; $xxu<$limit['content_replacement']; $xxu++) {

    if(isset($suggest_link_labels[$xxu])) { $the_suggestll = $suggest_link_labels[$xxu]; }
    else { $the_suggestll = '[show-this-content-instead]'; }

    $linksrow = field_build_row(2);
    $lridx = "(".($xxu+1).")";
    
    $info_fields = array_merge($info_fields, array (

	    $linksrow[0],
        field_build_text("content_replace_str_$xxu", "String to Replace $lridx", $the_suggestll),
        field_build_postobj("content_replace_post_$xxu", "Post Content to Show $lridx", $opendmo_global['cpt_names'], 0),
        $linksrow[1],

    ));

}

?>
