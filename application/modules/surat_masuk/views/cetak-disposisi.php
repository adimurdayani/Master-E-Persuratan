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
            body {
                height: 842px;
                width: 595px;
                /* to centre page on screen*/
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
        <table class="table table-bordered w-100">
            <thead>
                <tr>
                    <td colspan="3">
                        <div class="pt-0">
                            <img src="<?= base_url('assets/backend/images/upload/') . $get_config->logo_web ?>" alt="Logo Instansi" style="position: absolute; width: 160px; margin-left: 45px; margin-top: -10px;">
                        </div>
                        <div class="text-center">
                            <h2>PEMERINTAH KOTA PALOPO</h2>
                            <h2>DINAS PERHUBUNGAN KOTA PALOPO</h2>
                            <span><?= $get_config->alamat ?> <?= $get_config->phone ?>.</span>
                            <br>
                            <i>Email. <?= $get_config->email ?> || Website: <?= $get_config->link_website ?></i>
                            <div class="garis_vertikal"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th colspan="3" class="text-center">
                        <h5>LEMBAR DISPOSISI</h5>
                    </th>
                </tr>
                <tr>
                    <th style="width: 20%;">No. Agenda</th>
                    <td colspan="2"><?= $get_surat['no_agenda'] ?></td>
                </tr>
                <tr>
                    <th>Klasifikasi Surat</th>
                    <td colspan="2"><?= $get_surat['kode_klasifikasi'] ?></td>
                </tr>
                <tr>
                    <th>Asal Surat</th>
                    <td colspan="2"><?= $get_surat['asal_surat'] ?></td>
                </tr>
                <tr>
                    <th>Nomor Surat</th>
                    <td colspan="2"><?= $get_surat['no_surat'] ?></td>
                </tr>
                <tr>
                    <th>Tanggal Surat</th>
                    <td colspan="2"><?= tanggal_indonesia($get_surat['tgl_surat']) ?></td>
                </tr>
                <tr>
                    <th>Isi Surat</th>
                    <td colspan="2"><?= $get_surat['isi_surat'] ?></td>
                </tr>
                <tr>
                    <th>Penerima Surat</th>
                    <td colspan="2"><?= $get_surat['penerima'] ?></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="2" style="width: 70%;">
                        <strong>Isi Disposisi:</strong>
                        <br>
                        <br>
                        1. <?php
                            $this->db->where('kode_surat', $get_surat['kode_disposisi']);
                            $disposisi = $this->db->get('tb_disposisi')->row_array();
                            echo $disposisi['isi_disposisi'];
                            ?>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                    </td>
                    <td>
                        Ditujukan kepada:
                        <br>
                        <br>
                        1. <?php
                            $this->db->where('kode_surat', $get_surat['kode_disposisi']);
                            $disposisi = $this->db->get('tb_disposisi')->row_array();
                            echo $disposisi['tujuan_disposisi'];
                            ?>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                    </td>
                </tr>
            </tbody>
        </table>

        <table>
            <tr>
                <td style="width: 78%;"></td>
                <td>Palopo, <?= tanggal_indonesia(date('Y-m-d')) ?></td>
            </tr>
            <tr>
                <td>
                    Kepala Dinas
                    <br>
                    <br>
                    <br>
                    <br>
                    <strong><u><?= $get_config->pimpinan ?></u></strong>
                    <br>
                    NIP:.<?= $get_config->nidn_pimpinan ?>
                </td>
                <td>
                    <?php
                    $users_groups = $this->db->get_where('users_groups', ['user_id' => $session->id])->row();
                    $groups = $this->db->get_where('groups', ['id' => $users_groups->group_id])->row();
                    echo $groups->description;
                    ?>
                    <br>
                    <br>
                    <br>
                    <br>
                    <span><?= $session->first_name . ' ' . $session->last_name ?></span>
                    <br>
                    NIP:.<?= $session->nidn ?>
                </td>
            </tr>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <script>
        window.print();
    </script>
</body>

</html>