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
				    <p>Please choose the button to be learn.				   
				    </p>
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
                    <div class="col-md-4 col-sm-6 margin-left">
                        <!-- Mode -->
                        <h4>Mode</h4>
                        <div class="btn-group">
                            <a class="btn btn-default mode-btn" id="mode_cooling" onclick='AC_mode_onclick(1);'><i class="fa fa-asterisk fa-2x"></i></a>
                            <a class="btn btn-default mode-btn" id="mode_dehum" 	onclick='AC_mode_onclick(2);'><i class="fa fa-tint fa-2x"></i></a>
                            <a class="btn btn-default mode-btn" id="mode_heating" onclick='AC_mode_onclick(3);'><i class="fa fa-sun-o fa-2x"></i></a>
                            <a class="btn btn-default mode-btn" id="mode_fan" 		onclick='AC_mode_onclick(4);'><i class="fa fa-retweet fa-2x"></i></a>
                            <a class="btn btn-default mode-btn" id="mode_auto" 	onclick='AC_mode_onclick(5);'><i class="fa fa-font fa-2x"></i></a>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 margin-left">
                        <!-- Fan -->
                        <h4>Fan</h4>
                        <div class="btn-group">
                            <a class="btn btn-default fan-btn" id="fan_auto" 	onclick='AC_fan_onclick(1);'><i class="fa fa-font fa-2x"></i></a>
                            <a class="btn btn-default" onclick='AC_fan_onclick(2);'><img src="views/media/level_1_off.svg" height="29px" id="fan_lvl_1"></a>
                            <a class="btn btn-default" onclick='AC_fan_onclick(3);'><img src="views/media/level_2_off.svg" height="29px" id="fan_lvl_2"></a>
                            <a class="btn btn-default" onclick='AC_fan_onclick(4);'><img src="views/media/level_3_off.svg" height="29px" id="fan_lvl_3"></a>
                            <a class="btn btn-default" onclick='AC_fan_onclick(5);'><img src="views/media/level_4_off.svg" height="29px" id="fan_lvl_4"></a>
                            <a class="btn btn-default" onclick='AC_fan_onclick(6);'><img src="views/media/level_5_off.svg" height="29px" id="fan_lvl_5"></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-6 margin-left" id="target_temp_col" style="margin-bottom: 5%;margin-top: 5%">
                        <!--Step Temperature-->
                        <h4>Step Temperatures</h4>
<!--                         <div class="btn-group" >
                            <a class="btn btn-default" id="temp_now" style="font-size:2.2em;padding-top:12px;padding-bottom:12px;"><b> 18 &#x2103</b></a>
                        </div> -->

                        <div class="btn-group-vertical">
                            <a class="btn btn-default temp-step-btn" id="temp_step_up" onclick='AC_step_temp_onclick("up");' style="font-size:3em;padding-top:0px;padding-bottom:0px;"><i class="fa fa-chevron-up"></i></a>
                            <a class="btn btn-default temp-step-btn"	id="temp_step_down" onclick='AC_step_temp_onclick("down");' style="font-size:3em;padding-top:0px;padding-bottom:0px;"><i class="fa fa-chevron-down"></i></a>
                        </div>
    
                    </div>
                    <div class="col-md-4 col-sm-6 margin-left" style="margin-bottom: 5%;margin-top: 5%">
                        <!-- Target Temperatures -->
                        <h4>Target Temperatures</h4>
                        <div class="btn-group" >
                            <a class="btn btn-default temp-target-btn" style="font-size:1.8em;" onclick='AC_target_temp_onclick(this);' id="deg_18">
                                </i><b> 18 &#x2103</b>
                            </a>
                            <a class="btn btn-default temp-target-btn" style="font-size:1.8em;" onclick='AC_target_temp_onclick(this);' id="deg_20">
                                </i><b> 20 &#x2103</b>
                            </a>
                            <a class="btn btn-default temp-target-btn" style="font-size:1.8em;" onclick='AC_target_temp_onclick(this);' id="deg_22">
                                </i><b> 22 &#x2103</b>
                            </a>
                            <a class="btn btn-default temp-target-btn" style="font-size:1.8em;" onclick='AC_target_temp_onclick(this);' id="deg_24">
                                </i><b> 24 &#x2103</b>
                            </a>
                            <a class="btn btn-default temp-target-btn" style="font-size:1.8em;" onclick='AC_target_temp_onclick(this);' id="deg_26">
                                </i><b> 26 &#x2103</b>
                            </a>
                            <a class="btn btn-default temp-target-btn" style="font-size:1.8em;" onclick='AC_target_temp_onclick(this);' id="deg_28">
                                </i><b> 28 &#x2103</b>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
	</div>
</body>
</html>
