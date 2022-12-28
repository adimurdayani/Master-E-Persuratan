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
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-body">

                            <div class="btn-group mb-3">
                                <a href="javascript: void(0);" data-target="#tambah" data-toggle="modal" class="btn btn-xs btn-primary" title="Tambah" data-plugin="tippy" data-tippy-placement="top">
                                    <i class="fe-plus"></i>
                                </a>
                                <a href="" class="btn btn-xs btn-info" title="Reload" data-plugin="tippy" data-tippy-placement="top">
                                    <i class="fe-refresh-ccw"></i>
                                </a>
                            </div>
                            <a href="javascript: void(0);" data-target="#tambah-folder" data-toggle="modal" class="btn btn-xs btn-success mb-3" title="Tambah folder Baru" data-plugin="tippy" data-tippy-placement="top">
                                <i class="fe-folder-plus"></i>
                            </a>

                            <div class="table-responsive">
                                <table id="table-menu" class="table table-hover nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Aksi</th>
                                            <th class="text-center">Aktif </th>
                                            <th class="text-center">Collapse</th>
                                            <th class="text-center">No. Urut</th>
                                            <th class="text-center">Nama Menu</th>
                                            <th class="text-center">Url</th>
                                            <th class="text-center">Nama Folder</th>
                                            <th class="text-center">Icon </th>
                                        </tr>
                                    </thead>

                                    <tbody> </tbody>
                                </table>
                            </div>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
                <div class="col-lg-3">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title">Pengaturan Main Menu</h4>
                                    <p class="sub-header">Atur kategori menu dan pengguna yang dapat mengakses menu.</p>

                                    <?php $total_kategori = $this->db->get('menu_groups')->num_rows();
                                    $total_akses = $this->db->get('groups')->num_rows(); ?>
                                    <div class="list-group">
                                        <a href="<?= base_url('kategori_menu') ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                            <i class="fe-menu"></i>Kategori Menu
                                            <span class="badge badge-primary badge-pill"><?= $total_kategori ?></span>
                                        </a>
                                        <a href="<?= base_url('group') ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                            <i class="fe-user"></i>Akses Menu
                                            <span class="badge badge-success badge-pill"><?= $total_akses ?></span>
                                        </a>
                                    </div>
                                </div> <!-- end card-body -->
                            </div> <!-- end card-->
                        </div>
                        <div class="col-lg-12">

                            <div class="card-box">
                                <h4 class="header-title">Sitemap Main Menu</h4>
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
                        </div>
                    </div> <!-- end col-->
                </div> <!-- container -->

            </div> <!-- content -->

            <div id="tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah Menu</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <form id="form-menu" method="post">
                            <div class="modal-body p-4">

                                <div class="form-group">
                                    <label>Kategori Menu <span class="text-danger">*</span></label>
                                    <select name="id_kategori" id="id_kategori" class="form-control">
                                        <option value="">Pilih</option>
                                        <?php foreach ($get_kategori as $kat) : ?>
                                            <option value="<?= $kat->id_menu_group ?>"><?= htmlentities($kat->name, ENT_QUOTES) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Nama Menu <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_menu" id="nama_menu" value="<?= htmlentities(set_value('menu_title'), ENT_QUOTES) ?>" placeholder="Input nama menu" class="form-control">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Url Menu <span class="text-danger">*</span></label>
                                            <input type="text" name="url" id="url" value="<?= htmlentities(set_value('url'), ENT_QUOTES) ?>" placeholder="example/example" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Icon Menu <span class="text-danger">*</span></label>
                                            <input type="text" name="icon" id="icon" value="<?= htmlentities(set_value('icon'), ENT_QUOTES) ?>" placeholder="fe-home" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>No. Urut Menu <span class="text-danger">*</span></label>
                                    <input type="number" name="no_urut" id="no_urut" value="<?= htmlentities(set_value('serial_number'), ENT_QUOTES) ?>" placeholder="0" class="form-control">
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-secondary waves-effect" data-dismiss="modal">
                                    <span class="btn-label"><i class="fe-arrow-left"></i></span>Tutup
                                </button>
                                <button type="button" class="btn btn-sm btn-success waves-effect waves-light" id="simpan">
                                    <span class="btn-label"><i class="fe-save"></i></span>Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- /.modal -->

            <div id="edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit "<span id="Gmenu"></span>"</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body p-4">

                            <input type="hidden" name="id_menu" id="Tid" value="">

                            <div class="form-group">
                                <label>Kategori Menu <span class="text-danger">*</span></label>
                                <select name="Tid_kat" id="Tid_kat" class="form-control">
                                    <option value="">Pilih</option>
                                    <?php foreach ($get_kategori as $kategori) : ?>
                                        <option value="<?= $kategori->id_menu_group ?>"><?= htmlentities($kategori->name, ENT_QUOTES) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Nama Menu <span class="text-danger">*</span></label>
                                <input type="text" name="nama_menu" id="Tmenu" placeholder="Input nama menu" class="form-control">
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Url Menu <span class="text-danger">*</span></label>
                                        <input type="text" name="url" id="Turl_menu" placeholder="example/example" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Icon Menu <span class="text-danger">*</span></label>
                                        <input type="text" name="icon" id="Ticon_menu" placeholder="fe-home" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>No. Urut Menu <span class="text-danger">*</span></label>
                                <input type="number" name="no_urut" id="Tno_urut_menu" placeholder="0" class="form-control">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary waves-effect" data-dismiss="modal">
                                <span class="btn-label"><i class="fe-arrow-left"></i></span>Tutup
                            </button>
                            <button type="button" class="btn btn-sm btn-warning waves-effect waves-light ubah-menu">
                                <span class="btn-label"><i class="fe-save"></i></span>Ubah
                            </button>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal -->

            <div id="tambah-folder" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah Folder </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <?= form_open('menu/tambah_folder') ?>
                        <div class="modal-body p-4">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                            <div class="form-group">
                                <label>Nama Folder <span class="text-danger">*</span></label>
                                <input type="text" name="folder" id="folder" value="<?= set_value('folder') ?>" placeholder="Nama folder" class="form-control">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary waves-effect" data-dismiss="modal">
                                <span class="btn-label"><i class="fe-arrow-left"></i></span>Tutup
                            </button>
                            <button type="submit" class="btn btn-sm btn-success waves-effect waves-light">
                                <span class="btn-label"><i class="fe-save"></i></span>Buat
                            </button>
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div><!-- /.modal -->

            <?php echo $this->load->view('template/footer_start'); ?>
            <?php echo $this->load->view('template/right_sidebar'); ?>

            <script>
                var table;
                var token = "<?php echo $this->security->get_csrf_hash(); ?>";
                $(document).ready(function() {

                    //datatables
                    table = $('#table-menu').DataTable({

                        "processing": true,
                        "language": {
                            processing: '<div class="spinner-border text-primary m-2" role="status"></div>'
                        },
                        "serverSide": true,
                        "lengthMenu": [5, 10, 25, 50, 75, 100],
                        "order": [],
                        "ajax": {
                            "url": "<?php echo site_url('menu/load_data') ?>",
                            "type": "POST",
                            "data": function(d) {
                                d.<?php echo $this->security->get_csrf_token_name(); ?> = token;
                            }
                        },
                        "columnDefs": [{
                            "targets": [0],
                            "orderable": false,
                        }, ],

                    });

                    $(document).on('click', '#simpan', function() {
                        var id_kategori = $('#id_kategori').val();
                        var nama_menu = $('#nama_menu').val();
                        var url = $('#url').val();
                        var icon = $('#icon').val();
                        var no_urut = $('#no_urut').val();
                        var folder = $('#folder').val();
                        var token = '<?php echo $this->security->get_csrf_hash() ?>';

                        if (id_kategori == '') {
                            $.NotificationApp.send("Peringatan!", "Anda harus memilih salah satu kategori!", "top-right", "#da8609", "warning")
                            return false;
                        } else if (nama_menu == '') {
                            $.NotificationApp.send("Peringatan!", "Nama menu tidak boleh kosong!", "top-right", "#da8609", "warning")
                            return false;
                        } else if (url == '') {
                            $.NotificationApp.send("Peringatan!", "Url menu tidak boleh kosong!", "top-right", "#da8609", "warning")
                            return false;
                        } else if (icon == '') {
                            $.NotificationApp.send("Peringatan!", "Icon menu tidak boleh kosong!", "top-right", "#da8609", "warning")
                            return false;
                        } else if (no_urut == '') {
                            $.NotificationApp.send("Peringatan!", "No. urut tidak boleh kosong!", "top-right", "#da8609", "warning")
                            return false;
                        } else {

                            $.ajax({
                                url: "<?= base_url('menu/tambah') ?>",
                                type: 'post',
                                cache: false,
                                data: {
                                    id_kategori: id_kategori,
                                    nama_menu: nama_menu,
                                    url: url,
                                    icon: icon,
                                    no_urut: no_urut,
                                    token: token
                                },
                                success: function() {
                                    $.NotificationApp.send("Sukses!", "Menu berhasil disimpan!", "top-right", "#5ba035", "success");
                                    table.ajax.reload();
                                    $('#form-menu')[0].reset();
                                    $('#tambah').modal('hide');
                                }
                            });

                        }
                    });

                    $(document).on('click', '.edit-menu[data-id]', function(e) {
                        e.preventDefault();
                        var id = $(this).data('id');
                        $('#edit').modal('show');
                        $.ajax({
                            url: "<?= base_url('menu/show_data') ?>",
                            type: 'post',
                            dataType: "JSON",
                            cache: false,
                            data: {
                                id: id
                            },
                            success: function(data) {
                                $('#Gmenu').html(data.menu_title);
                                $('#Tid').val(data.id_menu);
                                $('#Tmenu').val(data.menu_title);
                                $('#Turl_menu').val(data.url);
                                $('#Ticon_menu').val(data.icon);
                                $('#Tno_urut_menu').val(data.serial_number);
                                $('select[name="Tid_kat"]').append('<option selected value="' + data.id_menu_groups + '">' + data.name + '</option>');
                            }
                        });
                    });

                    $(document).on('click', '.ubah-menu', function(e) {
                        e.preventDefault();
                        var id_menu = $('#Tid').val();
                        var menu_title = $('#Tmenu').val();
                        var url = $('#Turl_menu').val();
                        var icon = $('#Ticon_menu').val();
                        var serial_number = $('#Tno_urut_menu').val();
                        var id_menu_groups = $('#Tid_kat').val();

                        if (id_menu_groups == '') {
                            $.NotificationApp.send("Peringatan!", "Anda harus memilih salah satu kategori!", "top-right", "#da8609", "warning")
                            $('#edit').modal('show');
                        } else if (menu_title == '') {
                            $.NotificationApp.send("Peringatan!", "Nama menu tidak boleh kosong!", "top-right", "#da8609", "warning")
                            $('#edit').modal('show');
                        } else if (url == '') {
                            $.NotificationApp.send("Peringatan!", "Url menu tidak boleh kosong!", "top-right", "#da8609", "warning")
                            $('#edit').modal('show');
                        } else if (icon == '') {
                            $.NotificationApp.send("Peringatan!", "Icon menu tidak boleh kosong!", "top-right", "#da8609", "warning")
                            $('#edit').modal('show');
                        } else if (serial_number == '') {
                            $.NotificationApp.send("Peringatan!", "No. urut tidak boleh kosong!", "top-right", "#da8609", "warning")
                            $('#edit').modal('show');
                        } else {
                            $.ajax({
                                url: "<?= base_url('menu/edit') ?>",
                                type: 'post',
                                cache: false,
                                data: {
                                    id_menu: id_menu,
                                    id_menu_groups: id_menu_groups,
                                    menu_title: menu_title,
                                    url: url,
                                    icon: icon,
                                    serial_number: serial_number,
                                    token: token
                                },
                                success: function() {
                                    $.NotificationApp.send("Sukses!", "Menu berhasil disimpan!", "top-right", "#5ba035", "success");

                                    $('#Tid').val('');
                                    $('#Tmenu').val('');
                                    $('#Turl_menu').val('');
                                    $('#Ticon_menu').val('');
                                    $('#Tno_urut_menu').val('');
                                    $('#Tid_kat').val('');
                                    $('#edit').modal('hide');
                                    table.ajax.reload();
                                }
                            });
                        }
                    })

                    $(document).on('click', '.ubah-menu-aktif', function() {
                        const id_menu = $(this).data('id');
                        const token = '<?php echo $this->security->get_csrf_hash() ?>';

                        $.ajax({
                            url: "<?= base_url('menu/ubah_menu_aktif') ?>",
                            type: 'post',
                            data: {
                                id_menu: id_menu,
                                token: token
                            },
                            success: function() {
                                $.NotificationApp.send("Sukses!", "Aktifasi menu berhasil diubah!", "top-right", "#5ba035", "success");
                                table.ajax.reload();
                            }
                        });
                    });

                    $(document).on('click', '.ubah-menu-collapse', function() {
                        const id_menu = $(this).data('id');
                        const token = '<?php echo $this->security->get_csrf_hash() ?>';

                        $.ajax({
                            url: "<?= base_url('menu/ubah_collapse_menu') ?>",
                            type: 'post',
                            data: {
                                id_menu: id_menu,
                                token: token
                            },
                            success: function() {
                                $.NotificationApp.send("Sukses!", "Collapse menu berhasil diubah!", "top-right", "#5ba035", "success");
                                table.ajax.reload();
                            }
                        });
                    });

                    //delete data
                    $(document).on('click', '.btn_delete', function(e) {
                        var id_menu = $(this).attr('id');
                        const token = '<?php echo $this->security->get_csrf_hash() ?>';

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
                                    url: "<?= base_url(); ?>menu/hapus",
                                    method: "POST",
                                    data: {
                                        id_menu: id_menu,
                                        token: token
                                    },
                                    success: function(data) {
                                        $.NotificationApp.send("Sukses!", "Data berhasil dihapus", "top-right", "#5ba035", "success")
                                        table.ajax.reload();
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