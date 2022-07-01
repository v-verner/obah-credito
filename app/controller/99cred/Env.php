<?php 

namespace Cred99;

use stdClass;

defined('ABSPATH') || exit();

class Env
{
    private $apiEnv;
    private $apiKey;
    private $apiAvailableBanks;
    private $minAge;
    private $maxAge;
    private $minDuration;
    private $maxDuration;

    public function __construct()
    {
        $this->apiEnv = $this->getOption('env');
        $this->apiKey = $this->getOption('key');
        $this->minAge = (int) $this->getOption('min_age');
        $this->maxAge = (int) $this->getOption('max_age');
        $this->minDuration = (int) $this->getOption('min_duration');
        $this->maxDuration = (int) $this->getOption('max_duration');

        $banks = $this->getOption('available_banks');
        $banks = array_map('sanitize_title', explode(',', $banks));

        $this->apiAvailableBanks = $banks;
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

    public function getMinimumAgeForSimulation(): int
    {
        return $this->minAge;
    }

    public function getMaximumAgeForSimulation(): int
    {
        return $this->maxAge;
    }

    public function getMinimumSimulationDuration(): int
    {
        return $this->minDuration;
    }

    public function getMaximumSimulationDuration(): int
    {
        return $this->maxDuration;
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

    private function getOption(string $prop)
    {
        return function_exists('get_field') ? get_field('99cred_api_' . $prop, 'option') : null;
    }

    private function getSimpleObject(int $id, string $name): stdClass
    {
        return (object) [
            'id' => $id,
            'name' => $name
        ];
    }
}
