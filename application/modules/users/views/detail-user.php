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
                            <a href="<?= base_url('users') ?>" class="btn btn-sm btn-secondary waves-effect waves-light mb-2">
                                <span class="btn-label"><i class="fe-arrow-left"></i></span>Kembali
                            </a>
                            <table class="table  table-striped nowrap w-100">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Grup User</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($get_user as $s) : ?>
                                        <tr>
                                            <td style="vertical-align: middle;"><?= $s->first_name . ' ' . $s->last_name ?></td>
                                            <td style="vertical-align: middle;">
                                                <?php foreach ($s->groups as $g) : ?>
                                                    <div class="form-group m-0">
                                                        <input type="checkbox" class="ubah-grup" <?= check_users_groups($g->id) ?> data-id="<?= $s->id ?>">
                                                        <label for=""><?= $g->name ?></label>
                                                    </div>
                                                <?php endforeach ?>
                                            </td>
                                            <td class="text-center" style="vertical-align: middle;">
                                                <button type="button" data-target="#tambah" data-toggle="modal" class="btn btn-sm btn-success mb-3"><i class="fe-plus"></i> </button>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>

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
                    <h4 class="modal-title">Tambah Grup User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body p-4">

                    <input type="hidden" id="user_id" name="user_id" value="<?= $get_id_user->id ?>">

                    <div class="form-group">
                        <label for="aktifasi" class="control-label">Grup User</label>
                        <select name="group_id" id="group_id" class="form-control">
                            <option value="">Pilih</option>
                            <?php foreach ($get_grup as $grup) : ?>
                                <option value="<?= $grup->id ?>"><?= htmlentities($grup->name, ENT_QUOTES) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary waves-effect" data-dismiss="modal"><i class="fe-arrow-left"></i> Tutup</button>
                    <button type="button" class="btn btn-sm btn-success" id="simpan"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->

    <?php echo $this->load->view('template/footer_start'); ?>
    <?php echo $this->load->view('template/right_sidebar'); ?>
    <script>
        $(document).ready(function() {
            $('#simpan').on('click', function() {
                var group_id = $('#group_id').val();
                var user_id = $('#user_id').val();

                if (group_id == "") {
                    $.NotificationApp.send("Gagal!", "Anda harus memilih salah satu grup user!", "top-right", "#da8609", "warning");
                } else {
                    $.ajax({
                        url: "<?= base_url('users/tambah_grup') ?>",
                        type: 'post',
                        data: {
                            user_id: user_id,
                            group_id: group_id
                        },
                        success: function(data) {
                            location.href = '<?= site_url('users/detail_user/') . base64_encode($get_id_user->id) ?>';
                        }
                    });
                }
            });

            $('.ubah-grup').on('click', function() {
                var id = $(this).data('id');

                $.ajax({
                    url: "<?= base_url('users/hapus_grup') ?>",
                    type: 'post',
                    data: {
                        id: id
                    },
                    success: function() {
                        document.location.href = "<?= base_url('users/detail_user/') . base64_encode($get_id_user->id) ?>";
                    }
                })
            })
        });
    </script>
    <?php echo $this->load->view('template/footer_end'); ?>