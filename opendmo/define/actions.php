<?php

add_action('plugins_loaded', 'opendmo_get_options');
add_action('init', 'opendmo_register_options');
add_action('init', 'opendmo_register_cpt');
add_action('init', 'opendmo_acf_load');
add_action('wp_loaded', 'opendmo_cpt_load');
add_action('wp', 'opendmo_load_meta');
add_action('admin_menu','opendmo_admin_menu');
add_action('admin_head', 'opendmo_admin_head');

?>
