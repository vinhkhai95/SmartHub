<?php
require_once 'common/header.php';
$mqttDao = new com\loabten\model\data\MqttDao(com\loabten\model\data\DatabaseUtils::connect());
$mqtts = $mqttDao->findById($lab_id);   //Lay so thu tu mqttpara tuong ung voi id
?>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <script src="views/js/jquery.js"></script>
    <script type="text/javascript" src="views/js/boostrap.js"></script>
    <link rel="stylesheet" href="views/css/light.css">
    <link rel="stylesheet" href="views/css/fan.css">
    <link rel="stylesheet" href="views/css/css.css">

    <!-- Chuyển biến PHP sang Javascript để xử lý MQTT -->
    <script type="text/javascript">
        var room_id = <?=json_encode($lab_id)?>;
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
    <script src="views/js/mqttws31.js"></script>
    <script src="views/js/define.js"></script>
    <script src="views/js/utilityAdd.js"></script>
    <script type="text/javascript" src="views/js/light.js"></script>
    <script type="text/javascript" src="views/js/fan.js"></script>
    <script type="text/javascript" src="views/js/air.js"></script>
    <script type="text/javascript" src="views/js/addmore.js"></script>
</head>
<body>
<div class="dashboard-wrapper">
    <div class="top-bar">
        <div class="page-title"> Detail User </div>
    </div>
    <div class="main-container">
        <div class="container-fluid">
            <div class="spacer">
                <?php
                include 'common/message_panel.php';
                include 'common/error_panel.php';?>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-sx-12">
                        <div class="panel no-margin">
                            <div class="panel-heading">
                                <h4 class="panel-title">ROOM ID: <span><?= $lab_id?></span></h4>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td style="width:50%">
                                                <abbr><strong>Room Name:</strong></abbr>
                                                <span class="label label-info1"><?= $row['dashboard_value']?></span><br>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <hr class="less-margin">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-sx-12">
                                        <div class="pull-left">
                                            <a type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">
                                                <span class="hidden-xs">Add Device</span>
                                            </a>
                                            <div class="modal fade" id="myModal" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">Thiết bị</h4>
                                                        </div>
                                                        <div class="row">
                                                            <div class="modal-body">
                                                                <div class="col-sm-4" id="add_light">
                                                                    <img class="lightfan" src="../pictures/light.jpg">
                                                                </div>
                                                                <div class="col-sm-4" id="add_fan">
                                                                    <img class="lightfan" src="../pictures/fan.jpg">
                                                                </div>
                                                                <div class="col-sm-4" id="add_air">
                                                                    <img class="lightfan" src="../pictures/air.jpg">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pull-right">
                                            <a href="index.php?action=lab_edit&lab_id=<?= $lab_id?>" type="button" class="btn btn-warning">
                                                <i class="fa fa-edit"></i>
                                                <span class="hidden-xs">Edit</span>
                                            </a>
                                            <a href="#" type="button" class="btn btn-danger"
                                               onclick="confirmDelete('index.php?action=lab_delete&lab_id=<?=$lab_id?>', 'lab');">
                                                <i class="fa fa-trash-o"></i>
                                                <span class="hidden-xs">Delete</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <?php
                    $deviceDao = new com\loabten\model\data\DeviceDao(com\loabten\model\data\DatabaseUtils::connect());
                    $value = $deviceDao->findAll($lab_id);?>
                    <input type="hidden" id="lab_id" value="<?=$lab_id?>">
                    <?php
                    if (isset($value) && $value == NULL){ ?>
                        <input type="hidden" id="count" value="0"/>
                    <?php }  else { ?>
                        <input type="hidden" id="count" value="<?=count($value)?>"/>
                    <?php } ?>
                </div>
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-body" id="publishCollapse">
                            <div class="row" id="add_field">
                                <?php
                                foreach ($value as $key) {
                                    if(strpos($key['value'],'light') !== false ){
                                        ?>
                                        <div class="col-lg-4" id="<?=$key['device_value']?>">
                                            <div class="form-group thumbnail">
                                                <div class="text"><?=substr_replace($key['device_value'],"Device ",0,6);?></div>
                                                <div class="border">
                                                    <div class="light-bulb-off" id="light<?=$key['device_value']?>">
                                                    </div>
                                                    <input type="button" class="w3-button w3-black" value="delete"
                                                           onclick="deleteLight(this);checkLatch(this)" name="delete">
                                                </div>
                                            </div>
                                        </div>
                                    <?php } elseif(strpos($key['value'],'fan') !== false ) { ?>
                                        <div class="col-lg-4" id="<?=$key['device_value']?>">
                                            <div class="form-group thumbnail">
                                                <div class="text"><?=substr_replace($key['device_value'],"Device ",0,6);?></div>
                                                <div class="border">
                                                    <input type="button" class="w3-button w3-black" value="delete"
                                                           onclick="deleteFan(this);checkLatch(this)" name="delete">
                                                    <div>
                                                        <img class="img" src="../pictures/fan.jpg" id="fan<?=$key['device_value']?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } elseif(strpos($key['value'],'air') !== false ) { ?>
                                        <div class="col-lg-4" id="<?=$key['device_value']?>">
                                            <div class="form-group thumbnail">
                                                <div class="text"><?=substr_replace($key['device_value'],"Device ",0,6);?></div>
                                                <div class="border">
                                                    <input type="button" class="w3-button w3-black" value="delete"
                                                           onclick="deleteAir(this);checkLatch(this)" name="delete">
                                                    <div id="air<?=$key['device_value']?>">
                                                        <img class="img" src="../pictures/air.jpg">
                                                        <div class="selection">
                                                            <select>
                                                                <option>20&deg;C</option>
                                                                <option>22&deg;C</option>
                                                                <option>24&deg;C</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } elseif(strpos($key['value'],'NULL') !== false ) { ?>
                                        <div class="col-lg-4" id="<?=$key['device_value']?>">
                                            <div class="form-group thumbnail">
                                                <div class="text"><?=substr_replace($key['device_value'],"Device ",0,6);?></div>
                                                <div class="border">
                                                    <input type="button" class="w3-button w3-black" data-toggle="modal" data-target="#addmore<?=$key['device_value']?>" value="Add <?=substr_replace($key['device_value'],"Device ",0,6);?>" id="delete">
                                                    <div class="modal fade" id="addmore<?=$key['device_value']?>" role="dialog">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title">Thiết bị</h4>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="modal-body">
                                                                        <div class="col-sm-4" onclick="addmore_light(this)">
                                                                            <img class="lightfan" src="../pictures/light.jpg">
                                                                        </div>
                                                                        <div class="col-sm-4" onclick="addmore_fan(this)">
                                                                            <img class="lightfan" src="../pictures/fan.jpg">
                                                                        </div>
                                                                        <div class="col-sm-4" onclick="addmore_air(this)">
                                                                            <img class="lightfan" src="../pictures/air.jpg">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="addmore_field"></div>
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
    </div>
</div>
<script>connect();</script>
</body>
</html>
<?php
require_once 'common/footer.php';
?>