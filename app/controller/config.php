<?php defined('ABSPATH') || exit('No direct script access allowed');

$env    = new Cred99\Env();

$assets = VVerner\Assets::getInstance();
$assets->registerCss('main');

$assets->registerJs('vendor/jquery.mask.min');
$assets->registerJs('vendor/swal.min');

$assets->registerJs('app'); 
$assets->localizeJs('app', [
    'url'       => VVerner\AjaxAPI::getInstance()->getRequestUrl(),
    'simulator' => $env->toPublicArray()
]); 
