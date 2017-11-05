<?php

$maxlinks = $opendmo_options_meta['opendmo_ext_links_total'][0];
if(!$maxlinks > 0) { $maxlinks = $opendmo_default_limit['ext_links']; } 

$info_fields['links'] = array(field_build_tab('Links'));

$ux = array();

$suggest_link_labels = array('Official Website', 'Wikipedia Page');
$the_suggestll = '';

for($xxu = 0; $xxu<$maxlinks; $xxu++) {

    if(isset($suggest_link_labels[$xxu])) { $the_suggestll = $suggest_link_labels[$xxu]; }
    else { $the_suggestll = 'Other External Website'; }

    $linksrow = field_build_row(2);
    $lridx = "(".($xxu+1).")";
    
    $ux = array (

	    $linksrow[0],
        field_build_text("ext_link_label_$xxu", "External Link Label $lridx", $the_suggestll),
        field_build_text("ext_link_url_$xxu", "Website URL $lridx", "https://"),
        $linksrow[1],

    );

    $info_fields['links'] = array_merge($info_fields['links'], $ux);

}

?>
