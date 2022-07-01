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

        return $results ? array_filter( array_map([$this, 'parseApiResult'], $results) ) : [];
    }

    private function parseApiResult( stdClass $result ): ?stdClass
    {
        if (!$this->env->isAvailableBank( $result->Titulo )) : 
            return null;
        endif;

        $result->Taxa_Nominal = isset($result->Taxa_Nominal) ? $this->parseToFloat( $result->Taxa_Nominal ) : 0;
        $result->CET = isset($result->CET) ? $this->parseToFloat( $result->CET ) : 0;
        $result->Valor_Primeira_Parcela = isset($result->Valor_Primeira_Parcela) ? $this->parseToFloat( $result->Valor_Primeira_Parcela ) : 0;
        $result->Valor_Ultima_Parcela = isset($result->Valor_Ultima_Parcela) ? $this->parseToFloat( $result->Valor_Ultima_Parcela ) : 0;
        $result->Valor_Maior_Parcela = isset($result->Valor_Maior_Parcela) ? $this->parseToFloat( $result->Valor_Maior_Parcela ) : 0;
        $result->Valor_Renda_Minima = isset($result->Valor_Renda_Minima) ? $this->parseToFloat( $result->Valor_Renda_Minima ) : 0;
        $result->Taxa_Incial = isset($result->Taxa_Incial) ? $this->parseToFloat( $result->Taxa_Incial ) : 0;
        $result->Tarifa_Mensal = isset($result->Tarifa_Mensal) ? $this->parseToFloat( $result->Tarifa_Mensal ) : 0;
        $result->id_simulacao = isset($result->id_simulacao) ? (int) $result->id_simulacao : 0;

        return $result;
    }

    private function parseToFloat( string $str ): float
    {
        $str = str_replace('.', '', $str);
        $str = str_replace(',', '.', $str);
        return (float) $str;
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
