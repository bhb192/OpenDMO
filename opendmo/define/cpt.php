<?php

function opendmo_cpt_register() {

    global $opendmo_global;

    foreach($opendmo_global['cpt_names'] as $c) {

        $t = ucfirst($c);
        $single = $c;
        if(substr($single, -1) == "s") { $single = substr($single,0,(strlen($single)-1)); }

        register_post_type($c, array(

           'labels'  => array(

               'name'           => __($c),
               'singular_name'  => __($t),
               'menu_name'      => $t,
		       'edit_item'      => "Edit this $single",

           ),

           'public'      => true,
           'has_archive' => true,
           'show_in_menu'=>'opendmo-settings',



       ));

        add_post_type_support( $c, 'thumbnail' );

    }

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


?>
