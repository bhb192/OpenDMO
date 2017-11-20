<?php

function opendmo_cpt_register() {

    global $opendmo_global;

    foreach($opendmo_global['cpt_names'] as $c) {

        $t = ucfirst($c);
        $single = ucfirst(makesingular($c));
        $editstr = "Edit $single Post";
        if(is_admin()) { $editstr = "Editing $single Post"; }

        register_post_type($c, array(

           'labels'  => array(

               'name'           => $c,
               'singular_name'  => ucfirst(makesingular($c)),
               'menu_name'      => $t,
		       'edit_item'      => $editstr,
               'archives'       => "All ".makeplural($c),
                'add_new_item'       => "Add New ".$single,

           ),

           'label'       => $t,
           'public'      => true,
           'has_archive' => true,
           'show_in_menu'=>'opendmo-settings',



       ));

        add_post_type_support( $c, 'thumbnail' );
        flush_rewrite_rules();

    }

    add_filter( 'pre_get_posts', 'opendmo_cpt_addhome' );
    add_action( 'add_meta_boxes', 'opendmo_cpt_excerpt' );

    //safeout("register cpt done");

}

function opendmo_cpt_load() {

    global $cpt_onomies_manager;
    global $opendmo_global;

    if ( $cpt_onomies_manager ) {
      
        foreach($opendmo_global['cpt_names'] as $od_cpt) {

            $cpt_onomies_manager->register_cpt_onomy( 

                $od_cpt, 
                $opendmo_global['cpt_names'], 
                array('restrict_user_capabilities' => array( 

                    'administrator', 'editor', 'author' 

                ))

            );

        }

    }

    //safeout("cpt load done");

}

function opendmo_cpt_excerpt ( $post_type ) {

    global $opendmo_global;

    if ( in_array( $post_type, $opendmo_global['cpt_names'] ) ) {

        add_meta_box(

            'oz_postexcerpt',
            'Excerpt',
            'post_excerpt_meta_box',
            $post_type,
            'side',
            'low'

        );

    }

}

function opendmo_cpt_addhome( $query ) {

    global $opendmo_global;

    if ( is_home() && $query->is_main_query() )
    $query->set( 'post_type', array_merge(array('post'),$opendmo_global['cpt_names']) );
    return $query;

}


?>
