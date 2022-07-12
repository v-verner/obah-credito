<?php defined('ABSPATH') || exit;

add_action('wp_ajax_obah/create_simulation', 'ajaxCreateSimulation');
add_action('wp_ajax_nopriv_obah/create_simulation', 'ajaxCreateSimulation');
function ajaxCreateSimulation(): void
{
    check_ajax_referer('obah/create_simulation');

    if (!$_POST['accept_terms'] && !$_POST['accept_lgpd']) :
        wp_send_json_error('Os termos e a LGPD do site precisam ser aceitos.');
    endif;

    $simulation         = new Cred99\Simulation();
    $api                = new Cred99\API();
    $now                = new DateTime();

    $full_name          = $_POST['full_name'] ? sanitize_text_field($_POST['full_name']) : '';
    $birthday           = $_POST['birthday'] ? sanitize_text_field($_POST['birthday']) : '';
    $cpf                = $_POST['cpf'] ? sanitize_text_field($_POST['cpf']) : '';
    $phone              = $_POST['phone'] ? sanitize_text_field($_POST['phone']) : '';
    $email              = $_POST['email'] ? sanitize_email($_POST['email']) : '';
    $gross_income       = $_POST['gross_income'] ? $api::parseToFloat($_POST['gross_income']) : 0;
    $has_second_buyer   = $_POST['has_second_buyer'] === 'Sim' ? true : false;
    $property_type      = $_POST['property_type'] ? sanitize_text_field($_POST['property_type']) : '';
    $property_price     = $_POST['property_price'] ? $api::parseToFloat($_POST['property_price']) : 0;
    $property_location  = $_POST['property_location'] ? (int) $_POST['property_location'] : '';
    $property_condition = $_POST['property_condition'] ? sanitize_text_field($_POST['property_condition']) : '';
    $initial_payment    = $_POST['initial_payment'] ? $api::parseToFloat($_POST['initial_payment']) : 0;
    // $include_itbi_fee   = $_POST['include_itbi_fee'] ? sanitize_text_field($_POST['include_itbi_fee']) : '';
    $payment_length     = $_POST['payment_length'] ? (int) $_POST['payment_length'] : 0;

    if ($has_second_buyer) :
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

    $simulationHash = createSimulationHash($simulationID);

    saveSimulationHash($simulationHash, $simulationID);
    saveSimulationResults($simulationID, $result);

    $url  = trailingslashit(get_permalink(getObahPageId('Simulador')));
    $url .= $simulationHash;

    wp_send_json_success($url);
}

add_action('wp_ajax_obah/update_simulation', 'ajaxUpdateSimulation');
add_action('wp_ajax_nopriv_obah/update_simulation', 'ajaxUpdateSimulation');
function ajaxUpdateSimulation(): void
{
    check_ajax_referer('obah/update_simulation');

    $api             = new Cred99\API();
    $simulationURL   = explode('/', trailingslashit($_POST['_wp_http_referer']));
    $simulationHash  = array_reverse($simulationURL)[1];
    $simulationID    = getSimulationIdByHash($simulationHash);
    $simulation      = getSimulationByHash($simulationHash);

    if (!$simulation) :
        wp_send_json_error('Você precisa de uma simulação para atualizar.');
    endif;

    $birthday        = $_POST['birthday'] ? sanitize_text_field($_POST['birthday']) : '';
    $property_price  = $_POST['property_price'] ? $api::parseToFloat($_POST['property_price']) : 0;
    $initial_payment = $_POST['initial_payment'] ? $api::parseToFloat($_POST['initial_payment']) : 0;
    $payment_length  = $_POST['payment_length'] ? (int) $_POST['payment_length'] : 0;

    if ($birthday) :
        // ATUALIZAR A MB DE BIRTHDAY
    endif;

    if ($property_price) :
        $simulation->set('valor', $property_price);
    endif;

    if ($initial_payment) :
        $simulation->set('valor_financ', $property_price - $initial_payment);
    endif;

    if ($payment_length) :
        $simulation->set('prazo', $payment_length);
    endif;

    $result = $simulation->simulate();

    if (is_wp_error($result)) :
        wp_send_json_error('As informações não batem, por favor tente novamente.');
    endif;

    saveSimulationResults($simulationID, $result);
    
    // NOTE
    // Carregar os dados da simulação anterior para uso na simulação (loadSimulation())
    // Ao finalizar a simulação, salvar o novo resultado nela (saveSimulationResults())


    wp_send_json_success();
}