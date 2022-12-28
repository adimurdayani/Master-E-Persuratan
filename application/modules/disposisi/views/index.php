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

                            <div class="table-responsive">
                                <table class="table table-striped nowrap w-100" id="table-disposisi">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No.</th>
                                            <th class="text-center">Tujuan</th>
                                            <th class="text-center">Isi Disposisi</th>
                                            <th class="text-center">Sifat</th>
                                            <th class="text-center">Batas Waktu</th>
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

    <?php echo $this->load->view('template/footer_start'); ?>
    <?php echo $this->load->view('template/right_sidebar'); ?>

    <script>
        var table;
        var token = "<?php echo $this->security->get_csrf_hash(); ?>";
        $(document).ready(function() {

            table = $('#table-disposisi').DataTable({

                "processing": true,
                "language": {
                    processing: '<div class="spinner-border text-primary m-2" role="status"></div>'
                },
                "serverSide": true,
                "lengthMenu": [5, 10, 25, 50, 75, 100],
                "order": [],
                "ajax": {
                    "url": "<?php echo site_url('disposisi/load_data') ?>",
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

            //delete data
            $(document).on('click', '.btn_delete', function(e) {
                var id_disposisi = $(this).attr('id');

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
                            url: "<?= base_url(); ?>disposisi/hapus",
                            method: "POST",
                            cache: false,
                            data: {
                                id_disposisi: id_disposisi
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