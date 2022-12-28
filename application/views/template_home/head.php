<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="An impressive and flawless site template that includes various UI elements and countless features, attractive ready-made blocks and rich pages, basically everything you need to create a unique and professional website.">
  <meta name="keywords" content="Dinas Pekerjaan Umum dan Penataan Ruang, Website Dinas Pekerjaan Umum dan Penataan Ruang, Website Drainase Kota Palopo">
  <meta name="author" content="Pemerintah Kota Palopo">
  <title>Sistem Informasi Drainase Kota Palopo | Dinas Pekerjaan Umum dan Penataan Ruang</title>
  <?php if ($get_config) : ?>
    <link rel="shortcut icon" href="<?= base_url('assets/backend/images/upload/') . $get_config->icon_web ?>" loading="lazy">
  <?php endif; ?>
  <!-- maps leaflet -->
  <link href="<?= base_url('maps-leaflet/') ?>leaflet.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url('maps-leaflet/leaflet-fullscreen/') ?>Control.FullScreen.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url('maps-leaflet/') ?>L.Control.Layers.Tree.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" integrity="sha512-gc3xjCmIy673V6MyOAZhIW93xhM9ei1I+gLbmFjUHIjocENRsLX/QUE1htk5q1XV2D/iie/VQ8DXI6Vu8bexvQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="<?= base_url('assets/frontend/') ?>css/plugins.css">
  <link rel="stylesheet" href="<?= base_url('assets/frontend/') ?>css/style.css">
</head>

<body>
  <div class="content-wrapper">

    <div class="page-loader"></div>
    <!-- /header -->