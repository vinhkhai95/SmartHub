<?php

namespace com\loabten\model;

class Mqtt {
    private $mqtt_id;
    private $hostname;
    private $port;
    private $clientid;
    private $path;
    private $ssl;
    private $user;
    private $pass;
    private $keepalive;
    private $timeout;
    private $cleansession;
    private $qos;
    private $retain;

    function __construct($mqtt_id = 0, $hostname = null, $port = null, $clientid = null, $path = null,
                         $ssl = 0, $user = null, $pass = null, $keepalive = 0, $timeout = 0,
                         $cleansession = 1, $qos = 0, $retain = 0) 
    {   
        $this->mqtt_id = $mqtt_id;
        $this->hostname = $hostname;
        $this->port = $port;
        $this->clientid = $clientid;
        $this->path = $path;
        $this->ssl = $ssl;
        $this->user = $user;
        $this->pass = $pass;
        $this->keepalive = $keepalive;
        $this->timeout = $timeout;
        $this->cleansession = $cleansession;
        $this->qos = $qos;
        $this->retain = $retain;
    }
    function getMqtt_id() {
        return $this->mqtt_id;
    }

    function getHostname() {
        return $this->hostname;
    }

    function getPort() {
        return $this->port;
    }

    function getClientid() {
        return $this->clientid;
    }

    function getSsl() {
        return $this->ssl;
    }
    function getUser() {
        return $this->user;
    }
    function getPass() {
        return $this->pass;
    }
    function getPath() {
        return $this->path;
    }

    function getKeepalive() {
        return $this->keepalive;
    }

    function getTimeout() {
        return $this->timeout;
    }

    function getCleansession() {
        return $this->cleansession;
    }

    function getQos() {
        return $this->qos;
    }

    function getRetain() {
        return $this->retain;
    }

    function setMqtt_id($mqtt_id) {
        $this->mqtt_id = $mqtt_id;
    }
    function setHostname($hostname) {
        $this->hostname = $hostname;
    }

    function setPort($port) {
        $this->port = $port;
    }

    function setClientid($clientid) {
        $this->clientid = $clientid;
    }

    function setPath($path) {
        $this->path = $path;
    }    
    function setSsl($ssl) {
        $this->ssl = $ssl;
    }    
    function setUser($user) {
        $this->user = $user;
    }    
    function setPass($pass) {
        $this->pass = $pass;
    }

    function setKeepalive($keepAlive) {
        $this->keepalive = $keepAlive;
    }

    function setTimeout($cleansession) {
        $this->timeout = $cleansession;
    }

    function setCleansession($cleansession) {
        $this->cleansession = $cleansession;
    }

    function setQos($qos) {
        $this->qos = $qos;
    }

    function setRetain($retain) {
        $this->retain = $retain;
    }
}
