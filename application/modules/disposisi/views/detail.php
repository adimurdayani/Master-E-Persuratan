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
                                <li class="breadcrumb-item"><a href="<?= base_url('disposisi') ?>">Data Disposisi</a></li>
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
                                <table>
                                    <tr>
                                        <td style="width: 200px;">Nomor Surat</td>
                                        <th>: <?= $get_surat['no_surat'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Asal Surat</td>
                                        <th>: <?= $get_surat['asal_surat'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Surat</td>
                                        <th>: <?= $get_surat['tgl_surat'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Lihat File/Berkas</td>
                                        <th>: <a href="<?= base_url('assets/backend/images/surat_masuk/') . $get_surat['file_surat'] ?>" target="_blank" class="badge badge-success"><i class="fe-file"></i> Lihat File</a> <a href="<?= base_url('assets/backend/images/surat_masuk/') . $get_surat['link_file'] ?>" target="_blank" class="badge badge-warning"><i class="fe-hard-drive"></i> Google Drive</a></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tujuan_disposisi">Tujuan Disposisi</label>
                                        <input type="text" class="form-control" value="<?= $get_disposisi['tujuan_disposisi'] ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="isi_disposisi">Isi Disposisi</label>
                                        <textarea rows="5" class="form-control" disabled><?= $get_disposisi['isi_disposisi'] ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sifat_disposisi">Sifat Disposisi</label>
                                        <input type="text" value="<?= $get_disposisi['sifat_disposisi'] ?>" class="form-control" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="batas_waktu">Batas Waktu</label>
                                        <input type="text" class="form-control" value="<?= $get_disposisi['batas_waktu'] ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_selesai">Tanggal Disposisi</label>
                                        <input type="text" class="form-control" value="<?= $get_disposisi['tgl_selesai'] ?>" disabled>
                                    </div>
                                </div>
                            </div>

                        </div> <!-- end card body-->
                        <div class="card-footer">
                            <a href="<?= base_url('disposisi') ?>" class="btn btn-sm btn-warning"><i class="fe-list"></i> Data Disposisi</a>
                        </div>
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- content -->

    <?php echo $this->load->view('template/footer_start'); ?>
    <?php echo $this->load->view('template/right_sidebar'); ?>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        $("#penerima").autocomplete({
            source: "<?= site_url('surat_masuk/penerima/?') ?>"
        });
    </script>

    <?php echo $this->load->view('template/footer_end'); ?>