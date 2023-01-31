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
    <title>Dashboard - Tabler - Premium and Open Source dashboard template with responsive and high quality UI.</title>
    <!-- CSS files -->
    <?php $this->load->view('template/css'); ?>
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: Inter, -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }
    </style>
</head>

<body>
    <!-- <script src="./dist/js/demo-theme.min.js?1668287865"></script> -->
    <div class="page">
        <!-- Navbar -->
        <?php $this->load->view('template/navbar'); ?>
        <div class="page-wrapper">
            <!-- Page header -->
            <div class="page-header d-print-none text-white">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <!-- Page pre-title -->
                            <div class="page-pretitle">
                                Weighbridge
                            </div>
                            <h2 class="page-title">
                                Check Data
                            </h2>
                        </div>
                        <!-- Page title actions -->
                        <div class="col-auto ms-auto d-print-none">
                            <div class="btn-list">
                                <span class="d-none d-sm-inline">
                                    <a href="#" class="btn btn-dark">
                                        Last update :
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-cards">
                        <div class="col-12">
                            <div class="container-xl">
                                <form action="https://httpbin.org/post" method="post" class="card">
                                    <div class="card-header">
                                        <div>
                                            <label class="form-label">Pilih Tahun</label>
                                            <div class="form-selectgroup">
                                                <label class="form-selectgroup-item">
                                                    <select class="form-select" id="select" name="select">
                                                        <option value="-1">Pilih</option>
                                                        <?php foreach ($yearAll as $key => $value) { ?>
                                                            <option value="<?= $value['year'] ?>"><?= $value['year'] ?></option>
                                                        <?php } ?>
                                                    </select> </label>
                                                <label class="form-selectgroup-item">
                                                    <button type="submit" class="btn btn-primary ms-auto">Load</button>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row row-deck row-cards">
                                            <!-- Plan dan Target -->
                                            <div class="col-12">
                                                <div class="row row-cards">
                                                    <div class="col-sm-6 col-lg-3">
                                                        <a href ="" class="card card-sm">
                                                            <div class="card-body">
                                                                <div class="row align-items-center">
                                                                    <div class="col-auto">
                                                                        <span class="bg-green text-white avatar">
                                                                            R
                                                                        </span>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="font-weight-medium">
                                                                            56 Unit
                                                                        </div>
                                                                        <div class="text-muted">
                                                                            Unit Running
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="col-sm-6 col-lg-3">
                                                        <div class="card card-sm">
                                                            <div class="card-body">
                                                                <div class="row align-items-center">
                                                                    <div class="col-auto">
                                                                        <span class="bg-azure text-white avatar">
                                                                            <!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                                                                            S
                                                                        </span>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="font-weight-medium">
                                                                            5 Unit
                                                                        </div>
                                                                        <div class="text-muted">
                                                                            Unit Service
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 col-lg-3">
                                                        <div class="card card-sm">
                                                            <div class="card-body">
                                                                <div class="row align-items-center">
                                                                    <div class="col-auto">
                                                                        <span class="bg-orange text-white avatar">
                                                                            <!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                                                            B
                                                                        </span>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="font-weight-medium">
                                                                            2 Unit
                                                                        </div>
                                                                        <div class="text-muted">
                                                                            Unit Breakdown
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 col-lg-3">
                                                        <div class="card card-sm">
                                                            <div class="card-body">
                                                                <div class="row align-items-center">
                                                                    <div class="col-auto">
                                                                        <span class="bg-danger text-white avatar">
                                                                            A
                                                                        </span>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="font-weight-medium">
                                                                            1 Unit
                                                                        </div>
                                                                        <div class="text-muted">
                                                                            Unit Accident
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="card-footer text-end">
                                     
                                    </div> -->
                                </form>

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>


</body>

</html>