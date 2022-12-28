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
                                <li class="breadcrumb-item active"><?= $title ?></li>
                            </ol>
                        </div>
                        <h4 class="page-title"><?= $title ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Form Input</h4>
                            <p class="sub-header">
                                Sesuaikan nama website anda dengan cara mengisi form input di bawah.
                            </p>

                            <?php if ($get_total == 0) : ?>
                                <?= form_open_multipart('konfigurasi/tambah') ?>

                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                                <div class="form-group ">
                                    <label for="simpleinput">Nama Website</label>
                                    <input type="text" id="simpleinput" name="nama_web" value="<?= htmlentities(set_value('nama_web'), ENT_QUOTES) ?>" class="form-control">
                                    <small class="text-danger"><?= form_error('nama_web') ?></small>
                                </div>

                                <button type="submit" class="btn btn-sm btn-success"><i class="fe-save"></i> Simpan</button>

                                <?= form_close() ?>

                            <?php else : ?>
                                <?= form_open_multipart('konfigurasi/edit') ?>

                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                <input type="hidden" id="id" name="id" value="<?= base64_encode($get_config->id) ?>">

                                <div class="form-group">
                                    <label for="nama_web">Nama Website</label>
                                    <input type="text" id="nama_web" name="nama_web" value="<?= $get_config->nama_web ?>" class="form-control">
                                    <?= form_error('nama_web', '<small class="text-danger">', '</small>') ?>
                                </div>

                                <button type="submit" class="btn btn-sm btn-warning"><i class="fe-save"></i> Ubah</button>

                                <?= form_close() ?>

                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <?= form_open_multipart('konfigurasi/icon_web') ?>

                                        <input type="hidden" id="id" name="id" value="<?= base64_encode($get_config->id) ?>">
                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                                        <div class="form-group ">
                                            <label>Upload Icon Website</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input input1" id="icon_web" name="icon_web">
                                                    <label class="custom-file-label">Choose file</label>
                                                </div>
                                            </div>
                                            <img src="<?= base_url('assets/backend/images/upload/') . $get_config->icon_web ?>" alt="" class="img-thumbnail mt-2" width="100px" loading="lazy">
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-success  float-right"><i class="fe-upload"></i> Upload</button>
                                        <?= form_close() ?>
                                    </div>
                                    <div class="col-md-6">
                                        <?= form_open_multipart('konfigurasi/logo_web') ?>

                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                        <input type="hidden" id="id" name="id" value="<?= base64_encode($get_config->id) ?>">
                                        <div class="form-group">
                                            <label>Upload Logo Website</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input input2" id="logo_web" name="logo_web">
                                                    <label class="custom-file-label">Choose file</label>
                                                </div>
                                            </div>
                                            <img src="<?= base_url('assets/backend/images/upload/') . $get_config->logo_web ?>" alt="" class="img-thumbnail mt-2" width="100px" loading="lazy">
                                        </div>

                                        <button type="submit" class="btn btn-sm btn-success float-right"><i class="fe-upload"></i> Upload</button>
                                        <?= form_close() ?>
                                    </div>
                                </div>

                            <?php endif ?>

                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div><!-- end col -->
                <?php if ($get_total != 0) : ?>
                    <div class="col-lg-6">
                        <div class="card">
                            <?= form_open('konfigurasi/edit_data_web') ?>
                            <div class="card-body">
                                <input type="hidden" id="id" name="id" value="<?= base64_encode($get_config->id) ?>">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                                <div class="form-group">
                                    <label for="nama_web">Nama Instansi <span class="text-danger">*</span></label>
                                    <input type="text" id="instansi" name="instansi" value="<?= $get_config->instansi ?>" class="form-control">
                                    <?= form_error('instansi', '<small class="text-danger">', '</small>') ?>
                                </div>

                                <div class="form-group">
                                    <label for="phone">No. Telp <span class="text-danger">*</span></label>
                                    <input type="text" id="phone" name="phone" value="<?= $get_config->phone ?>" class="form-control">
                                    <?= form_error('phone', '<small class="text-danger">', '</small>') ?>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email <span class="text-danger">*</span></label>
                                    <input type="email" id="email" name="email" value="<?= $get_config->email ?>" class="form-control">
                                    <?= form_error('email', '<small class="text-danger">', '</small>') ?>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="pimpinan">Nama Pimpinan <span class="text-danger">*</span></label>
                                            <input type="text" id="pimpinan" name="pimpinan" value="<?= $get_config->pimpinan ?>" class="form-control">
                                            <?= form_error('pimpinan', '<small class="text-danger">', '</small>') ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nidn_pimpinan">NIDN Pimpinan <span class="text-danger">*</span></label>
                                            <input type="text" id="nidn_pimpinan" name="nidn_pimpinan" value="<?= $get_config->nidn_pimpinan ?>" class="form-control">
                                            <?= form_error('nidn_pimpinan', '<small class="text-danger">', '</small>') ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="link_website">Link Website <span class="text-danger">*</span></label>
                                    <input type="text" id="link_website" name="link_website" value="<?= $get_config->link_website ?>" class="form-control">
                                    <?= form_error('link_website', '<small class="text-danger">', '</small>') ?>
                                </div>

                                <div class="form-group">
                                    <label for="alamat">Link Website <span class="text-danger">*</span></label>
                                    <input type="text" id="alamat" name="alamat" value="<?= $get_config->alamat ?>" class="form-control">
                                    <?= form_error('alamat', '<small class="text-danger">', '</small>') ?>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-sm btn-success"><i class="fe-save"></i> Simpan</button>
                            </div>
                            <?= form_close() ?>
                        </div>
                    </div>
                <?php endif ?>
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->

    <?php echo $this->load->view('template/footer_start'); ?>
    <?php echo $this->load->view('template/right_sidebar'); ?>
    <?php echo $this->load->view('template/footer_end'); ?>