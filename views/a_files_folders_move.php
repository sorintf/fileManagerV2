<?php include_once('views/_a_head.php'); ?>

<?php include_once('views/_a_header.php'); ?>

    <!-- [ Main Content 01 ] start -->
    <div class="pc-container">
        <div class="pc-content">

            <?php include_once('views/_a_breadcrumb.php'); ?>

            <!-- [ Main Content 02 ] start -->
            <div class="row">

                <?php include_once('views/_messages.php'); ?>

                <!-- [ clients-list-page ] start -->
                <div class="col-sm-12">
                    <div class="row my-3">
                        <div class="col">
                            <div class="d-flex align-items-center">
                                <h5 class="mb-0 me-2">Structura folderului: <?php echo $adminFunctions->rep['folder']->name; ?></h5>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <?php echo $adminFunctions->rep['children_view']; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ clients-list-page ] end -->
            </div>
            <!-- [ Main Content 02 ] end -->
        </div>
    </div>
    <!-- [ Main Content 01 ] end -->



<?php include_once('views/_a_footer.php'); ?>