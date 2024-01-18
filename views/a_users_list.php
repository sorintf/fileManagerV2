<?php include_once('views/_a_head.php'); ?>

<?php include_once('views/_a_header.php'); ?>



    <!-- [ Main Content 01 ] start -->
    <div class="pc-container">
        <div class="pc-content">

            <?php include_once('views/_a_breadcrumb.php'); ?>

            <!-- [ Main Content 02 ] start -->
            <div class="row">

                <?php include_once('views/_messages.php'); ?>

                <!-- [ sample-page ] start -->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Lista utilizatori</h5>
                            <ul>TODO:
                                <li>Add</li>
                                <li>Edit</li>
                                <li>Delete</li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="dt-responsive table-responsive">
                                <table id="list-users" data-status="<?php echo isset($_GET['status'])?trim(htmlspecialchars($_GET['status'])):'all'; ?>" data-totalRows="<?php echo $adminFunctions->rep['users_nr']; ?>" class="table table-striped table-hover table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Prenume</th>
                                            <th>Nume</th>
                                            <th>Email</th>
                                            <th>Telefon</th>
                                        </tr>
                                    </thead>
                                    
                                    <tfoot>
                                        <tr>
                                            <th>Username</th>
                                            <th>Prenume</th>
                                            <th>Nume</th>
                                            <th>Email</th>
                                            <th>Telefon</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ sample-page ] end -->
            </div>
            <!-- [ Main Content 02 ] end -->
        </div>
    </div>
    <!-- [ Main Content 01 ] end -->



<?php include_once('views/_a_footer.php'); ?>