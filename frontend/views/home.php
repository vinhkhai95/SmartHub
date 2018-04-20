<?php

$username = $_SESSION['username'];

$deviceDao = new com\loabten\model\data\DeviceDao(com\loabten\model\data\DatabaseUtils::connect());
$userDao = new com\loabten\model\data\UserDao(com\loabten\model\data\DatabaseUtils::connect());
$lastpresenceDao = new com\loabten\model\data\LastpresenceDao(com\loabten\model\data\DatabaseUtils::connect());
$now = time();
// if($now - $_SESSION['start'] > 1800){
//     session_unset(); 
//     session_destroy();
//     header("Location: index.php?action=login");
// }

// Lấy mảng id của user dựa vào username cũng chính là stt dashboard
$room_id = $userDao->findByUsername($username);
//Lấy tất cả thông tin từ dashboard của user để tạo giao diện
$value = $deviceDao->findAll($room_id['dashboard_id']);

//Lấy tổng số lượng phòng làm gì??
$totalNumberRoom = $userDao->getLastID();

$mqttDao = new com\loabten\model\data\MqttDao(com\loabten\model\data\DatabaseUtils::connect());
$mqtts = $mqttDao->findById($room_id['dashboard_id']);   //Lay so thu tu mqttpara tuong ung voi id
?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<title>Lab System</title>
<link rel="shortcut icon" href="views/pictures/favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="views/css/style.css">
<link rel="stylesheet" type="text/css" href="views/css/light.css">
<link rel="stylesheet" type="text/css" href="views/css/fan.css">
<link rel="stylesheet" type="text/css" href="views/css/css.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/solid-gauge.js"></script>
<script type="text/javascript" src="views/js/charts.js"></script>
<script type="text/javascript" src="views/js/warning.js"></script>
<script type="text/javascript" src="views/js/fan.js"></script>
<script type="text/javascript" src="views/js/light.js"></script>
<script type="text/javascript" src="views/js/air.js"></script>


<!-- Chuyển biến PHP sang Javascript để xử lý MQTT -->
<script type="text/javascript">   
    var AllDeviceName = <?=json_encode($value)?>;   //Lấy tên của các thiết bị dùng để subscribe
    var room_id = <?=json_encode($room_id['dashboard_id'])?>;
    var mqtts = (<?php echo json_encode($mqtts); ?>);
    var hostname = mqtts.hostname;
    var port = mqtts.port;
    var clientId = mqtts.clientid;
    var path = mqtts.path;
    var ssl = mqtts.ssl == '0'?false:true;
    var user = mqtts.user;
    var pass = mqtts.pass;
    var keepAlive = Number(mqtts.keepalive);
    var timeout = Number(mqtts.timeout);
    var cleanSession = mqtts.cleansession == '0'?false:true;
    var qos = Number(mqtts.qos);
    var retain = mqtts.retain == '0'?false:true;
</script>
<script src="views/js/moment.js"></script>
<script src="views/js/mqttws31.js"></script>
<script src="views/js/define.js"></script>
<script src="views/js/utilityAdd.js"></script>
</head>
<body>
<div class="container" id="main">
    <?php require "common/main_menu.php"; ?>
    <div class="controller">
    <div class="heading" style="background-color: #eaeaea;">
        <div class="row">
            <?php $room_value = $userDao->findRoomName($room_id['dashboard_id'])?>
            <div class="title">Name: <?=$room_value[0]['name'];?></div>
        </div>
        <div class="row">
            <?php $room_value = $userDao->findRoomName($room_id['dashboard_id'])?>
            <div class="title">Room: <?=$room_value[0]['dashboard_value'];?></div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align: left;">Controller Panel</div>
                <div class="panel-body" id="publishCollapse">
                    <div class="row" id="add_field">
                    <?php
                    foreach ($value as $key) {
                        if(strpos($key['value'],'light') !== false ){
                        ?>
                        <div class="col-lg-4 col-md-6" id="<?=$key['device_value']?>">
                            <div class="form-group">
                                <div class="text"><?=substr_replace($key['device_value'],"Device ",0,6);?></div>
                                <div>
                                    <div class="cube-switch">
                                        <span class="switch" onclick="switchLight(this);checkLight(this)">
                                            <span class="switch-state off">Off</span>
                                            <span class="switch-state on">On</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="light-bulb-off off ui-draggable" >
                                    <div class="light-bulb-on" style="opacity: 0;"></div>
                                </div>
                            </div>
                        </div>
                        <?php
                        } elseif(strpos($key['value'],'fan') !== false ) {  ?>
                        <div class="col-lg-4 col-md-6" id="<?=$key['device_value']?>">
                            <div class="form-group">
                                <div class="text"><?=substr_replace($key['device_value'],"Device ",0,6);?></div>
                                <div>
                                    <div class="cube-switch3">
                                        <span class="switch3" onclick="switchFan(this);checkFan(this)">
                                            <span class="switch-state3 off3">Off</span>
                                            <span class="switch-state3 on3">On</span>
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <img class="div" src="../pictures/fan.jpg" id="fan<?=$key['device_value']?>">
                                </div>
                            </div>
                        </div>
                        <?php } }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
<!--    <div class="monitor">-->
        <div class="row">
            <div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Temperature Monitor Panel</div>
                    <div class="panel-body warning" id="subscribeCollapse">
                        <div id="container-speed" class="container-speed"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Light Detection Panel</div>
                    <div class="panel-body warning" id="subscribeCollapse">
                        <img class="light-on-off" id="lightsensor" src="../pictures/lightoff.png">
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Human Presence Panel</div>
                    <div class="panel-body warning" id="subscribeCollapse"> 
                        <img id="humanpresence" src="views/pictures/notHuman.PNG" alt="human presence" class="img-responsive">
                        <div class="lastPresence" id="lastPresence">
                            <?php 
                            $result = $lastpresenceDao->getlastpresence($room_id['dashboard_id']);
                            if(!isset($result[0]['time'])) {
                                echo 'Last presence: No data';
                            } else {
                                echo 'Last presence:'.$result[0]['time'];
                            }?>
                        </div>               
                    </div>
                </div>
            </div>
              
        </div>
<!--    </div>-->
</div>
</body>
</html>
