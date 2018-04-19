<?php

namespace com\loabten\model\data;

class MqttDao {

    private $db;

    function __construct($db) {
        $this->db = $db;
    }

    function insert($mqtt) {
        $sql = "INSERT INTO `mqttparam` (`mqtt_id`,`hostname`,`port`,`clientid`,"
                . " `path`,`ssl`, `user`,`pass`,`keepalive`,`timeout`,`cleansession`,`qos`,`retain`)"
                . " VALUES(:mqtt_id,:hostname,:port,:clientid,:path,"
                . ":ssl, :user, :pass, :keepalive, :timeout, :cleansession, :qos, :retain);";
        $command = $this->db->prepare($sql);

        $args = array(
            'mqtt_id' => $mqtt->getMqtt_id(),
            'hostname' => $mqtt->getHostname(),
            'port' => $mqtt->getPort(),
            'clientid' => $mqtt->getClientid(),           
            'path' => $mqtt->getPath(),
            'ssl' => $mqtt->getSsl(),
            'user' => $mqtt->getUser(),
            'pass' => $mqtt->getPass(), 
            'keepalive'=>$mqtt->getKeepalive(),
            'timeout'=>$mqtt->getTimeout(),
            'cleansession'=>$mqtt->getCleansession(),
            'qos' => $mqtt->getQos(),
            'retain' => $mqtt->getRetain()
        );

        $result = $command->execute($args);
        return $result;
    }
    
    function update($mqtt) {
        $sql = "UPDATE `mqttparam` SET `mqtt_id` = :mqtt_id,`hostname` = :hostname, "
                . "`port` = :port, `clientid` = :clientid,  `path` = :path, `ssl` = :ssl,"
                . "`user` = :user, `pass` = :pass,  `keepalive` = :keepalive, `timeout` = :timeout,"
                . "`cleansession` = :cleansession, `qos` = :qos,  `retain` = :retain"
                . " WHERE `mqtt_id` = :mqtt_id";
        $command = $this->db->prepare($sql);

        $args = array(
            'mqtt_id' => $mqtt->getMqtt_id(),
            'hostname' => $mqtt->getHostname(),
            'port' => $mqtt->getPort(),
            'clientid' => $mqtt->getClientid(),           
            'path' => $mqtt->getPath(),
            'ssl' => $mqtt->getSsl(),
            'user' => $mqtt->getUser(),
            'pass' => $mqtt->getPass(), 
            'keepalive'=>$mqtt->getKeepalive(),
            'timeout'=>$mqtt->getTimeout(),
            'cleansession'=>$mqtt->getCleansession(),
            'qos' => $mqtt->getQos(),
            'retain' => $mqtt->getRetain()
        );

        $result = $command->execute($args);
        return $result;
    }
    function findById($mqtt_id) {
        $sql = "select * from `mqttparam` where `mqtt_id` = ?";
        $command = $command = $this->db->prepare($sql);
        $command->bindValue(1, $mqtt_id);
        $command->execute();
        $result = $command->fetch();
        $command->closeCursor();
        return $result;
    }

    function delete($mqtt_id) {
        $sql = "delete from `mqttparam` where `mqtt_id` = ?";
        $command = $this->db->prepare($sql);
        $command->bindValue(1, $mqtt_id);
        $result = $command->execute();
        return $result;
    }

    function deleteByRoomId($lab_id) {
        $sql = "DELETE FROM `mqttparam` WHERE `clientid` = ?";
        $command = $this->db->prepare($sql);
        $command->bindValue(1, 'room' . $lab_id);
        $result = $command->execute();
        return $result;
    }
    
    function findAll() {
        $sql = "select * from `mqttparam`";
        $command = $this->db->prepare($sql);
        $command->execute();
        $result = $command->fetchAll();
        $command->closeCursor();
        return $result;
    }
}