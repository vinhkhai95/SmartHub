<?php

namespace com\loabten\model;

class User {

    private $user_id;
    private $dashboard_id;
    private $name;
    private $username;
    private $password;
    private $phone;
    private $gender;
    private $email;

    function __construct($user_id = 0,$dashboard_id = 0, $name = null, $username = null, $password = null, $phone = 0, $gender = null, $email = null) {
        $this->user_id = $user_id;
        $this->dashboard_id = $dashboard_id;
        $this->name = $name;
        $this->username = $username;
        $this->password = $password;
        $this->phone = $phone;
        $this->gender = $gender;
        $this->email = $email;
    }
    function getuser_id() {
        return $this->user_id;
    }

    function getdashboard_id(){
        return $this->dashboard_id;
    }

    function getName() {
        return $this->name;
    }

    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }

    function getPhone() {
        return $this->phone;
    }

    function getGender() {
        return $this->gender;
    }

    function getEmail() {
        return $this->email;
    }

    function setuser_id($user_id) {
        $this->user_id = $user_id;
    }

    function setdashboard_id($dashboard_id){
        $this->dashboard_id = $dashboard_id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setPhone($phone) {
        $this->phone = $phone;
    }

    function setGender($gender) {
        $this->gender = $gender;
    }

    function setEmail($email) {
        $this->email = $email;
    }
}