<!DOCTYPE html>
<html lang="en">

<head>
  <!-- set the encoding of your site -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta property="og:title" content="<?= htmlentities($get_berita->judul, ENT_QUOTES) ?>">
  <?php $img = $this->db->get_where('tb_berita_img', ['kode_berita' => $get_berita->kode_img])->row(); ?>
  <meta property="og:image" content="<?= base_url('assets/backend/images/berita/') . htmlentities($img->img_berita, ENT_QUOTES) ?>" loading="lazy">
  <meta property="og:site_name" content="Kecamatan Wara">
  <meta property="og:description" content="<?= strip_tags(html_entity_decode(word_limiter(teksKonv($get_berita->isi), 30))) ?>">
  <!-- set the page title -->
  <title><?= word_limiter(htmlentities($get_berita->judul, ENT_QUOTES), 5) ?> | Dinas Pekerjaan Umum dan Penataan Ruang</title>
  <?php if ($get_config) : ?>
    <link rel="shortcut icon" href="<?= base_url('assets/backend/images/upload/') . $get_config->icon_web ?>" loading="lazy">
  <?php endif; ?>
  <link rel="stylesheet" href="<?= base_url('assets/frontend/') ?>css/plugins.css">
  <link rel="stylesheet" href="<?= base_url('assets/frontend/') ?>css/style.css">
</head>

<body>
  <div class="content-wrapper">
    
  <div class="page-loader"></div>