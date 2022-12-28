        <!-- Topbar Start -->
        <div class="navbar-custom">
            <div class="container-fluid">
                <ul class="list-unstyled topnav-menu float-right mb-0">

                    <li class="dropdown d-none d-lg-inline-block">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="fullscreen" href="#">
                            <i class="fe-maximize noti-icon"></i>
                        </a>
                    </li>

                    <li class="dropdown notification-list topbar-dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="mdi mdi-email-receive-outline noti-icon"></i>
                            <span class="badge badge-danger rounded-circle noti-icon-badge" id="jml-pesan-masuk">0</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-lg">

                            <!-- item-->
                            <div class="dropdown-item noti-title">
                                <h5 class="m-0">
                                    <span class="float-right">
                                        <a href="" class="text-dark">
                                            <small>Clear All</small>
                                        </a>
                                    </span>Surat Masuk
                                </h5>
                            </div>

                            <div class="noti-scroll pesan-masuk" data-simplebar>

                                <!-- item-->

                            </div>

                            <!-- All-->
                            <a href="<?= base_url('surat_masuk') ?>" class="dropdown-item text-center text-primary notify-item notify-all">
                                View all
                                <i class="fe-arrow-right"></i>
                            </a>

                        </div>
                    </li>

                    <li class="dropdown notification-list topbar-dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="mdi mdi-email-send-outline noti-icon"></i>
                            <span class="badge badge-danger rounded-circle noti-icon-badge" id="jml-pesan-keluar">0</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-lg">

                            <!-- item-->
                            <div class="dropdown-item noti-title">
                                <h5 class="m-0">
                                    <span class="float-right">
                                        <a href="" class="text-dark">
                                            <small>Clear All</small>
                                        </a>
                                    </span>Surat Keluar
                                </h5>
                            </div>

                            <div class="noti-scroll pesan-keluar" data-simplebar>

                                <!-- item-->

                            </div>

                            <!-- All-->
                            <a href="<?= base_url('surat_keluar') ?>" class="dropdown-item text-center text-primary notify-item notify-all">
                                View all
                                <i class="fe-arrow-right"></i>
                            </a>

                        </div>
                    </li>

                    <li class="dropdown notification-list topbar-dropdown">
                        <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="<?= base_url('assets/backend/images/users/user.png') ?>" alt="user-image" class="rounded-circle" loading="lazy">
                            <span class="pro-user-name ml-1">
                                <?= $session->first_name ?> <i class="mdi mdi-chevron-down"></i>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                            <!-- item-->
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome !</h6>
                            </div>

                            <!-- item-->
                            <a href="<?= base_url('profil') ?>" class="dropdown-item notify-item">
                                <i class="fe-user"></i>
                                <span>My Account</span>
                            </a>

                            <!-- item-->
                            <a href="<?= base_url('konfigurasi') ?>" class="dropdown-item notify-item">
                                <i class="fe-settings"></i>
                                <span>Settings</span>
                            </a>

                            <div class="dropdown-divider"></div>

                            <!-- item-->
                            <a href="<?= base_url('log-out-user') ?>" class="dropdown-item notify-item">
                                <i class="fe-log-out"></i>
                                <span>Logout</span>
                            </a>

                        </div>
                    </li>

                    <li class="dropdown notification-list">
                        <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect waves-light">
                            <i class="fe-settings noti-icon"></i>
                        </a>
                    </li>

                </ul>

                <!-- LOGO -->
                <div class="logo-box">
                    <a href="<?= base_url() ?>" class="logo logo-dark text-center">
                        <span class="logo-sm">
                            <img src="<?= base_url('assets/backend/images/upload/') . $get_config->icon_web ?>" alt="" height="33">
                            <!-- <span class="logo-lg-text-dark">U</span> -->
                        </span>
                        <span class="logo-lg">
                            <!-- <span class="logo-lg-text-dark">UBold</span> -->
                            <img src="<?= base_url('assets/backend/images/upload/') . $get_config->logo_web ?>" alt="" height="50">
                        </span>
                    </a>
                </div>

                <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                    <li>
                        <button class="button-menu-mobile waves-effect waves-light">
                            <i class="fe-menu"></i>
                        </button>
                    </li>

                    <li>
                        <!-- Mobile menu toggle (Horizontal Layout)-->
                        <a class="navbar-toggle nav-link" data-toggle="collapse" data-target="#topnav-menu-content">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </a>
                        <!-- End mobile menu toggle-->
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- end Topbar -->