<?php

$info_fields = array(field_build_tab('Links'));

$suggest_link_labels = array('Official Website', 'Wikipedia Page');
$the_suggestll = '';

for($xxu = 0; $xxu<$limit['ext_links']; $xxu++) {

    if(isset($suggest_link_labels[$xxu])) { $the_suggestll = $suggest_link_labels[$xxu]; }
    else { $the_suggestll = 'Other External Website'; }

    $linksrow = field_build_row(2);
    $lridx = "(".($xxu+1).")";
    
    $info_fields = array_merge($info_fields, array (

	    $linksrow[0],
        field_build_text("ext_link_label_$xxu", "External Link Label $lridx", $the_suggestll),
        field_build_text("ext_link_url_$xxu", "Website URL $lridx", "https://"),
        $linksrow[1],

    ));

}

?>
