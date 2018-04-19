<?php
require_once 'common/header.php';
$mqttDao = new com\loabten\model\data\MqttDao(com\loabten\model\data\DatabaseUtils::connect());
$mqtts = $mqttDao->findById($user_id);   //Lay so thu tu mqttpara tuong ung voi id
?>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<script src="views/js/jquery.js"></script>

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
                                <h4 class="panel-title">User ID:<span><?= $row['user_id']?></span></h4>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td style="width:50%">
                                                    <abbr><strong>User Name:</strong></abbr> 
                                                    <span class="label label-info1"><?= $row['name']?></span><br>
                                                    <abbr><strong>Phone:</strong></abbr> 
                                                    <span class="label label-info1"><?= $row['phone']?></span><br>
                                                </td>
                                                <td style="width:50%" class="left-align-text">
                                                    <abbr><strong>Gender:</strong></abbr>
                                                    <span class="label label-info1">
                                                        <?= $row['gender'] == 0 ? 'Female' : 'Male' ?></span><br>
                                                   <abbr><strong>Email:</strong></abbr> 
                                                    <span class="label label-info1"><?= $row['email']?></span><br>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <hr class="less-margin">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-sx-12">
                                        <div class="pull-right">
                                            <a href="index.php?action=user_edit&user_id=<?= $row['user_id']?>" type="button" class="btn btn-warning">
                                                <i class="fa fa-edit"></i>
                                                <span class="hidden-xs">Edit</span>
                                            </a>
                                            <a href="#" type="button" class="btn btn-danger"
                                               onclick="confirmDelete('index.php?action=user_delete&user_id=<?= $row['user_id']?>', 'user');">
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