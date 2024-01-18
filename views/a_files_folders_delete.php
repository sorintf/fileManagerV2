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

                            <div class="card">
                                <form action="" method="post" class="needs-validation" novalidate>
                                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                                        <svg class="bi flex-shrink-0 me-2" width="64" height="64">
                                            <use xlink:href="#exclamation-triangle-fill"></use>
                                        </svg>
                                        <div>
                                            <h4 class="alert-heading">Mare atentie!</h4>
                                            <p>Urmeaza sa stergi folderul cu toate folderele/fisierele respective.</p>
                                        </div>
                                    </div>

                                    <div class="form-group text-center">
                                        <input type="hidden" name="id_folder" value="<?php echo $adminFunctions->rep['folder']->ID; ?>">
                                        <input class="btn btn-danger" type="submit" name="folder_delete" value="Sterge">
                                    </div>
                                </form>
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