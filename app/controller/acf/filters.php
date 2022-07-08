<?php defined('ABSPATH') || exit(); 

add_filter('acf/settings/save_json', function($path){
   return __DIR__. '/json';
});

add_filter('acf/settings/load_json', function($paths){
   $paths[] = __DIR__. '/json';
   return $paths;
});

// Mapeamento de campos - SIMULADOR
add_filter('acf/load_field/key=field_62c49b2fde339', function($field){
    $field['choices'] = OBAH_SIMULATOR_FIELDS;
    return $field;
});

// Mapeamento de campos - BITRIX
add_filter('acf/load_field/key=field_62c49b20de338', function($field){
    $api    = new Bitrix\API();
    $items  = $api->getFieldsAvailable();

    if (!$items) : 
        return $field;
    endif;

    $field['choices'] = [];

    foreach ($items as $item) : 
        $field['choices'][ $item->key ] = $item->key . ' : ' . $item->name;
    endforeach;

    return $field;
});
