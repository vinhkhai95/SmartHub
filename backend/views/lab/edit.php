<?php
require_once 'common/header.php';
?>
<!-- Dashboard Wrapper starts -->
<div class="dashboard-wrapper"> 

    <!-- Top Bar starts -->
    <div class="top-bar">
        <div class="page-title"> Edit Room</div>
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
                                    <input type="hidden" name="action" value="lab_edit_save">
                                    <input type="hidden" name="lab_id" value="<?=   $row['lab_id']?>">
                                    <fieldset>
                                        <legend>Room Information</legend>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Room ID</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" name="lab_id" disabled
                                                       value="<?= $row['lab_id']?>" />
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-lg-3 control-label">Lab Name</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" name="value"
                                                       value="<?=$row['dashboard_value']?>" />
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

<?php
require_once 'common/footer.php';
?>