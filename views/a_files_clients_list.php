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
                    <div class="card">
                        <div class="card-header">
                            <ul>TODO:
                                <li>&check; Upload unlimited number of files with drag&drop</li>
                                <li>&check; Alternativ upload to drag&drop</li>
                                <li>&check; Sort by name (asc)</li>
                                <li>Upload folders with contents with drag&drop</li>
                                <li>&check; Add to favorites</li>
                                <li>&check; Sort by favorites first, by name (asc) second </li>
                                <li>Permissions for clients to see some of the files/folders</li>
                                <li>Move files/folders</li>
                            </ul>
                        </div>
                    </div>
                </div>


                <div class="col-sm-12">
                    <div class="row my-3">
                        <div class="col">
                            <div class="d-flex align-items-center">
                                <h5 class="mb-0 me-2">Clienti</h5>
                                <a href="#" class="avtar avtar-xs btn btn-primary rounded-circle p-0" data-bs-toggle="modal" data-bs-target="#modalAddFolder" data-type="client" data-title="Add client" data-parent="0">
                                    <i class="ti ti-plus f-16"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-primary d-inline-flex multiple-dl-toggler">
                                <i class="ti ti-download me-1"></i>
                                Multiple downloads
                            </button>

                            <button type="button" class="btn btn-danger d-none clearall">
                                <i class="ti ti-mask-off me-1"></i>
                                Clear selection
                            </button>
                        </div>
                    </div>


                    <div class="row py-2">
                        <div class="col"></div>
                        <div class="col-auto">
                            <ul class="nav nav-pills nav-files" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link listview-toggler" data-target=".lists" data-aclass="list-cards" data-rclass="grid-cards">
                                        <i class="ti ti-layout-grid"></i>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active listview-toggler" data-target=".lists" data-aclass="grid-cards" data-rclass="list-cards">
                                        <i class="ti ti-layout-list"></i>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <form action="" method="post" class="needs-validation dl-list" novalidate>
                        <div class="row lists grid-cards">
                            <?php foreach ($adminFunctions->rep['clients_list'] as $key => $value): ?>
                                <div class="wrap-card">
                                    <div class="card card-file t01 selectable">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="favorite <?php echo (in_array($value['ID'], $adminFunctions->rep['favorite_file_ids']))?'text-warning':'text-secondary'; ?>" data-idfile="<?php echo $value['ID']; ?>" data-idusr="<?php echo $adminFunctions->ID; ?>">
                                                    <svg class="pc-icon">
                                                        <use xlink:href="#custom-setting-2"></use>
                                                    </svg>
                                                </div>
                                                <div class="thumbnail">
                                                    <svg class="pc-icon text-warning">
                                                        <use xlink:href="#custom-folder-open"></use>
                                                    </svg>
                                                    <div class="form-check">
                                                        <input class="form-check-input input-success wid-40 hei-40" name="dl_list[]" type="checkbox" value="<?php echo $value['ID']; ?>">
                                                    </div>
                                                </div>
                                                <div class="name">
                                                    <h5 class="mb-1 text-truncate">
                                                        <a href="<?php echo $adminFunctions->buildUrl(array('view'=>'a_files_folders_view', 'id_file'=>$value['ID'])); ?>" class="">
                                                            <span class="text-truncate w-100"><?php echo $value['name']; ?></span>
                                                        </a>
                                                    </h5>
                                                    <p class="mb-0"><small><?php echo $value['nr_files']; ?> folders and files</small></p>
                                                </div>
                                                <div class="dropdown">
                                                    <a
                                                    class="avtar avtar-xs btn-link-secondary dropdown-toggle arrow-none"
                                                    href="#"
                                                    data-bs-toggle="dropdown"
                                                    aria-haspopup="true"
                                                    aria-expanded="false"
                                                    ><i class="material-icons-two-tone f-18">more_vert</i></a
                                                    >
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalRenameFolder" data-name="<?php echo $value['name']; ?>" data-title="Rename <?php echo $value['name']; ?>" data-idfile="<?php echo $value['ID']; ?>">Rename</a>
                                                        <a class="dropdown-item" href="<?php echo $adminFunctions->buildUrl(array('view'=>'a_files_folders_delete', 'id_file'=>$value['ID'])); ?>">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <input type="hidden" name="id_folder" value="">
                                <button type="submit" class="btn btn-success d-none" name="download_archive">
                                    <i class="ti ti-download me-1"></i>
                                    Crează arhiva și downloadează
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- [ clients-list-page ] end -->
            </div>
            <!-- [ Main Content 02 ] end -->
        </div>
    </div>
    <!-- [ Main Content 01 ] end -->



<?php include_once('views/_a_footer.php'); ?>