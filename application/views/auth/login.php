<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Sign in</title>
    <!-- CSS files -->
    <?php $this->load->view('template/css'); ?>
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: Inter, -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }
    </style>
</head>

<body class=" border-top-wide border-primary d-flex flex-column">
    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="card card-md">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <img src="https://static.wixstatic.com/media/3d4787_ed3fbd15162d4cb089c7cbc4eef1228e~mv2.png/v1/fill/w_120,h_106,al_c,q_85,usm_0.66_1.00_0.01/3d4787_ed3fbd15162d4cb089c7cbc4eef1228e~mv2.webp" height="36" alt="">
                    </div>
                    <h2 class="h2 text-center mb-4">Akses Dashboard Produksi</h2>
                    <form action="<?= base_url('user/login') ?>" method="post" autocomplete="off" required>
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="nama" class="form-control" name="nama" placeholder="Masukkan nama" autocomplete="off" value="<?php echo set_value('nama'); ?>" required>
                            <?php echo form_error('nama'); ?>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">
                                Password
                            </label>
                            <div class="input-group input-group-flat">
                                <input type="password" class="form-control" name="password" placeholder="Masukkan password" autocomplete="off">
                                <?php echo form_error('password'); ?>
                                <span class="input-group-text">
                                    <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <circle cx="12" cy="12" r="2" />
                                            <path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" />
                                        </svg>
                                    </a>
                                </span>
                            </div>
                        </div>
                        <div class="mb-2">
                            <label class="form-check">
                                <input type="checkbox" class="form-check-input" />
                                <span class="form-check-label">Ingat akun ini di perangkat ini</span>
                            </label>
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100">Masuk</button>
                            <?php echo $this->session->flashdata('login_error'); ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <?php $this->load->view('template/js'); ?>
</body>

</html>