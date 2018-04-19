<?php

namespace com\loabten\model\data;

class AdminDao {
    private $db;

    function __construct($db) {
        $this->db = $db;
    }

    function insert($admin) {
        $sql = "INSERT INTO `admin` "
                . " (`adminname`,`name`,`password`,`gender`,`address`,`email`,`phone`)"
                . " VALUES(?,?,?,?,?,?,?)";
        $command = $this->db->prepare($sql);

        $command->bindValue(1, $admin->getadminname());
        $command->bindValue(2, $admin->getName());
        $command->bindValue(3, $admin->getPassword());
        $command->bindValue(4, $admin->getGender());
        $command->bindValue(5, $admin->getAddress());
        $command->bindValue(6, $admin->getEmail());
        $command->bindValue(7, $admin->getPhone());
        $result = $command->execute();
        return $result;
    }

    function update($admin) {
        $sql = "UPDATE `admin` SET `adminname` = ?,`name` = ?,`password` = ?,`gender` = ?,"
                . " `address` = ?,`email` = ?,`phone` = ? WHERE `admin_id` = ?;";
        $command = $this->db->prepare($sql);

        $command->bindValue(1, $admin->getadminname());
        $command->bindValue(2, $admin->getName());
        $command->bindValue(3, $admin->getPassword());
        $command->bindValue(4, $admin->getGender());
        $command->bindValue(5, $admin->getAddress());
        $command->bindValue(6, $admin->getEmail());
        $command->bindValue(7, $admin->getPhone());
        $command->bindValue(8, $admin->getadmin_id());
        $result = $command->execute();
        return $result;
    }

    function checkadminname($adminname) {
        $sql = "SELECT adminname FROM admin WHERE adminname = ?";
        $command = $this->db->prepare($sql);
        $command->bindValue(1, $adminname);
        $command->execute();
        $check = $command->fetchAll();
        return $check;
    }

    function checkLogin($adminname, $password) {
        $sql = "select * from admin where adminname = ? and password = ?";
        $command = $this->db->prepare($sql);
        $command->bindValue(1, $adminname);
        $command->bindValue(2, $password);
        $command->execute();
        $result = $command->fetch();
        $command->closeCursor();
        return !empty($result);
    }

    function findById($admin_id) {
        $sql = "select * from admin where admin_id=?";
        $command = $this->db->prepare($sql);
        $command->bindValue(1, $admin_id);
        $command->execute();
        $result = $command->fetch();
        $command->closeCursor();
        return $result;
    }

    function findByName($name) {
        $sql = "select * from admin where name like ?";
        $command = $this->db->prepare($sql);
        $command->bindValue(1, '%' . $name . '%');
        $command->execute();
        $result = $command->fetchAll();
        $command->closeCursor();
        return $result;
    }

    function delete($admin_id) {
        $sql = "delete from admin where admin_id =?";
        $command = $this->db->prepare($sql);
        $command->bindValue(1, $admin_id);
        $result = $command->execute();
        return $result;
    }

    function findAll() {
        $sql = "select * from admin";
        $command = $this->db->prepare($sql);
        $command->execute();
        $result = $command->fetchAll();
        $command->closeCursor();
        return $result;
    }

    function getLastID() {
        $sql = "SELECT admin_id FROM admin ORDER BY admin_id DESC LIMIT 1";
        $command = $this->db->prepare($sql);
        $command->execute();
        $result = $command->fetchAll();
        return $result[0]['admin_id'];
    }

    function creatTable($getlastid) {
        $sql = "CREATE TABLE dashboard".$getlastid."(
                device_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                device_value VARCHAR(30) NOT NULL )";
        $command = $this->db->prepare($sql);
        $command->execute();
    }

}
