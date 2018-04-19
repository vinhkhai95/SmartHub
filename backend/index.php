<?php
require '../models/data/DatabaseUtils.php';
require '../models/data/UserDao.php';
require '../models/User.php';
require '../models/data/LastpresenceDao.php';
require '../models/Lastpresence.php';
require '../models/data/AdminDao.php';
require '../models/Admin.php';
require '../Utilities/UploadFileHelper.php';
require '../models/Device.php';
require '../models/data/DeviceDao.php';
require '../models/MQTT.php';
require '../models/data/MqttDao.php';
require '../models/Lab.php';
require '../models/data/LabDao.php';
$action = "list";

if (isset($_POST['action'])) {
    $action = $_POST['action'];
}elseif (isset($_GET['action'])) {
    $action = $_GET['action'];
}
if ($action == 'login'){
    include './views/security/login.php';
}elseif($action == 'abc'){
    $customer_id = $_POST['get_option'];
    $mqttDaos = new com\loabten\model\data\MqttDao(com\loabten\model\data\DatabaseUtils::connect());
    $row = $mqttDaos->findById($customer_id);
    echo json_encode($row);
}elseif ($action == 'login_check'){
    $userDao = new com\loabten\model\data\AdminDao(com\loabten\model\data\DatabaseUtils::connect());
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($userDao->checkLogin($username, $password)){
        header('Location: index.php');
    }else{
        $msg = "Invalid username or password";
        include './views/security/login.php';
    }
}else{

    include '../Utilities/Security.php';

    if (strpos($action, 'admin')!== false){
        $action = substr($action, 6);
        $type = 'admin';

        include './controllers/AdminController.php';
    }elseif (strpos($action, 'user') !== false) {
        $action = substr($action, 5);
        $type = 'user';

        include './controllers/UserController.php';
    }elseif (strpos($action, 'lab') !== false) {
        $action = substr($action, 4);
        $type = 'lab';

        include './controllers/LabController.php';
    }elseif (strpos($action, 'MQTT') !== false) {
        $action = substr($action, 5);
        $type = 'MQTT';

        include './controllers/MqttController.php';
    }else{
        $type='dashboard';
        include './views/dashboard/home.php';
    }
}