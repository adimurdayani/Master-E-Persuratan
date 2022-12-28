        <!-- ========== Left Sidebar Start ========== -->
        <div class="left-side-menu">

            <div class="h-100" data-simplebar>

                <!-- User box -->
                <div class="user-box text-center">
                    <img src="<?= base_url('assets/backend/images/users/user.png') ?>" alt="user-img" title="Mat Helme" class="rounded-circle avatar-md" loading="lazy">
                    <div class="dropdown">
                        <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block" data-toggle="dropdown"><?= $session->first_name ?></a>
                        <div class="dropdown-menu user-pro-dropdown">

                            <!-- item-->
                            <a href="<?= base_url('profil') ?>" class="dropdown-item notify-item">
                                <i class="fe-user mr-1"></i>
                                <span>My Account</span>
                            </a>

                            <!-- item-->
                            <a href="<?= base_url('konfigurasi') ?>" class="dropdown-item notify-item">
                                <i class="fe-settings mr-1"></i>
                                <span>Settings</span>
                            </a>

                            <!-- item-->
                            <a href="<?= base_url('auth/logout') ?>" class="dropdown-item notify-item">
                                <i class="fe-log-out mr-1"></i>
                                <span>Logout</span>
                            </a>

                        </div>
                    </div>
                    <?php if (!$this->ion_auth->is_admin()) : ?>
                        <p class="text-muted"><?= $session->last_name ?></p>
                    <?php else : ?>
                        <p class="text-muted">Admin Head</p>
                    <?php endif; ?>
                </div>

                <!--- Sidemenu -->
                <div id="sidebar-menu">

                    <ul id="side-menu">

                        <?php foreach ($akses_menu as $km) : ?>

                            <li class="menu-title"><?= $km['name'] ?></li>

                            <?php foreach ($km['menu'] as $m) : ?>
                                <li>

                                    <?php if ($m['dropdown_active'] == 0) : ?>
                                        <a href="<?= base_url() . $m['url'] ?>">
                                            <i class="<?= $m['icon'] ?>"></i>
                                            <span> <?= $m['menu_title'] ?> </span>
                                        </a>

                                    <?php else : ?>
                                        <a href="#<?= $m['url'] ?>" data-toggle="collapse">
                                            <i class="<?= $m['icon'] ?>"></i>
                                            <span> <?= $m['menu_title'] ?> </span>
                                            <span class="menu-arrow"></span>
                                        </a>

                                        <div class="collapse" id="<?= $m['url'] ?>">
                                            <ul class="nav-second-level">

                                                <?php foreach ($submenu as $sm) : ?>

                                                    <?php if ($sm['id_menus'] == $m['id_menu']) : ?>

                                                        <li>
                                                            <a href="<?= base_url() . $sm['url'] ?>"><?= $sm['submenu_title'] ?></a>
                                                        </li>
                                                    <?php endif; ?>

                                                <?php endforeach; ?>
                                            </ul>
                                        </div>

                                    <?php endif; ?>
                                </li>

                            <?php endforeach; ?>

                        <?php endforeach; ?>
                    </ul>

                </div>
                <!-- End Sidebar -->

                <div class="clearfix"></div>

            </div>
            <!-- Sidebar -left -->

        </div>
        <!-- Left Sidebar End -->