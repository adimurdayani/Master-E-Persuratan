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
                                <li class="breadcrumb-item"><a href="<?= base_url('menu') ?>">Menu</a></li>
                                <li class="breadcrumb-item active"><?= $title ?></li>
                            </ol>
                        </div>
                        <h4 class="page-title"><?= $title ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <?php $uri = $this->uri->segment(4) ?>

            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-12 text-sm-center form-inline">
                                        <div class="form-group mr-2">
                                            <a href="<?= base_url('menu') ?>" class="btn btn-xs btn-secondary">
                                                <span class="btn-xs btn-label"><i class="fe-arrow-left"></i></span> Kembali
                                            </a>
                                        </div>
                                        <div class="form-group mr-2">
                                            <a href="#" data-target="#tambah" data-toggle="modal" class="btn btn-xs btn-primary">
                                                <span class="btn-xs btn-label"><i class="fe-plus"></i></span> Tambah
                                            </a>
                                        </div>
                                        <div class="form-group mr-2">
                                            <a href="<?= base_url('menu/detail/submenu/') . $uri ?>" title="Reload" class="btn btn-xs btn-info">
                                                <span class="btn-xs btn-label"><i class="fe-refresh-ccw"></i></span> Reload
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No. Urut</th>
                                            <th class="text-center">Nama Sub Menu</th>
                                            <th class="text-center">Url </th>
                                            <th class="text-center">Aktif </th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody> </tbody>
                                </table>
                            </div>
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
                <div class="col-lg-4">
                    <div class="card-box">
                        <h4 class="header-title">Sitemap Sub Menu</h4>
                        <div class="custom-dd" id="nestable_list_2">
                            <ol class="dd-list">
                                <li class="dd-item dd-collapsed" data-id="<?= $get_menu->id_menu ?>">
                                    <div class="dd-handle">
                                        <?= $get_menu->menu_title ?>
                                    </div>
                                    <ol class="dd-list">
                                        <?php foreach ($get_submenu as $gs) : ?>
                                            <?php if ($gs->id_sub_menu == $get_menu->id_menu) : ?>
                                                <li class="dd-item dd-collapsed" data-id="<?= $gs->id_sub_menu ?>">
                                                    <div class="dd-handle">
                                                        <?= $gs->submenu_title ?>
                                                    </div>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ol>
                                </li>
                            </ol>
                        </div>

                    </div> <!-- end card-box-->
                </div> <!-- end col-->

            </div> <!-- container -->

        </div> <!-- content -->

        <div id="tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Sub Menu</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <form id="form-submenu" method="post">
                        <div class="modal-body p-4">
                            <input type="hidden" id="id_kategori" name="id_kategori" value="<?= $get_menu->id_menu_groups ?>">
                            <input type="hidden" id="id_menu" name="id_menu" value="<?= $get_menu->id_menu ?>">
                            <div class="form-group">
                                <label>Nama Sub Menu <span class="text-danger">*</span></label>
                                <input type="text" name="nama_submenu" id="nama_submenu" placeholder="Input nama sub menu" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Url Sub Menu <span class="text-danger">*</span></label>
                                <input type="text" name="url" id="url" placeholder="example/example" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>No. Urut Menu <span class="text-danger">*</span></label>
                                <input type="number" name="no_urut" id="no_urut" placeholder="0" class="form-control">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary waves-effect" data-dismiss="modal">
                                <span class="btn-label"><i class="fe-arrow-left"></i></span>Tutup
                            </button>
                            <button type="button" id="simpan" class="btn btn-sm btn-success waves-effect waves-light">
                                <span class="btn-label"><i class="fe-save"></i></span>Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- /.modal -->

        <?php echo $this->load->view('template/footer_start'); ?>
        <?php echo $this->load->view('template/right_sidebar'); ?>

        <?php $uri = $this->uri->segment(4) ?>

        <script>
            $(document).ready(function() {

                function load_data() {
                    $.ajax({
                        url: "<?= base_url('menu/detail/load_data/') . $uri; ?>",
                        dataType: "JSON",
                        success: function(data) {
                            //colom inputan
                            var html = '<tr>';
                            for (var count = 0; count < data.length; count++) {
                                var id = data[count].id_sub_menu;
                                var check = '';
                                if (data[count].active == 1) {
                                    check = 'checked=checked';
                                }
                                html += '<tr>';
                                html += '<td class="table_data text-center" data-row_id="' + id +
                                    '" data-column_name="serial_number" contenteditable>' + data[count].serial_number + '</td>';
                                html += '<td class="table_data" data-row_id="' + id +
                                    '" data-column_name="submenu_title" contenteditable>' + data[count].submenu_title + '</td>';
                                html += '<td class="table_data" data-row_id="' + id +
                                    '" data-column_name="url" contenteditable>' + data[count].url + '</td>';
                                html += '<td> <div class="checkbox checkbox-success checkbox-single text-center">' +
                                    '<input id="singleCheckbox2" type="checkbox" data-id="' + id + '" class="ubah-submenu-aktif checkbox checkbox-success" ' + check + '>' +
                                    '<label></label></div></td>';
                                html += '<td class="text-center"><button type="button" name="delete_btn" id="' + id +
                                    '" class="btn btn-xs btn-danger btn_delete" title="Hapus Data"><span class="fe-trash" ></span> </button>' + '</td></tr>';
                            }
                            //hasil looping
                            $('tbody').html(html);
                        }
                    });
                }
                load_data(); //panggil fungsi load data

                $(document).on('click', '#simpan', function() {
                    var nama_submenu = $('#nama_submenu').val();
                    var url = $('#url').val();
                    var no_urut = $('#no_urut').val();
                    var id_kategori = $('#id_kategori').val();
                    var id_menu = $('#id_menu').val();
                    var token = '<?php echo $this->security->get_csrf_hash() ?>';

                    if (nama_submenu == '') {
                        $.NotificationApp.send("Peringatan!", "Nama submenu tidak boleh kosong!", "top-right", "#da8609", "warning")
                        return false;
                    } else if (url == '') {
                        $.NotificationApp.send("Peringatan!", "Url submenu tidak boleh kosong!", "top-right", "#da8609", "warning")
                        return false;
                    } else if (no_urut == '') {
                        $.NotificationApp.send("Peringatan!", "No. urut submenumenu tidak boleh kosong!", "top-right", "#da8609", "warning")
                        return false;
                    } else {
                        $.ajax({
                            url: "<?= base_url('menu/detail/tambah') ?>",
                            type: 'post',
                            data: {
                                id_kategori: id_kategori,
                                id_menu: id_menu,
                                url: url,
                                nama_submenu: nama_submenu,
                                no_urut: no_urut,
                                token: token
                            },
                            success: function() {
                                $.NotificationApp.send("Sukses!", "Submenu berhasil disimpan!", "top-right", "#5ba035", "success");
                                load_data();
                                $('#form-submenu')[0].reset();
                                $('#tambah').modal('hide');
                            }
                        });

                    }
                });

                $(document).on('blur', '.table_data', function() {
                    var id_sub_menu = $(this).data('row_id');
                    var table_column = $(this).data('column_name');
                    var value = $(this).text();
                    var token = '<?php echo $this->security->get_csrf_hash() ?>';
                    console.log(id_sub_menu);

                    $.ajax({
                        url: "<?= base_url(); ?>menu/detail/update",
                        method: "POST",
                        data: {
                            id_sub_menu: id_sub_menu,
                            table_column: table_column,
                            value: value,
                            token: token
                        },
                        success: function(data) {
                            $.NotificationApp.send("Sukses!", "Data berhasil diupdate", "top-right", "#5ba035", "success")
                            load_data();
                        }
                    });
                });

                $(document).on('click', '.ubah-submenu-aktif', function() {
                    const id_sub_menu = $(this).data('id');
                    const token = '<?php echo $this->security->get_csrf_hash() ?>';

                    $.ajax({
                        url: "<?= base_url('menu/detail/ubah_submenu_aktif') ?>",
                        type: 'post',
                        data: {
                            id_sub_menu: id_sub_menu,
                            token: token
                        },
                        success: function() {
                            $.NotificationApp.send("Sukses!", "", "top-right", "#5ba035", "success");
                            load_data();
                        }
                    });
                });

                //delete data
                $(document).on('click', '.btn_delete', function(e) {
                    var id_sub_menu = $(this).attr('id');
                    var token = '<?php echo $this->security->get_csrf_hash() ?>';

                    Swal.fire({
                        title: "Apakah anda yakin?",
                        text: "Menghapus data ini!",
                        type: "warning",
                        showCancelButton: !0,
                        confirmButtonText: "Hapus!",
                        cancelButtonText: "Tutup!",
                        confirmButtonClass: "btn btn-sm btn-danger mt-2",
                        cancelButtonClass: "btn btn-sm btn-secondary ml-2 mt-2",
                        buttonsStyling: !1
                    }).then((result) => {
                        if (result.value) {

                            $.ajax({
                                url: "<?= base_url(); ?>menu/detail/hapus",
                                method: "POST",
                                data: {
                                    id_sub_menu: id_sub_menu,
                                    token: token
                                },
                                success: function(data) {
                                    $.NotificationApp.send("Sukses!", "Submenu berhasil dihapus!", "top-right", "#5ba035", "success");
                                    load_data();
                                }
                            });
                        } else if (result.dismiss === swal.DismissReason.cancel) {}
                    })
                });

            });


            $("#nestable_list_2").nestable({
                group: 1
            });
        </script>

        <?php echo $this->load->view('template/footer_end'); ?>