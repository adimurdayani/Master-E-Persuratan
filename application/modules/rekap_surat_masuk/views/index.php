<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->

<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                                <li class="breadcrumb-item active"><?= $title; ?></li>
                            </ol>
                        </div>
                        <h4 class="page-title"> <?= $title; ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="alert alert-info mb-3" role="alert">
                                <i class="mdi mdi-alert-circle-outline mr-2"></i> Anda dapat melakukan rekap data surat masuk dengan cara <strong>memilih tanggal awal rekap surat dan tanggal akhir rekap surat</strong>. Kemudian anda dapat mengklik tombol cetak di samping. Maka data yang anda inginkan akan terekap sesuai tanggal awal dan tanggal akhir yang ada pilih.
                            </div>

                            <?= form_open('rekap_surat_masuk/cetak') ?>
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-inline">
                                        <div class="form-group mx-sm-3">
                                            <label for="status-select" class="mr-2">Tanggal Awal</label>
                                            <input type="date" name="tgl_awal" id="tgl_awal" class="form-control">
                                        </div>
                                        <div class="form-group mx-sm-3">
                                            <label for="status-select" class="mr-2">Tanggal Akhir</label>
                                            <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="text-lg-right mt-3 mt-lg-0">
                                        <button type="submit" class="btn btn-success waves-effect waves-light"><i class="fe-printer mr-1"></i> Cetak</button>
                                    </div>
                                </div><!-- end col-->
                            </div> <!-- end row -->
                            <?= form_close() ?>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- content -->

    <?php echo $this->load->view('template/footer_start'); ?>
    <?php echo $this->load->view('template/right_sidebar'); ?>


    <?php echo $this->load->view('template/footer_end'); ?>