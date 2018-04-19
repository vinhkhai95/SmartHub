<?php

namespace com\loabten\model\data;

class LabDao {
    private $db;

    function __construct($db) {
        $this->db = $db;
    }

    function insert($lab_name){
        $sql = "INSERT INTO dashboard(`dashboard_value`) VALUES('$lab_name')";
        $command = $this->db->prepare($sql);
        $result = $command->execute();
        return $result;
    }

    function delete($lab_id) {
        $sql = "DELETE FROM dashboard WHERE `lab_id` = $lab_id";
        $command = $this->db->prepare($sql);
        $result = $command->execute();
        return $result;
    }

    function update($lab_id,$value) {
        $sql = "UPDATE `dashboard` SET `dashboard_value` = '$value' WHERE `lab_id` = $lab_id";
        $command = $this->db->prepare($sql);
        $result = $command->execute();
        return $result;
    }

    function findById($lab_id) {
        $sql = "SELECT * FROM `dashboard` WHERE `lab_id` = $lab_id";
        $command = $this->db->prepare($sql);
        $command->execute();
        $result = $command->fetch();
        $command->closeCursor();
        return $result;
    }

    function checkLabname($lab_name) {
        $sql = "SELECT * FROM `dashboard` WHERE `dashboard_value` = ?";
        $command = $this->db->prepare($sql);
        $command->bindValue(1, $lab_name);
        $command->execute();
        $check = $command->fetchAll();
        return $check;
    }

    function getdashboardname(){
        $sql = "SELECT * FROM dashboard LEFT JOIN `user` ON dashboard.lab_id = user.dashboard_id";
        $command = $this->db->prepare($sql);
        $result = $command->execute();
        $result = $command->fetchAll();
        return $result;
    }

    function findId($name) {
        $sql = "SELECT * FROM `dashboard` WHERE `dashboard_value` = ?";
        $command = $this->db->prepare($sql);
        $command->bindValue(1, $name);
        $command->execute();
        $result = $command->fetchAll();
        return $result;
    }

    function findByName($name) {
        $sql = "SELECT * FROM dashboard WHERE dashboard_value LIKE ?";
        $command = $this->db->prepare($sql);
        $command->bindValue(1, '%' . $name . '%');
        $command->execute();
        $result = $command->fetchAll();
        $command->closeCursor();
        return $result;
    }

    function findAll(){
        $sql = "SELECT * FROM dashboard";
        $command = $this->db->prepare($sql);
        $command->execute();
        $result = $command->fetchAll();
        return $result;
    }

    function creatTable($lab_id) {
        $sql = "CREATE TABLE IF NOT EXISTS dashboard".$lab_id."(
                device_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                device_value VARCHAR(255) NOT NULL,
                value VARCHAR(255) NOT NULL)";
        $command = $this->db->prepare($sql);
        $command->execute();
    }

    function creatTableLastpresence($lab_id) {
        $sql = "CREATE TABLE IF NOT EXISTS lastpresence".$lab_id."(
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                time DATETIME NOT NULL)";
        $command = $this->db->prepare($sql);
        $command->execute();
    }
    
    function dropdashboard($lab_id){
        $sql = "DROP TABLE IF EXISTS dashboard".$lab_id;
        $command = $this->db->prepare($sql);
        $result = $command->execute();
        return $result;
    }

    function dropLastpresence($lab_id){
        $sql = "DROP TABLE IF EXISTS lastpresence".$lab_id;
        $command = $this->db->prepare($sql);
        $result = $command->execute();
        return $result;
    }

}
