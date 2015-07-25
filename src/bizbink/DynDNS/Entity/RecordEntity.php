<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace bizbink\DynDNS\Entity;

/**
 * Description of RecordObject
 *
 * @author Matthew
 */
class RecordEntity {
    
    public function __construct($id = null, $type = null, $name = null, $data = null, $ttl = null, $priority = null, $port = null, $weight = null) {
        $this->setId($id);
        $this->setType($type);
        $this->setName($name);
        $this->setData($data);
        $this->setTTL($ttl);
        $this->setPriority($priority);
        $this->setPort($port);
        $this->setWeight($weight);
    }

    /**
     * 
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * 
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    /**
     * 
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * 
     * @return string
     */
    public function getData() {
        return $this->data;
    }

    /**
     * 
     * @return string
     */
    public function getTTL() {
        return $this->ttl;
    }

    public function getPriority() {
        return $this->priority;
    }

    /**
     * 
     * @return int
     */
    public function getPort() {
        return $this->port;
    }

    /**
     * 
     * @return int
     */
    public function getWeight() {
        return $this->weight;
    }

    /**
     * 
     * @param int $id
     * @return int
     */
    public function setId($id) {
        return $this->id = $id;
    }

    /**
     * 
     * @param string $type
     * @return string
     */
    public function setType($type) {
        return $this->type = $type;
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
     * @param string $data
     * @return string
     */
    public function setData($data) {
        return $this->data = $data;
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
     * @param int $priority
     * @return int
     */
    public function setPriority($priority) {
        return $this->priority = $priority;
    }

    /**
     * 
     * @param int $port
     * @return int
     */
    public function setPort($port) {
        return $this->port = $port;
    }

    /**
     * 
     * @param int $weight
     * @return int
     */
    public function setWeight($weight) {
        return $this->weight = $weight;
    }

    /**
     *
     * @var int 
     */
    public $id;

    /**
     *
     * @var string 
     */
    public $type;

    /**
     *
     * @var string 
     */
    public $name;

    /**
     *
     * @var string 
     */
    public $data;

    /**
     *
     * @var int 
     */
    public $ttl;

    /**
     *
     * @var int 
     */
    public $priority;

    /**
     *
     * @var int 
     */
    public $port;

    /**
     *
     * @var int 
     */
    public $weight;

}
