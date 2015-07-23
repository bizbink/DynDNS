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
     * @return \bizbink\DynDNS\Entity\RecordEntity
     */
    public function getRecord();

    /**
     * 
     * @return \bizbink\DynDNS\Entity\DomainEntity
     */
    public function getDomain();

    /**
     * 
     * @return string
     */
    public function getResponse();

    /**
     * 
     * @param array $authentication 
     * @return array
     */
    public function setCredentials(array $authentication);

    /**
     * 
     * @param \bizbink\DynDNS\Entity\RecordEntity $record 
     * @return \bizbink\DynDNS\Entity\RecordEntity
     */
    public function setRecord(\bizbink\DynDNS\Entity\RecordEntity $record);

    /**
     * 
     * @param \bizbink\DynDNS\Entity\DomainEntity $domain 
     * @return \bizbink\DynDNS\Entity\DomainEntity
     */
    public function setDomain(\bizbink\DynDNS\Entity\DomainEntity $domain);

    /**
     * 
     * @param \bizbink\DynDNS\Entity\RecordEntity $record
     * @param \bizbink\DynDNS\Entity\DomainEntity $domain
     * @return string|bool 
     */
    public function updateRecord(\bizbink\DynDNS\Entity\RecordEntity $record = null, \bizbink\DynDNS\Entity\DomainEntity $domain = null);
}
