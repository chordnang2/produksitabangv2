<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title><?= $title ?></title>
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
        <div class="page-wrapper">
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-cards">
                        <div class="col-12">
                            <div class="card">
                                <!-- /.card-header -->
                                <div class="card-header">
                                    <h3 class="card-title">Tambah Data <b><i>Surat Peringatan</i></h3>
                                </div>
                                <div class="card-body">
                                    <div class="col-12">
                                        <form action="<?= base_url('mpp/sanksiSpAdd') ?>" method="post" class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="row">
                                                            <div class="col-md-6 col-xl-12">
                                                                <div class="mb-1">
                                                                    <label class="form-label">Tanggal</label>
                                                                    <input type="date" class="form-control" name="tanggal" placeholder="Masukkan NIK" value="<?= set_value('tanggal'); ?>" required>
                                                                </div>
                                                                <div class="mb-1">
                                                                    <label class="form-label">NIK</label>
                                                                    <input type="number" class="form-control" name="nik" placeholder="Masukkan NIK" value="<?= set_value('nik'); ?>" required>
                                                                </div>
                                                                <div class="mb-1">
                                                                    <div class="form-label">Jenis SP</div>
                                                                    <select class="form-select" name="jenis_kejadian" required>
                                                                        <?php if (!set_value('jenis_kejadian')) { ?>
                                                                            <option value="" selected disabled>Pilih</option>
                                                                        <?php   } ?>
                                                                        <?php foreach ($listJenisSanksi as $key => $value) { ?>
                                                                            <option value="<?= $value['jenis'] ?>" <?php if (set_value('jenis_kejadian') == $value['jenis']) : echo "selected";
                                                                                                                    endif; ?>><?= $value['jenis'] ?></option>
                                                                        <?php  } ?>
                                                                    </select>

                                                                </div>
                                                                <div class="mb-1">
                                                                    <label class="form-label">Detail Kejadian</label>
                                                                    <textarea rows="5" class="form-control" placeholder="Detail Keterangan Kejadian" name="kejadian" required><?= set_value('kejadian'); ?></textarea>
                                                                </div>
                                                                <div class="mb-1">
                                                                    <div class="form-label">Sanksi SP</div>
                                                                    <select class="form-select" name="sanksi_sp" required>
                                                                        <?php if (!set_value('sanksi_sp')) { ?>
                                                                            <option value="" selected disabled>Pilih</option>
                                                                        <?php   } ?>
                                                                        <option value="1" <?php if (set_value('sanksi_sp') == "1") : echo "selected";
                                                                                            endif; ?>>1</option>

                                                                        <option value="2" <?php if (set_value('sanksi_sp') == "2") : echo "selected";
                                                                                            endif; ?>>2</option>

                                                                        <option value="3" <?php if (set_value('sanksi_sp') == "3") : echo "selected";
                                                                                            endif; ?>>3</option>

                                                                    </select>
                                                                </div>
                                                                <div class="mb-1">
                                                                    <label class="form-label">Kimper</label>
                                                                    <div class="divide-y">
                                                                        <div>
                                                                            <label class="row">
                                                                                <span class="col">Lobang</span>
                                                                                <span class="col-auto">
                                                                                    <label class="form-check form-check-single form-switch">
                                                                                        <input class="form-check-input" type="checkbox" name="lobang_kimper" <?php if (set_value('lobang_kimper') == "on") : echo " checked";
                                                                                                                                                                endif; ?>>
                                                                                    </label>
                                                                                </span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="mb-1">
                                                            <label class="form-label">Sesuai PP</label>
                                                            <input type="text" class="form-control" name="sesuai_pp" placeholder="Masukkan PP" value="<?= set_value('sesuai_pp'); ?>" required>
                                                        </div>
                                                        <div class="mb-1">
                                                            <label class="form-label">Bunyi PP</label>
                                                            <input type="text" class="form-control" name="bunyi_pasal" placeholder="Bunyi PP" value="<?= set_value('bunyi_pasal'); ?>" required>
                                                        </div>
                                                        <div class="mb-1">
                                                            <label class="form-label">Start</label>
                                                            <input type="date" class="form-control" name="startTanggalSanksi" value="<?= set_value('startTanggalSanksi'); ?>" required>
                                                        </div>
                                                        <div class="mb-1">
                                                            <label class="form-label">End</label>
                                                            <input type="date" class="form-control" name="endTanggalSanksi" value="<?= set_value('endTanggalSanksi'); ?>" required>
                                                        </div>
                                                        <div class="mb-1">
                                                            <label class="form-label">Diberikan Oleh</label>
                                                            <input type="text" class="form-control" name="diberikan_oleh" placeholder="Masukkan Nama Pengawas" value="<?= set_value('diberikan_oleh'); ?>" required>
                                                        </div>
                                                        <div class="mb-1">
                                                            <div class="form-label">Sifat Surat</div>
                                                            <select class="form-select" name="sifat_surat" required>
                                                                <?php if (!set_value('sanksi_sp')) { ?>
                                                                    <option value="" selected disabled>Pilih</option>
                                                                <?php   } ?>
                                                                <option value="External" <?php if (set_value('sifat_surat') == "External") : echo "selected";
                                                                                            endif; ?>>External</option>
                                                                <option value="Internal" <?php if (set_value('sifat_surat') == "Internal") : echo "selected";
                                                                                            endif; ?>>Internal</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer text-end">
                                                <div class="d-flex">
                                                    <a href="<?= base_url('mpp/sanksiSpView') ?>" class="btn btn-link">Kembali</a>
                                                    <button type="submit" class="btn btn-primary ms-auto">Kirim Data</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('template/js'); ?>
    <script src="<?= base_url('assets/tabler-dev/demo/') ?>dist/libs/litepicker/dist/litepicker.js?1668287865" defer></script>
</body>

</html>