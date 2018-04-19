<?php

namespace com\loabten\model;

class Lastpresence {

    private $id;
    private $time;

    function __construct($id = 0, $time = null) {
        $this->id = $id;
        $this->time = $time;
    }
    function getid() {
        return $this->id;
    }

    function getTime() {
        return $this->time;
    }

    function setid($id) {
        $this->id = $id;
    }

    function setTime($time) {
        $this->time = $time;
    }
}