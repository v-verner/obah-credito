<?php 

namespace Cred99;

use Exception;
use stdClass;

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

    public function set(string $prop, $value)
    {
        foreach (self::SANITIZE_SCHEMA as $cb => $props) : 
            if ( in_array($prop, $props) ) : 
                $value = $cb( $value );
            endif;
        endforeach;

        $this->$prop = $value;
    }

    public function simulate(): array
    {
        $this->validateRequiredProperties();
        return $this->api->getSimulationResult( $this->toArray() );
    }

    private function validateRequiredProperties(): bool
    {
        $props = array_filter($this->toArray());
        $props = array_keys($props);
        $missing = array_diff( self::REQUIRED_PROPERTIES, $props );

        if ($missing) : 
            throw new Exception('Missing required props ' . implode(', ', $missing));
            exit;
        endif;

        return true;
    }

    private function toArray(): array
    {
        $vars = get_object_vars( $this );
        unset( $vars['env'], $vars['api'] );
        return $vars;
    }
}
