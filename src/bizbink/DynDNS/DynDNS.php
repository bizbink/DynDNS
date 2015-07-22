<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace bizbink\DynDNS;

/**
 * Description of DynDNS
 *
 * @author Matthew
 */
class DynDNS {

    public function __construct(\bizbink\DynDNS\Provider\Provider $provider) {
        return $this->provider = $provider;
    }

    /**
     * 
     * @return \bizbink\DynDNS\Provider\Provider
     */
    public function getProvder() {
        return $this->provider;
    }

    /**
     * 
     * @param \bizbink\DynDNS\Provider\Provider $provider 
     * @return \bizbink\DynDNS\Provider\Provider
     */
    public function setProvder(\bizbink\DynDNS\Provider\Provider $provider) {
        return $this->provider = $provider;
    }

    /**
     *
     * @var \bizbink\DynDNS\Provider\Provider 
     */
    protected $provider;

}
