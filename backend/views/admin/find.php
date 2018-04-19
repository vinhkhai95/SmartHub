<?php include 'common/header.php'; ?>

<div class="dashboard-wrapper">

    <!-- Top Bar starts -->
    <div class="top-bar">
        <div class="page-title">
            Find Admin by Name
        </div>

    </div>
    <!-- Top Bar ends -->

    <!-- Main Container starts -->
    <div class="main-container">

        <!-- Container fluid starts -->
        <div class="container-fluid">
            <!-- Spacer starts -->
            <div class="spacer">
                <?php include 'search_form.php';?>
                
                <?php include 'common/message_panel.php'; ?>

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
                                                    <th style="width:10%">Admin ID</th>
                                                    <th style="width:10%">Admin Name</th>
                                                    <th style="width:15%">Name</th>
                                                    <th style="width:12%">Phone</th>
                                                    <th style="width:25%">Email</th>
                                                    <th style="width:20%">Address</th>
                                                    <th style="width:15%">&nbsp;</th>
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
                                                            <td><?= $row['admin_id'] ?></td>
                                                            <td><?= $row['adminname'] ?></td>
                                                            <td><?= $row['name'] ?></td>
                                                            <td>
                                                                <?= $row['phone']?>
                                                            </td>
                                                            <td>
                                                                <?= $row['email'] ?>
                                                            </td>
                                                            <td>
                                                                <?= $row['address'] ?>
                                                            </td>
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

</div>

<?php include 'common/footer.php'; ?>