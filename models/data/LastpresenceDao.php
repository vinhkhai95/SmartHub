<?php

namespace com\loabten\model\data;

class LastpresenceDao {
    private $db;

    function __construct($db) {
        $this->db = $db;
    }

    function insert($id,$time) {
        $sql = "INSERT INTO lastpresence".$id."(`time`) VALUES('".$time."')";
        $command = $this->db->prepare($sql);
        $result = $command->execute();
        return $result;
    }

    function getlastpresence($id){
        $sql = "SELECT * FROM lastpresence".$id." ORDER BY time DESC LIMIT 1";
        $command = $this->db->prepare($sql);
        $command->execute();
        $check = $command->fetchAll();
        return $check;
    }

    function dropLastpresence($num){
        $sql = "DROP TABLE IF EXISTS lastpresence".$num;
        $command = $this->db->prepare($sql);
        $result = $command->execute();
        return $result;
    }
}
