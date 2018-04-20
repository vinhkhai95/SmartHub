<?php
require '../models/data/DatabaseUtils.php';
require '../models/data/UserDao.php';
require '../models/User.php';
require '../models/data/DeviceDao.php';
require '../models/Device.php';
require '../models/Lastpresence.php';
require '../models/data/LastpresenceDao.php';
require '../models/data/MqttDao.php';
require '../models/Mqtt.php';

$action = 'list';

if (isset($_POST['action'])) {
    $action = $_POST['action'];
} elseif (isset($_GET['action'])) {
    $action = $_GET['action'];
}

if ($action == 'login'){
    include './views/security/login.php';
}elseif ($action == 'login_check'){
    $customerDao = new com\loabten\model\data\UserDao(com\loabten\model\data\DatabaseUtils::connect());
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($customerDao->checkLoginuser($username, $password)){
        session_start();
        $_SESSION['username'] = $username;
        header("Location: index.php?action=home");
    }else{
        $msg = "Invalid username or password";
        include './views/security/login.php';
    }
}elseif ($action == 'logout'){
    session_destroy();
    header("Location: index.php?action=login");
}
else{
    include '../Utilities/Security.php';

    if ($action == 'home') {
        include './views/home.php';
    }elseif ($action == 'ac'){
        include './views/ac.php';
    }elseif ($action == 'projector'){
        include './views/projector.php';
    }
}