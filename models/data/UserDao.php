<?php

namespace com\loabten\model\data;

class UserDao{
    private $db;

    function __construct($db) {
        $this->db = $db;
    }
    /**
     * Insert new user
     * @param type $user
     * @return type
     */
    function insert($user) {
        $sql = "INSERT INTO `user` (`user_id`,`dashboard_id`, `name`, `username`, `password`, `phone`, `gender`, `email`) "
                . "VALUES (:user_id, :dashboard_id, :name, :username, :password, :phone, :gender, :email)";
        $command = $this->db->prepare($sql);

        $args = array(
            'user_id'=>$user->getuser_id(),
            'dashboard_id'=>$user->getdashboard_id(),
            'name' => $user->getName(),
            'username'=>$user->getUsername(),
            'password' => $user->getPassword(),
            'phone'=>$user->getPhone(),
            'gender' => $user->getGender(),
            'email' => $user->getEmail()
        );

        $result = $command->execute($args);
        return $result;
    }
    function update($user) {
        $sql = "UPDATE `user` SET `dashboard_id` = ?,`name` = ?,`username` = ?,`password` = ?,`phone` = ?,"
                . " `gender` = ?, `email` = ? WHERE `user_id` = ?;";
        $command = $this->db->prepare($sql);

        $command->bindValue(1, $user->getdashboard_id());
        $command->bindValue(2, $user->getName());
        $command->bindValue(3, $user->getUsername());
        $command->bindValue(4, $user->getPassword());
        $command->bindValue(5, $user->getPhone());
        $command->bindValue(6, $user->getGender());
        $command->bindValue(7, $user->getEmail());
        $command->bindValue(8, $user->getuser_id());
        $result = $command->execute();
        return $result;
    }

    function checkUsername($username) {
        $sql = "SELECT username FROM user WHERE username = ?";
        $command = $this->db->prepare($sql);
        $command->bindValue(1, $username);
        $command->execute();
        $check = $command->fetchAll();
        return $check;
    }
    
    function checkLoginuser($username, $password) {
        $sql = "select * from user where username=? and password = ?";
        $command = $command = $this->db->prepare($sql);
        $command->bindValue(1, $username);
        $command->bindValue(2, $password);
        $command->execute();
        $result = $command->fetch();
        $command->closeCursor();
        return !empty($result);
    }

    
    function findById($user_id) {
        $sql = "SELECT * FROM user WHERE user_id=?";
        $command = $command = $this->db->prepare($sql);
        $command->bindValue(1, $user_id);
        $command->execute();
        $result = $command->fetch();
        $command->closeCursor();
        return $result;
    }

    function findByName($name) {
        $sql = "SELECT * FROM user WHERE name LIKE ?";
        $command = $this->db->prepare($sql);
        $command->bindValue(1, '%' . $name . '%');
        $command->execute();
        $result = $command->fetchAll();
        $command->closeCursor();
        return $result;
    }

    function findByUsername($username){
        $sql = "SELECT dashboard_id FROM user WHERE username = '$username'";
        $command = $this->db->prepare($sql);
        $command->execute();
        $result = $command->fetch();
        return $result;
    }

    function delete($user_id) {
        $sql = "delete from user where user_id =?";
        $command = $this->db->prepare($sql);
        $command->bindValue(1, $user_id);
        $result = $command->execute();
        return $result;
    }
    function findAll() {
        $sql = "SELECT * FROM user LEFT JOIN dashboard ON user.dashboard_id = dashboard.lab_id";
        $command = $this->db->prepare($sql);
        $command->execute();
        $result = $command->fetchAll();
        $command->closeCursor();
        return $result;
    }
    function findRoomName($room_id) {
        $sql = "SELECT * FROM user LEFT JOIN dashboard ON user.dashboard_id = dashboard.lab_id WHERE dashboard_id = $room_id";
        $command = $this->db->prepare($sql);
        $command->execute();
        $result = $command->fetchAll();
        $command->closeCursor();
        return $result;
    }
    function findSortedAll($name) {
        $sql = "select * from user order by $name";
        $command = $this->db->prepare($sql);
        $command->execute();
        $result = $command->fetchAll();
        $command->closeCursor();
        return $result;
    }
    function getLastID() {
        $sql = "SELECT user_id FROM user ORDER BY user_id DESC LIMIT 1";
        $command = $this->db->prepare($sql);
        $command->execute();
        $result = $command->fetchAll();
        return $result[0]['user_id'];
    }

    
}