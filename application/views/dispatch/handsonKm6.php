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
                                Dispatch KM 6
                            </div>
                            <h2 class="page-title">
                                Form Excel
                                &nbsp
                                <span class="bg-green text-white avatar ">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-table" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <rect x="4" y="4" width="16" height="16" rx="2"></rect>
                                        <line x1="4" y1="10" x2="20" y2="10"></line>
                                        <line x1="10" y1="4" x2="10" y2="20"></line>
                                    </svg>
                                </span>
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
                            <div class="card">
                                <form action="<?php echo base_url() ?>dispatch/loadAjaxHandsonKm6" method="GET">
                                    <div class="card-header">
                                        <div class="mb-0">
                                            <label class="form-label">Pilih Tanggal</label>
                                            <div class="form-selectgroup">
                                                <label class="form-selectgroup-item">
                                                    <input class="form-control mb-2" placeholder="Select a date" id="datepicker-default" name="date" autocomplete="off" value="<?= $date ?>">
                                                </label>
                                                <label class="form-selectgroup-item">
                                                    <button type="submit" class="btn btn-primary ms-auto">Load</button>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <?php if ($date) { ?>
                                        <h3 class="card-title">Form Excel Dispatch <b><i>KM 6</i></b> Tanggal <b><i><?= date_format(date_create($date), "d M Y"); ?></i></b></h3>
                                        <div class="col-lg-12">
                                            <div id="ht" class="hot"></div>
                                            <div class="controls">
                                                <button id="save" class="btn btn-success">Simpan Data</button>
                                                <button id="new" class="btn btn-info">Tambah Baris</button>
                                                <button id="delete" class="btn btn-danger">Hapus Baris</button>
                                            </div>
                                        </div>
                                        <pre id="example1console" class="console">Click "Load" to load data from server</pre>
                                        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/handsontable/dist/handsontable.full.min.js"></script>
                                        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/handsontable/dist/handsontable.full.min.css" />
                                        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
                                        <script type="text/javascript">
                                            const container = document.querySelector('#ht');
                                            const exampleConsole = document.querySelector('#example1console');
                                            const autosave = document.querySelector('#autosave');
                                            const load = document.querySelector('#load');
                                            const save = document.querySelector('#save');
                                            const searchField = document.querySelector('#search_field');
                                            let autosaveNotification;
                                            <?php if (isset($handson) && $handson) { ?>
                                                const data = [
                                                    <?php foreach ($handson as $key => $value) {
                                                        echo $value;
                                                    } ?>
                                                ];
                                            <?php } ?>
                                            var wrong_flag = 0;

                                            function log(event) {
                                                console.log(event)
                                            }
                                            const hot = new Handsontable(container, {
                                                <?php if (isset($handson) && $handson) { ?>
                                                    data,
                                                <?php } ?>
                                                startRows: 1,
                                                startCols: 1,
                                                rowHeaders: true,
                                                contextMenu: true,
                                                afterChange: log.bind(this, 'afterChange'),
                                                afterRemoveRow: log.bind(this, 'removeRow'),
                                                afterRemoveCol: log.bind(this, 'removeCol'),
                                                afterCreateRow: log.bind(this, 'createRow'),
                                                afterCreateCol: log.bind(this, 'createCol'),
                                                colHeaders: ['Date', 'Shift', 'No Unit', 'Problem', 'Activity', 'Preparation', 'Start', 'Out', 'Preparation', 'HM', 'KM', 'Location', 'Status'],
                                                height: '150px',
                                                licenseKey: 'non-commercial-and-evaluation',
                                                columns: [{
                                                        validator: function(value, callback) {
                                                            if (!value) {
                                                                callback(false)
                                                            } else {
                                                                callback(true)
                                                            }
                                                        }
                                                    },
                                                    {},
                                                    {},
                                                    {},
                                                    {},
                                                    {},
                                                    {},
                                                    {},
                                                    {},
                                                    {},
                                                    {},
                                                    {},
                                                    {},
                                                ],
                                                afterChange: function(change, source) {
                                                    /*if (source === 'loadData') {
                                                      return; //don't save this change
                                                    }*/
                                                }
                                            });
                                            Handsontable.dom.addEvent(save, 'click', () => {
                                                hot.validateCells();
                                                // save all cell's data
                                                ajax('<?php echo base_url() ?>dispatch/ajaxHandsonKm6', 'POST', JSON.stringify({
                                                    data: hot.getData()
                                                }), res => {
                                                    const response = JSON.parse(res.response);
                                                    if (response.result === 'ok') {
                                                        exampleConsole.innerText = 'Data saved';
                                                    } else {
                                                        exampleConsole.innerText = 'Fill all data';
                                                    }
                                                });
                                            });

                                            function ajax(url, method, params, callback) {
                                                let obj;
                                                try {
                                                    obj = new XMLHttpRequest();
                                                } catch (e) {
                                                    try {
                                                        obj = new ActiveXObject('Msxml2.XMLHTTP');
                                                    } catch (e) {
                                                        try {
                                                            obj = new ActiveXObject('Microsoft.XMLHTTP');
                                                        } catch (e) {
                                                            alert('Your browser does not support Ajax.');
                                                            return false;
                                                        }
                                                    }
                                                }
                                                obj.onreadystatechange = () => {
                                                    if (obj.readyState == 4) {
                                                        callback(obj);
                                                    }
                                                };
                                                obj.open(method, url, true);
                                                obj.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                                                obj.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                                                obj.send(params);
                                                return obj;
                                            }
                                            $('#new').on('click', function() {
                                                hot.alter('insert_row');
                                                hot.validateCells();
                                            });
                                            $('#delete').on('click', function() {
                                                hot.alter('remove_row');
                                                hot.validateCells();
                                            });
                                        </script>
                                    <?php } ?>
                                </div>
                            </div>

                            <!-- /.card-body -->
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
    <script>
        // @formatter:off
        document.addEventListener("DOMContentLoaded", function() {
            window.Litepicker && (new Litepicker({
                element: document.getElementById('datepicker-default'),
                buttonText: {
                    previousMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>`,
                    nextMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>`,
                },
            }));
        });
        // @formatter:on
    </script>
</body>

</html>