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
                                <li class="breadcrumb-item active"><?= $title; ?></li>
                            </ol>
                        </div>
                        <h4 class="page-title"> <?= $title; ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <a href="<?= base_url('menu') ?>" class="btn btn-xs btn-secondary mb-3">
                                <span class="btn-xs btn-label"><i class="fe-arrow-left"></i></span> Kembali
                            </a>
                            <table class="table  table-striped nowrap w-100">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th class="text-center">Nama Menu</th>
                                        <th class="text-center">Tanggal</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody> </tbody>
                            </table>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
                <div class="col-lg-4">
                    <div class="card-box">
                        <h4 class="header-title">Sitemap Kategori Menu</h4>
                        <div class="custom-dd" id="nestable_list_2">
                            <ol class="dd-list">
                                <?php foreach ($get_kategori as $gk) : ?>
                                    <li class="dd-item dd-collapsed" data-id="<?= $gk->id_menu_group ?>">
                                        <div class="dd-handle">
                                            <?= $gk->name ?>
                                        </div>
                                        <ol class="dd-list">
                                            <?php foreach ($get_menu as $gm) : ?>
                                                <?php if ($gm->id_menu_groups == $gk->id_menu_group) : ?>
                                                    <li class="dd-item dd-collapsed" data-id="<?= $gm->id_menu ?>">
                                                        <div class="dd-handle">
                                                            <?= $gm->menu_title ?>
                                                        </div>
                                                        <ol class="dd-list">
                                                            <?php foreach ($get_submenu as $gs) : ?>
                                                                <?php if ($gs->id_menus == $gm->id_menu) : ?>
                                                                    <li class="dd-item" data-id="<?= $gs->id_sub_menu ?>">
                                                                        <div class="dd-handle">
                                                                            <?= $gs->submenu_title ?>
                                                                        </div>
                                                                    </li>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        </ol>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </ol>
                                    </li>
                                <?php endforeach; ?>
                            </ol>
                        </div>

                    </div> <!-- end card-box-->
                </div> <!-- end col-->
            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- content -->

    <?php echo $this->load->view('template/footer_start'); ?>
    <?php echo $this->load->view('template/right_sidebar'); ?>

    <script>
        $(document).ready(function() {

            //load data
            function load_data() {
                $.ajax({
                    url: "<?= base_url(); ?>kategori_menu/load_data",
                    dataType: "JSON",
                    cache: false,
                    success: function(data) {
                        //colom inputan
                        var html = '<tr>';
                        html += '<td id="serial_number" contenteditable placeholder="No urut"></td>';
                        html += '<td id="name" contenteditable placeholder="Nama grup"></td>';
                        html += '<td></td>';
                        html += '<td class="text-center"><button type="button" name="btn_add" id="btn_add" title="Tambah Data" class="btn btn-xs btn-primary"><span class="fa fa-plus"></span></td></tr>';
                        //looping data dalam bentuk json
                        for (var count = 0; count < data.length; count++) {
                            var id = data[count].id_menu_group;
                            html += '<tr>';
                            html += '<td class="table_data" data-row_id="' + id +
                                '" data-column_name="serial_number" contenteditable>' + data[count].serial_number +
                                '</td>';
                            html += '<td class="table_data" data-row_id="' + id +
                                '" data-column_name="name" contenteditable>' + data[count].name +
                                '</td>';
                            html += '<td class="text-center">' + data[count].created_at + '</td>';
                            html += '<td ></td>';
                            html += '</tr>';
                        }
                        //hasil looping
                        $('tbody').html(html);
                    }
                });
            }
            load_data(); //panggil fungsi load data

            //simpan data
            $(document).on('click', '#btn_add', function() {
                var name = $('#name').text();
                var serial_number = $('#serial_number').text();
                var validasiAngka = /^[0-9]+$/;

                //cek jika inputan kososng
                if (name == '') {
                    $.NotificationApp.send("Peringatan!", "Nama kategori menu tidak boleh kosong!", "top-right", "#da8609", "warning")
                    return false;
                }
                if (serial_number == '') {
                    $.NotificationApp.send("Peringatan!", "No. urut tidak boleh kosong!", "top-right", "#da8609", "warning")
                    return false;
                }
                if (!serial_number.match(validasiAngka)) {
                    $.NotificationApp.send("Peringatan!", "No. urut harus mengandung angka!", "top-right", "#da8609", "warning")
                    return false;
                }

                //jika inputan ada isinya, kirim data
                $.ajax({
                    url: "<?= base_url(); ?>kategori_menu/tambah",
                    method: 'POST',
                    cache: false,
                    //data yang dikirim (variabel : value)
                    data: {
                        name: name,
                        serial_number: serial_number
                    },
                    //callback jika data berhasil disimpan
                    success: function(data) {
                        $.NotificationApp.send("Sukses!", "Data berhasil ditambah", "top-right", "#5ba035", "success")
                        load_data();
                    }
                });
            });

            //update data
            $(document).on('blur', '.table_data', function() {
                var id_menu_group = $(this).data('row_id');
                var table_column = $(this).data('column_name');
                var value = $(this).text();

                $.ajax({
                    url: "<?= base_url(); ?>kategori_menu/update",
                    method: "POST",
                    cache: false,
                    data: {
                        id_menu_group: id_menu_group,
                        table_column: table_column,
                        value: value
                    },
                    success: function(data) {
                        $.NotificationApp.send("Sukses!", "Data berhasil diupdate", "top-right", "#5ba035", "success")
                        load_data();
                    }
                });
            });
        });

        $("#nestable_list_2").nestable({
            group: 1
        });
    </script>

    <?php echo $this->load->view('template/footer_end'); ?>