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
require '../Utilities/UploadFileHelper.php';

$action = 'list';
if (isset($_POST['action'])) {
    $action = $_POST['action'];
} elseif (isset($_GET['action'])) {
    $action = $_GET['action'];
}   
if ($action == 'home'){
    include './views/home.php';
}elseif ($action == 'ac'){
    include './views/ac.php';
}elseif ($action == 'login'){
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
}
else{
    include '../Utilities/Security.php';
    include './views/home.php';
    if (strpos($action, 'home') !== false) {
        $action = substr($action, 5);
        $type = 'home';

        include './controllers/UserController.php';
    } elseif (strpos($action, 'ac') !== false) {
        $action = substr($action, 3);
        $type = 'ac';

        include './controllers/AcController.php';
    }
}