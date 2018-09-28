<?php

opendmo_add_meta("<div id='opendmo_cpt'>",'cpt');

$cpt_order = array();

foreach($opendmo_global['cpt_names'] as $c=>$the_cpt) {

    $cpt_order[$c] = $meta["select_cpt_priority_".$the_cpt];

}

asort($cpt_order);

foreach($cpt_order as $c=>$cpto) {

    $the_cpt = $opendmo_global['cpt_names'][$c];
    $cpthook = 'cpt';
    $cpt_terms = get_field("postmeta_opendmo_postobj_cpt_related_".$opendmo_global['cpt_names'][$c],get_the_ID());

    if(isset($meta["boolean_cpt_showinline_".$the_cpt])) {

        if($meta["boolean_cpt_showinline_".$the_cpt] == 1) {

            $cpthook = 'post-after';

        }

    }

    if(isset($cpt_terms[0])) {

        $bgcolor = "transparent";
        $padg = 0;

        if(isset($meta["color_cpt_bg_".$the_cpt])) {

            $bgcolor = $meta["color_cpt_bg_".$the_cpt];

        }

        if($bgcolor != 'transparent') {

            $padg = '.5em 0 .05em 1em';

        }

        $stylestr = "background-color:$bgcolor;padding:$padg;margin-bottom:1em;";

        opendmo_add_meta("<div style='$stylestr' id='opendmo_cpt_$the_cpt'>", $cpthook);

        if(isset($meta["text_cpt_label_".$the_cpt])) {

            opendmo_add_meta("<h4>".$meta["text_cpt_label_".$the_cpt]."</h4>", $cpthook);

        }

        $cpt_sort = array('name'=>array(), 'link'=>array(), 'date'=>array(), 'excerpt'=>array());

        foreach($cpt_terms as $c=>$the_cpt_term) {

            $cpt_sort['name'][$c] = $the_cpt_term->post_title;
            $cpt_sort['link'][$c] = get_post_permalink($the_cpt_term->ID);
            $cpt_sort['date'][$c] = get_the_modified_date("U",$the_cpt_term->ID);

            if(has_excerpt($the_cpt_term->ID)) {

                $cpt_sort['excerpt'][$c] = get_the_excerpt($the_cpt_term->ID);

            }

        }

        if($meta["select_cpt_sort_".$the_cpt] == "mr") {

            arsort($cpt_sort['date']);

        }

        opendmo_add_meta("<ul>",$cpthook);

        foreach($cpt_sort['date'] as $c=>$the_date) {

            opendmo_add_meta("<li>",$cpthook);
            opendmo_add_meta("<a href='".$cpt_sort['link'][$c]."'>",$cpthook);
            opendmo_add_meta("<h5>".$cpt_sort['name'][$c]."</h5>",$cpthook);
            opendmo_add_meta("</a>",$cpthook);

            if(isset($cpt_sort['excerpt'][$c])) {

                opendmo_add_meta($cpt_sort['excerpt'][$c], $cpthook);

            }

            opendmo_add_meta("</li>", $cpthook);

        }

        opendmo_add_meta("</ul>", $cpthook);
        opendmo_add_meta("</div>", $cpthook);

    } 

}

opendmo_add_meta("</div>",'cpt');

