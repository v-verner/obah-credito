<?php defined('ABSPATH') || exit;

add_action('wp_ajax_obah/create_simulation', 'ajaxCreateSimulation');
add_action('wp_ajax_nopriv_obah/create_simulation', 'ajaxCreateSimulation');
function ajaxCreateSimulation(): void
{
    check_ajax_referer('obah/create_simulation');

    // NOTE
    // Ao finalizar a simulação, salvar ela no post-type "simulation" e retornar no ajax o ID dela futuras atualizações (saveSimulation())

    // TODO
    // 1 gerar simulação no 99cred
    // 2 enviar lead para o bitrix (aguardar)
    // 3 salvar simulação
    // 4 gerar hash (base64_encode) do ID da simulação salva
    // 5 retornar url da página "simulador" com o hash gerado 
    //     5.1 criar rewrite para hashes no simulador



    wp_send_json_success();
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
