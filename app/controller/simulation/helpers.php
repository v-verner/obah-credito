<?php defined('ABSPATH') || exit;

function saveSimulation( Cred99\Simulation $simulation ): int
{
    return wp_insert_post([
        'post_title'    => $simulation->get('nome') ?? 'Anônimo',
        'post_type'     => 'simulation',
        'post_status'   => 'publish',
        'meta_input'    =>  [
            OBAH_99_META_KEY_PREFIX . 'uf'              => $simulation->get('uf'),
            OBAH_99_META_KEY_PREFIX . 'perfil'          => $simulation->get('perfil'),
            OBAH_99_META_KEY_PREFIX . 'condicao'        => $simulation->get('condicao'),
            OBAH_99_META_KEY_PREFIX . 'idade'           => $simulation->get('idade'),
            OBAH_99_META_KEY_PREFIX . 'valor'           => $simulation->get('valor'),
            OBAH_99_META_KEY_PREFIX . 'valor_financ'    => $simulation->get('valor_financ'),
            OBAH_99_META_KEY_PREFIX . 'prazo'           => $simulation->get('prazo'),
            OBAH_99_META_KEY_PREFIX . 'nome'            => $simulation->get('nome'),
            OBAH_99_META_KEY_PREFIX . 'fone'            => $simulation->get('fone'),
            OBAH_99_META_KEY_PREFIX . 'email'           => $simulation->get('email')
        ]
    ]);
}

function saveSimulationResults( int $simulationId, array $results )
{
    add_post_meta($simulationId, OBAH_99_META_KEY_PREFIX . 'resultados', $results);
}

function loadSimulation( int $simulationId ): Cred99\Simulation
{
    $simulation = new Cred99\Simulation();

    $simulation->set('uf', get_post_meta( $simulationId, OBAH_99_META_KEY_PREFIX . 'uf', true ) );
    $simulation->set('perfil', get_post_meta( $simulationId, OBAH_99_META_KEY_PREFIX . 'perfil', true ) );
    $simulation->set('condicao', get_post_meta( $simulationId, OBAH_99_META_KEY_PREFIX . 'condicao', true ) );
    $simulation->set('idade', get_post_meta( $simulationId, OBAH_99_META_KEY_PREFIX . 'idade', true ) );
    $simulation->set('valor', get_post_meta( $simulationId, OBAH_99_META_KEY_PREFIX . 'valor', true ) );
    $simulation->set('valor_financ', get_post_meta( $simulationId, OBAH_99_META_KEY_PREFIX . 'valor_financ', true ) );
    $simulation->set('prazo', get_post_meta( $simulationId, OBAH_99_META_KEY_PREFIX . 'prazo', true ) );
    $simulation->set('nome', get_post_meta( $simulationId, OBAH_99_META_KEY_PREFIX . 'nome', true ) );
    $simulation->set('fone', get_post_meta( $simulationId, OBAH_99_META_KEY_PREFIX . 'fone', true ) );
    $simulation->set('email', get_post_meta( $simulationId, OBAH_99_META_KEY_PREFIX . 'email', true ) );

    return $simulation;
}

function getSimulationStoredResults( int $simulationId ): array
{
    return get_post_meta($simulationId, OBAH_99_META_KEY_PREFIX . 'resultados');
}
