<?php defined('ABSPATH') || exit('No direct script access allowed');

// REWRITE
add_action('init', function() {
    $ID     = getObahPageId('Simulador');
    $data   = $ID ? get_post( $ID ) : null;

    if ($data) : 
        add_rewrite_rule(
            $data->post_name . '/([A-Z0-9-]+)[/]?$',
            'index.php?pagename=' . $data->post_name . '&simulation_hash=$matches[1]',
            'top'
        );
    endif;
});

add_filter('query_vars', function($vars) {
    $vars[] = 'simulation_hash';
    return $vars;
});

add_action('template_redirect', function(){
    global $wp_query, $currentSimulation, $currentSimulationId;

    $hash = get_query_var('simulation_hash');
    if (!$hash) :
        return;
    endif;

    $simulation = getSimulationByHash($hash);

    if (!$simulation) :
        $wp_query->set_404();
    endif;

    $currentSimulation = $simulation;
    $currentSimulationId = getSimulationIdByHash($hash);
});
