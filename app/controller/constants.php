<?php defined('ABSPATH') || exit;

// PAGES
define('OBAH_PAGES', [
    'Home',
    'Simulador',
    'Formulário'
]);

// 99
define('OBAH_PAGE_META_KEY', '_obah-page'); 
define('OBAH_99_META_KEY_PREFIX', '_obah_99_api-'); 

// BITRIX
define('C_REST_IGNORE_SSL',true);
define('C_REST_BLOCK_LOG', true);
define('C_REST_WEB_HOOK_URL', get_option('options_bitrix24_api_webhook_url'));

// CAMPOS SIMULAÇÃO
define('OBAH_SIMULATOR_FIELDS', [
    'full_name'              => 'Nome completo',
    'birthday'               => 'Data de nascimento',
    'cpf'                    => 'CPF',
    'phone'                  => 'Telefone',
    'email'                  => 'E-mail',
    'gross_income'           => 'Renda Bruta',
    'has_second_buyer'       => 'Tem segundo comprador',
    'second_buyer_full_name' => 'Nome do segundo comprador',
    'second_buyer_birthday'  => 'Data de nascimento do segundo comprador',
    'second_buyer_cpf'       => 'CPF do segundo comprador',
    'second_buyer_phone'     => 'Telefone do segundo comprador',
    'second_buyer_email'     => 'E-mail do segundo comprador',
    'property_type'          => 'Tipo de imóvel',
    'property_price'         => 'Valor do imóvel',
    'property_location'      => 'Local do imóvel',
    'property_condition'     => 'Condição do imóvel',
    'initial_payment'        => 'Valor da entrada',
    'include_itbi_fee'       => 'Incluir despesas com tarifas (ITBI)',
    'payment_length'         => 'Prazo',
    'accept_terms'           => 'Aceite de termos do site',
    'accept_lgpd'            => 'Aceite de LGPD',
    '_opportunity_price'     => 'Valor financiado'
]);

// SIMULAÇÂO
define('SIMULATION_HASH_KEY', 'simulation_hash');
define('SIMULATION_BANKS_ORDER', [
    0  => 'ITAU ',
    10 => 'SANTANDER',
    20 => 'BRADESCO',
    30 => 'CAIXA',
]);

// ENV
define('OBAH_DEV', strpos($_SERVER['SERVER_NAME'], '.dev') !== false);
