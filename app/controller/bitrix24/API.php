<?php 

namespace Bitrix;

use CRest;
use stdClass;

defined('ABSPATH') || exit();

class API
{
    private $api;
    private $fields;

    public function __construct()
    {
        $this->api = new CRest();
    }

    public function insertLead(array $lead)
    {
        return $this->api->call(
            'crm.lead.add',
            [
                'fields' => $this->normalizeLead($lead)
            ]
        );
    }

    public function getFieldsAvailable(): array
    {
        if ($this->fields) : 
            return $this->fields;
        endif;

        $this->fields = $this->getFieldsAvailableCache();

        if (!$this->fields) : 
            $response       = $this->api->call('crm.lead.fields');
            $keys           = is_array($response) && isset($response['result']) ? array_keys($response['result']) : [];

            $this->fields   = is_array($response) && isset($response['result']) ? array_map([$this, 'parseField'], $response['result'], $keys) : [];
            $this->fields   = array_combine($keys, $this->fields);

            $this->setFieldsAvailableCache();
        endif;
        
        return $this->fields;
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

    private function normalizeLead(array $lead): array
    {
        $matrix = $this->getFieldsMatrix();
        $normalizedLead = [];

        if (!$matrix) : 
            return $normalizedLead;
        endif;

        foreach ($matrix as $entry) : 
            $simulatorKey = $entry['simulator'];
            $bitrixKey    = $entry['bitrix'];
            $defaultValue = $entry['default_value'];
            $field        = $this->getField( $bitrixKey );

            if (!$field) : 
                continue;
            endif;

            if (isset($lead[$simulatorKey]) && $lead[$simulatorKey]) : 
                $normalizedLead[$bitrixKey] = $this->normalizeFieldValue( $lead[$simulatorKey], $field );
            elseif ($defaultValue) :
                $normalizedLead[$bitrixKey] = $this->normalizeFieldValue( $defaultValue, $field );
            endif;
        endforeach;

        return $normalizedLead;
    }

    private function getFieldsMatrix(): array
    {
        return get_field('bitrix24_api_fields_map', 'option');
    }

    private function getFieldsAvailableCache(): array
    {
        $cache = get_transient('_bitrix_24_fields_available');
        return $cache ? $cache : [];
    }

    private function setFieldsAvailableCache(): void
    {
        set_transient('_bitrix_24_fields_available', $this->fields, DAY_IN_SECONDS);
    }

    private function getField(string $key): ?stdClass
    {
        return isset( $this->getFieldsAvailable()[ $key ] ) ? $this->getFieldsAvailable()[ $key ] : null;
    }

    private function normalizeFieldValue($value, stdClass $field)
    {
        switch($field->type) : 
            case ('integer') : 
                $value = str_replace('.', '', $value);
                $value = str_replace(',', '.', $value);
                $value = (int) $value; 
                break;
            case ('double') : 
                $value = str_replace('.', '', $value);
                $value = str_replace(',', '.', $value);
                $value = (float) $value; 
                break;
            case ('enumeration') : 
                $correctValue = null;
                foreach ($field->options as $option) : 
                    if (sanitize_title($option['VALUE']) === sanitize_title($value)) : 
                        $correctValue = $option['ID'];
                        break;
                    endif;
                endforeach;
                $value = $correctValue;
                break;
        endswitch;
        return $value;
    }
}
