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
abstract class AbstractProvider implements \bizbink\DynDNS\Provider\Provider {

    public function __construct($config = null) {
        $this->config = $config;
    }

    /**
     * 
     * @return \bizbink\DynDNS\Entity\RecordEntity
     */
    public function getRecord() {
        return $this->record;
    }

    /**
     * 
     * @return \bizbink\DynDNS\Entity\DomainEntity
     */
    public function getDomain() {
        return $this->domain;
    }

    /**
     * 
     * @return string
     */
    public function getResponse() {
        return $this->response;
    }

    /**
     * 
     * @param \bizbink\DynDNS\Entity\RecordEntity $record 
     * @return \bizbink\DynDNS\Entity\RecordEntity
     */
    public function setRecord(\bizbink\DynDNS\Entity\RecordEntity $record) {
        return $this->record = $record;
    }

    /**
     * 
     * @param \bizbink\DynDNS\Entity\DomainEntity $domain 
     * @return \bizbink\DynDNS\Entity\DomainEntity
     */
    public function setDomain(\bizbink\DynDNS\Entity\DomainEntity $domain) {
        return $this->domain = $domain;
    }

    /**
     *
     * @var array
     */
    protected $config;

    /**
     *
     * @var \bizbink\DynDNS\Entity\RecordEntity
     */
    protected $record;

    /**
     *
     * @var \bizbink\DynDNS\Entity\DomainEntity
     */
    protected $domain;

    /**
     *
     * @var string
     */
    protected $response;

}
