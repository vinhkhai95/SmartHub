<?php

namespace com\loabten\model\data;

class DeviceDao {
    private $db;

    function __construct($db) {
        $this->db = $db;
    }

    function insert($lab_id,$device) {
        $sql = "INSERT INTO `dashboard".$lab_id."`(`device_value`,`value`) VALUES (?,?)";
        $command = $this->db->prepare($sql);
        $command->bindValue(1, $device->getDevice_value());
        $command->bindValue(2, $device->get_value());
        $result = $command->execute();
        return $result;
    }

    function update($lab_id,$device) {
        $sql = "UPDATE `dashboard".$lab_id."` SET `value` = ? WHERE `device_value`= ?";
        $command = $this->db->prepare($sql);
        $command->bindValue(1, $device->get_value());
        $command->bindValue(2, $device->getDevice_value());
        $result = $command->execute();
        return $result;
    }

    function delete($lab_id,$device) {
        $sql = "UPDATE `dashboard".$lab_id."` SET `value` = 'NULL' WHERE `device_value`= ?";
        $command = $this->db->prepare($sql);
        $command->bindValue(1, $device->getDevice_value());
        $result = $command->execute();
        return $result;
    }

    function findAll($lab_id) {
        $sql = "SELECT * FROM `dashboard".$lab_id."`";
        $command = $this->db->prepare($sql);
        $command->execute();
        $result = $command->fetchAll();
        return $result;
    }

    function findById($user_id) {
        $sql = "SELECT * FROM dashboard".$user_id." ORDER BY device_id DESC LIMIT 1";
        $command = $this->db->prepare($sql);
        $command->execute();
        $result = $command->fetchAll();
        $command->closeCursor();
        return $result;
    }

}
