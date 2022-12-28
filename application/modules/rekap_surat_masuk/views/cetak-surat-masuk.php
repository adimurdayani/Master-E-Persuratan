<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <style>
        @media print {
            @page {
                size: A4 landscape;
            }

            body {
                height: 842px;
                width: 595px;
                margin-left: auto;
                margin-right: auto;
            }

        }

        hr {
            width: 85%;
            height: 5px;
            background-color: black;
        }

        .garis_vertikal {
            border-bottom: 5px black solid;
            width: 100%;
            margin-top: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="pt-0">
            <img src="<?= base_url('assets/backend/images/upload/') . $get_config['logo_web'] ?>" alt="Logo Instansi" style="position: absolute; width: 160px; margin-left: 45px; margin-top: -10px;">
        </div>
        <div class="text-center">
            <h4>PEMERINTAH KOTA PALOPO</h4>
            <h4>DINAS PERHUBUNGAN KOTA PALOPO</h4>
            <span><?= $get_config['alamat'] ?> <?= $get_config['phone'] ?>.</span>
            <br>
            <i>Email. <?= $get_config['email'] ?> || Website: <?= $get_config['link_website'] ?></i>
            <div class="garis_vertikal"></div>
        </div>
        <h5 class="text-center mb-3">REKAPITULASI SURAT MASUK</h5>
        <table class="table table-bordered" style="font-size: 12px;">
            <thead>
                <tr>
                    <th class="text-center align-middle">No.</th>
                    <th class="text-center align-middle">No. Agenda & Kode</th>
                    <th class="text-center align-middle">Isi Ringkasan</th>
                    <th class="text-center align-middle">Dari</th>
                    <th class="text-center align-middle">Nomor Surat</th>
                    <th class="text-center align-middle">Tgl. Surat</th>
                    <th class="text-center align-middle">Penerima Surat</th>
                    <th class="text-center align-middle">Ket</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($get_surat as $data) : ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td class="text-center"><?= $data['no_agenda'] ?>/<?= $data['no_surat'] ?></td>
                        <td><strong><?= $data['jenis_surat'] ?>:</strong> <?= $data['isi_surat'] ?></td>
                        <td><?= $data['asal_surat'] ?></td>
                        <td class="text-center"><?= $data['no_surat'] ?>/<?= $data['kode_klasifikasi'] ?>/<?= romawi(date('m', strtotime($data['tgl_surat']))) ?>/<?= $data['tahun'] ?></td>
                        <td class="text-center"><?= tanggal_indonesia($data['tgl_surat']) ?></td>
                        <td><?= $data['penerima'] ?></td>
                        <td><?= $data['keterangan'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="row mt-4">
            <div class="col-md-8">
                <br>
                <span>Kepala Dinas</span>
                <br>
                <br>
                <br>
                <br>
                <strong><u><?= $get_config['pimpinan'] ?></u></strong>
                <br>
                <span>NIDN:.<?= $get_config['nidn_pimpinan'] ?></span>
            </div>
            <div class="col-md-4">
                <span>Palopo, <?= tanggal_indonesia(date('Y-m-d')) ?></span>
                <br>
                <span>
                    <?php
                    $user_group = $this->db->get_where('users_groups', ['user_id' => $session['id']])->row_array();
                    $groups = $this->db->get_where('groups', ['id' => $user_group['group_id']])->row_array();
                    echo $groups['description'];
                    ?>
                </span>
                <br>
                <br>
                <br>
                <br>
                <strong><u><?= $session['first_name'] ?> <?= $session['last_name'] ?></u></strong>
                <br>
                <span>NIDN:.<?= $session['nidn'] ?></span>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <script>
        window.print();
    </script>
</body>

</html>