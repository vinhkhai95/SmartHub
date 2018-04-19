<?php
require_once 'common/header.php';
?>
<!-- Dashboard Wrapper starts -->
<div class="dashboard-wrapper"> 

    <!-- Top Bar starts -->
    <div class="top-bar">
        <div class="page-title"> MQTT Parameter Config</div>
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
                                      class="form-horizontal">
                                    <input type="hidden" name="action" value="category_add_save">
                                    <fieldset>
                                        <legend>Configuration</legend>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Hostname</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" name="category_name" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">port</label>
                                            <div class="col-lg-9">
                                                <input type="number" class="form-control" name="numofproduct" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">clientId</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" name="description" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">path</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" name="description" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">ssl</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" name="description" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">user</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" name="description" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">pass</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" name="description" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">keepAlive</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" name="description" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">timeout</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" name="description" />
                                            </div>
                                        </div><div class="form-group">
                                            <label class="col-lg-3 control-label">cleanSession</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" name="description" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">qos</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" name="description" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">retain1</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" name="description" />
                                            </div>
                                        </div>
                                    </fieldset>
                                    
                                    <div class="form-group">
                                        <div class="col-lg-6 col-lg-offset-6">
                                            <button type="submit" class="btn btn-success">Submit</button>
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

<!-- Main Container ends --> 
</div>
<!-- Dashboard Wrapper ends --> 

<?php
require_once 'common/footer.php';
?>