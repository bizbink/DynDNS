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

    /**
     * 
     * @return \bizbink\DynDNS\Provider\Provider
     */
    public function getProvder() {
        return $this->provider;
    }

    /**
     * 
     * @return array
     */
    public function getAuthentication() {
        return $this->authentication;
    }

    /**
     * 
     * @param string $provider
     * @return \bizbink\DynDNS\Provider\Provider
     * @throws \bizbink\DynDNS\Exception\NullProviderException
     */
    public function setProvder($provider) {
        switch ($provider) {
            case 'DigitalOcean':
                return $this->provider = new \bizbink\DynDNS\Provider\DigitalOceanProvider($this->authentication);
            default:
                throw new \bizbink\DynDNS\Exception\NullProviderException();
        }
    }

    /**
     * 
     * @param array $authentication 
     * @return array
     */
    public function setAuthentication(array $authentication) {
        return $this->authentication = $authentication;
    }

    /**
     *
     * @var \bizbink\DynDNS\Provider\Provider 
     */
    protected $provider;

    /**
     *
     * @var array
     */
    protected $authentication;

}
