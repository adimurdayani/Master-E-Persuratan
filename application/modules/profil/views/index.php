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
                                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Dashboard</a></li>
                                <li class="breadcrumb-item active">Profile</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Profile</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-4 col-xl-4">
                    <div class="card-box text-center">
                        <img src="<?= base_url('assets/backend/') ?>/images/users/user.png" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">

                        <h4 class="mb-0"><?= $session->first_name ?></h4>
                        <p class="text-muted"><?= $session->email ?></p>

                        <div class="text-left mt-3">
                            <p class="text-muted mb-2 font-13"><strong>Nama Lengkap :</strong> <span class="ml-2"><?= $session->first_name . ' ' . $session->last_name ?></span></p>

                            <p class="text-muted mb-2 font-13"><strong>No. Telp :</strong><span class="ml-2"><?= $session->phone ?></span></p>

                            <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ml-2 "><?= $session->email ?></span></p>
                        </div>
                    </div> <!-- end card-box -->

                </div> <!-- end col-->
                <?php $uri = $this->uri->segment(2) ?>
                <div class="col-lg-8 col-xl-8">
                    <div class="card-box">
                        <ul class="nav nav-pills navtab-bg nav-justified">
                            <li class="nav-item">
                                <a href="<?= base_url('profil/ubahprofile') ?>" aria-expanded="false" class="nav-link <?php if ($uri == "ubahprofile") : ?>active<?php endif; ?>">
                                    Update Profile
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?= base_url('profil/ubahpassword') ?>" aria-expanded="false" class="nav-link <?php if ($uri == "ubahpassword") : ?>active<?php endif; ?>">
                                    Update Password
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">

                            <div class="tab-pane <?php if ($uri == "ubahprofile") : ?>show active<?php endif; ?>" id="<?= base_url('profil/ubahprofile') ?>">
                                <?= form_open('profil/ubahprofile') ?>
                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle mr-1"></i> Info Pengguna</h5>

                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="firstname">Nama Depan <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="firstname" name="first_name" placeholder="Input nama depan" value="<?= htmlentities($session->first_name, ENT_QUOTES) ?>">
                                            <small class="text-danger"><?= form_error('first_name') ?></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lastname">Nama Belakang <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="lastname" name="last_name" placeholder="Input nama belakang" value="<?= htmlentities($session->last_name, ENT_QUOTES) ?>">
                                            <small class="text-danger"><?= form_error('last_name') ?></small>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Input email" value="<?= htmlentities($session->email, ENT_QUOTES) ?>">
                                            <small class="text-danger"><?= form_error('email') ?></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone">No. Telp <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="phone" name="phone" value="<?= htmlentities($session->phone, ENT_QUOTES) ?>" placeholder="Input no. telp">
                                            <small class="text-danger"><?= form_error('phone') ?></small>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->

                                <div class="form-group">
                                    <label for="nidn">NIDN <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="nidn" name="nidn" value="<?= htmlentities($session->nidn, ENT_QUOTES) ?>" placeholder="Input NIDN">
                                    <small class="text-danger"><?= form_error('nidn') ?></small>
                                </div>

                                <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-office-building mr-1"></i> Info Perusahaan</h5>
                                <div class="form-group">
                                    <label for="company">Nama Perusahaan <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="company" name="company" value="<?= htmlentities($session->company, ENT_QUOTES) ?>" placeholder="Input company name">
                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-sm btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Ubah</button>
                                </div>
                                <?= form_close() ?>
                            </div>
                            <!-- end settings content-->

                            <div class="tab-pane <?php if ($uri == "ubahpassword") : ?>show active<?php endif; ?>" id="<?= base_url('profil/ubahpassword') ?>">
                                <?= form_open('profil/ubahpassword') ?>

                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle mr-1"></i> Password User</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Input password">
                                            <small class="text-danger"><?= form_error('password') ?></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="konf_pass">Konfirmasi Password</label>
                                            <input type="password" class="form-control" id="konf_pass" name="konf_pass" placeholder="Input konfirmasi password">
                                            <small class="text-danger"><?= form_error('konf_pass') ?></small>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->
                                <div class="text-right">
                                    <button type="submit" class="btn btn-sm btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Ubah</button>
                                </div>
                                <?= form_close() ?>
                            </div>
                            <!-- end settings content-->

                        </div> <!-- end tab-content -->
                    </div> <!-- end card-box-->

                </div> <!-- end col -->
            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- content -->

    <?php echo $this->load->view('template/footer_start'); ?>
    <?php echo $this->load->view('template/right_sidebar'); ?>
    <?php echo $this->load->view('template/footer_end'); ?>