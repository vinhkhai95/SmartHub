<?php include 'common/header.php'; ?>
<!-- Dashboard Wrapper starts -->
<div class="dashboard-wrapper"> 

    <!-- Top Bar starts -->
    <div class="top-bar">
        <div class="page-title"> Administrator Details</div>
    </div>
    <!-- Top Bar ends --> 

    <!-- Main Container starts -->
    <div class="main-container"> 

        <!-- Container fluid Starts -->
        <div class="container-fluid"> 

            <!-- Spacer starts -->
            <div class="spacer"> 
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="panel">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <div id="dt_example" class="table-responsive example_alt_pagination clearfix">
                                        <table class="table table-condensed table-striped table-hover table-bordered pull-left" id="data-table">    
                                            <thead>
                                                <tr>
                                                    <th style="width:20%">Administrator Name</th>
                                                    <th style="width:20%">Mobile Phone</th>
                                                    <th style="width:20%">Email</th>
                                                    <th style="width:3.5%">&nbsp;</th>
                                                </tr>
                                            </thead> 
                                            <tbody> 
                                                <tr>
                                                    <td style="width:20%">Lê Công Vĩnh Khải</td>
                                                    <td style="width:20%">01287421885</td>
                                                    <td style="width:20%">vinhkhai95@gmail.com</td>
                                                    <td>
                                                                <!-- <?php include 'common/list_control_buttons.php';?> -->
                                                            </td>
                                                </tr>
                                
                                            </tbody>  
                                        </table>
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

</div>
<!-- Dashboard Wrapper ends --> 
<?php include 'common/footer.php'; ?>