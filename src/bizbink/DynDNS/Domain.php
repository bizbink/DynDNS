<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace bizbink\DynDNS;

/**
 * Description of DomainObject
 *
 * @author Matthew
 */
class Domain {

    /**
     * 
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * 
     * @return int
     */
    public function getTTL() {
        return $this->ttl;
    }

    /**
     * 
     * @return string
     */
    public function getZoneFile() {
        return $this->zoneFile;
    }

    /**
     * 
     * @return string
     */
    public function getIPAddress() {
        return $this->ipAddress;
    }

    /**
     * 
     * @param string $name
     * @return string
     */
    public function setName($name) {
        return $this->name = $name;
    }

    /**
     * 
     * @param int $ttl
     * @return int
     */
    public function setTTL($ttl) {
        return $this->ttl = $ttl;
    }

    /**
     * 
     * @param string $zoneFile
     * @return string
     */
    public function setZoneFile($zoneFile) {
        return $this->zoneFile = $zoneFile;
    }

    /**
     * 
     * @param string $ipAddress
     * @return string
     */
    public function setIPAddress($ipAddress) {
        return $this->ipAddress = $ipAddress;
    }

    /**
     *
     * @var string
     */
    protected $name;

    /**
     *
     * @var int
     */
    protected $ttl;

    /**
     *
     * @var string
     */
    protected $zoneFile;

    /**
     *
     * @var string
     */
    protected $ipAddress;

}
