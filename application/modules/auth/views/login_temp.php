<?php $this->load->view('template_auth/header'); ?>

<div class="account-pages mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-pattern">

                    <div class="card-body p-4">

                        <div class="text-center w-75 m-auto">
                            <div class="auth-logo">
                                <a href="<?= base_url() ?>" class="logo logo-dark text-center">
                                    <span class="logo-lg">
                                        <img src="<?= htmlentities(base_url('assets/backend/images/logo_luwu.png'), ENT_QUOTES); ?>" alt="" height="50" class="lazyload">
                                    </span>
                                </a>
                            </div>
                            <p class="text-muted mb-4 mt-3">Input email dan password anda, untuk mengakses admin panel.</p>
                        </div>
                        <?php if ($message == true) : ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <?php echo $message; ?>
                            </div>
                        <?php endif; ?>

                        <?php echo form_open("auth"); ?>

                        <div class="form-group mb-3">
                            <label for="emailaddress">Email</label>
                            <input class="form-control" type="text" id="emailaddress" name="identity" value="<?= htmlentities(set_value('identity'), ENT_QUOTES); ?>" required="" placeholder="Input email">
                        </div>

                        <div class="form-group mb-3">
                            <label for="password">Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control" name="password" value="<?= htmlentities(set_value('password'), ENT_QUOTES); ?>" placeholder="Input password">
                                <div class="input-group-append" data-password="false">
                                    <div class="input-group-text">
                                        <span class="password-eye"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"', 'class="custom-control-input"'); ?>
                            <?php echo lang('login_remember_label', 'remember'); ?>
                        </div>

                        <div class="form-group mb-0 text-center">
                            <button class="btn btn-primary btn-block" type="submit"> Masuk </button>
                        </div>

                        <?php echo form_close(); ?>

                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end page -->
<?php $this->load->view('template_auth/footer'); ?>