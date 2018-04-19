<?php
namespace com\loabten\model;

class Admin {

    private $admin_id;
    private $adminname;
    private $name;
    private $password;
    private $gender;
    private $address;
    private $email;
    private $phone;

    function __construct($admin_id = 0, $adminname = null, $name = null, $password = null, $gender = 0, $address = null, $email = null, $phone = null) {
        $this->admin_id = $admin_id;
        $this->adminname = $adminname;
        $this->name = $name;
        $this->password = $password;
        $this->gender = $gender;
        $this->address = $address;
        $this->email = $email;
        $this->phone = $phone;
    }

    function getadmin_id() {
        return $this->admin_id;
    }

    function getadminname() {
        return $this->adminname;
    }

    function getName() {
        return $this->name;
    }

    function getPassword() {
        return $this->password;
    }

    function getGender() {
        return $this->gender;
    }

    function getAddress() {
        return $this->address;
    }

    function getEmail() {
        return $this->email;
    }

    function getPhone() {
        return $this->phone;
    }

    function setadmin_id($admin_id) {
        $this->admin_id = $admin_id;
    }

    function setadminname($adminname) {
        $this->adminname = $adminname;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setGender($gender) {
        $this->gender = $gender;
    }

    function setAddress($address) {
        $this->address = $address;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPhone($phone) {
        $this->phone = $phone;
    }

}
