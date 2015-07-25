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

    /**
     * 
     * @param array $authentication
     */
    public function __construct(array $authentication) {
        $this->authentication = $authentication;
    }

    /**
     *
     * @var array
     */
    protected $authentication;

    /**
     *
     * @var string
     */
    protected $responseData;

    /**
     *
     * @var string
     */
    protected $requestData;

    /**
     * 
     * @return string
     */
    public function getResponseData() {
        return $this->responseData;
    }

    /**
     * 
     * @return string
     */
    public function getRequestData() {
        return $this->requestData;
    }

    /**
     * 
     * @param string $data 
     * @return string
     */
    public function setResponseData($data) {
        return $this->responseData = $data;
    }

    /**
     * 
     * @param string $data 
     * @return string
     */
    public function setRequestData($data) {
        return $this->requestData = $data;
    }

    /**
     * 
     * @return boolean|string
     */
    public function getExternalIp() {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://" . self::CHECK_IP_API_HOST . "/?format=" . self::CHECK_IP_API_FORMAT);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, self::CHECK_IP_TIMEOUT);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        $ip = curl_exec($ch);
        curl_close($ch);
        if (preg_match('/(\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})/', $ip)) {
            return $ip;
        }
        return false;
    }

    const CHECK_IP_API_HOST = 'api.ipify.org';
    const CHECK_IP_API_FORMAT = 'plain';
    const CHECK_IP_TIMEOUT = 15;

}
