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

    public function getLead( int $leadId )
    {
        return $this->api->call(
            'crm.lead.get',
            [
                'id' => $leadId
            ]
        );     
    }

    public function getLeads()
    {
        return $this->api->call(
            'crm.lead.list',
            [
                
            ]
        );     
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
            elseif ($defaultValue || $simulatorKey === 'only_default_value' ) :
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
                $value = (int) self::parseToFloat( $value ); 
                break;
            case ('string') : 
                $value = sanitize_text_field($value); 
                break;
            case ('crm_multifield') : 
                $value = [
                    (object) [
                        'VALUE' => $field->key === 'PHONE' ? preg_replace('/\D/', '', $value) : sanitize_email($value),
                        'VALUE_TYPE' => 'WORK'
                    ]
                ]; 
                break;
            case ('money') : 
                $value = round(self::parseToFloat( $value )) . '|BRL';
                break;
            case ('date') : 
            case ('datetime') : 
                $date = is_a($value, '\DateTime') ? $value : new \DateTime( $value );
                $value = $date->format('Y-m-d\TH:i:s') . '+03:00'; 
                break;
            case ('float') : 
            case ('double') : 
                $value = (float) self::parseToFloat( $value ); 
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

    public static function parseToFloat( string $str ): float
    {
        $str = str_replace('.', '', $str);
        $str = str_replace(',', '.', $str);
        return (float) $str;
    }
}
