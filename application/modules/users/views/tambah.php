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
                <div class="col-lg-7">
                    <div class="card">
                        <?= form_open('users/tambah') ?>
                        <div class="card-body">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="first_name">First Name <span class="text-danger">*</span></label>
                                        <input type="text" id="first_name" name="first_name" value="<?= htmlentities(set_value('first_name'), ENT_QUOTES) ?>" class="form-control" requiredd>
                                        <small class="text-danger"><?= form_error('first_name') ?></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="last_name">Last Name <span class="text-danger">*</span></label>
                                        <input type="text" id="last_name" name="last_name" class="form-control" value="<?= htmlentities(set_value('last_name'), ENT_QUOTES) ?>" required>
                                        <small class="text-danger"><?= form_error('last_name') ?></small>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="company">Nama Instansi <span class="text-danger">*</span></label>
                                <input type="text" id="company" name="company" class="form-control" value="<?= htmlentities(set_value('company'), ENT_QUOTES) ?>" required>
                                <small class="text-danger"><?= form_error('company') ?></small>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="username">Username <span class="text-danger">*</span></label>
                                        <input type="text" id="username" name="username" class="form-control" value="<?= htmlentities(set_value('username'), ENT_QUOTES) ?>" required>
                                        <small class="text-danger"><?= form_error('username') ?></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="email">Email <span class="text-danger">*</span></label>
                                        <input type="email" id="email" name="email" class="form-control" value="<?= htmlentities(set_value('email'), ENT_QUOTES) ?>" required>
                                        <small class="text-danger"><?= form_error('email') ?></small>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="phone">Phone <span class="text-danger">*</span></label>
                                <input type="number" id="phone" name="phone" class="form-control" value="<?= htmlentities(set_value('phone'), ENT_QUOTES) ?>" required>
                                <small class="text-danger"><?= form_error('phone') ?></small>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="password">Password <span class="text-danger">*</span></label>
                                        <input type="password" id="password" name="password" class="form-control" required>
                                        <small class="text-danger"><?= form_error('password') ?></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="konf_pass">Konfirmasi Password <span class="text-danger">*</span></label>
                                        <input type="password" id="konf_pass" name="konf_pass" class="form-control" required>
                                        <small class="text-danger"><?= form_error('konf_pass') ?></small>
                                    </div>
                                </div>
                            </div>

                        </div> <!-- end card body-->

                        <div class="card-footer">
                            <a href="<?= base_url('users') ?>" class="btn btn-sm btn-secondary waves-effect" data-dismiss="modal">
                                <span class="btn-label"><i class="fe-arrow-left"></i></span>Kembali
                            </a>
                            <button type="submit" class="btn btn-sm btn-success waves-effect waves-light">
                                <span class="btn-label"><i class="fe-save"></i></span>Simpan
                            </button>
                        </div>

                        <?= form_close() ?>
                    </div> <!-- end card -->
                </div><!-- end col-->

            </div> <!-- container -->

        </div> <!-- content -->

        <?php echo $this->load->view('template/footer_start'); ?>
        <?php echo $this->load->view('template/right_sidebar'); ?>
        <?php echo $this->load->view('template/footer_end'); ?>