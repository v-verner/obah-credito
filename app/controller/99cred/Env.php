<?php 

namespace Cred99;

use stdClass;

defined('ABSPATH') || exit();

class Env
{
    private $apiEnv;
    private $apiKey;
    private $apiAvailableBanks;

    public function __construct()
    {
        if (function_exists('get_field')) : 
            $this->apiEnv = get_field('99cred_api_env', 'option');
            $this->apiKey = get_field('99cred_api_key', 'option');

            $banks = get_field('99cred_api_available_banks', 'option') ?? '';
            $banks = array_map('sanitize_title', explode(',', $banks));

            $this->apiAvailableBanks = $banks;
        else :
            $this->apiEnv = null;
            $this->apiKey = null;
            $this->apiAvailableBanks = null;
        endif;
    }

    public function isInSandboxMode(): bool
    {
        return $this->getApiEnv() === 'sandbox';
    }

    public function isAvailableBank(string $bankName): bool
    {
        if (!$this->getApiAvailableBanks()) : 
            return false;
        endif;

        $bankName       = sanitize_title($bankName);
        $isAvailable    = false;
        foreach ( $this->getApiAvailableBanks() as $key ) : 
            $isAvailable = strpos($bankName, $key) !== false;
            if ($isAvailable) : 
                break;
            endif;
        endforeach;

        return $isAvailable;

    }

    public function getApiEnv(): ?string
    {
        return $this->apiEnv;
    }

    public function getApiKey(): ?string
    {
        return $this->apiKey;
    }

    public function getApiAvailableBanks(): ?array
    {
        return $this->apiAvailableBanks;
    }

    public function getBrazilianStates(): array
    {
        return [
            $this->getSimpleObject(1, 'Acre'),
            $this->getSimpleObject(2, 'Alagoas'),
            $this->getSimpleObject(3, 'Amapá'),
            $this->getSimpleObject(4, 'Amazonas'),
            $this->getSimpleObject(5, 'Bahia'),
            $this->getSimpleObject(6, 'Ceará'),
            $this->getSimpleObject(7, 'Distrito Federal'),
            $this->getSimpleObject(8, 'Espírito Santo'),
            $this->getSimpleObject(9, 'Goiás'),
            $this->getSimpleObject(10, 'Maranhão'),
            $this->getSimpleObject(11, 'Mato Grosso'),
            $this->getSimpleObject(12, 'Mato Grosso do Sul'),
            $this->getSimpleObject(13, 'Minas Gerais'),
            $this->getSimpleObject(14, 'Pará'),
            $this->getSimpleObject(15, 'Paraíba'),
            $this->getSimpleObject(16, 'Paraná'),
            $this->getSimpleObject(17, 'Pernambuco'),
            $this->getSimpleObject(18, 'Piauí'),
            $this->getSimpleObject(19, 'Rio de Janeiro'),
            $this->getSimpleObject(20, 'Rio Grande do Norte'),
            $this->getSimpleObject(21, 'Rio Grande do Sul'),
            $this->getSimpleObject(22, 'Rondônia'),
            $this->getSimpleObject(23, 'Roraima'),
            $this->getSimpleObject(24, 'Santa Catarina'),
            $this->getSimpleObject(25, 'São Paulo'),
            $this->getSimpleObject(26, 'Sergipe'),
            $this->getSimpleObject(27, 'Tocantins')
        ];
    }
    
    public function getUsageProfile(): array
    {
        return [
            $this->getSimpleObject(1, 'Residencial'),
            $this->getSimpleObject(2, 'Comercial'),
            $this->getSimpleObject(3, 'Veraneio')
        ];
    }
    
    public function getPropertyCondition(): array
    {
        return [
            $this->getSimpleObject(1, 'Novo'),
            $this->getSimpleObject(2, 'Usado'),
            $this->getSimpleObject(3, 'Terreno'),
            $this->getSimpleObject(4, 'Em Construção'),
            $this->getSimpleObject(5, 'Reforma'),
            $this->getSimpleObject(6, 'Ampliação'),
            $this->getSimpleObject(7, 'Dinheiro com seu Imóvel')
        ];
    }

    public function parseApiResult( stdClass $result ): ?stdClass
    {
        if (!$this->isAvailableBank( $result->Titulo )) : 
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
        $str = str_replace('.', ',', $str);
        $str = str_replace(',', '.', $str);
        return (float) $str;
    }

    private function getSimpleObject(int $id, string $name): stdClass
    {
        return (object) [
            'id' => $id,
            'name' => $name
        ];
    }
}
