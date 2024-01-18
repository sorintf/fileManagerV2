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
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Modifica &ldquo;<?php echo $adminFunctions->rep['folder']->name; ?>&rdquo;</h5>
                            <?php if (!empty($adminFunctions->rep['folder']->modified)): ?>
                                <p class="text-muted m-0">Last modified: <?php echo $adminFunctions->rep['folder']->modified; ?></p>
                            <?php endif ?>
                            <h6 class="text-muted">&ldquo;<?php echo $adminFunctions->rep['folder']->f_path; ?>&rdquo;</h6>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" class="needs-validation" novalidate>
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label" for="name">Nume</label>
                                            <input type="text" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Nume" value="<?php echo $adminFunctions->rep['folder']->name; ?>">
                                            <small id="nameHelp" class="form-text text-muted">Se va modifica path-ul tuturor fisierelor si folderelor din acest folder.</small>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label" for="note">Note</label>
                                            <textarea id="note" name="note" class="form-control txt-tinymce">
                                                <?php echo $adminFunctions->rep['folder']->note; ?>
                                            </textarea>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group text-center">
                                            <input class="btn btn-primary" type="submit" name="folder_edit" value="Modifica">
                                        </div>
                                    </div>
                                </div>
                            </form>
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