<?php
require_once 'common/header.php';
?>
<script type="text/javascript">
function fetch_select(val)
{
 $.ajax({
 type: 'post',
 url: 'index.php?action=abc',
 data: {
  get_option:val
 },
 success: function (response) {
    var obj = JSON.parse(response);
    console.log(obj);
    document.getElementById("hostname").value=obj.hostname; 
    document.getElementById("port").value=obj.port; 
    document.getElementById("clientid").value=obj.clientid; 
    document.getElementById("path").value=obj.path; 
    document.getElementById("ssl").value=obj.ssl; 
    document.getElementById("user").value=obj.user; 
    document.getElementById("pass").value=obj.pass; 
    document.getElementById("keepalive").value=obj.keepalive; 
    document.getElementById("timeout").value=obj.timeout; 
    document.getElementById("cleansession").value=obj.cleansession; 
    document.getElementById("qos").value=obj.qos; 
    document.getElementById("retain").value=obj.retain; 
 }
 });
}

</script>
<div id="new_select"></div>
<!-- Dashboard Wrapper starts -->
<div class="dashboard-wrapper"> 

    <!-- Top Bar starts -->
    <div class="top-bar">
        <div class="page-title"> Edit MQTT</div>
    </div>
    <!-- Top Bar ends --> 

    <!-- Main Container starts -->
    <div class="main-container"> 

        <!-- Container fluid Starts -->
        <div class="container-fluid"> 

            <!-- Spacer starts -->
            <div class="spacer"> 
                <?php include 'common/message_panel.php'; ?>
                <?php include 'common/error_panel.php'; ?>
                <!-- Row Starts -->
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <div class="blog">
                            <div class="blog-body">
                                <form id="defaultForm" method="post" action="index.php" 
                                      class="form-horizontal"  enctype="multipart/form-data">
                                    <input type="hidden" name="action" value="MQTT_edit_save">
                                    <fieldset>
                                        <legend>MQTT Information</legend>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Room ID</label>
                                            <div class="col-lg-9">
                                                <select name="user_id" class="form-control" id="user_id" onchange="fetch_select(this.value);">
                                                    <?php 
                                                    foreach ($mqtts as $mqttrow):
                                                    ?>
                                                    <option value="<?= $mqttrow['mqtt_id']?>">
                                                        <?= $mqttrow['mqtt_id']?>
                                                    </option>
                                                    <?php 
                                                    endforeach;
                                                    ?>
                                                </select>
                                                
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Hostname</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" 
                                                       name="hostname" id="hostname" value="<?=$row['hostname'] ?>"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Port</label>
                                            <div class="col-lg-9">
                                                <input type="number" class="form-control" 
                                                       name="port" id="port" value="<?=$row['port'] ?>"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">ClientId</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" 
                                                       name="clientid" id="clientid" value="<?=$row['clientid'] ?>"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Path</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" 
                                                       name="path" id="path" value="<?=$row['path'] ?>"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Ssl</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" 
                                                       name="ssl" id="ssl" value="<?=$row['ssl'] ?>"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Username</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" 
                                                       name="user" id="user" value="<?=$row['user'] ?>"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Password</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" 
                                                       name="pass" id="pass" value="<?=$row['pass'] ?>"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">KeepAlive</label>
                                            <div class="col-lg-9">
                                                <input type="number" class="form-control" 
                                                       name="keepalive" id="keepalive" value="<?=$row['keepalive'] ?>"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Timeout</label>
                                            <div class="col-lg-9">
                                                <input type="number" class="form-control" 
                                                       name="timeout" id="timeout" value="<?=$row['timeout'] ?>"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">CleanSession</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" 
                                                       name="cleansession" id="cleansession" value="<?=$row['cleansession'] ?>"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Qos</label>
                                            <div class="col-lg-9">
                                                <input type="number" class="form-control" 
                                                       name="qos" id="qos" value="<?=$row['qos'] ?>"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Retain</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" 
                                                       name="retain" id="retain" value="<?=$row['retain'] ?>"/>
                                            </div>
                                        </div>                                        
                                    <div class="form-group">
                                        <div class="col-lg-6 col-lg-offset-6">
                                            <button type="submit" class="btn btn-success">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row Ends --> 

        </div>
        <!-- Spacer ends --> 

    </div>
    <!-- Container fluid ends -->

</div>
<!-- Main Container ends --> 


<!-- Footer starts -->
</div>
<!-- Dashboard Wrapper ends --> 

<?php
require_once 'common/footer.php';
?>