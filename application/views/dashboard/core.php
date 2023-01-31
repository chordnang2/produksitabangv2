<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta16
* @link https://tabler.io
* Copyright 2018-2022 The Tabler Authors
* Copyright 2018-2022 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Dashboard</title>
    <!-- CSS files -->
    <?php $this->load->view('template/css'); ?>
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: Inter, -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }
    </style>
</head>

<body class=" layout-fluid">
    <!-- <script src="./dist/js/demo-theme.min.js?1668287865"></script> -->
    <div class="page">
        <!-- Navbar -->
        <?php $this->load->view('template/navbar'); ?>
        <div  id="navigation" class="page-wrapper">
            <!-- Page header -->
            <div class="page-header d-print-none text-white">
                <div class="container-xl">
                    <div class="row g-2 align-items-center" id="top">
                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">

                    <div class="row row-deck row-cards">
                        <!-- Plan dan Target -->
                        <div id="links" class="row col-lg-12">
                        </div>
                        <div class="col-lg-12">
                            <div class="card" id="wrap" style="overflow-y: scroll;overflow-x: scroll;">
                                <div class="card-body">
                                    <h3 class="card-title">Monitoring Produksi <code><i>Ton/Jam</i></code></h3>
                                    <div id="chartMonitoringProduksi" class="chart-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card" id="wrap" style="overflow-y: scroll;overflow-x: scroll;">
                                <div class="card-body">
                                    <h3 class="card-title">Average Ritasi,Total Unit,Total Ritasi <code><i>Unit/Jam</i></code></h3>
                                    <div id="chartRitasi" class="chart-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Average Muatan/Lokasi <code><i>Ton/lokasi</i></code></h3>
                                    <div id="chartAverageMuatanPerLokasi" class="chart-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Average Muatan/Tipe Vessel <code><i>Ton/Tipe Vessel</i></code></h3>
                                    <div id="chartAverageMuatanPerTipeVessel" class="chart-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Total Trip/Tipe Vessel <code><i>Trip/Tipe Vessel</i></code></h3>
                                    <div id="chartTotalTripPerTipeVessel" class="chart-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Total Trip,Underload,TonKM <code><i>Per Lokasi</i></code></h3>
                                    <div id="chartPerlokasi" class="chart-sm"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php $this->load->view('template/footer'); ?>
        </div>
    </div>
    <?php $this->load->view('template/js'); ?>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <?php $this->load->view('dashboard/chart/chartMonitoringProduksi'); ?>
    <?php $this->load->view('dashboard/chart/chartRitasi'); ?>
    <?php $this->load->view('dashboard/chart/chartAverageMuatanPerLokasi'); ?>
    <?php $this->load->view('dashboard/chart/chartAverageMuatanPerTipeVessel'); ?>
    <?php $this->load->view('dashboard/chart/chartTotalTripPerTipeVessel'); ?>
    <?php $this->load->view('dashboard/chart/chartPerlokasi'); ?>
    <script>
        function myFunction() {
            $('html, body').animate({
                scrollTop: $('#navigation').offset().top
            }, 'slow');
            var elem = document.getElementById("navigation");
            if (elem.requestFullscreen) {
                elem.requestFullscreen();
            } else if (elem.webkitRequestFullscreen) {
                /* Safari */
                elem.webkitRequestFullscreen();
            } else if (elem.msRequestFullscreen) {
                /* IE11 */
                elem.msRequestFullscreen();
            }
        }
    </script>

    <script language="javascript" type="text/javascript">
        function loadlink() {
            $('#links').load('<?= base_url('dashboard/planActualCard') ?>', function() {
                $(this);
            });
            $('#top').load('<?= base_url('dashboard/top') ?>', function() {
                $(this);
            });
        }
        loadlink(); // This will run on page load
        setInterval(function() {
            loadlink() // this will run after every 5 seconds
        }, 5000);
    </script>
</body>

</html>