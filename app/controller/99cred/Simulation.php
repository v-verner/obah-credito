<?php 

namespace Cred99;

use Exception;
use WP_Error;

defined('ABSPATH') || exit();

class Simulation
{
    protected $EC;
    protected $uf;
    protected $perfil;
    protected $condicao;
    protected $idade;
    protected $valor;
    protected $valor_financ;
    protected $prazo;
    protected $nome;
    protected $fone;
    protected $email;
    protected $fmt      = 'JSON';
    protected $infmail  = 'S';
    protected $copiacli = 'N';
    protected $canal    = '';

    private $env;
    private $api;

    private const SANITIZE_SCHEMA = [
        'sanitize_email'        => ['email'],
        'sanitize_text_field'   => ['nome', 'fone'],
        'intval'                => ['idade', 'prazo', 'uf', 'prefil', 'condicao'],
        'floatval'              => ['valor', 'valor_financ'],
    ];

    private const REQUIRED_PROPERTIES = [
        'EC',
        'uf',
        'perfil',
        'condicao',
        'idade',
        'valor',
        'valor_financ',
        'prazo'
    ];

    public function __construct()
    {
        $this->env = new Env();
        $this->api = new API();

        $this->EC = $this->env->getApiKey();
    }

    public function get(string $prop)
    {
        return isset($this->$prop) ? $this->$prop : null;
    }

    public function set(string $prop, $value)
    {
        foreach (self::SANITIZE_SCHEMA as $cb => $props) : 
            if ( in_array($prop, $props) ) : 
                $value = $cb( $value );
            endif;
        endforeach;

        $this->$prop = $value;
    }

    public function simulate()
    {
        $validation = $this->validateRequiredProperties();

        if (is_wp_error($validation)) : 
            return $validation;
        endif;

        $validation = $this->validateBusinessLogic();

        if (is_wp_error($validation)) : 
            return $validation;
        endif;

        $results = $this->api->getSimulationResult( $this->toArray() );

        return $results ? $results : new WP_Error(-1, 'Nenhum resultado localizado');
    }

    private function validateRequiredProperties(): ?WP_Error
    {
        $props = array_filter($this->toArray());
        $props = array_keys($props);
        $missing = array_diff( self::REQUIRED_PROPERTIES, $props );

        if ($missing) : 
            return new WP_Error(-2, 'Faltando informações para simulação', $missing);
        endif;

        return null;
    }

    private function validateBusinessLogic(): ?WP_Error
    {
        if (!$this->validateAmount()) :
            return new WP_Error(-3, 'Valor financiado incompatível com simulação');
        endif;

        if (!$this->validateInitialPayment()) :
            return new WP_Error(-4, 'Entrada incompatível com simulação');
        endif;

        if (!$this->validateDuration()) :
            return new WP_Error(-5, 'Prazo incompatível com simulação');
        endif;

        if (!$this->validateAge()) :
            return new WP_Error(-6, 'Idade incompatível com simulação');
        endif;

        return null;
    }

    private function validateAge(): bool
    {
        return $this->idade >= $this->env->getMinimumAgeForSimulation() && $this->idade <= $this->env->getMaximumAgeForSimulation();
    }
    
    private function validateAmount(): bool
    {
        return  $this->valor_financ >= $this->env->getMinimumSimulationAmount() && 
                $this->valor_financ <= $this->env->getMaximumSimulationAmount() && 
                $this->valor > $this->valor_financ;
    }
    
    private function validateInitialPayment(): bool
    {
        $ratio = $this->valor_financ / $this->valor;
        return $ratio > $this->env->getMinimumSimulationInitialPaymentRatio();
    }

    private function validateDuration(): bool
    {
        return $this->prazo >= $this->env->getMinimumSimulationDuration() && $this->idade <= $this->env->getMaximumSimulationDuration();
    }

    private function toArray(): array
    {
        $vars = get_object_vars( $this );
        unset( $vars['env'], $vars['api'] );
        return $vars;
    }
}
