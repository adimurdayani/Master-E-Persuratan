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

                            <div class="alert alert-warning mb-3" role="alert">
                                <i class="mdi mdi-alert-circle-outline mr-2"></i> Perhatikan tanda <code>(*)</code> menunjukkan bahwa kolom input tersebut tidak boleh dikosongkan.
                            </div>

                            <?= form_open_multipart('') ?>
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group mb-3">
                                        <label for="no_agenda">No. Agenda <span class="text-danger">*</span></label>
                                        <input type="number" name="no_agenda" id="no_agenda" class="form-control" placeholder="0" value="<?= $get_surat['no_agenda'] ?>" autofocus>
                                        <small class="text-danger"><?= form_error('no_agenda') ?></small>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="tujuan_surat">Tujaun Surat <span class="text-danger">*</span></label>
                                        <input type="text" name="tujuan_surat" id="tujuan_surat" class="form-control" value="<?= $get_surat['tujuan_surat'] ?>" placeholder="Tulis dari mana surat berasal">
                                        <small class="text-danger"><?= form_error('tujuan_surat') ?></small>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="no_surat">No. Surat <span class="text-danger">*</span></label>
                                        <input type="number" name="no_surat" id="no_surat" class="form-control" value="<?= $get_surat['no_surat'] ?>" placeholder="Tulis dengan teliti nomor surat masuk">
                                        <small class="text-danger"><?= form_error('no_surat') ?></small>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="tgl_surat">Tanggal Surat <span class="text-danger">*</span></label>
                                        <input type="date" name="tgl_surat" id="tgl_surat" class="form-control" value="<?= $get_surat['tgl_surat'] ?>">
                                        <small class="text-danger"><?= form_error('tgl_surat') ?></small>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="isi_surat">Isi Surat <span class="text-danger">*</span></label>
                                        <textarea name="isi_surat" id="isi_surat" cols="30" rows="5" placeholder="Tulis isi surat" class="form-control"><?= $get_surat['isi_surat'] ?></textarea>
                                        <small class="text-danger"><?= form_error('isi_surat') ?></small>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="jenis_surat">Jenis Surat <span class="text-danger">*</span></label>
                                        <input type="text" name="jenis_surat" id="jenis_surat" class="form-control" value="<?= $get_surat['jenis_surat'] ?>" placeholder="Contoh: Surat izin, SPPD, Surat Pengantar">
                                        <small class="text-danger"><?= form_error('jenis_surat') ?></small>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="sifat_surat">Sifat Surat <span class="text-danger">*</span></label>
                                        <?= form_dropdown('sifat_surat', $sifat_surat, '', 'class="form-control" required') ?>
                                        <small class="text-danger"><?= form_error('sifat_surat'); ?></small>
                                    </div>

                                </div>
                                <div class="col-md-6">

                                    <div class="form-group mb-3">
                                        <label for="kode_klasifikasi">Kode Klasifikasi <span class="text-danger">*</span></label>
                                        <input type="text" name="kode_klasifikasi" id="kode_klasifikasi" class="form-control" placeholder="0" value="<?= $get_surat['kode_klasifikasi'] ?>">
                                        <small class="text-danger"><?= form_error('kode_klasifikasi') ?></small>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="bidang">Bidang <span class="text-danger">*</span></label>
                                        <input type="text" name="bidang" id="bidang" class="form-control" placeholder="Input nama bidang" value="<?= $get_surat['bidang'] ?>">
                                        <small class="text-danger"><?= form_error('bidang') ?></small>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="pembuat_surat">Pembuat Surat <span class="text-danger">*</span></label>
                                        <input type="text" name="pembuat_surat" id="pembuat_surat" class="form-control" placeholder="Tulis nama pembuat surat" value="<?= $get_surat['pembuat_surat'] ?>">
                                        <small class="text-danger"><?= form_error('pembuat_surat') ?></small>
                                    </div>

                                    <div class="form-group">
                                        <label>Upload File Surat</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input input1" name="file_surat" id="file_surat" accept=".png,.jpeg,.jpg" value="<?= $get_surat['file_surat'] ?>">
                                                <label class="custom-file-label">Choose file</label>
                                            </div>
                                        </div>
                                        <small class="text-danger">Hanya file .JPG, .JPEG, .PNG</small>
                                        <br>
                                        <a href="<?= base_url('assets/backend/images/surat_keluar/') . $get_surat['file_surat'] ?>" target="_blank" class="btn btn-xs btn-success  mt-2 mb-2"><i class="fe-file"></i> Lihat file</a>
                                        <a href="<?= $get_surat['link_file'] ?>" class="btn btn-xs btn-warning mt-2 mb-2" target="_blank"><i class="fe-hard-drive"></i> Google drive</a>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="link_file">Link Surat <span class="text-danger">*</span></label>
                                        <input type="text" name="link_file" id="link_file" class="form-control" placeholder="Contoh: Surat izin, SPPD, Surat Pengantar" value="<?= $get_surat['link_file'] ?>">
                                        <small class="text-danger"><?= form_error('link_file') ?></small>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="keterangan">Keterangan Surat <span class="text-danger">*</span></label>
                                        <?= form_dropdown('keterangan', $keterangan, '', 'class="form-control" required') ?>
                                        <small class="text-danger"><?= form_error('keterangan') ?></small>
                                    </div>

                                </div>
                            </div>

                            <button type="submit" class="btn btn-sm btn-warning waves-effect waves-light float-right">
                                <span class="btn-label"><i class="fe-save"></i></span>Ubah
                            </button>
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
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script>
        $(document).ready(function() {
            $("#kode_klasifikasi").autocomplete({
                source: "<?= site_url('surat_keluar/kode_klasifikasi/?') ?>"
            });

            $("#pembuat_surat").autocomplete({
                source: "<?= site_url('surat_keluar/penerima/?') ?>"
            });

            $("#jenis_surat").autocomplete({
                source: "<?= site_url('surat_keluar/jenis_surat/?') ?>"
            });

            $("#bidang").autocomplete({
                source: "<?= site_url('surat_keluar/bidang/?') ?>"
            });
        });
    </script>

    <?php echo $this->load->view('template/footer_end'); ?>