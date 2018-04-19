<?php

try {
    $userDao = new com\loabten\model\data\UserDao(com\loabten\model\data\DatabaseUtils::connect());
    $labDao = new com\loabten\model\data\LabDao(com\loabten\model\data\DatabaseUtils::connect());
    if ($action == 'detail') {
        $user_id = $_GET['user_id'];
        $row = $userDao->findById($user_id);
        include './views/users/detail.php';
    }elseif ($action == 'add') {
        $lab_name = $labDao->getdashboardname();
        include './views/users/add.php';
    }elseif ($action == 'add_save') {
        $name = $_POST['name'];
        $dashboard_id = $_POST['lab_id'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $phone = $_POST['phone'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $user = new com\loabten\model\User();
        $user->setName($name);
        $user->setdashboard_id($dashboard_id);
        $user->setUsername($username);
        $user->setPassword($password);
        $user->setPhone($phone);
        $user->setEmail($email);
        $user->setGender($gender);

        $check = $userDao->checkUsername($username);
        if (isset($check[0]['username']) && $check[0]['username'] == $username) {
            $msg = "Username exits already!";
            $result = $userDao->findAll();        
            include './views/users/add.php';
        } else {
            $result = $userDao->insert($user);

            $msg = "$result user has been inserted";
            $dashboard_name = $labDao->getdashboardname();
            $result = $userDao->findAll();
            include './views/users/list.php';
        }
    } elseif ($action == 'delete') {
        $user_id = $_GET['user_id'];        
        $result = $userDao->delete($user_id);
        $result = $userDao->findAll();
        
        //Delete mqttparameter
        $result2 = $mqttDao->delete($user_id);
        
        $alert_message = 'The user has been deleted!!';        
        include './views/users/list.php';
    } elseif ($action == 'edit') {
        $user_id = $_GET['user_id'];
        $row = $userDao->findById($user_id);
        $lab_name = $labDao->getdashboardname();
        include './views/users/edit.php';
    } elseif ($action == 'edit_save') {
        $user_id = $_POST['user_id'];
        $lab_id = $_POST['lab_id'];
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];

        $user = new com\loabten\model\User();

        $user->setuser_id($user_id);
        $user->setdashboard_id($lab_id);
        $user->setName($name);
        $user->setUsername($username);
        $user->setPassword($password);
        $user->setPhone($phone);
        $user->setGender($gender);
        $user->setEmail($email);

        $userDao->update($user);

        $msg = 'The user has been updated!';
        $result = $userDao->findAll();
        include './views/users/list.php';
    } elseif ($action == 'find') {
        $result = NULL;
        if (isset($_POST['name'])) {
            $user_name = $_POST['name'];
            $result = $userDao->findByName($user_name);
            if (empty($result)) {
                $msg = "There aren't any users";
            }
        } else {
            $result = $userDao->findAll();
        }
        include './views/users/find.php';
    } else { //(action == 'list')
        $result = $userDao->findAll();
        include './views/users/list.php';
    }
} catch (Exception $exc) {
    $error = $exc->getMessage();
}