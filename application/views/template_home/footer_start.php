<!-- /.content-wrapper -->
<footer class="bg-dark text-inverse">
    <div class="container py-13 py-md-15">
        <div class="row gy-6 gy-lg-0">
            <div class="col-lg-4">
                <div class="widget">
                    <img class="mb-4" src="<?= base_url('assets/frontend/') ?>img/logo-kota-light.png" loading="lazy" srcset="<?= base_url('assets/frontend/') ?>img/logo-kota-light.png 1x" alt="" />
                    <p class="mb-4">© 2022 Dinas Pekerjaan Umum Dan Penataan Ruang Kota Palopo.</p>
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
            <!-- /column -->
            <div class="col-md-4 col-lg-2 offset-lg-2">
                <div class="widget">
                    <h4 class="widget-title mb-3 text-white">Link Terkait</h4>
                    <ul class="list-unstyled mb-0">
                        <li><a href="#">Support</a></li>
                        <li><a href="#">Get Started</a></li>
                        <li><a href="#">Terms of Use</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
                <!-- /.widget -->
            </div>
            <!-- /column -->
            <div class="col-md-4 col-lg-2">
                <div class="widget">
                    <h4 class="widget-title mb-3 text-white">Data Drainase</h4>
                    <ul class="list-unstyled mb-0">
                        <li><a href="<?= base_url('home/drainase') ?>">Drainase</a></li>
                        <li><a href="<?= base_url('home/jaringan_drainase') ?>">Jaringan Drainase</a></li>
                        <li><a href="<?= base_url('home/bangunan_drainase') ?>">Bangunan Drainase</a></li>
                        <li><a href="<?= base_url('home/pintu_drainase') ?>">Pintu Drainase</a></li>
                        <li><a href="<?= base_url('home/gangguan_drainase') ?>">Gangguan Drainase</a></li>
                    </ul>
                </div>
                <!-- /.widget -->
            </div>
            <!-- /column -->
            <div class="col-md-4 col-lg-2">
                <div class="widget">
                    <h4 class="widget-title mb-3 text-white">Kontak</h4>
                    <address>Boting, Wara, Palopo City, South Sulawesi 91911, Indonesia</address>
                    <a href="mailto:first.last@email.com">info@email.com</a><br /> 00 (123) 456 78 90
                </div>
                <!-- /.widget -->
            </div>
            <!-- /column -->
        </div>
        <!--/.row -->
    </div>
    <!-- /.container -->
</footer>
<div class="progress-wrap">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
</div>
<?php echo $this->load->view('template_home/footer_middle'); ?>