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

    public function __construct(array $credentials = null) {
        $this->credentials = $credentials;
    }

    /**
     * 
     * @return \bizbink\DynDNS\Record
     */
    public function getRecord() {
        return $this->record;
    }

    /**
     * 
     * @return \bizbink\DynDNS\Domain
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
     * @param array $credentials 
     * @return array
     */
    public function setCredentials(array $credentials) {
        return $this->credentials = $credentials;
    }

    /**
     * 
     * @param \bizbink\DynDNS\Record $record 
     * @return \bizbink\DynDNS\Record
     */
    public function setRecord(\bizbink\DynDNS\Record $record) {
        return $this->record = $record;
    }

    /**
     * 
     * @param \bizbink\DynDNS\Domain $domain 
     * @return \bizbink\DynDNS\Domain
     */
    public function setDomain(\bizbink\DynDNS\Domain $domain) {
        return $this->domain = $domain;
    }

    /**
     *
     * @var array
     */
    protected $credentials;

    /**
     *
     * @var \bizbink\DynDNS\Record
     */
    protected $record;

    /**
     *
     * @var \bizbink\DynDNS\Domain
     */
    protected $domain;

    /**
     *
     * @var string
     */
    protected $response;

}
