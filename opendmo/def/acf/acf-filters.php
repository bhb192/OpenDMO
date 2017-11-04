<?php


$venuequeryi = 0;

function myAcfFilters() {

    function venue_query( $args, $field, $post_id ) {

        global $opendmo_cpt_names;
        global $venuequeryi;
        $thecptname = $opendmo_cpt_names[$venuequeryi];
	
         $args = array(
        'post_type'		=> $thecptname,
        'meta_query'		=> array(
	        array(
		        'key' => 'is_venue',
		        'value' => '1',
		        'compare' => '=='
		        )
	        )
        );

        $venuequeryi++;
        return $args;


    }

    add_filter('acf/fields/post_object/query/name=opendmo_evs', 'venue_query', 10, 3);

}

function acf_content_after($content) {

    $acfoutput = '';
    $infos = get_fields($post->ID);
    include('acf-post-meta-location.php');
    include('acf-post-meta-links.php');
    include('acf-post-meta-social.php');

    $fullcontent = $content . $acfoutput;
    return $fullcontent;

}

//add_filter('the_content', 'acf_content_after');


add_action('plugins_loaded', 'myAcfFilters');



?>
