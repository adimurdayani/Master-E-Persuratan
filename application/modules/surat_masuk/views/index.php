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
                                <i class="mdi mdi-alert-circle-outline mr-2"></i> Anda dapat melakukan pencarian data surat masuk secara spesifik dengan memilih <strong>sifat surat dan status arsip surat</strong>
                            </div>
                            <div class="row">
                                <div class="col-lg-8">
                                    <form id="form-filter" class="form-inline">
                                        <div class="form-group mx-sm-3">
                                            <label for="sifat_surat" class="mr-2">Sifat Surat</label>
                                            <select name="sifat_surat" id="sifat_surat" class="form-control">
                                                <option value="">Semua Sifat Surat</option>
                                                <option value="UMUM">UMUM</option>
                                                <option value="RAHASIA">RAHASIA</option>
                                            </select>
                                        </div>
                                        <div class="form-group mx-sm-3">
                                            <label for="keterangan" class="mr-2">Arsip</label>
                                            <select name="keterangan" id="keterangan" class="form-control">
                                                <option value="">Semua Arsip</option>
                                                <option value="Sudah Ter-Arsip">Sudah Ter-Arsip</option>
                                                <option value="Belum Ter-Arsip">Belum Ter-Arsip</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-lg-4">
                                    <div class="text-lg-right mt-3 mt-lg-0">
                                        <button type="button" id="btn-reset" class="btn btn-sm btn-danger mr-1"><i class="fe-refresh-ccw"></i> Reset</button>
                                        <button type="button" id="btn-filter" class="btn btn-sm btn-info"><i class="fe-filter"></i> Filter</button>
                                    </div>
                                </div><!-- end col-->
                            </div> <!-- end row -->
                            <hr>
                            <a href="<?= base_url('surat_masuk/tambah') ?>" class="btn btn-sm btn-primary waves-effect waves-light mb-3">
                                <span class="btn-label"><i class="fe-plus"></i></span>Tambah surat masuk
                            </a>

                            <div class="table-responsive">
                                <table class="table table-striped nowrap w-100" id="table-surat-masuk">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Aksi</th>
                                            <th class="text-center">Kode</th>
                                            <th class="text-center" style="width: 50px;">Isi / File Surat</th>
                                            <th class="text-center" style="width: 50px;">Asal Surat</th>
                                            <th class="text-center">Nomor & Tanggal Surat</th>
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

    <div id="update-verifikasi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Verifikasi Surat Masuk</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body p-4">

                    <input type="hidden" name="id_smasuk" id="id_smasuk">

                    <div class="form-group">
                        <label>Verifikasi Surat <span class="text-danger">*</span></label>
                        <select name="status_verifikasi" id="status_verifikasi" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            <option value="1">Verifikasi</option>
                            <option value="0">Tidak diverifikasi</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary waves-effect" data-dismiss="modal">
                        <span class="btn-label"><i class="fe-arrow-left"></i></span>Tutup
                    </button>
                    <button type="button" class="btn btn-sm btn-success waves-effect waves-light verifikasi">
                        <span class="btn-label"><i class="fe-save"></i></span>Simpan
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

            table = $('#table-surat-masuk').DataTable({

                "processing": true,
                "language": {
                    processing: '<div class="spinner-border text-primary m-2" role="status"></div>'
                },
                "serverSide": true,
                "lengthMenu": [5, 10, 25, 50, 75, 100],
                "order": [],
                "ajax": {
                    "url": "<?php echo site_url('surat_masuk/load_data') ?>",
                    "type": "POST",
                    "data": function(data) {
                        data.<?php echo $this->security->get_csrf_token_name(); ?> = token;
                        data.sifat_surat = $('#sifat_surat').val();
                        data.keterangan = $('#keterangan').val();
                    }
                },
                "columnDefs": [{
                    "targets": [0],
                    "orderable": false,
                }, ],

            });

            $('#btn-filter').click(function() {
                table.ajax.reload();
            });
            $('#btn-reset').click(function() {
                $('#form-filter')[0].reset();
                table.ajax.reload();
            });

            //delete data
            $(document).on('click', '.btn_delete', function(e) {
                var id_smasuk = $(this).attr('id');

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
                            url: "<?= base_url(); ?>surat_masuk/hapus",
                            method: "POST",
                            cache: false,
                            data: {
                                id_smasuk: id_smasuk
                            },
                            success: function(data) {
                                $.NotificationApp.send("Sukses!", "Data berhasil dihapus", "top-right", "#5ba035", "success")
                                table.ajax.reload();
                            }
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel) {}
                })
            });

            $(document).on('click', '.btn-verifikasi', function(e) {
                e.preventDefault();
                var id = $(this).attr('id');
                $('#update-verifikasi').modal('show');
                $('#id_smasuk').val(id);
            });


            $(document).on('click', '.verifikasi', function(e) {
                e.preventDefault();
                var status_verifikasi = $('#status_verifikasi').val();
                var id_smasuk = $('#id_smasuk').val();
                if (status_verifikasi == '') {
                    $.NotificationApp.send("Peringatan!", "Anda harus memilih salah satu verifikasi surat!", "top-right", "#da8609", "warning")
                    $('#update-verifikasi').modal('show');
                } else {
                    $.ajax({
                        url: "<?= base_url('surat_masuk/edit_verifikasi') ?>",
                        type: 'post',
                        cache: false,
                        data: {
                            id_smasuk: id_smasuk,
                            status_verifikasi: status_verifikasi
                        },
                        success: function() {
                            $.NotificationApp.send("Sukses!", "Verifikasi surat berhasil disimpan!", "top-right", "#5ba035", "success");

                            $('#id_smasuk').val('');
                            $('#status_verifikasi').val('');
                            $('#update-verifikasi').modal('hide');
                            table.ajax.reload();
                        }
                    });
                }
            });
        });
    </script>

    <?php echo $this->load->view('template/footer_end'); ?>