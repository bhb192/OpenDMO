<?php

function opendmo_custom_post_type()
{
    global $opendmo_cpt_names;

    foreach($opendmo_cpt_names as $od_cpt) {

        $cptsingle = ucfirst($od_cpt);

        register_post_type($od_cpt, [

           'labels'      => [

               'name'          => __($od_cpt),
               'singular_name' => __($cptsingle),
                'menu_name'=>   $cptsingle,
		        'edit_item'          => "Edit $cptsingle",

           ],

           'public'      => true,
           'has_archive' => true,
            'show_in_menu'=>'opendmo-settings',


       ]);

        add_post_type_support( $od_cpt, 'excerpt' );
        add_post_type_support( $od_cpt, 'thumbnail' );

    }

}

function opendmo_register_cpt_onomy() {

   global $cpt_onomies_manager;
   if ( $cpt_onomies_manager ) {
      
        global $opendmo_cpt_names;

        foreach($opendmo_cpt_names as $od_cpt) {

            $cpt_onomies_manager->register_cpt_onomy( 

                $od_cpt, 
                $opendmo_cpt_names, 
                array( 

                    'restrict_user_capabilities' => array( 

                        'administrator', 'editor', 'author' 

                    ) 
                )

            );

        }

   }

}

add_action('init', 'opendmo_custom_post_type');
add_action( 'wp_loaded', 'opendmo_register_cpt_onomy' );

?>
