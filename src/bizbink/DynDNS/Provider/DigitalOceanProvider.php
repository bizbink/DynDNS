<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace bizbink\DynDNS\Provider;

/**
 * Description of DigitalOceanDynDNSProvider
 *
 * @author Matthew
 */
class DigitalOceanProvider extends \bizbink\DynDNS\Provider\AbstractProvider implements \bizbink\DynDNS\Provider\Provider {

    /**
     * 
     * @param \bizbink\DynDNS\Entity\RecordEntity $record 
     * @return \bizbink\DynDNS\Entity\RecordEntity
     */
    public function setRecord(\bizbink\DynDNS\Entity\RecordEntity $record) {
            parent::setRecord($record);
            $this->buildRecordUpdateJSON($record);
    }

    /**
     * 
     * @param \bizbink\DynDNS\Entity\RecordEntity $record
     * @param \bizbink\DynDNS\Entity\DomainEntity $domain
     * @return string|bool 
     */
    public function updateRecord(\bizbink\DynDNS\Entity\RecordEntity $record = null, \bizbink\DynDNS\Entity\DomainEntity $domain = null) {
        if (isset($record)) {
            $this->setRecord($record);
        }
        if (isset($domain)) {
            $this->setDomain($domain);
        }
        $this->buildRecordUpdateCURL();
        $this->executeRecordUpdateCURL();
        $this->validateResponse();
        return $this->getResponse();
    }

    /**
     * 
     * @param \bizbink\DynDNS\Entity\RecordEntity $record
     */
    private function buildRecordUpdateJSON(\bizbink\DynDNS\Entity\RecordEntity $record) {
        $data = [];
        if (isset($record->type)) {
            $data['type'] = $record->type;
        }
        if (isset($record->name)) {
            $data['name'] = $record->name;
        }
        if (isset($record->data)) {
            $data['data'] = $record->data;
        }
        if (isset($record->priority)) {
            $data['priority'] = $record->priority;
        }
        if (isset($record->port)) {
            $data['port'] = $record->port;
        }
        if (isset($record->weight)) {
            $data['weight'] = $record->weight;
        }
        $this->data = json_encode($data);
    }
    
    private function buildRecordUpdateCURL() {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://' . self::API_HOST . '/v' . self::API_VERSION . '/' . 'domains/' . $this->getDomain()->getName() . '/records/' . $this->getRecord()->getId());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->data);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, self::TIMEOUT);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . $this->credentials['token'],
            'Content-Type: application/json',
            'Content-Length: ' . strlen($this->data))
        );
        $this->ch = $ch;
    }
    
    /**
     * 
     * @return resource|bool
     */
    private function executeRecordUpdateCURL() {
        $response = curl_exec($this->ch);
        curl_close($this->ch);
        return $this->response = $response;
    }
    
    /**
     * 
     * @return boolean
     * @throws \bizbink\DynDNS\Exception\UnprocessableEntityException
     */
    private function validateResponse() {
        $response = json_decode($this->response);
        if(isset($response->{'id'}) && $response->{'id'} === 'unprocessable_entity') {
            throw new \bizbink\DynDNS\Exception\UnprocessableEntityException($response->{'message'});
        }
        elseif(isset($response->{'id'}) && $response->{'id'} === 'not_found') {
            throw new \bizbink\DynDNS\Exception\RecordNotFoundException($response->{'message'});
        }
        elseif(isset($response->{'id'}) && $response->{'id'} === 'unauthorized') {
            throw new \bizbink\DynDNS\Exception\UnauthorizedAcessException($response->{'message'});
        }
        return true;
    }
    
    /**
     *
     * @var array 
     */
    protected $data;
    
    /**
     *
     * @var resource 
     */
    protected $ch;
    
    /**
     *
     * @var string 
     */
    protected $response;

    const API_HOST = 'api.digitalocean.com';
    const API_VERSION = '2';
    const TIMEOUT = 15;

}
