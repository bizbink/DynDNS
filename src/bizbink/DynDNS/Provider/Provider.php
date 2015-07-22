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
     * @return \bizbink\DynDNS\Record
     */
    public function getRecord();

    /**
     * 
     * @return \bizbink\DynDNS\Domain
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
     * @param \bizbink\DynDNS\Record $record 
     * @return \bizbink\DynDNS\Record
     */
    public function setRecord(\bizbink\DynDNS\Record $record);

    /**
     * 
     * @param \bizbink\DynDNS\Domain $domain 
     * @return \bizbink\DynDNS\Domain
     */
    public function setDomain(\bizbink\DynDNS\Domain $domain);

    /**
     * 
     * @param \bizbink\DynDNS\Record $record
     * @param \bizbink\DynDNS\Domain $domain
     * @return string|bool 
     */
    public function updateRecord(\bizbink\DynDNS\Record $record = null, \bizbink\DynDNS\Domain $domain = null);
}
