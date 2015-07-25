<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace bizbink\DynDNS\Provider;

/**
 * Description of DigitalOceanProvider
 *
 * @author Matthew
 */
class DigitalOceanProvider extends \bizbink\DynDNS\Provider\AbstractProvider implements \bizbink\DynDNS\Provider\Provider {

    /**
     * @param \bizbink\DynDNS\Entity\DomainEntity $domainEntity
     * @param \bizbink\DynDNS\Entity\RecordEntity $recordEntity
     * @param int $page
     * @return boolean|\bizbink\DynDNS\Entity\RecordEntity
     * @throws \bizbink\DynDNS\Exception\UnprocessableEntityException
     * @throws \bizbink\DynDNS\Exception\RecordNotFoundException
     * @throws \bizbink\DynDNS\Exception\UnauthorizedAcessException
     */
    public function findRecordEntity(\bizbink\DynDNS\Entity\DomainEntity $domainEntity, \bizbink\DynDNS\Entity\RecordEntity $recordEntity, $page = null) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://' . self::DNS_API_HOST . '/v' . self::DNS_API_VERSION . '/' . 'domains/' . $domainEntity->getName() . '/records' . ($page != null ? '?page=' . $page : ''));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, self::DNS_TIMEOUT);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . (isset($this->authentication['token']) ? $this->authentication['token'] : ''),
            'Content-Type: application/json'
        ));
        $responseData = curl_exec($ch);
        $responseCode = curl_getinfo($ch)['http_code'];
        curl_close($ch);
        if ($responseData === false) {
            return false;
        } elseif ($responseCode == 401) {
            throw new \bizbink\DynDNS\Exception\UnauthorizedAcessException("The token is not be set or incorrect");
        } elseif ($responseCode == 404) {
            throw new \bizbink\DynDNS\Exception\RecordNotFoundException("Unable to find record with supplied entity");
        } elseif ($responseCode == 422) {
            throw new \bizbink\DynDNS\Exception\UnprocessableEntityException("Unable to update record, the entity supplied is invalid");
        } elseif ($responseCode !== 200) {
            return false;
        } else {
            $this->setResponseData($responseData);
        }
        $responseData = json_decode($responseData, true);
        foreach ($responseData['domain_records'] as $record) {
            if ($record['type'] === $recordEntity->getType() && $record['name'] === $recordEntity->getName()) {
                return new \bizbink\DynDNS\Entity\RecordEntity($record['id'], $record['type'], $record['name'], $record['data'], null, $record['priority'], $record['port'], $record['weight']);
            }
        }
        // Recursive call for pages results
        if (isset($responseData['links']['pages']['next']) && $responseData['links']['pages']['next'] != '') {
            preg_match('/page=(?<page_number>\d+)/i', $responseData['links']['pages']['next'], $match);
            if (isset($match['page_number']) && $match['page_number'] != '') {
                return findRecordEntity($match['page_number']);
            }
        }
        throw new \bizbink\DynDNS\Exception\RecordNotFoundException("Unable to find record with supplied entity");
    }

    /**
     * 
     * @param \bizbink\DynDNS\Entity\DomainEntity $domainEntity
     * @param \bizbink\DynDNS\Entity\RecordEntity $recordEntity
     * @return \bizbink\DynDNS\Entity\RecordEntity|boolean
     * @throws \bizbink\DynDNS\Exception\UnprocessableEntityException
     * @throws \bizbink\DynDNS\Exception\RecordNotFoundException
     * @throws \bizbink\DynDNS\Exception\UnauthorizedAcessException
     */
    public function updateRecordEntity(\bizbink\DynDNS\Entity\DomainEntity $domainEntity, \bizbink\DynDNS\Entity\RecordEntity $recordEntity) {
        $this->setRequestData(array('data' => $recordEntity->getData()));
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://' . self::DNS_API_HOST . '/v' . self::DNS_API_VERSION . '/' . 'domains/' . $domainEntity->getName() . '/records/' . $recordEntity->getId());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($this->getRequestData()));
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, self::DNS_TIMEOUT);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . (isset($this->authentication['token']) ? $this->authentication['token'] : ''),
            'Content-Type: application/json',
            'Content-Length: ' . strlen(json_encode($this->getRequestData())))
        );
        $responseData = curl_exec($ch);
        $responseCode = curl_getinfo($ch)['http_code'];
        curl_close($ch);
        if ($responseData === false) {
            return false;
        } elseif ($responseCode == 401) {
            throw new \bizbink\DynDNS\Exception\UnauthorizedAcessException("The token is not be set or incorrect");
        } elseif ($responseCode == 404) {
            throw new \bizbink\DynDNS\Exception\RecordNotFoundException("Unable to find record with supplied entity");
        } elseif ($responseCode == 422) {
            throw new \bizbink\DynDNS\Exception\UnprocessableEntityException("Unable to update record, the entity supplied is invalid");
        } elseif ($responseCode !== 200) {
            return false;
        } else {
            $this->setResponseData($responseData);
        }
        $record = json_decode($responseData, true)['domain_record'];
        return new \bizbink\DynDNS\Entity\RecordEntity($record['id'], $record['type'], $record['name'], $record['data'], null, $record['priority'], $record['port'], $record['weight']);
    }

    const DNS_API_HOST = 'api.digitalocean.com';
    const DNS_API_VERSION = '2';
    const DNS_TIMEOUT = 15;

}
