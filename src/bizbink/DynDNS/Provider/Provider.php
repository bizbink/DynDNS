<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace bizbink\DynDNS\Provider;

/**
 * Description of AbstractProvider
 *
 * @author Matthew
 */
interface Provider {

    /**
     * 
     * @return string
     */
    public function getResponseData();

    /**
     * 
     * @return string
     */
    public function getRequestData();

    /**
     * 
     * @return string $data
     */
    public function setResponseData($data);

    /**
     * 
     * @return string $data
     */
    public function setRequestData($data);

    /**
     * 
     * @param \bizbink\DynDNS\Entity\DomainEntity $domainEntity
     * @param \bizbink\DynDNS\Entity\RecordEntity $recordEntity
     * @param int $page
     * @return boolean|\bizbink\DynDNS\Entity\RecordEntity
     * @throws \bizbink\DynDNS\Exception\UnprocessableEntityException
     * @throws \bizbink\DynDNS\Exception\RecordNotFoundException
     * @throws \bizbink\DynDNS\Exception\UnauthorizedAcessException
     */
    public function findRecordEntity(\bizbink\DynDNS\Entity\DomainEntity $domainEntity, \bizbink\DynDNS\Entity\RecordEntity $recordEntity, $page = null);

    /**
     * 
     * @param \bizbink\DynDNS\Entity\DomainEntity $domainEntity
     * @param \bizbink\DynDNS\Entity\RecordEntity $recordEntity
     * @return \bizbink\DynDNS\Entity\RecordEntity|boolean
     * @throws \bizbink\DynDNS\Exception\UnprocessableEntityException
     * @throws \bizbink\DynDNS\Exception\RecordNotFoundException
     * @throws \bizbink\DynDNS\Exception\UnauthorizedAcessException
     */
    public function updateRecordEntity(\bizbink\DynDNS\Entity\DomainEntity $domainEntity, \bizbink\DynDNS\Entity\RecordEntity $recordEntity);

    /**
     * 
     * @return boolean|string
     */
    public function getExternalIp();
}
