<?php defined('ABSPATH') || exit('No direct script access allowed');

$env    = new Cred99\Env();

$assets = VVerner\Assets::getInstance();
$assets->registerCss('main');

$assets->registerJs('jquery.mask.min'); 
$assets->registerJs('app'); 
$assets->localizeJs('app', [
    'url'       => VVerner\AjaxAPI::getInstance()->getRequestUrl(),
    'simulator' => $env->toPublicArray()
]); 
