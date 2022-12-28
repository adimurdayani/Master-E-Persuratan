<!-- Footer Start -->
<footer class="footer">
    <div class="container-fluid">
        <?php $konfig = $this->db->get('tb_konfigurasi')->row(); ?>
        <div class="row">
            <div class="col-md-6">
                2022 - <script>
                    document.write(new Date().getFullYear())
                </script> &copy; <?= $konfig->nama_web ?>
            </div>
            <div class="col-md-6">
                <div class="text-md-right footer-links d-none d-sm-block">
                    <a href="https://www.technokreatif.com/">About Us</a>
                    <a href="https://www.technokreatif.com/home/kontak">Help</a>
                    <a href="https://www.technokreatif.com/home/kontak">Contact Us</a>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- end Footer -->

</div>

<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->