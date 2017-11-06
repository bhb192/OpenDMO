<?php

$cpthook = 'cpt';
$cpt_terms = get_the_terms( get_post()->ID, $the_cpt );

if(isset($opendmo_postmeta["boolean_cpt_showinline_".$the_cpt])) {

    if($opendmo_postmeta["boolean_cpt_showinline_".$the_cpt] == 1) {

        $cpthook = 'post-after';

    }

}

if(isset($cpt_terms[0])) {

    $bgcolor = "transparent";
    $padg = 0;

    if(isset($opendmo_postmeta["color_cpt_bg_".$the_cpt])) {

        $bgcolor = $opendmo_postmeta["color_cpt_bg_".$the_cpt];

    }

    if($bgcolor != 'transparent') {

        $padg = '.5em 0 .05em 1em';

    }

    opendmo_add_meta("<div style='background-color:$bgcolor;padding:$padg' id='opendmo_cpt_$the_cpt'>", $cpthook);

    if(isset($opendmo_postmeta["text_cpt_label_".$the_cpt])) {

        opendmo_add_meta("<h5>".$opendmo_postmeta["text_cpt_label_".$the_cpt]."</h5>", $cpthook);

    }

    $cpt_sort = array('name'=>array(), 'link'=>array(), 'date'=>array(), 'excerpt'=>array());

    foreach($cpt_terms as $c=>$the_cpt_term) {

        $cpt_sort['name'][$c] = $the_cpt_term->name;
        $cpt_sort['link'][$c] = get_post_permalink($the_cpt_term->term_id);
        $cpt_sort['date'][$c] = get_the_modified_date("U",$the_cpt_term->term_id);

        if(has_excerpt($the_cpt_term->term_id)) {

            $cpt_sort['excerpt'][$c] = get_the_excerpt($the_cpt_term->term_id);

        }

    }

    if($opendmo_postmeta["select_cpt_sort_".$the_cpt] == "mr") {

        arsort($cpt_sort['date']);

    }

    opendmo_add_meta("<ul>",$cpthook);

    foreach($cpt_sort['date'] as $c=>$the_date) {

        opendmo_add_meta("<li>",$cpthook);
        opendmo_add_meta("<a href='".$cpt_sort['link'][$c]."'>",$cpthook);
        opendmo_add_meta("<h6>".$cpt_sort['name'][$c]."</h6>",$cpthook);
        opendmo_add_meta("</a>",$cpthook);

        if(isset($cpt_sort['excerpt'][$c])) {

            opendmo_add_meta($cpt_sort['excerpt'][$c], $cpthook);

        }

        opendmo_add_meta("</li>", $cpthook);

    }

    opendmo_add_meta("</ul>", $cpthook);
    opendmo_add_meta("</div>", $cpthook);

}

?>
