<?php

try {
    $labDao = new com\loabten\model\data\LabDao(com\loabten\model\data\DatabaseUtils::connect());
    $deviceDao = new com\loabten\model\data\DeviceDao(com\loabten\model\data\DatabaseUtils::connect());
    $mqttDao = new com\loabten\model\data\MqttDao(com\loabten\model\data\DatabaseUtils::connect());
    if ($action == 'detail') {
        $lab_id = $_GET['lab_id'];
        $row = $labDao->findById($lab_id);
        include './views/lab/detail.php';
    }elseif ($action == 'add') {
        include './views/lab/add.php';
    }elseif ($action == 'add_save') {
        $name = $_POST['name'];

        $check_name = $labDao->checkLabname($name);
        if (isset($check_name[0]['dashboard_value']) && $check_name[0]['dashboard_value'] == $name) {
            $msg = "Lab Name exists already!";
            include './views/lab/add.php';
            return;
        }
        $labDao->insert($name);
        $dashboard_id = $labDao->findId($name);
        $labDao->creatTable($dashboard_id[0]['lab_id']);
        $labDao->creatTableLastpresence($dashboard_id[0]['lab_id']);

        //Set MQTT parameters default
        $hostname = "tapit.vn";
        $port = 9001;
        $clientid = "room".$dashboard_id[0]['lab_id'];
        $path = '/mqtt';
        $ssl = 0;
        $user = 'vinhkhai';
        $pass = 'vinhkhai';
        $keepalive= 60;
        $timeout= 3;
        $cleansession = 0;
        $qos = 0;
        $retain = 0;

        $mqtt = new com\loabten\model\Mqtt();

        $mqtt->setHostname($hostname);
        $mqtt->setPort($port);
        $mqtt->setClientid($clientid);
        $mqtt->setPath($path);
        $mqtt->setSsl($ssl);
        $mqtt->setUser($user);
        $mqtt->setPass($pass);
        $mqtt->setKeepalive($keepalive);
        $mqtt->setTimeout($timeout);
        $mqtt->setCleansession($cleansession);
        $mqtt->setQos($qos);
        $mqtt->setRetain($retain);

        $newMqttParam = $mqttDao->insert($mqtt);
        $result = $labDao->findAll();

        $smg = "$name has been inserted";

        include './views/lab/list.php';
    }elseif ($action == 'add_device') {
        $lab_id = $_POST['lab_id'];
        $device_value = $_POST['device_value'];
        $value = $_POST['value'];

        $device = new com\loabten\model\Device();

        $device->setDevice_value($device_value);
        $device->set_value($value);

        $deviceDao->insert($lab_id,$device);

        include './views/lab/detail.php';
    }elseif ($action == 'delete_device') {
        $lab_id = $_POST['lab_id'];
        $device_value = $_POST['device_value'];

        $device = new com\loabten\model\Device();

        $device->setDevice_value($device_value);

        $deviceDao->delete($lab_id,$device);

        include './views/lab/detail.php';
    }elseif ($action == 'update_device') {
        $lab_id = $_POST['lab_id'];
        $device_value = $_POST['device_value'];
        $value = $_POST['value'];

        $device = new com\loabten\model\Device();

        $device->setDevice_value($device_value);
        $device->set_value($value);

        $deviceDao->update($lab_id,$device);

        include './views/lab/detail.php';
    }elseif ($action == 'delete') {
        $lab_id = $_GET['lab_id'];
        $labDao->delete($lab_id);
        $labDao->dropdashboard($lab_id);
        $labDao->dropLastpresence($lab_id);
        $mqttDao->deleteByRoomId($lab_id);
        $alert_message = 'The lab name has been deleted!!';
        $result = $labDao->findAll();
        include './views/lab/list.php';
    }elseif ($action == 'edit') {
        $lab_id = $_GET['lab_id'];
        $row = $labDao->findById($lab_id);
        include './views/lab/edit.php';
    }elseif ($action == 'edit_save') {
        $lab_id = $_POST['lab_id'];
        $value = $_POST['value'];

        $row = $labDao->update($lab_id,$value);
        $row = $labDao->findById($lab_id);

        $msg = "Room ".$lab_id." has been updated!";

        include './views/lab/edit.php';
    }elseif ($action == 'delete') {
        $lab_id = $_GET['lab_id'];
        $result = $userDao->delete($lab_id);
        $result = $userDao->findAll();

        //Delete mqttparameter
        $result2 = $mqttDao->delete($lab_id);

        $alert_message = 'The user has been deleted!!';
        include './views/users/list.php';
    }elseif ($action == 'find') {
        $result = NULL;
        if (isset($_POST['name'])) {
            $name = $_POST['name'];
            $result = $labDao->findByName($name);
            if (empty($result)) {
                $msg = "There aren't any lab";
            }
        } else {
            $result = $labDao->findAll();
        }
        include './views/lab/find.php';
    } else { //(action == 'list')
        $result = $labDao->findAll();
        include './views/lab/list.php';
    }
} catch (Exception $exc) {
    $error = $exc->getMessage();
}