<?php

add_action('plugins_loaded', 'opendmo_options_get');
add_action('plugins_loaded', 'opendmo_redirect_do');

add_action('init', 'opendmo_options_register');
add_action('init', 'opendmo_cpt_register');
add_action('init', 'opendmo_acf_load');

add_action('wp_enqueue_scripts', 'opendmo_views_ajax');
add_action('wp_ajax_odvacb', 'odvacb');
add_action('wp', 'opendmo_meta_load');
add_action('wp', 'opendmo_archive_load');

add_action('admin_menu','opendmo_admin_menu');
add_action('admin_head', 'opendmo_admin_head');

?>
