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
                                <li class="breadcrumb-item"><a href="<?= base_url('group') ?>"></a> Group</li>
                                <li class="breadcrumb-item active"><?= $title; ?></li>
                            </ol>
                        </div>
                        <h4 class="page-title"><?= $get_grup->description ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <a href="<?= base_url('group') ?>" class="btn btn-xs btn-secondary mb-2"><span class="btn-xs btn-label"><i class="fe-arrow-left"></i></span> Kembali</a>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <h4 class="header-title mb-4">Group Menu</h4>
                            <table class="table  table-striped table-bordered nowrap w-100">
                                <thead>
                                    <tr>
                                        <th class="text-center">Group Menu</th>
                                        <th class="text-center">Akses</th>
                                        <th class="text-center">Main Menu & Sub Menu</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($menu_groups as $mg) : ?>
                                        <tr>
                                            <td><?= $mg['name'] ?></td>
                                            <td>
                                                <div class="checkbox checkbox-success checkbox-single text-center">
                                                    <input id="singleCheckbox2" type="checkbox" class="ubah-akses-menu-groups checkbox checkbox-success" <?= check_akses_menu_group($get_grup->id, $mg['id_menu_group']) ?> data-idgrup="<?= $get_grup->id ?>" data-idkategori="<?= $mg['id_menu_group'] ?>">
                                                    <label></label>
                                                </div>
                                            </td>
                                            <td>
                                                <?php foreach ($mg['main_menu'] as $mm) : ?>
                                                    <ul>
                                                        <li><strong>Akses Main Menu</strong></li>
                                                        <ul>
                                                            <li><?= $mm['menu_title'] ?> </li>
                                                            <ul>
                                                                <?php if ($mm['dropdown_active'] == 1) : ?>
                                                                    <li><strong>Akses Sub Menu</strong></li>
                                                                <?php endif; ?>
                                                                <?php foreach ($sub_menu as $sm) : ?>
                                                                    <?php if ($sm['id_menus'] == $mm['id_menu']) : ?>
                                                                        <ul>
                                                                            <li>
                                                                                <div class=""><?= $sm['submenu_title'] ?></div>
                                                                            </li>
                                                                        </ul>
                                                                    <?php endif; ?>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        </ul>
                                                    </ul>
                                                <?php endforeach; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
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
            $(document).on('click', '.ubah-akses-menu-groups', function() {
                const idgrup = $(this).data('idgrup');
                const idkategori = $(this).data('idkategori');

                $.ajax({
                    url: "<?= base_url('group/ubah_akses_user') ?>",
                    type: 'post',
                    data: {
                        idgrup: idgrup,
                        idkategori: idkategori
                    },
                    success: function() {
                        document.location.href = "<?= base_url('group/akses_user/') . base64_encode($get_grup->id) ?>"
                    }
                });
            });

        });
    </script>

    <?php echo $this->load->view('template/footer_end'); ?>