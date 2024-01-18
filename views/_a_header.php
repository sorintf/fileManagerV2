
    <!-- [ Sidebar Menu ] start -->
    <nav class="pc-sidebar">
        <div class="navbar-wrapper">

            <div class="navbar-content">
                <div class="card pc-user-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <img src="/admin_files/assets/images/user/avatar-1.jpg" alt="user-image" class="user-avtar wid-45 rounded-circle" />
                            </div>

                            <div class="flex-grow-1 ms-3 me-2">
                                <h6 class="mb-0"><?php echo $adminFunctions->firstname_user.' '.$adminFunctions->lastname_user; ?></h6>
                                <small><?php echo $adminFunctions->admin_status; ?></small>
                            </div>
                            <a class="btn btn-icon btn-link-secondary avtar" data-bs-toggle="collapse" href="#pc_sidebar_userlink">
                                <svg class="pc-icon">
                                    <use xlink:href="#custom-sort-outline"></use>
                                </svg>
                            </a>
                        </div>

                        <div class="collapse pc-user-links" id="pc_sidebar_userlink">
                            <div class="pt-3">
                                <a href="#">
                                    <i class="ti ti-user"></i>
                                    <span>TODO: edits</span>
                                </a>

                                <a href="<?php echo $adminFunctions->buildUrl(array('view'=>"b_acc_logout")); ?>">
                                    <i class="ti ti-power"></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <ul class="pc-navbar">
                    <li class="pc-item pc-caption">
                        <label>Utilizatori</label>
                    </li>
                    <li class="pc-item pc-hasmenu <?php echo (strpos($adminFunctions->view, "a_users")!==false)?'active pc-trigger':''; ?>">
                        <a href="#!" class="pc-link">
                            <span class="pc-micon">
                                <svg class="pc-icon">
                                    <use xlink:href="#custom-user"></use>
                                </svg>
                            </span>
                            <span class="pc-mtext">Utilizatori</span>
                            <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                        </a>

                        <ul class="pc-submenu">
                            <li class="pc-item <?php echo ($adminFunctions->rep['status']==="all")?'active':''; ?>">
                                <a class="pc-link" href="<?php echo $adminFunctions->buildUrl(array('view'=>'a_users_list', 'status'=>'all')); ?>">
                                    <span class="pc-mtext">Toti utilizatorii</span>
                                </a>
                            </li>

                            <li class="pc-item <?php echo ($adminFunctions->rep['status']==="all")?'active':''; ?>">
                                <a class="pc-link" href="<?php echo $adminFunctions->buildUrl(array('view'=>'a_users_add')); ?>">
                                    <span class="pc-mtext">Adauga (// TODO)</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="pc-item pc-caption">
                        <label>FileManager</label>
                    </li>
                    <li class="pc-item pc-hasmenu <?php echo ((strpos($adminFunctions->view, "a_files_agency")!==false)||($adminFunctions->breadCrumb[1]['label']==="Lista foldere/fisiere agentie"))?'active pc-trigger':''; ?>">
                        <a href="#!" class="pc-link">
                            <span class="pc-micon">
                                <svg class="pc-icon">
                                    <use xlink:href="#custom-dollar-square"></use>
                                </svg>
                            </span>
                            <span class="pc-mtext">Agentie</span>
                            <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                        </a>
                        <ul class="pc-submenu">
                            <li class="pc-item <?php echo ($adminFunctions->view==="a_files_agency_list")?'active':''; ?>">
                                <a class="pc-link" href="<?php echo $adminFunctions->buildUrl(array('view'=>'a_files_agency_list')); ?>">
                                    <span class="pc-mtext">Lista</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="pc-item pc-hasmenu <?php echo ((strpos($adminFunctions->view, "a_files")!==false)&&((strpos($adminFunctions->view, "a_files_agency")===false)&&($adminFunctions->breadCrumb[1]['label']!=="Lista foldere/fisiere agentie")))?'active pc-trigger':''; ?>">
                        <a href="#!" class="pc-link">
                            <span class="pc-micon">
                                <svg class="pc-icon">
                                    <use xlink:href="#custom-dollar-square"></use>
                                </svg>
                            </span>
                            <span class="pc-mtext">Clienti</span>
                            <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                        </a>
                        <ul class="pc-submenu">
                            <li class="pc-item <?php echo ($adminFunctions->view==="a_files_clients_list")?'active':''; ?>">
                                <a class="pc-link" href="<?php echo $adminFunctions->buildUrl(array('view'=>'a_files_clients_list')); ?>">
                                    <span class="pc-mtext">Lista</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- [ Sidebar Menu ] end -->

    <!-- [ Header Topbar ] start -->
    <header class="pc-header">
        <div class="header-wrapper">
            <!-- [Mobile Media Block] start -->
            <div class="me-auto pc-mob-drp">
                <ul class="list-unstyled">
                    <!-- ======= Menu collapse Icon ===== -->
                    <li class="pc-h-item pc-sidebar-collapse">
                        <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
                            <i class="ti ti-menu-2"></i>
                        </a>
                    </li>
                    <li class="pc-h-item pc-sidebar-popup">
                        <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
                            <i class="ti ti-menu-2"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- [Mobile Media Block end] -->

            <div class="ms-auto">
                <ul class="list-unstyled">
                    <li class="dropdown pc-h-item">
                        <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-sun-1"></use>
                            </svg>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end pc-h-dropdown">
                            <a href="#!" class="dropdown-item" onclick="layout_change('dark')">
                                <svg class="pc-icon">
                                    <use xlink:href="#custom-moon"></use>
                                </svg>
                                <span>Dark</span>
                            </a>
                            <a href="#!" class="dropdown-item" onclick="layout_change('light')">
                                <svg class="pc-icon">
                                    <use xlink:href="#custom-sun-1"></use>
                                </svg>
                                <span>Light</span>
                            </a>
                            <a href="#!" class="dropdown-item" onclick="layout_change_default()">
                                <svg class="pc-icon">
                                    <use xlink:href="#custom-setting-2"></use>
                                </svg>
                                <span>Default</span>
                            </a>
                        </div>
                    </li>
                    <li class="dropdown pc-h-item">
                        <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-notification"></use>
                            </svg>
                            <span class="badge bg-success pc-h-badge">3</span>
                        </a>
                        <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown">
                            <div class="dropdown-header d-flex align-items-center justify-content-between">
                                <h5 class="m-0">Notifications</h5>
                                <a href="#!" class="btn btn-link btn-sm">Mark all read</a>
                            </div>
                            <div class="dropdown-body text-wrap header-notification-scroll position-relative" style="max-height: calc(100vh - 215px)">
                                <p class="text-span">Today</p>
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <svg class="pc-icon text-primary">
                                                    <use xlink:href="#custom-layer"></use>
                                                </svg>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <span class="float-end text-sm text-muted">Some time ago</span>
                                                <h5 class="text-body mb-2">TODO</h5>
                                                <p class="mb-0">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center py-2">
                                <a href="#!" class="link-danger">Clear all Notifications</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <!-- [ Header ] end -->