<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<!-- Vendor js -->
<script src="<?= base_url('assets/backend/') ?>js/vendor.min.js"></script>

<!-- Tippy js-->
<script src="<?= base_url('assets/backend') ?>/libs/tippy.js/tippy.all.min.js"></script>

<!-- third party js -->
<script src="<?= base_url('assets/backend/') ?>libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/backend/') ?>libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/backend/') ?>libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets/backend/') ?>libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<!-- Table Editable plugin-->
<script src="<?= base_url('assets/backend/') ?>libs/jquery-tabledit/jquery.tabledit.min.js"></script>

<!-- Sweet Alerts js -->
<script src="<?= base_url('assets/backend/') ?>libs/sweetalert2/sweetalert2.min.js"></script>
<!-- Summernote js -->
<script src="<?= base_url('assets/backend/') ?>libs/summernote/summernote-bs4.min.js"></script>
<!-- Tost-->
<script src="<?= base_url('assets/backend/') ?>libs/jquery-toast-plugin/jquery.toast.min.js"></script>
<!-- toastr init js-->
<script src="<?= base_url('assets/backend/') ?>js/pages/toastr.init.js"></script>

<!-- Footable js -->
<script src="<?= base_url('assets/backend/') ?>libs/footable/footable.all.min.js"></script>

<!-- Plugins js-->
<script src="<?= base_url('assets/backend/') ?>libs/flatpickr/flatpickr.min.js"></script>
<script src="<?= base_url('assets/backend/') ?>libs/apexcharts/apexcharts.min.js"></script>
<script src="https://apexcharts.com/samples/assets/irregular-data-series.js"></script>
<script src="https://apexcharts.com/samples/assets/ohlc.js"></script>
<script src="<?= base_url('assets/backend/') ?>libs/dropzone/min/dropzone.min.js"></script>
<script src="<?= base_url('assets/backend/') ?>libs/select2/js/select2.min.js"></script>
<script src="<?= base_url('assets/backend/') ?>libs/selectize/js/standalone/selectize.min.js"></script>
<script src="<?= base_url('assets/backend/') ?>libs/nestable2/jquery.nestable.min.js"></script>
<script src="<?= base_url('assets/backend/') ?>libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url('assets/backend/') ?>libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Chart JS -->
<script src="<?= base_url('assets/backend/') ?>libs/chart.js/Chart.bundle.min.js"></script>

<!-- App js-->
<script src="<?= base_url('assets/backend/') ?>js/app.min.js"></script>

<script>
    // datepicker
    $('[data-toggle="select2"]').select2(), $('[data-toggle="flatpicker"]').flatpickr({
        altInput: !0,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d"
    });
    // file upload
    $('.input1').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    // error
    <?= $this->session->flashdata('error'); ?>
    // sukses
    <?= $this->session->flashdata('success'); ?>
    // delete
    $('.hapus').on('click', function(e) {

        e.preventDefault();
        const href = $(this).attr('href');

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
                document: location.href = href,
                title: "Dihapus!",
                text: "File anda telah di hapus.",
                type: "success"
            }) : t.dismiss === Swal.DismissReason.cancel
        })
    })

    //delete-all

    $('#content').summernote({
        height: 230,
        styleWithSpan: false,
        placeholder: "Tulis sesuatu...",
        callbacks: {
            onInit: function(e) {
                $(e.editor).find(".custom-control-description").addClass("custom-control-label").parent().removeAttr("for")
            }
        }
    });

    $('#content-dua').summernote({
        height: 230,
        styleWithSpan: false,
        placeholder: "Tulis sesuatu...",
        callbacks: {
            onInit: function(e) {
                $(e.editor).find(".custom-control-description").addClass("custom-control-label").parent().removeAttr("for")
            }
        }
    });

    $('#content-tiga').summernote({
        height: 230,
        styleWithSpan: false,
        placeholder: "Tulis sesuatu...",
        callbacks: {
            onInit: function(e) {
                $(e.editor).find(".custom-control-description").addClass("custom-control-label").parent().removeAttr("for")
            }
        }
    });

    function load_jml_surat_masuk() {
        $.ajax({
            url: "<?= base_url(); ?>dashboard/load_notifikasi",
            method: "POST",
            cache: false,
            dataType: "json",
            data: {},
            success: function(data) {
                $('#jml-pesan-masuk').html(data.jml);
            }
        });
    };

    function load_data_surat_masuk() {
        $.ajax({
            url: "<?= base_url(); ?>dashboard/load_data_notifikasi",
            method: "POST",
            cache: false,
            dataType: "json",
            success: function(data) {
                var html = '';
                for (var count = 0; count < data.length; count++) {
                    html += '<a href="<?= base_url('surat_masuk') ?>" id="' + data[count].id_smasuk + '" class="dropdown-item notify-item btn-dibaca">' +
                        '<div class="notify-icon bg-success"><i class="mdi mdi-comment-account-outline"></i></div>';
                    html += '<p class="notify-details"><strong>' + data[count].jenis_surat + ':</strong> <br>' + data[count].isi_surat +
                        '<small class="text-muted">' + data[count].created_at + '</small></p>';
                    html += '</a>'
                }
                $('.pesan-masuk').html(html);
            }
        });

        $(document).on('click', '.btn-dibaca', function() {
            var id_smasuk = $(this).attr('id');
            $.ajax({
                url: "<?= base_url(); ?>dashboard/dibaca",
                method: "POST",
                cache: false,
                data: {
                    id_smasuk: id_smasuk
                }
            });
        });
    }

    function load_jml_surat_keluar() {
        $.ajax({
            url: "<?= base_url(); ?>dashboard/load_jml_surat_keluar",
            method: "POST",
            cache: false,
            dataType: "json",
            data: {},
            success: function(data) {
                $('#jml-pesan-keluar').html(data.jml_surat_keluar);
            }
        });
    }

    function load_data_surat_keluar() {
        $.ajax({
            url: "<?= base_url(); ?>dashboard/load_data_surat_keluar",
            method: "POST",
            cache: false,
            dataType: "json",
            success: function(data) {
                var html = '';
                for (var count = 0; count < data.length; count++) {
                    html += '<a href="<?= base_url('surat_keluar') ?>" id="' + data[count].id_skeluar + '" class="dropdown-item notify-item btn-baca-surat-keluar">' +
                        '<div class="notify-icon bg-warning"><i class="mdi mdi-comment-account-outline"></i></div>';
                    html += '<p class="notify-details"><strong>' + data[count].jenis_surat + ':</strong> <br>' + data[count].isi_surat +
                        '<small class="text-muted">' + data[count].created_at + '</small></p>';
                    html += '</a>'
                }
                $('.pesan-keluar').html(html);
            }
        });

        $(document).on('click', '.btn-baca-surat-keluar', function() {
            var id_skeluar = $(this).attr('id');
            $.ajax({
                url: "<?= base_url(); ?>dashboard/baca_surat_keluar",
                method: "POST",
                cache: false,
                data: {
                    id_skeluar: id_skeluar
                }
            });
        });
    }

    setInterval(function() {
        load_jml_surat_masuk();
        load_data_surat_masuk();

        load_jml_surat_keluar();
        load_data_surat_keluar();
    }, 2000);
</script>