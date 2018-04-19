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
                    <?php include 'search_form.php'; ?>
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
                                                    <th style="width:10%">Lab ID</th>
                                                    <th style="width:20%">Lab Name</th>
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
                                                            <td><?= $row['lab_id'] ?></td>
                                                            <td><?= $row['dashboard_value'] ?></td>

                                                            <td>
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
                </div>
            </div>
        </div>
    </div>

<?php include 'common/footer.php'; ?>