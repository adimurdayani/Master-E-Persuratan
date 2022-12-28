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
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <a href="<?= base_url('menu') ?>" class="btn btn-xs btn-secondary mb-3">
                                <span class="btn-xs btn-label"><i class="fe-arrow-left"></i></span> Kembali
                            </a>
                            <table class="table table-striped nowrap w-100">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Deskripsi</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody> </tbody>
                            </table>

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
        $(document).ready(function() {

            //load data
            function load_data() {
                $.ajax({
                    url: "<?= base_url(); ?>group/load_data",
                    dataType: "JSON",
                    cache: false,
                    success: function(data) {
                        //colom inputan
                        var html = '<tr>';
                        html += '<td id="name" contenteditable placeholder="Nama grup"></td>';
                        html += '<td id="description" contenteditable placeholder="Deskripsi"></td>';
                        html += '<td class="text-center"><button type="button" name="btn_add" id="btn_add" title="Tambah Data" class="btn btn-xs btn-primary"><span class="fe-plus"></span></td></tr>';
                        //looping data dalam bentuk json
                        for (var count = 0; count < data.length; count++) {
                            var id = data[count].id;
                            html += '<tr>';
                            html += '<td style="vertical-align:middle;" class="table_data" data-row_id="' + id +
                                '" data-column_name="name" contenteditable>' + data[count].name +
                                '</td>';
                            html += '<td style="vertical-align:middle;" class="table_data" data-row_id="' + id +
                                '" data-column_name="description" contenteditable>' + data[count].description +
                                '</td>';
                            html += '<td style="vertical-align:middle;" class="text-center">' +
                                '<div class="btn-group">' +
                                '<a href="<?= base_url('group/akses_user/') ?>' + btoa(id) + '" class="btn btn-xs btn-warning" title="Akses Grup User"><span class="fe-list" ></span></a>' +
                                '<button type="button" name="delete_btn" id="' + id + '" class="btn btn-xs btn-danger disabled" title="Hapus Data"><span class="fe-trash" ></span> </button>' +
                                '</div>' +
                                '</td>';
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
                var description = $('#description').text();

                //cek jika inputan kososng
                if (name == '') {
                    $.NotificationApp.send("Peringatan!", "Nama tidak boleh kosong!", "top-right", "#da8609", "warning")
                    return false;
                }

                //cek jika inputan kososng
                if (description == '') {
                    $.NotificationApp.send("Peringatan!", "Deskripsi tidak boleh kosong!", "top-right", "#da8609", "warning")
                    return false;
                }

                //jika inputan ada isinya, kirim data
                $.ajax({
                    url: "<?= base_url(); ?>group/tambah",
                    method: 'POST',
                    cache: false,
                    //data yang dikirim (variabel : value)
                    data: {
                        name: name,
                        description: description
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
                var id = $(this).data('row_id');
                var table_column = $(this).data('column_name');
                var value = $(this).text();

                $.ajax({
                    url: "<?= base_url(); ?>group/update",
                    method: "POST",
                    cache: false,
                    data: {
                        id: id,
                        table_column: table_column,
                        value: value
                    },
                    success: function(data) {
                        $.NotificationApp.send("Sukses!", "Data berhasil diupdate", "top-right", "#5ba035", "success")
                        load_data();
                    }
                });
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
                            url: "<?= base_url(); ?>group/delete",
                            method: "POST",
                            cache: false,
                            data: {
                                id: id
                            },
                            success: function(data) {
                                $.NotificationApp.send("Sukses!", "Data berhasil dihapus", "top-right", "#5ba035", "success")
                                load_data();
                            }
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel) {}
                })
            });
        });
    </script>

    <?php echo $this->load->view('template/footer_end'); ?>