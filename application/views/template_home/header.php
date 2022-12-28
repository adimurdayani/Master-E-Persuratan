<header class="wrapper bg-soft-primary">
    <nav class="navbar navbar-expand-lg center-nav transparent position-absolute navbar-dark caret-none">
        <div class="container flex-lg-row flex-nowrap align-items-center">
            <div class="navbar-brand w-100">
                <a href="<?= base_url() ?>">
                    <img class="logo-dark" src="<?= base_url('assets/frontend/') ?>img/logo-kota-dark.png" srcset="<?= base_url('assets/frontend/') ?>img/logo-kota-dark.png 1x" alt="" loading="lazy" />
                    <img class="logo-light" src="<?= base_url('assets/frontend/') ?>img/logo-kota-light.png" srcset="<?= base_url('assets/frontend/') ?>img/logo-kota-light.png 1x" alt="" loading="lazy" />
                </a>
            </div>
            <div class="navbar-collapse offcanvas offcanvas-nav offcanvas-start">
                <div class="offcanvas-header d-lg-none">
                    <h3 class="text-white fs-30 mb-0">SIDRAS</h3>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body ms-lg-auto d-flex flex-column h-100">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('home/berita') ?>">Berita</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Data Drainase</a>
                            <ul class="dropdown-menu">
                                <li class="nav-item"><a class="dropdown-item" href="<?= base_url('home/drainase') ?>">Drainase</a></li>
                                <li class="nav-item"><a class="dropdown-item" href="<?= base_url('home/jaringan_drainase') ?>">Jaringan Drainase</a></li>
                                <li class="nav-item"><a class="dropdown-item" href="<?= base_url('home/bangunan_drainase') ?>">Bangunan Drainase</a></li>
                                <li class="nav-item"><a class="dropdown-item" href="<?= base_url('home/pintu_drainase') ?>">Pintu Drainase</a></li>
                                <li class="nav-item"><a class="dropdown-item" href="<?= base_url('home/gangguan_drainase') ?>">Gangguan Drainase</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('home/statistik_drainase') ?>">Statistik</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('home/peta_persebaran') ?>">Peta Persebaran</a>
                        </li>
                    </ul>
                    <!-- /.navbar-nav -->
                    <div class="offcanvas-footer d-lg-none">
                        <div>
                            <a href="mailto:first.last@email.com" class="link-inverse">info@email.com</a>
                            <br /> 00 (123) 456 78 90 <br />
                            <nav class="nav social social-white mt-4">
                                <a href="#"><i class="uil uil-twitter"></i></a>
                                <a href="#"><i class="uil uil-facebook-f"></i></a>
                                <a href="#"><i class="uil uil-dribbble"></i></a>
                                <a href="#"><i class="uil uil-instagram"></i></a>
                                <a href="#"><i class="uil uil-youtube"></i></a>
                            </nav>
                            <!-- /.social -->
                        </div>
                    </div>
                    <!-- /.offcanvas-footer -->
                </div>
                <!-- /.offcanvas-body -->
            </div>
            <!-- /.navbar-collapse -->
            <div class="navbar-other w-100 d-flex ms-auto">
                <ul class="navbar-nav flex-row align-items-center ms-auto">
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-info"><i class="uil uil-info-circle"></i></a></li>
                    <li class="nav-item d-lg-none">
                        <button class="hamburger offcanvas-nav-btn"><span></span></button>
                    </li>
                </ul>
                <!-- /.navbar-nav -->
            </div>
            <!-- /.navbar-other -->
        </div>
        <!-- /.container -->
    </nav>
    <!-- /.navbar -->
    <div class="offcanvas offcanvas-end text-inverse" id="offcanvas-info" data-bs-scroll="true">
        <div class="offcanvas-header">
            <h3 class="text-white fs-30 mb-0">SIDRAS</h3>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body pb-6">
            <div class="widget mb-8">
                <p>Dinas Pekerjaan Umum dan Penataan Ruang Kota Palopo Merupakan kantor dinas PU untuk wilayah Palopo, provinsi Sulawesi Selatan. Dinas PU bertugas sebagai penyelenggaraan urusan pemerintah bidang pekerjaan umum, pembangunan infrastrukur dan perumahan untuk daerah Palopo, Sulawesi Selatan.
                </p>
            </div>
            <!-- /.widget -->
            <div class="widget mb-8">
                <h4 class="widget-title text-white mb-3">Kontak</h4>
                <address> Boting, Wara, Palopo City,<br />South Sulawesi 91911, Indonesia </address>
                <a href="mailto:first.last@email.com">info@email.com</a><br /> 00 (123) 456 78 90
            </div>
            <!-- /.widget -->
            <div class="widget mb-8">
                <h4 class="widget-title text-white mb-3">Data Drainase</h4>
                <ul class="list-unstyled">
                    <li><a href="<?= base_url('home/drainase') ?>">Drainase</a></li>
                    <li><a href="<?= base_url('home/jaringan_drainase') ?>">Jaringan Drainase</a></li>
                    <li><a href="<?= base_url('home/bangunan_drainase') ?>">Bangunan Drainase</a></li>
                    <li><a href="<?= base_url('home/pintu_drainase') ?>">Pintu Drainase</a></li>
                    <li><a href="<?= base_url('home/gangguan_drainase') ?>">Gangguan Drainase</a></li>
                </ul>
            </div>
            <!-- /.widget -->
            <div class="widget">
                <h4 class="widget-title text-white mb-3">Ikuti Kami</h4>
                <nav class="nav social social-white">
                    <a href="#"><i class="uil uil-twitter"></i></a>
                    <a href="#"><i class="uil uil-facebook-f"></i></a>
                    <a href="#"><i class="uil uil-dribbble"></i></a>
                    <a href="#"><i class="uil uil-instagram"></i></a>
                    <a href="#"><i class="uil uil-youtube"></i></a>
                </nav>
                <!-- /.social -->
            </div>
            <!-- /.widget -->
        </div>
        <!-- /.offcanvas-body -->
    </div>
    <!-- /.offcanvas -->
    <div class="offcanvas offcanvas-top bg-light" id="offcanvas-search" data-bs-scroll="true">
        <div class="container d-flex flex-row py-6">
            <form class="search-form w-100">
                <input id="search-form" type="text" class="form-control" placeholder="Type keyword and hit enter">
            </form>
            <!-- /.search-form -->
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <!-- /.container -->
    </div>
    <!-- /.offcanvas -->
</header>