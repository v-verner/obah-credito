<?php defined('ABSPATH') || exit(); 

add_action('acf/init', function () {
    acf_add_options_page([
        'page_title'    => 'Configurações do app',
        'menu_title'   => 'Obáh crédito',
        'menu_slug'    => 'vv-app-settings',
        'capability'   => 'edit_posts',
        'redirect'      => false
    ]);
});
