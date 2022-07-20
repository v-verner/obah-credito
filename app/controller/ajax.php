<?php defined('ABSPATH') || exit;

add_action('wp_ajax_obah/create_simulation', 'ajaxCreateSimulation');
add_action('wp_ajax_nopriv_obah/create_simulation', 'ajaxCreateSimulation');
function ajaxCreateSimulation(): void
{
    check_ajax_referer('obah/create_simulation');

    if (!isset($_POST['accept_terms']) && !isset($_POST['accept_lgpd'])) :
        wp_send_json_error('Os termos e a LGPD do site precisam ser aceitos.');
    endif;

    do_action('obah/create_lead', $_POST);

    $simulation         = new Cred99\Simulation();
    $api                = new Cred99\API();
    $now                = new DateTime();

    $full_name          = isset($_POST['full_name']) ? sanitize_text_field($_POST['full_name']) : '';
    $birthday           = isset($_POST['birthday']) ? sanitize_text_field($_POST['birthday']) : '';
    $cpf                = isset($_POST['cpf']) ? sanitize_text_field($_POST['cpf']) : '';
    $phone              = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
    $email              = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $gross_income       = isset($_POST['gross_income']) ? $api::parseToFloat($_POST['gross_income']) : 0;
    $has_second_buyer   = isset($_POST['has_second_buyer']) === 'Sim' ? 'Sim' : 'Não';
    $property_type      = isset($_POST['property_type']) ? sanitize_text_field($_POST['property_type']) : '';
    $property_price     = isset($_POST['property_price']) ? $api::parseToFloat($_POST['property_price']) : 0;
    $property_location  = isset($_POST['property_location']) ? (int) $_POST['property_location'] : '';
    $property_condition = isset($_POST['property_condition']) ? sanitize_text_field($_POST['property_condition']) : '';
    $initial_payment    = isset($_POST['initial_payment']) ? $api::parseToFloat($_POST['initial_payment']) : 0;
    $include_itbi_fee   = isset($_POST['include_itbi_fee']) ? 'Sim' : 'Não';
    $payment_length     = isset($_POST['payment_length']) ? (int) $_POST['payment_length'] : 0;
    $amortization_type  = isset($_POST['amortization_type']) ? sanitize_text_field($_POST['amortization_type']) : '';

    if ($has_second_buyer === 'Sim') :
        $second_buyer_full_name = $_POST['second_buyer_full_name'] ? sanitize_text_field($_POST['second_buyer_full_name']) : '';
        $second_buyer_birthday  = $_POST['second_buyer_birthday'] ? sanitize_text_field($_POST['second_buyer_birthday']) : '';
        $second_buyer_cpf       = $_POST['second_buyer_cpf'] ? sanitize_text_field($_POST['second_buyer_cpf']) : '';
        $second_buyer_phone     = $_POST['second_buyer_phone'] ? sanitize_text_field($_POST['second_buyer_phone']) : '';
        $second_buyer_email     = $_POST['second_buyer_email'] ? sanitize_email($_POST['second_buyer_email']) : '';

        $second_buyer_birthdate = new DateTime($second_buyer_birthday);
        $second_buyer_age       = $now->format('Y') - $second_buyer_birthdate->format('Y');
    endif;

    $birthdate = new DateTime($birthday);
    $age       = $now->format('Y') - $birthdate->format('Y');

    $simulation->set('uf', $property_location);
    $simulation->set('perfil', $property_type);
    $simulation->set('condicao', $property_condition);
    $simulation->set('idade', $age);
    $simulation->set('valor', $property_price);
    $simulation->set('valor_financ', $property_price - $initial_payment);
    $simulation->set('prazo', $payment_length);
    $simulation->set('nome', $full_name);
    $simulation->set('fone', preg_replace('/\D/', '', $phone));
    $simulation->set('email', $email);

    $result    = $simulation->simulate();

    if (is_wp_error($result)) :
        wp_send_json_error($result->get_error_message());
    endif;

    $simulationID   = saveSimulation($simulation);

    if (isset($_POST['accept_terms']) && isset($_POST['accept_lgpd'])) :
        update_post_meta($simulationID, 'terms_acceptance', 'Sim');
        update_post_meta($simulationID, 'lgpd_acceptance', 'Sim');
    endif;

    update_post_meta($simulationID, 'cpf', $cpf);
    update_post_meta($simulationID, 'birthday', $birthday);
    update_post_meta($simulationID, 'gross_income', $gross_income);
    update_post_meta($simulationID, 'include_itbi_fee', $include_itbi_fee);
    update_post_meta($simulationID, 'has-second_buyer', $has_second_buyer);
    update_post_meta($simulationID, 'amortization_type', $amortization_type);

    if ($has_second_buyer === 'Sim') :
        update_post_meta($simulationID, 'second_buyer-name', $second_buyer_full_name);
        update_post_meta($simulationID, 'second_buyer-cpf', $second_buyer_cpf);
        update_post_meta($simulationID, 'second_buyer-phone', $second_buyer_phone);
        update_post_meta($simulationID, 'second_buyer-email', $second_buyer_email);
        update_post_meta($simulationID, 'second_buyer-age', $second_buyer_age);
    endif;

    $simulationHash = createSimulationHash($simulationID);

    saveSimulationHash($simulationHash, $simulationID);
    saveSimulationResults($simulationID, $result);

    $url  = trailingslashit(get_permalink(getObahPageId('Simulador')));
    $url .= $simulationHash;

    // TODO FUTURE
    // CRIAR ALGUM MODO DE SALVAR O LINK DA SIMULAÇÃO

    wp_send_json_success($url);
}

add_action('wp_ajax_obah/update_simulation', 'ajaxUpdateSimulation');
add_action('wp_ajax_nopriv_obah/update_simulation', 'ajaxUpdateSimulation');
function ajaxUpdateSimulation(): void
{
    check_ajax_referer('obah/update_simulation');

    global $currentSimulation, $currentSimulationId;

    $api             = new Cred99\API();
    $env             = new Cred99\Env();
    $simulationURL   = explode('/', trailingslashit($_POST['_wp_http_referer']));
    $simulationHash  = array_reverse($simulationURL)[1];
    $currentSimulationId    = getSimulationIdByHash($simulationHash);
    $currentSimulation      = getSimulationByHash($simulationHash);

    if (!$currentSimulation) :
        wp_send_json_error('Você precisa de uma simulação para atualizar.');
    endif;

    $birthday         = isset($_POST['birthday']) ? sanitize_text_field($_POST['birthday']) : '';
    $property_price   = isset($_POST['property_price']) ? $api::parseToFloat($_POST['property_price']) : 0;
    $initial_payment  = isset($_POST['initial_payment']) ? $api::parseToFloat($_POST['initial_payment']) : 0;
    $payment_length   = isset($_POST['payment_length']) ? (int) $_POST['payment_length'] : 0;
    $include_itbi_fee = isset($_POST['include_itbi_fee']) ? 'Sim' : 'Não';

    if ($birthday) :
        update_post_meta($currentSimulationId, 'birthday', $birthday);
    endif;

    if ($property_price) :
        $currentSimulation->set('valor', $property_price);
    endif;

    if ($include_itbi_fee) :
        update_post_meta($currentSimulationId, 'include_itbi_fee', $include_itbi_fee);
    endif;

    if ($initial_payment) :
        $calc = $property_price - $initial_payment;

        if ($calc >= $env->getMinimumSimulationAmount() && $calc <= $env->getMaximumSimulationAmount() && $property_price > $calc) :
            $currentSimulation->set('valor_financ', $calc);
        else :
            wp_send_json_error('A sua simulação está imcompatível com nossa regra. Por favor, verifique seus dados.');
        endif;

    endif;

    if ($payment_length) :
        $currentSimulation->set('prazo', $payment_length);
    endif;

    $result = $currentSimulation->simulate();

    if (is_wp_error($result)) :
        wp_send_json_error('As informações não batem, por favor tente novamente.');
    endif;

    saveSimulationResults($currentSimulationId, $result);

    ob_start();
    VVerner\Views::getInstance()->getComponent('form_simulation_table', ['simulation_results' => $result]);

    wp_send_json_success(ob_get_clean());
}