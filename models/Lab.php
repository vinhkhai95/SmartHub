<?php

namespace com\loabten\model;

class Lab {

    private $lab_id;

    function __construct($lab_id = 0) {
        $this->lab_id = $lab_id;
    }
    function getlab_id() {
        return $this->lab_id;
    }
    function setlab_id(){
        $this->lab_id = $lab_id;
    }
}