<?php
namespace com\loabten\model;

class Device {

    private $device_id;
    private $device_value;
    private $value;

    function __construct($device_id = 0, $device_value = null, $value = null) {
        $this->device_id = $device_id;
        $this->device_value = $device_value;
        $this->value = $value;
    }

    function getDevice_id() {
        return $this->device_id;
    }

    function getDevice_value() {
        return $this->device_value;
    }

    function get_value() {
        return $this->value;
    }

    function setDevice_id($device_id) {
        $this->device_id = $device_id;
    }

    function setDevice_value($device_value) {
        $this->device_value = $device_value;
    }

    function set_value($value) {
        $this->value = $value;
    }
}
