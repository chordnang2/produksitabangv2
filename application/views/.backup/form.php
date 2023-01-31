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
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <h2 class="page-title">
                                Form elements
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-cards">
                        <div class="col-12">
                            <form class="card" method="post" action="<?php echo base_url('weighbridge/upload') ?>" enctype="multipart/form-data">
                                <div class="card-header">
                                    <h4 class="card-title">Form upload excel weighbridge (timbangan)</h4>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label required">Nama Sheet</label>
                                        <div>
                                            <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Masukkan nama sheet" name="nama_sheet">
                                            <small class="form-hint">We'll never share your email with anyone else.</small>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label required">File Excel</label>
                                        <div>
                                            <input type="file" class="form-control" name="file" />
                                            <small class="form-hint">
                                                Your password must be 8-20 characters long, contain letters and numbers, and must not contain
                                                spaces, special characters, or emoji.
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <button type="submit" class="btn btn-primary ms-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-upload" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path>
                                            <polyline points="7 9 12 4 17 9"></polyline>
                                            <line x1="12" y1="4" x2="12" y2="16"></line>
                                        </svg>
                                        upload</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php $this->load->view('template/footer');
            ?>
        </div>
    </div>
    <?php $this->load->view('template/js'); ?>
</body>

</html>