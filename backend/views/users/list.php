<?php include 'common/header.php'; ?>

<div class="dashboard-wrapper">

    <!-- Top Bar starts -->
    <div class="top-bar">
        <div class="page-title">
            List All Users
        </div>

    </div>
    <!-- Top Bar ends -->

    <!-- Main Container starts -->
    <div class="main-container">

        <!-- Container fluid starts -->
        <div class="container-fluid">
            <!-- Spacer starts -->
            <div class="spacer">
                <?php include 'common/message_panel.php'; ?>
                <?php include 'common/error_panel.php'; ?>
                <!-- Row Starts -->
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="panel">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <div id="dt_example" class="table-responsive example_alt_pagination clearfix">
                                        <table class="table table-condensed table-striped table-hover table-bordered pull-left" id="data-table">    
                                            <thead>
                                                <tr>
                                                    <th style="width:1%">
                                                        <input type="checkbox">
                                                    </th>
                                                    <th style="width:10%">User ID</th>
                                                    <th style="width:20%">Name</th>
                                                    <th style="width:20%">User Name</th>
                                                    <th style="width:20%">Room Name</th>
                                                    <th style="width:20%">Email</th>
                                                    <th style="width:20%">Mobile Phone</th>
                                                    <th style="width:5%">&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (!empty($result)):
                                                    $ch = 'A';
                                                    foreach ($result as $row) :
                                                        ?>
                                                        <tr class="grade<?= $ch ?>">
                                                            <td>
                                                                <input type="checkbox">
                                                            </td>
                                                            <td><?= $row['user_id'] ?></td>
                                                            <td><?= $row['name'] ?></td>
                                                            <td><?= $row['username'] ?></td>
                                                            <td><?= $row['dashboard_value'] ?></td>
                                                            <td><?= $row['email'] ?></td>
                                                            <td><?= $row['phone'] ?></td>

                                                            <td>
                                                                <!-- List Control Buttons -->
                                                                <?php include 'common/list_control_buttons.php'; ?>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        $ch ++;
                                                        if ($ch > 'Z')
                                                            $ch = 'A';
                                                    endforeach;
                                                endif;
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
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

    <!-- Right sidebar starts -->
  
</div>

<?php include 'common/footer.php'; ?>