<?php


function opendmo_add_meta($m,$h='post-after') {

    global $opendmo_global;
    $opendmo_global['acfoutput'][$h] = $opendmo_global['acfoutput'][$h].$m;

}

function opendmo_meta_load() {

    if(is_singular()) {

        global $opendmo_global;
        $opendmo_global['postmeta'] = opendmo_clean_meta(get_post()->ID);

    }

}

function opendmo_meta_css() {

    global $opendmo_global;

    $css = file_get_contents($opendmo_global['path']."css/meta.css");
    $css = "<style type='text/css'>".$css."</style>";
    opendmo_add_meta($css,'post-before');

}

function opendmo_replace_content($s) {

    global $opendmo_global;
    $meta = $opendmo_global['postmeta'];
    if(!is_array($meta)) { $meta = array(); }

    $news = $s;

    foreach($meta as $me=>$ta) {

        if(strpos($me,'text_content_replace_str_')===0) {

            if(strlen($ta)>0) {

                $r = str_replace('text_content_replace_str_','',$me);

                if(isset($meta['postobj_content_replace_post_'.$r])) {

                    $id = $meta['postobj_content_replace_post_'.$r]->ID;
                    $title = "<h4><a href='".get_the_permalink($id)."'>".$meta['postobj_content_replace_post_'.$r]->post_title."</a></h4>";
                    $excerpt = '';
                    if(has_excerpt($id)) { $excerpt = "<p>".get_the_excerpt($id)."</p>"; }                    
                    $replace = "<div class='opendmo_replace'>".$title."</div>".$excerpt;
                    $news = str_replace($ta,$replace,$news);

                }

            }

        }

    }

    return $news;

}
    

function opendmo_content_after($content) {

    global $opendmo_global;
    $gpt = get_post_type($id);

    //This function loads the OpenDMO post info so it can only happen on plugin created posts

    if(in_array($gpt,$opendmo_global['cpt_names'])) { 

        $meta = $opendmo_global['postmeta'];

        $newcontent = opendmo_replace_content($content);

        opendmo_meta_css();

        foreach($opendmo_global['acfoutput'] as $o=>$h) { opendmo_add_meta("<div class='opendmo'>",$o); }
        foreach (glob($opendmo_global['path']."post/*.php") as $f) { include $f; }       
        foreach($opendmo_global['acfoutput'] as $out=>$hook) { opendmo_add_meta("</div>",$o); }

        $allafter = implode(array_slice($opendmo_global['acfoutput'], 1));
        $fullpost = $opendmo_global['acfoutput']['post-before'].$newcontent.$allafter;

        return $fullpost;

    }
    
    else { return $content; }

}

function opendmo_views_ajax() {

    if(is_singular()) {

        $uvajxv = array( 
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'uvid' => get_the_ID(),
            'uvact' => 'opendmo_odvacb',
        );

        wp_enqueue_script( 'opendmo-views-ajax-request', plugins_url().'/opendmo/js/views.js', array('jquery'), '1.0', true  );
        wp_localize_script( 'opendmo-views-ajax-request', 'ViewsAjax', $uvajxv );

    }

}

function opendmo_odvacb() {

    $odpuv = $_POST['puv'];
    if(!is_numeric($odpuv)) { $odpuv = 0; }

    if(metadata_exists('post',$odpuv,'_opendmo_viewcount')) {

        $odvc = get_post_meta($odpuv,'_opendmo_viewcount', true);
        update_post_meta( $odpuv, '_opendmo_viewcount', ($odvc+1), $odvc );

    }

    else{

        add_post_meta($odpuv, '_opendmo_viewcount', 1, true);

    }

}

function opendmo_clean_meta($id) { 
    
    global $opendmo_global;
    $gpt = get_post_type($id);

    //This function loads the OpenDMO post info so it can only happen on plugin created posts

    if(in_array($gpt,$opendmo_global['cpt_names'])) { 

        // get the custom fields set by ACF and remove any blank fields

        $infos = array_filter(get_fields($id));

        if(count($infos)>0) {

            //only process fields if there are any set for the post

            $info = array();
            foreach($infos as $in=>$fo) {

                //limit fields only to postmeta - this prefix is set in fields.php

                if(strpos($in, 'postmeta_opendmo')===0 && isset($fo)) {

                    //limit fields only to those that have a value set

                    if(count($fo) > 0) {

                        //remove the postmeta header in the new fields list

                        $newin = str_replace("postmeta_opendmo_","",$in);
                        $info = array_merge($info, array($newin=>$fo));

                        //if field is select then add a new meta entry 
                        //for the display name of the selected item

                        if(strpos($in, 'postmeta_opendmo_select')===0) {

                            $fin = get_field_object($in);
                            $fin = $fin['choices'][$fo];

                            $info = array_merge($info, array($newin."_display"=>$fin));

                        }


                    }

                }

            }

            //sort fields by type

            ksort($info);    
            return $info;

        }

    }

}

