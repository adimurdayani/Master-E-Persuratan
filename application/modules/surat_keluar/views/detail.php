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
                                <li class="breadcrumb-item"><a href="<?= base_url('surat_keluar') ?>">Surat Keluar</a></li>
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
                        <div class="card-footer">
                            <a href="<?= base_url('surat_keluar') ?>" class="btn btn-sm btn-secondary waves-effect waves-light">
                                <span class="btn-label"><i class="fe-arrow-left"></i></span>Kembali
                            </a>
                        </div>
                        <div class="card-body">
                            <?php if ($get_surat['status_verifikasi'] != 0) : ?>
                                <div class="alert alert-info mb-3" role="alert">
                                    <i class="mdi mdi-alert-circle-outline mr-2"></i> <?= $get_surat['catatan_kelengkapan'] ?>
                                </div>
                            <?php else : ?>
                                <div class="alert alert-warning mb-3" role="alert">
                                    <i class="mdi mdi-alert-circle-outline mr-2"></i> <?= $get_surat['catatan_kelengkapan'] ?>
                                </div>
                            <?php endif; ?>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <td style="width: 250px;"><i class="fe-user text-primary"></i> Penerima Surat</td>
                                        <td>: <?= $get_surat['pembuat_surat'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><i class="fe-gift text-primary"></i> Jenis Surat</td>
                                        <td>: <?= $get_surat['jenis_surat'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><i class="fe-layers text-primary"></i> Klasifikasi Surat</td>
                                        <td>: <?= $get_surat['kode_klasifikasi'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><i class="fe-log-in text-warning"></i> Asal Surat</td>
                                        <td>: <?= $get_surat['tujuan_surat'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><i class="fe-filter text-primary"></i> Nomor Surat</td>
                                        <td>: <?= $get_surat['no_surat'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><i class="fe-calendar text-success"></i> Tanggal Surat</td>
                                        <td>: <?= tanggal_indonesia($get_surat['tgl_surat']) ?></td>
                                    </tr>
                                    <tr>
                                        <td><i class="fe-clipboard text-info"></i> Isi Surat</td>
                                        <td>: <?= $get_surat['isi_surat'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><i class="fe-eye text-success"></i> Dibaca</td>
                                        <td>: <?= $get_surat['dibaca'] ?> Kali</td>
                                    </tr>
                                </thead>
                            </table>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-footer">
                            <h4 class="header-title"> <i class="fe-eye text-success"></i> Preview File</h4>
                        </div>
                        <div class="card-body">

                            <div class="badge badge-warning">
                                <i class="fe-hard-drive"></i> Google Drive
                            </div>
                            <br>
                            <a href="<?= $get_surat['link_file'] ?>" class="btn btn-sm btn-outline-blue mt-2" target="_blank"><i class="fe-eye"></i> Lihat file</a>
                            <hr>

                            <div class="badge badge-success">
                                <i class="fe-file"></i> File Surat Keluar
                            </div>
                            <br>
                            <div data-spy="scroll" data-target="#navbar-example2" data-offset="0" class="scrollspy-example">
                                <img src="<?= base_url('assets/backend/images/surat_keluar/') . $get_surat['file_surat'] ?>" alt="file surat disposisi" class="img-thumbnail mt-2" width="100%">
                            </div>
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