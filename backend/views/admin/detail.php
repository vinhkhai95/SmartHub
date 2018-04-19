<?php
require_once 'common/header.php';?>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript" src="views/js/boostrap.js"></script>
<link rel="stylesheet" href="views/css/light.css">
<link rel="stylesheet" href="views/css/fan.css">
<link rel="stylesheet" href="views/css/css.css"> 
</head>
<body>
<div class="dashboard-wrapper">
    <div class="top-bar">
        <div class="page-title"> Detail Admin </div>
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
                                <h4 class="panel-title">Admin ID:<span><?= $row['admin_id']?></span></h4>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td style="width:50%">
                                                    <abbr><strong>Admin Name:</strong></abbr> 
                                                    <span class="label label-info1"><?= $row['name']?></span><br>
                                                    <abbr><strong>Phone:</strong></abbr> 
                                                    <span class="label label-info1"><?= $row['phone']?></span><br>
                                                    <abbr><strong>Address:</strong></abbr> 
                                                    <span class="label label-info1"><?= $row['address']?></span><br>
                                                </td>
                                                <td style="width:50%" class="left-align-text">
                                                    <abbr><strong>Gender:</strong></abbr>
                                                    <span class="label label-info1">
                                                        <?= $row['gender'] == 0 ? 'Female' : 'Male'?> </span><br>
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
                                            <a href="index.php?action=admin_edit&admin_id=<?= $row['admin_id']?>" type="button" class="btn btn-warning">
                                                <i class="fa fa-edit"></i> 
                                                <span class="hidden-xs">Edit</span>
                                            </a>
                                            <a href="#" type="button" class="btn btn-danger"
                                               onclick="confirmDelete('index.php?action=admin_delete&admin_id=<?= $row['admin_id']?>', 'admin');">
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
</body>
</html>
<?php
require_once 'common/footer.php';
?>