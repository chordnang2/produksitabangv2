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
    <title><?= $title ?></title>
    <!-- CSS files -->
    <?php $this->load->view('template/css'); ?>
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet" />
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: Inter, -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        .dataTables_wrapper {
            position: relative;
            clear: both;
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
                                Sanksi Surat Peringatan
                            </div>
                            <h2 class="page-title">
                                View Data SP
                            </h2>
                        </div>
                        <!-- Page title actions -->
                        <div class="col-auto ms-auto d-print-none">
                            <div class="btn-list">
                                <span class="d-none d-sm-inline">
                                    <!-- <a href="#" class="btn btn-dark">
                                        Last update : <?php if ($lastupdate) {
                                                            echo date_format(date_create($lastupdate[0]['maxDate']), "d M Y") . ' ' . $lastupdate[0]['maxHour'];
                                                        } ?>
                                    </a> -->
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
                            <div class="card">
                                <form action="<?php echo base_url() ?>mpp/sanksiSpView" method="post">
                                    <div class="card-header">
                                        <div>
                                            <label class="form-label">Pilih Tahun</label>
                                            <div class="form-selectgroup">
                                                <label class="form-selectgroup-item">
                                                    <select class="form-select" name="selectTahun">
                                                        <option value="<?= $tahunUpdate ?>"><?= $tahunUpdate ?></option>
                                                        <?php foreach ($getAlllistTahun as $key => $value) { ?>
                                                            <option value="<?= $value['tahunList'] ?>"><?= $value['tahunList'] ?></option>
                                                        <?php } ?>
                                                    </select> </label>
                                                <label class="form-selectgroup-item">
                                                    <button type="submit" class="btn btn-primary ms-auto">Load</button>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!-- /.card-header -->
                                <div class="card-header">
                                    <h3 class="card-title">View Data <b><i>Surat Peringatan</i></b> Tahun <?php echo $tahunUpdate ?><b><i><?php //echo date_format(date_create($date), "d M Y"); 
                                                                                                                                            ?></i></b></h3>
                                    <div class="card-actions">
                                        <a href="<?= base_url('mpp/sanksiSpAdd') ?>" class="btn btn-primary">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                            </svg>
                                            Tambah data
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <font size="1">
                                                <table id="example" class="table card-table table-vcenter text-nowrap datatable dataTables_wrapper" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>NO</th>
                                                            <th>Tanggal</th>
                                                            <th>NIK</th>
                                                            <th>NAMA</th>
                                                            <th>JABATAN</th>
                                                            <th>DEPARTEMEN</th>
                                                            <th>JENIS KEJADIAN</th>
                                                            <th>URAIAN KEJADIAN</th>
                                                            <th>SP</th>
                                                            <th>LOBANG KIMPER</th>
                                                            <th>PP</th>
                                                            <th>PASAL</th>
                                                            <th>JANGKA</th>
                                                            <th>START</th>
                                                            <th>END</th>
                                                            <th>DIBERIKAN OLEH</th>
                                                            <th>SIFAT SURAT</th>
                                                            <th class="w-1"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if (isset($getAllistSanksi)) { ?>
                                                            <?php $no = 1;
                                                            foreach ($getAllistSanksi as $key => $value) { ?>
                                                                <tr>
                                                                    <td><?php echo $no++ ?></td>
                                                                    <td><?php echo date_format(date_create($value['tanggal']), 'd F  Y') ?></td>
                                                                    <td><?php echo $value['nikSP'] ?></td>
                                                                    <td><?php echo $value['nama'] ?></td>
                                                                    <td><?php echo $value['jabatan'] ?></td>
                                                                    <td><?php echo $value['departemen'] ?></td>
                                                                    <td><?php echo $value['jenis_kejadian'] ?></td>
                                                                    <td><?php echo $value['kejadian'] ?></td>
                                                                    <td><?php echo $value['sanksi_sp'] ?></td>
                                                                    <td><?php echo $value['lobang_kimper'] ?></td>
                                                                    <td><?php echo $value['sesuai_pp'] ?></td>
                                                                    <td><?php echo $value['bunyi_pasal'] ?></td>
                                                                    <td><?php echo (strtotime($value['endTanggalSanksi']) - strtotime($value['startTanggalSanksi'])) / 86400 ?> hari</td>
                                                                    <td><?php echo date_format(date_create($value['startTanggalSanksi']), 'd F  Y') ?></td>
                                                                    <td><?php echo date_format(date_create($value['endTanggalSanksi']), 'd F  Y') ?></td>
                                                                    <td><?php echo $value['diberikan_oleh'] ?></td>
                                                                    <td><?php echo $value['sifat_surat'] ?></td>
                                                                    <td>
                                                                        <div class="dropdown">
                                                                            <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                                                                Menu
                                                                            </button>
                                                                            <div class="dropdown-menu dropdown-menu-end ">
                                                                                <a class="dropdown-item btn-square" href="<?= base_url('mpp/sanksiSpEdit/' . urlencode($value['id'])) ?>">
                                                                                    EDIT
                                                                                </a>
                                                                                <a class="dropdown-item btn-square" href="<?= base_url('mpp/sanksiSpDelete/' . urlencode($value['id'])) ?>">DELETE</a>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </font>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php $this->load->view('template/footer');
            ?>
        </div>
    </div>


    <?php $this->load->view('template/js'); ?>
    <script src="<?= base_url('assets/tabler-dev/demo/') ?>dist/libs/litepicker/dist/litepicker.js?1668287865" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>

    <script>
        toastr.options.closeButton = true;
        toastr.options.timeOut = 0;
        toastr.options.extendedTimeOut = 0;
    </script>
    <script type="text/javascript">
        <?php if ($this->session->flashdata('sukses_sp')) { ?>
            toastr.success("<?php echo $this->session->flashdata('sukses_sp'); ?>");
        <?php } else if ($this->session->flashdata('error_sp')) {  ?>
            toastr.error("<?php echo $this->session->flashdata('error_sp'); ?>");
        <?php } ?>
    </script>
</body>

</html>