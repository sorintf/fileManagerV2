
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">

                        <div class="d-none"><?php var_dump($adminFunctions->breadCrumb); ?></div>

                        <div class="col-md-12">
                            <ul class="breadcrumb mb-3">
                                <?php foreach ($adminFunctions->breadCrumb as $breadCrumbItem): ?>
                                    <?php if ($breadCrumbItem['currentPage']): ?>
                                        <li class="breadcrumb-item" aria-current="page"><?php echo $breadCrumbItem['label'] ?></li>
                                    <?php else: ?>
                                        <li class="breadcrumb-item">
                                            <a href="<?php echo $breadCrumbItem['href'] ?>"><?php echo $breadCrumbItem['label'] ?></a>
                                        </li>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </ul>
                        </div>

                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0"><?php echo $adminFunctions->page_title; ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
