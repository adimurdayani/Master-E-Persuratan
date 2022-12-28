<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-md-3">
                    <div class="widget-rounded-circle card-box">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                                    <i class="mdi mdi-email-receive-outline font-22 avatar-title text-primary"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="mt-1"><span data-plugin="counterup"><?= $jml_surat_masuk ?></span></h3>
                                    <p class="text-muted mb-1 text-truncate">Surat Masuk</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-3">
                    <div class="widget-rounded-circle card-box">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                                    <i class="mdi mdi-email-send-outline font-22 avatar-title text-success"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"><?= $jml_surat_keluar ?></span></h3>
                                    <p class="text-muted mb-1 text-truncate">Surat Keluar</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-3">
                    <div class="widget-rounded-circle card-box">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                                    <i class="mdi mdi-file-tree font-22 avatar-title text-info"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"><?= $jml_klasifikasi ?></span></h3>
                                    <p class="text-muted mb-1 text-truncate">Klasifikasi Surat</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-3">
                    <div class="widget-rounded-circle card-box">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded-circle bg-soft-warning border-warning border">
                                    <i class="mdi mdi-view-list font-22 avatar-title text-warning"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"><?= $jml_disposisi ?></span></h3>
                                    <p class="text-muted mb-1 text-truncate">Disposisi</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->
            </div>
            <!-- end row-->
            <div class="row">
                <div class="col-md-4">
                    <div class="widget-rounded-circle card-box">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                                    <i class="mdi mdi-format-list-checks font-22 avatar-title text-primary"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="mt-1"><span data-plugin="counterup"><?= $jml_jenis_surat ?></span></h3>
                                    <p class="text-muted mb-1 text-truncate">Jenis Surat</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-4">
                    <div class="widget-rounded-circle card-box">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                                    <i class="fe-users font-22 avatar-title text-success"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"><?= $jml_group ?></span></h3>
                                    <p class="text-muted mb-1 text-truncate">Grup User</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-4">
                    <div class="widget-rounded-circle card-box">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                                    <i class="mdi mdi-tooltip-account font-22 avatar-title text-info"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"><?= $jml_user ?></span></h3>
                                    <p class="text-muted mb-1 text-truncate">Akun User</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->
            </div>
            <!-- end row-->

            <div class="row">
                <div class="col-12">
                    <div class="card-box widget-inline">
                        <div class="row">
                            <div class="col-md-6 col-xl-6">
                                <div class="p-2 text-center">
                                    <i class="mdi mdi-account-arrow-right text-primary mdi-24px"></i>
                                    <h3><span data-plugin="counterup"><?= $jml_penerima ?></span></h3>
                                    <p class="text-muted font-15 mb-0">Penerima</p>
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-6">
                                <div class="p-2 text-center">
                                    <i class="mdi mdi-google-classroom text-success mdi-24px"></i>
                                    <h3><span data-plugin="counterup"><?= $jml_bidang ?></span></h3>
                                    <p class="text-muted font-15 mb-0">Bidang</p>
                                </div>
                            </div>


                        </div> <!-- end row -->
                    </div> <!-- end card-box-->
                </div> <!-- end col-->
            </div>
            <!-- end row-->

            <div class="row">
                <div class="col-lg-4">
                    <div class="card-box">

                        <h4 class="header-title mb-3">Jumlah Disposisi Surat</h4>

                        <div class="widget-chart text-center" dir="ltr">
                            <div id="apex-pie-1" class="apex-charts" data-colors="#4fc6e1,#f1556c"></div>
                        </div>
                    </div> <!-- end card-box -->
                </div> <!-- end col-->

                <div class="col-lg-8">
                    <div class="card-box pb-2">
                        <div class="float-right d-none d-md-inline-block">
                            <div class="btn-group mb-2">
                                <button type="button" class="btn btn-xs btn-light">Today</button>
                                <button type="button" class="btn btn-xs btn-light">Weekly</button>
                                <button type="button" class="btn btn-xs btn-secondary">Monthly</button>
                            </div>
                        </div>

                        <h4 class="header-title mb-3">Jumlah Surat Masuk</h4>

                        <div dir="ltr">
                            <div id="sales-analytics" class="mt-4" data-colors="#4a81d4"></div>
                        </div>
                    </div> <!-- end card-box -->
                </div> <!-- end col-->
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->
    <?php echo $this->load->view('template/footer_start'); ?>
    <?php echo $this->load->view('template/right_sidebar'); ?>
    <script>
        var dataColors;
        colors = ["#4a81d4"];
        (dataColors = $("#sales-analytics").data("colors")) && (colors = dataColors.split(","));
        var chart;
        options = {
            series: [{
                name: "Surat Masuk",
                type: "column",
                data: [<?php foreach ($get_total_surat_masuk as $surat_masuk) : ?><?= $surat_masuk->total ?>, <?php endforeach ?>]
            }],
            chart: {
                height: 378,
                type: "line"
            },
            stroke: {
                width: [2, 3]
            },
            plotOptions: {
                bar: {
                    columnWidth: "50%"
                }
            },
            colors: colors,
            dataLabels: {
                enabled: !0,
                enabledOnSeries: [1]
            },
            labels: [<?php foreach ($get_surat as $tgl) : ?> "<?= $tgl['tgl_surat'] ?>",
                <?php endforeach; ?>
            ],
            xaxis: {
                type: "datetime"
            },
            legend: {
                offsetY: 7
            },
            grid: {
                padding: {
                    bottom: 20
                }
            },
            fill: {
                type: "gradient",
                gradient: {
                    shade: "light",
                    type: "horizontal",
                    shadeIntensity: .25,
                    gradientToColors: void 0,
                    inverseColors: !0,
                    opacityFrom: .75,
                    opacityTo: .75,
                    stops: [0, 0, 0]
                }
            },
            yaxis: [{
                title: {
                    text: "Surat Masuk"
                }
            }, {
                opposite: !0,
                title: {
                    text: "Surat Masuk"
                }
            }]
        };
        (chart = new ApexCharts(document.querySelector("#sales-analytics"), options)).render(), $("#dash-daterange").flatpickr({
            altInput: !0,
            mode: "range",
            altFormat: "F j, y",
            defaultDate: "today"
        });
    </script>
    <script>
        Apex.grid = {
            padding: {
                right: 0,
                left: 0
            }
        }, Apex.dataLabels = {
            enabled: !1
        };

        colors = ["#4fc6e1", "#f1556c"];
        (dataColors = $("#apex-pie-1").data("colors")) && (colors = dataColors.split(","));
        options = {
            chart: {
                height: 320,
                type: "pie"
            },
            series: [<?= $jml_surat_masuk ?>, <?= $jml_surat_keluar ?>],
            labels: ["Surat Masuk", "Surat Keluar"],
            colors: colors,
            legend: {
                show: !0,
                position: "bottom",
                horizontalAlign: "center",
                verticalAlign: "middle",
                floating: !1,
                fontSize: "14px",
                offsetX: 0,
                offsetY: 7
            },
            responsive: [{
                breakpoint: 600,
                options: {
                    chart: {
                        height: 240
                    },
                    legend: {
                        show: !1
                    }
                }
            }]
        };
        (chart = new ApexCharts(document.querySelector("#apex-pie-1"), options)).render();
    </script>
    <?php echo $this->load->view('template/footer_end'); ?>