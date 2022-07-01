<?php 

namespace Cred99;

use stdClass;

defined('ABSPATH') || exit();

class API
{
    private $env;

    public function __construct()
    {
        $this->env = new Env();
    }

    public function getSimulationResult( array $simulation ): array
    {
        $qs      = http_build_query($simulation);
        $url     = $this->getApiUrl() . $qs;
        $results = $this->fetch('GET', $url);

        return $results ? array_filter( array_map([$this->env, 'parseApiResult'], $results) ) : [];
    }

    private function fetch(string $method, string $url): ?array
    {
        $request = wp_remote_request($url, [
            'method'    => strtoupper($method),
            'sslverify' => false
        ]);

        if (is_wp_error($request)) : 
            return null;
        endif;

        $response = wp_remote_retrieve_body( $request );
        $response = $response ? json_decode($response) : [];

        return is_array($response) ? $response : [];
    }

    private function getApiUrl(): string
    {
        return $this->env->isInSandboxMode() ?
                'http://99credfront.web203.uni5.net/simulador/api_simule/' : 
                'https://99cred.com.br/simulador/api_simule/' ;
    }
}
