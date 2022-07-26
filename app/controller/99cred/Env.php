<?php 

namespace Cred99;

use DateTime;
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
    private $durationStep;

    private $itbiFee;

    private $minAmount;
    private $maxAmount;
    private $minInitialPaymentRatio;

    public function __construct()
    {
        $this->apiEnv = $this->getOption('env');
        $this->apiKey = $this->getOption('key');
        $this->minAge = (int) $this->getOption('min_age');
        $this->maxAge = (int) $this->getOption('max_age');
        $this->minAmount = (int) $this->getOption('min_amount');
        $this->maxAmount = (int) $this->getOption('max_amount');
        $this->minDuration  = (int) $this->getOption('min_duration');
        $this->maxDuration  = (int) $this->getOption('max_duration');
        $this->durationStep = (int) $this->getOption('duration_step');
        $this->itbiFee      = $this->getOption('itbi_fee') / 100;
        $this->minInitialPaymentRatio = $this->getOption('min_initial_payment') / 100;

        $banks = $this->getOption('available_banks');
        $banks = array_map('trim', explode(',', $banks));

        $this->apiAvailableBanks = $banks;
    }

    public function toPublicArray(): array
    {
        $props = get_object_vars( $this );

        unset(
            $props['apiEnv'],
            $props['apiKey'],
            $props['apiAvailableBanks'],
        );

        return $props;
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

        $bankName    = trim($bankName);
        $isAvailable = false;

        foreach ( $this->getApiAvailableBanks() as $key ) : 
            $isBankAvailable = strpos($bankName, $key) !== false;
            $hasStopWord     = strpos('poupan', $key) !== false;

            if ($isBankAvailable && !$hasStopWord) : 
                $isAvailable = true;
                break;
            endif;
        endforeach;

        return $isAvailable;

    }

    public function getMinimumBirthdayDate(): DateTime
    {
        $date = new DateTime( current_time('Y-m-d') );
        $date->modify('- '. $this->getMinimumAgeForSimulation() .' years');
        return $date;
    }

    public function getMaximumBirthdayDate(): DateTime
    {
        $date = new DateTime( current_time('Y-m-d') );
        $date->modify('- '. $this->getMaximumAgeForSimulation() .' years');
        return $date;
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

    public function getSimulationDurationStep(): int
    {
        return $this->durationStep;
    }

    public function getMinimumSimulationAmount(): int
    {
        return $this->minAmount;
    }

    public function getMaximumSimulationAmount(): int
    {
        return $this->maxAmount;
    }

    public function getMinimumSimulationInitialPaymentRatio(): float
    {
        return $this->minInitialPaymentRatio;
    }

    public function getApiAvailableBanks(): ?array
    {
        return $this->apiAvailableBanks;
    }

    public function getItbiFee(): ?float
    {
        return $this->itbiFee;
    }

    public function getBrazilianStates(): array
    {
        return [
            $this->getSimpleObject(25, 'São Paulo'),
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
    
    public function getPropertyConditions(): array
    {
        return [
            $this->getSimpleObject(1, 'Novo'),
            $this->getSimpleObject(2, 'Usado'),
            $this->getSimpleObject(3, 'Terreno'),
            // $this->getSimpleObject(4, 'Em Construção'),
            // $this->getSimpleObject(5, 'Reforma'),
            // $this->getSimpleObject(6, 'Ampliação'),
            $this->getSimpleObject(7, 'Dinheiro com seu Imóvel')
        ];
    }

    private function getOption(string $prop)
    {
        return function_exists('get_field') ? get_field('99cred_api_' . $prop, 'option') : get_option('options_99cred_api_' . $prop);
    }

    private function getSimpleObject(int $id, string $name): stdClass
    {
        return (object) [
            'id' => $id,
            'name' => $name
        ];
    }
}
