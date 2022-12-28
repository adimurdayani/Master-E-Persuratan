<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title><?= $title ?> | Administrator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <?php if ($get_config) : ?>
        <link rel="shortcut icon" href="<?= base_url('assets/backend/images/upload/') . $get_config->icon_web ?>" loading="lazy">
    <?php endif; ?>
    <!-- Summernote css -->
    <link href="<?= base_url('assets/backend/') ?>libs/summernote/summernote-bs4.min.css" rel="stylesheet" type="text/css" />
    <!-- Sweet Alert-->
    <link href="<?= base_url('assets/backend/') ?>libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

    <!-- Jquery Toast css -->
    <link href="<?= base_url('assets/backend/') ?>libs/jquery-toast-plugin/jquery.toast.min.css" rel="stylesheet" type="text/css" />

    <!-- third party css -->
    <link href="<?= base_url('assets/backend/') ?>libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/backend/') ?>libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Plugins css -->
    <link href="<?= base_url('assets/backend/') ?>libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/backend/') ?>libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/backend/') ?>libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/backend/') ?>libs/nestable2/jquery.nestable.min.css" rel="stylesheet" />
    <link href="<?= base_url('assets/backend/') ?>libs/selectize/css/selectize.bootstrap3.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/backend/') ?>libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/backend/') ?>libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <!-- App css -->
    <link href="<?= base_url('assets/backend/') ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="<?= base_url('assets/backend/') ?>css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <link href="<?= base_url('assets/backend/') ?>css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" disabled />
    <link href="<?= base_url('assets/backend/') ?>css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" disabled />

    <!-- icons -->
    <link href="<?= base_url('assets/backend/') ?>css/icons.min.css" rel="stylesheet" type="text/css" />

</head>

<body data-layout='{"sidebar": {"showuser": true},"topbar": {"color": "light"},"showRightSidebarOnPageLoad": false}'>
    <!-- Pre-loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner">Loading...</div>
        </div>
    </div>
    <!-- End Preloader-->
    <!-- Begin page -->
    <div id="wrapper">