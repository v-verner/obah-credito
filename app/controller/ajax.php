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
    $now                = new DateTime();

    $full_name          = $_POST['full_name'] ? sanitize_text_field($_POST['full_name']) : '';
    $birthday           = $_POST['birthday'] ? sanitize_text_field($_POST['birthday']) : '';
    $cpf                = $_POST['cpf'] ? sanitize_text_field($_POST['cpf']) : '';
    $phone              = $_POST['phone'] ? sanitize_text_field($_POST['phone']) : '';
    $email              = $_POST['email'] ? sanitize_email($_POST['email']) : '';
    $gross_income       = $_POST['gross_income'] ? (float) $_POST['gross_income'] : 0;
    $has_second_buyer   = $_POST['has_second_buyer'] === 'Sim' ? true : false;
    $property_type      = $_POST['property_type'] ? sanitize_text_field($_POST['property_type']) : '';
    $property_price     = $_POST['property_price'] ? (float) $_POST['property_price'] : 0;
    $property_location  = $_POST['property_location'] ? sanitize_text_field($_POST['property_location']) : '';
    $property_condition = $_POST['property_condition'] ? sanitize_text_field($_POST['property_condition']) : '';
    $initial_payment    = $_POST['initial_payment'] ? (float) $_POST['initial_payment'] : 0;
    $include_itbi_fee   = $_POST['include_itbi_fee'] ? sanitize_text_field($_POST['include_itbi_fee']) : '';
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

    // NOTE
    // Ao finalizar a simulação, salvar ela no post-type "simulation" e retornar no ajax o ID dela futuras atualizações (saveSimulation())

    // TODO
    // 1 - gerar simulação no 99cred
    // 2 - enviar lead para o bitrix (aguardar)
    // 3 - salvar simulação
    // 4 - gerar hash (base64_encode) do ID da simulação salva
    // 5 - retornar url da página "simulador" com o hash gerado 
        // 5.1 - criar rewrite para hashes no simulador


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

    error_log(print_r($simulation, true));


    $result = $simulation->simulate();

    error_log(print_r($result, true));

    wp_send_json_success('Tudo bem, simulação feita!');
}

add_action('wp_ajax_obah/update_simulation', 'ajaxUpdateSimulation');
add_action('wp_ajax_nopriv_obah/update_simulation', 'ajaxUpdateSimulation');
function ajaxUpdateSimulation(): void
{
    check_ajax_referer('obah/update_simulation');

    // NOTE
    // Carregar os dados da simulação anterior para uso na simulação (loadSimulation())
    // Ao finalizar a simulação, salvar o novo resultado nela (saveSimulationResults())


    wp_send_json_success();
}
