<?php
if(empty($_SESSION['username'])) {
    header("Location: index.php?action=login");
}
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
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home Temperature</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="views/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="views/css/style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
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
</head>
<script src="views/js/mqttws31.js"></script>
<script src="views/js/define.js"></script>
<script src="views/js/utilityAdd.js"></script>
<!--page content-->
<body>
<div class="container" id="main">
    <?php require "common/main_menu.php"; ?>
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
        <div class="container-fluid">
            <div class="panel panel-default">
                <div id="waitingPopup" class="popup">
                    <!-- Modal content -->
                    <div class="popup-content">
                        <p>Please wait for hardware!!
                            <img src="https://i.stack.imgur.com/FhHRx.gif" alt="enter image description here">
                        </p>
                    </div>

                </div>
                <div id="ChooseButtonPopup" class="popup">
                    <!-- Modal content -->
                    <div class="popup-content">
                        <p>Please choose the button to be learn.</p>
                        <!-- <button onclick="close_choose_button_popup();">OK</button> -->
                        <button onclick="AC_power_learning(1);">ON</button>
                        <button onclick="AC_power_learning(2);">OFF</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-6 margin-left" style="margin-bottom: 2%">
                        <a class="btn btn-default" onclick='waiting_popup(), learning_onclick();' id="learning">
                            <i class="fa fa-power-off" style="font-size:1.6em;color:black;"></i>
                            <b style="font-size:1.5em;">Learning Code</b>
                        </a>
                        <a class="btn btn-default" onclick='AC_power_onclick();' id="power">
                            <i class="fa fa-power-off" style="font-size:1.6em;color:black;"></i>
                            <b id="power-value" style="font-size:1.5em;">OFF</b>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 margin-left-button" id="target_temp_col">
                        <div class="btn-group-vertical">
                            <div class="row">
                                <div class="col-sm-4 col-sm-4 col-md-4 col-xs-4"></div>
                                <div class="col-sm-4 col-sm-4 col-md-4 col-xs-4">
                                    <a class="btn btn-default temp-step-btn button" id="temp_step_up" onclick='AC_step_temp_onclick("up");'>
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                </div>
                                <div class="col-sm-4 col-sm-4 col-md-4 col-xs-4"></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 col-lg-4 col-md-4 col-xs-4">
                                <a class="btn btn-default temp-step-btn button" id="temp_step_left" onclick='AC_step_temp_onclick("down");'>
                                    <i class="fa fa-chevron-left"></i>
                                </a>
                                </div>
                                <div class="col-sm-4 col-lg-4 col-md-4 col-xs-4">
                                <a class="btn btn-default temp-step-btn button" id="temp_step_ok" onclick='AC_step_temp_onclick("down");' style="font-size:2em;">
                                    <i>OK</i>
                                </a>
                                </div>
                                <div class="col-sm-4 col-lg-4 col-md-4 col-xs-4">
                                <a class="btn btn-default temp-step-btn button" id="temp_step_right" onclick='AC_step_temp_onclick("down");'>
                                    <i class="fa fa-chevron-right"></i>
                                </a>
                            </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 col-sm-4 col-md-4 col-xs-4"></div>
                                <div class="col-sm-4 col-sm-4 col-md-4 col-xs-4">
                                    <a class="btn btn-default temp-step-btn button" id="temp_step_down" onclick='AC_step_temp_onclick("down");'>
                                        <i class="fa fa-chevron-down"></i>
                                    </a>
                                </div>
                                <div class="col-sm-4 col-sm-4 col-md-4 col-xs-4"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 margin-left-menu">
                        <a class="btn btn-default" onclick='waiting_popup_menu(), learning_onclick();' id="learning">
                            <i class="fa fa-power-off" style="font-size:1.6em;color:black;"></i>
                            <b style="font-size:1.5em;">MENU</b>
                        </a>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 margin-left-exit">
                        <a class="btn btn-default" onclick='waiting_popup_menu(), learning_onclick();' id="learning">
                            <i class="fa fa-power-off" style="font-size:1.6em;color:black;"></i>
                            <b style="font-size:1.5em;">EXIT</b>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
