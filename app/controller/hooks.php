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
    if (get_the_ID() === getObahPageId('Simulador')) :
        global $wp_query, $currentSimulation, $currentSimulationId;

        $hash = get_query_var('simulation_hash');
        if (!$hash) :
            $wp_query->set_404();
        endif;

        $simulation = getSimulationByHash($hash);

        if (!$simulation) :
            $wp_query->set_404();
        endif;

        $currentSimulation = $simulation;
        $currentSimulationId = getSimulationIdByHash($hash);
    endif;
});

add_action('obah/create_lead', function ($data){

    $cred99 = new Cred99\Env();

    $data['has_second_buyer'] === 'Não' ? '160' : '158';

    // LOCATION
    $stateId = (int) $data['property_location'];
    foreach ($cred99->getBrazilianStates() as $item) :
        if ($item->id === $stateId) : 
            $data['property_location'] = $item->name;
            break;
        endif;
    endforeach;

    // CONDITION
    $conditionId = (int) $data['property_type'];
    foreach ($cred99->getPropertyConditions() as $item) :
        if ($item->id === $conditionId) : 
            $data['property_condition'] = $item->name;
            break;
        endif;
    endforeach;

    // USAGE
    $usageId = (int) $data['property_type'];
    foreach ($cred99->getUsageProfile() as $item) :
        if ($item->id === $usageId) : 
            $data['property_type'] = $item->name;
            break;
        endif;
    endforeach;

    $property_price     = isset($data['property_price']) ? Cred99\API::parseToFloat($data['property_price']) : 0;
    $initial_payment    = isset($data['initial_payment']) ? Cred99\API::parseToFloat($data['initial_payment']) : 0;
    $data['_opportunity_price'] = $property_price - $initial_payment;

    $api = new Bitrix\API();
    $response = $api->insertLead( $data );
});