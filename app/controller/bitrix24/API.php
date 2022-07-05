<?php 

namespace Bitrix;

use CRest;
use stdClass;

defined('ABSPATH') || exit();

class API
{
    private $api;

    public function __construct()
    {
        $this->api = new CRest();
    }

    public function getFieldsAvailable(): array
    {
        $response = $this->api->call('crm.lead.fields');
        return is_array($response) && isset($response['result']) ? array_map([$this, 'parseField'], $response['result'], array_keys($response['result'])) : [];
    }

    private function parseField(array $data, string $key): stdClass
    {
        $field = (object) [];

        $field->key     = $key;
        $field->type    = $data['type'];
        $field->name    = isset($data['listLabel']) && $data['listLabel'] ? $data['listLabel'] : $data['title'];

        if (isset($data['items']) && $data['items']) : 
            $field->options = $data['items'];
        endif;

        return $field;
    }
}
