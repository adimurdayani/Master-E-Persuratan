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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="alert alert-info mb-3" role="alert">
                                <i class="mdi mdi-alert-circle-outline mr-2"></i> Data penerima surat digunakan untuk menentukan siapa saja yang menerima suat masuk dan keluar. <strong>Data ini dapat mempermudah dalam menentukan si penerima surat, pada saat akan menambahkan surat masuk dan surat keluar</strong>.
                            </div>

                            <a href="javascript:void(0);" data-target="#tambah" data-toggle="modal" class="btn btn-sm btn-primary waves-effect waves-light mb-3" id="simpan">
                                <span class="btn-label"><i class="fe-plus"></i></span>Tambah
                            </a>

                            <div class="table-responsive">
                                <table class="table table-striped nowrap w-100" id="table-penerima">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No.</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Tanggal</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody> </tbody>
                                </table>
                            </div>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- content -->

    <div id="tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Penerima</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body p-4">

                    <div class="form-group">
                        <label>Nama <span class="text-danger">*</span></label>
                        <input type="text" name="nama" id="nama" placeholder="Input nama" class="form-control">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary waves-effect" data-dismiss="modal">
                        <span class="btn-label"><i class="fe-arrow-left"></i></span>Tutup
                    </button>
                    <button type="button" class="btn btn-sm btn-success waves-effect waves-light simpan">
                        <span class="btn-label"><i class="fe-save"></i></span>Simpan
                    </button>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->

    <div id="edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit "<span id="Gnama"></span>"</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body p-4">

                    <input type="hidden" name="id" id="id">

                    <div class="form-group">
                        <label>Nama <span class="text-danger">*</span></label>
                        <input type="text" name="nama" id="Tnama" placeholder="Input nama" class="form-control">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary waves-effect" data-dismiss="modal">
                        <span class="btn-label"><i class="fe-arrow-left"></i></span>Tutup
                    </button>
                    <button type="button" class="btn btn-sm btn-warning waves-effect waves-light ubah">
                        <span class="btn-label"><i class="fe-save"></i></span>Ubah
                    </button>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->

    <?php echo $this->load->view('template/footer_start'); ?>
    <?php echo $this->load->view('template/right_sidebar'); ?>

    <script>
        var table;
        var token = "<?php echo $this->security->get_csrf_hash(); ?>";
        $(document).ready(function() {

            table = $('#table-penerima').DataTable({

                "processing": true,
                "language": {
                    processing: '<div class="spinner-border text-primary m-2" role="status"></div>'
                },
                "serverSide": true,
                "lengthMenu": [5, 10, 25, 50, 75, 100],
                "order": [],
                "ajax": {
                    "url": "<?php echo site_url('penerima/load_data') ?>",
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

            //simpan data
            $(document).on('click', '.simpan', function() {
                var nama = $('#nama').val();

                if (nama == '') {
                    $.NotificationApp.send("Peringatan!", "Nama tidak boleh kosong!", "top-right", "#da8609", "warning")
                    return false;
                } else {
                    $.ajax({
                        url: "<?= base_url(); ?>penerima/tambah",
                        method: 'POST',
                        cache: false,
                        data: {
                            nama: nama
                        },
                        success: function(data) {
                            $.NotificationApp.send("Sukses!", "Data berhasil ditambah", "top-right", "#5ba035", "success")
                            table.ajax.reload();
                            $('#nama').val('');
                            $('#tambah').modal('hide');
                        }
                    });

                }
            });

            //update data
            $(document).on('click', '.edit-penerima[data-id]', function() {
                var id = $(this).data('id');
                $('#edit').modal('show');
                $.ajax({
                    url: "<?= base_url(); ?>penerima/show_data",
                    method: 'POST',
                    cache: false,
                    dataType: "JSON",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        $('#Gnama').html(data.nama);
                        $('#Tnama').val(data.nama);
                        $('#id').val(data.id);
                    }
                });
            });

            $(document).on('click', '.ubah', function() {
                var id = $('#id').val();
                var nama = $('#Tnama').val();
                $('#edit').modal('show');

                if (nama == '') {
                    $.NotificationApp.send("Peringatan!", "Nama tidak boleh kosong!", "top-right", "#da8609", "warning")
                    return false;
                } else {
                    $.ajax({
                        url: "<?= base_url(); ?>penerima/edit",
                        method: 'POST',
                        cache: false,
                        data: {
                            id: id,
                            nama: nama
                        },
                        success: function(data) {
                            $.NotificationApp.send("Sukses!", "Data berhasil diubah", "top-right", "#5ba035", "success")
                            table.ajax.reload();
                            $('#Tnama').val('');
                            $('#id').val('');
                            $('#edit').modal('hide');
                        }
                    });
                }
            });

            //delete data
            $(document).on('click', '.btn_delete', function(e) {
                var id = $(this).attr('id');

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
                            url: "<?= base_url(); ?>penerima/hapus",
                            method: "POST",
                            cache: false,
                            data: {
                                id: id
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
    </script>

    <?php echo $this->load->view('template/footer_end'); ?>