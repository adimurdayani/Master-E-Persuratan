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
                <div class="col-lg">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <div class="btn-group mb-2">
                                <a href="<?= base_url('users/tambah') ?>" class="btn btn-xs btn-primary" title="Tambah" data-plugin="tippy" data-tippy-placement="top"><i class="fe-plus"></i></a>
                            </div>
                            <table id="table-users" class="table nowrap w-100">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Phone </th>
                                        <th class="text-center">Aktif </th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody> </tbody>
                            </table>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->

            </div> <!-- container -->

        </div> <!-- content -->

        <?php echo $this->load->view('template/footer_start'); ?>
        <?php echo $this->load->view('template/right_sidebar'); ?>

        <script>
            var table;
            var token = "<?php echo $this->security->get_csrf_hash(); ?>";
            $(document).ready(function() {

                //datatables
                table = $('#table-users').DataTable({
                    "processing": true,
                    "language": {
                        processing: '<div class="spinner-border text-primary m-2" role="status"></div>'
                    },
                    "serverSide": true,
                    "order": [],
                    "ajax": {
                        "url": "<?php echo site_url('users/load_data') ?>",
                        "type": "POST",
                        "cache": false,
                        "data": function(d) {
                            d.<?php echo $this->security->get_csrf_token_name(); ?> = token;
                        }
                    },
                    "columnDefs": [{
                        "targets": [0],
                        "orderable": false,
                    }, ],

                });

                $(document).on('click', '.ubah-user-aktif', function() {
                    const id = $(this).data('id');
                    const aktif = $(this).data('aktif');
                    const token = "<?php echo $this->security->get_csrf_hash(); ?>";

                    $.ajax({
                        url: "<?= base_url('users/ubah_user_aktif') ?>",
                        type: 'post',
                        cache: false,
                        data: {
                            id: id,
                            aktif: aktif,
                            token: token
                        },
                        success: function() {
                            $.NotificationApp.send("Sukses!", "Aktifasi user berhasil diubah!", "top-right", "#5ba035", "success");
                            table.ajax.reload();
                        }
                    });
                });

                //delete data
                $(document).on('click', '.btn_delete', function(e) {
                    var id = $(this).attr('id');
                    var token = "<?php echo $this->security->get_csrf_hash(); ?>";

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
                                url: "<?= base_url(); ?>users/hapus",
                                method: "POST",
                                cache: false,
                                data: {
                                    id: id,
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
        </script>

        <?php echo $this->load->view('template/footer_end'); ?>