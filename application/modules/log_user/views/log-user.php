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
                            <form action="<?= base_url('log_user/hapus_all/') ?>" method="POST" id="form-delete">
                                <div class="btn-group mb-2">
                                    <a href="<?= base_url('log_user/cetak') ?>" class="btn btn-sm btn-warning" title="Cetak" data-plugin="tippy" data-tippy-placement="top"><i class="fe-printer"></i></a>
                                    <button type="submit" class="btn btn-sm btn-danger" id="hapus" title="Hapus semua" data-plugin="tippy" data-tippy-placement="top"><i class="fe-trash"></i></button>
                                </div>
                                <table id="table-log" class="table nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th style="width: 50px;"><input type="checkbox" id="chack-all"></th>
                                            <th>No</th>
                                            <th>IP Address</th>
                                            <th>Sistem Operasi</th>
                                            <th>Browser</th>
                                            <th>Tanggal/Waktu</th>
                                        </tr>
                                    </thead>

                                    <tbody></tbody>
                                </table>
                            </form>
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

            //datatables
            table = $('#table-log').DataTable({

                "processing": true,
                "language": {
                    processing: '<div class="spinner-border text-primary m-2" role="status"></div>'
                },
                "serverSide": true,
                "order": [],
                "ajax": {
                    "url": "<?php echo site_url('log_user/load_data') ?>",
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

            var button = document.getElementById('hapus');
            button.disabled = true;
            $("#chack-all").click(function() {
                if ($(this).is(":checked")) {
                    $(".check-item").prop("checked", true);
                    button.disabled = false;
                } else {
                    $(".check-item").prop("checked", false);
                    button.disabled = true;
                }
            });

            // delete all
            $("#hapus").click(function(e) {
                e.preventDefault();
                const confirm = $("#form-delete");

                Swal.fire({
                    title: "Apakah anda yakin?",
                    text: "Anda ingin menghapus data ini!",
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonText: "Iya, hapus!",
                    cancelButtonText: "Tidak, Tutup!",
                    confirmButtonClass: "btn btn-sm btn-danger mt-2",
                    cancelButtonClass: "btn btn-sm btn-secondary ml-2 mt-2",
                    buttonsStyling: !1
                }).
                then(function(t) {
                    t.value ? Swal.fire({
                        document: confirm.submit(),
                        title: "Dihapus!",
                        text: "File anda telah di hapus.",
                        type: "success"
                    }) : t.dismiss === Swal.DismissReason.cancel
                })
            });

        });
    </script>

    <?php echo $this->load->view('template/footer_end'); ?>