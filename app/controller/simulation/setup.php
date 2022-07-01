<?php defined('ABSPATH') || exit;

$cpt = new VVerner\PostType('Simulação', 'Simulações', 'simulation');
$cpt->setPublic(false);
$cpt->setIcon('dashicons-media-document');
$cpt->setSupports(['title']);
$cpt->addMetaBox('Dados da simulação', 'data');
$cpt->addMetaBox('Histórico da simulação', 'history');
$cpt->register();
