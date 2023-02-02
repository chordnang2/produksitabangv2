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
                                    <h3 class="card-title">Edit Data <b><i>Konseling</i></h3>
                                </div>
                                <div class="card-body">
                                    <div class="col-12">
                                        <form action="<?= base_url('mpp/konselingEdit') ?>" method="post" class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="row">
                                                            <div class="col-md-6 col-xl-12">
                                                                <div class="mb-1">
                                                                    <input type="hidden" name="id" value="<?= $edit['id'] ?>">
                                                                    <label class="form-label">NIK</label>
                                                                    <input type="number" class="form-control" name="nik" placeholder="Masukkan NIK" value="<?= $edit['nik'] ?>" required>
                                                                </div>
                                                                <div class="mb-1">
                                                                    <div class="form-label">Jenis Konseling</div>
                                                                    <select class="form-select" name="jenis_konseling" required>
                                                                        <?php foreach ($listJenisSanksi as $key => $value) { ?>
                                                                            <option value="<?= $value['jenis'] ?>" <?php if ($edit['jenis_konseling'] == $value['jenis']) : echo "selected";
                                                                                                                    endif; ?>><?= $value['jenis'] ?></option>
                                                                        <?php  } ?>
                                                                    </select>

                                                                </div>
                                                                <div class="mb-1">
                                                                    <label class="form-label">Isu Permasalahan</label>
                                                                    <textarea rows="5" class="form-control" placeholder="Isu Permasalahan Kejadian" name="isu_permasalahan" required><?= $edit['isu_permasalahan']; ?></textarea>
                                                                </div>
                                                                <div class="mb-1">
                                                                    <label class="form-label">Tanggapan</label>
                                                                    <textarea rows="5" class="form-control" placeholder="Tanggapan Kejadian" name="tanggapan" required><?= $edit['tanggapan']; ?></textarea>
                                                                </div>
                                                                <div class="mb-1">
                                                                    <label class="form-label">Tindakan</label>
                                                                    <textarea rows="5" class="form-control" placeholder="Tindakan Kejadian" name="tindakan" required><?= $edit['tindakan']; ?></textarea>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="mb-1">
                                                            <label class="form-label">Tanggal</label>
                                                            <input type="date" class="form-control" name="tanggal" placeholder="Masukkan NIK" value="<?= $edit['tanggal'] ?>" required>
                                                        </div>
                                                        <div class="mb-1">
                                                            <label class="form-label">Saksi 1</label>
                                                            <input type="text" class="form-control" name="saksi1" placeholder="Masukkan Saksi Pertama" value="<?= $edit['saksi1'] ?>" required>
                                                        </div>
                                                        <div class="mb-1">
                                                            <label class="form-label">Saksi 2</label>
                                                            <input type="text" class="form-control" name="saksi2" placeholder="Masukkan Saksi Kedua" value="<?= $edit['saksi2'] ?>" required>
                                                        </div>
                                                        <div class="mb-1">
                                                            <label class="form-label">Diberikan Oleh</label>
                                                            <input type="text" class="form-control" name="diberikan_oleh" placeholder="Masukkan PIC Diberikan Oleh" value="<?= $edit['diberikan_oleh'] ?>" required>
                                                        </div>
                                                        <div class="mb-1">
                                                            <label class="form-label">Sanksi</label>
                                                            <input type="text" class="form-control" name="sanksi" placeholder="Masukkan Sanksi" value="<?= $edit['sanksi']?>" required>
                                                        </div>
                                                        <div class="mb-1">
                                                            <label class="form-label">Sifat Surat</label>
                                                            <input type="text" class="form-control" name="sifat_surat" placeholder="Masukkan Sifat Surat" value="<?= $edit['sifat_surat'] ?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer text-end">
                                                <div class="d-flex">
                                                    <a href="<?= base_url('mpp/konselingView') ?>" class="btn btn-link">Kembali</a>
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