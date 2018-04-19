<?php
try {
    $connection = com\loabten\model\data\DatabaseUtils::connect();
    $mqttDao = new com\loabten\model\data\MqttDao($connection);
    $userDao = new com\loabten\model\data\UserDao($connection);
    if ($action == 'edit') {        
        $mqtts = $mqttDao->findAll();
        $row = $mqttDao->findById('1');
        include './views/mqtt/edit.php';
    } elseif ($action == 'edit_save') {
        $hostname = $_POST['hostname'];
        $mqtt_id = $_POST['user_id'];
        $port = $_POST['port'];
        $clientid = $_POST['clientid'];
        $path = $_POST['path'];
        $ssl = $_POST['ssl'];
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $keepalive= $_POST['keepalive'];
        $timeout= $_POST['timeout'];
        $cleansession = $_POST['cleansession'];
        $qos = $_POST['qos'];
        $retain = $_POST['retain'];
        echo "$mqtt_id";
        $mqtt = new com\loabten\model\Mqtt();
        
        $mqtt->setMqtt_id($mqtt_id);
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

        $mqttDao->update($mqtt);
        $msg = 'The MQTT Parameter has been updated!';
        //$result = $mqttDao->findAll();
        // include './views/mqtt/edit.php';
        header('location: index.php?action=edit');
    } elseif ($action == 'find') {
        $result = NULL;
        if (isset($_POST['productname'])) {
            $productname = $_POST['productname'];
            $result = $productDao->findByName($productname);
            if (empty($result)) {
                $msg = "There aren't any products";
            }
        } else {
            $result = $productDao->findAll();
        }
        include './views/products/find.php';
    } else { //(action == 'list')
        $result = $mqttDao->findAll();
        include './views/products/list.php';
    }
} catch (Exception $exc) {
    $error = $exc->getMessage();
    include 'views/dashboard/error.php';
}