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
                            <?= form_open('') ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tujuan_disposisi">Tujuan Disposisi</label>
                                        <input type="text" name="tujuan_disposisi" id="penerima" class="form-control" placeholder="Input tujuan disposisi" value="<?= $get_disposisi['tujuan_disposisi'] ?>" autofocus>
                                        <small class="text-danger"><?= form_error('tujuan_disposisi') ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="isi_disposisi">Isi Disposisi</label>
                                        <textarea name="isi_disposisi" id="isi_disposisi" rows="5" class="form-control" placeholder="Input isi disposisi"><?= $get_disposisi['isi_disposisi'] ?></textarea>
                                        <small class="text-danger"><?= form_error('isi_disposisi') ?></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sifat_disposisi">Sifat Disposisi</label>
                                        <?= form_dropdown('sifat_disposisi', $sifat_disposisi, '', 'class="form-control" required') ?>
                                        <small class="text-danger"><?= form_error('sifat_disposisi') ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="batas_waktu">Batas Waktu</label>
                                        <input type="date" name="batas_waktu" id="batas_waktu" class="form-control" value="<?= $get_disposisi['batas_waktu'] ?>">
                                        <small class="text-danger"><?= form_error('batas_waktu') ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_selesai">Tanggal Disposisi</label>
                                        <input type="date" name="tgl_selesai" id="tgl_selesai" class="form-control" value="<?= $get_disposisi['tgl_selesai'] ?>">
                                        <small class="text-danger"><?= form_error('tgl_selesai') ?></small>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-warning float-right"><i class="fe-save"></i> Ubah</button>
                                </div>
                            </div>
                            <?= form_close() ?>

                        </div> <!-- end card body-->
                        <div class="card-footer">
                            <a href="<?= base_url('surat_masuk') ?>" class="btn btn-sm btn-secondary"><i class="fe-list"></i> Data Surat Masuk</a>
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