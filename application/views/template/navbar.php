
<header class="autohide navbar navbar-expand-md navbar-dark navbar-overlap d-print-none">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href=".">
                <p class="navbar-brand">Produksi </p>
            </a>
        </h1>
        <div class="navbar-nav flex-row order-md-last">
            <?php
            $userName = $this->session->userdata('nama');
            ?>
            <div class="nav-item dropdown">
                <a href="" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                    <div class="d-none d-xl-block ps-2">
                        <div>Hai User <b><?= strtoupper($userName) ?> </b></div>
                    </div>
                </a>
            </div>
            <div class="nav-item d-none d-md-flex">
                <a href="<?= base_url('user/logout') ?>" class="nav-link px-0" tabindex="-1" aria-label="Show notifications">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path>
                        <path d="M7 12h14l-3 -3m0 6l3 -3"></path>
                    </svg>
                </a>
            </div>
            <div class="nav-item d-none d-md-flex">
                <a href="#" class="nav-link px-0" onclick="myFunction()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-maximize" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M4 8v-2a2 2 0 0 1 2 -2h2"></path>
                        <path d="M4 16v2a2 2 0 0 0 2 2h2"></path>
                        <path d="M16 4h2a2 2 0 0 1 2 2v2"></path>
                        <path d="M16 20h2a2 2 0 0 0 2 -2v-2"></path>
                    </svg>
                </a>
            </div>
        </div>

        <?php
        if ($this->uri->segment(1) == 'dashboard') {
            $activeDashboard = 'active';
        }else {
            $activeDashboard = '';
            # code...
        }
        if ($this->uri->segment(1) == 'ccr') {
            $activeCcr = 'active';
        }else {
            $activeCcr = '';
            # code...
        }
        if ($this->uri->segment(1) == 'weighbridge') {
            $activeWeighbridge = 'active';
        }else {
            $activeWeighbridge = '';
            # code...
        }
        if ($this->uri->segment(1) == 'dispatch') {
            $activeDispatch = 'active';
        }else {
            $activeDispatch = '';
            # code...
        }
        ?>

        <div class="collapse navbar-collapse" id="navbar-menu">
            <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
                <ul class="navbar-nav">
                    <li class="nav-item <?= $activeDashboard ?>">
                        <a class="nav-link" href="<?= base_url('dashboard') ?>">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <polyline points="5 12 3 12 12 3 21 12 19 12" />
                                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Dashboard
                            </span>
                        </a>
                    </li>
                    <?php if (in_array($userName, array('ccradmin'))) { ?>
                        <li class="nav-item dropdown <?= $activeCcr ?>">
                            <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-server-cog" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <rect x="3" y="4" width="18" height="8" rx="3"></rect>
                                        <path d="M12 20h-6a3 3 0 0 1 -3 -3v-2a3 3 0 0 1 3 -3h10.5"></path>
                                        <circle cx="18.001" cy="18" r="2"></circle>
                                        <path d="M18.001 14.5v1.5"></path>
                                        <path d="M18.001 20v1.5"></path>
                                        <path d="M21.032 16.25l-1.299 .75"></path>
                                        <path d="M16.27 19l-1.3 .75"></path>
                                        <path d="M14.97 16.25l1.3 .75"></path>
                                        <path d="M19.733 19l1.3 .75"></path>
                                        <path d="M7 8v.01"></path>
                                        <path d="M7 16v.01"></path>
                                    </svg>
                                </span>
                                <span class="nav-link-title">
                                    CCR
                                </span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="dropdown-menu-columns">
                                    <div class="dropdown-menu-column">
                                        <a class="dropdown-item" href="<?= base_url('ccr/loadAjaxHandson') ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clipboard-data" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path>
                                                <rect x="9" y="3" width="6" height="4" rx="2"></rect>
                                                <path d="M9 17v-4"></path>
                                                <path d="M12 17v-1"></path>
                                                <path d="M15 17v-2"></path>
                                                <path d="M12 17v-1"></path>
                                            </svg>
                                            Upload Data Forecast
                                        </a>
                                    </div>
                                </div>
                                <div class="dropdown-menu-columns">
                                    <div class="dropdown-menu-column">
                                        <a class="dropdown-item" href="<?= base_url('weighbridge/check') ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-zoom-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <circle cx="10" cy="10" r="7"></circle>
                                                <path d="M21 21l-6 -6"></path>
                                                <path d="M7 10l2 2l4 -4"></path>
                                            </svg>
                                            Cross Check
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                    <?php if (in_array($userName, array('ccradmin', 'timbangan'))) { ?>
                        <li class="nav-item dropdown <?= $activeWeighbridge?>">
                            <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-weight" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <circle cx="12" cy="6" r="3"></circle>
                                        <path d="M6.835 9h10.33a1 1 0 0 1 .984 .821l1.637 9a1 1 0 0 1 -.984 1.179h-13.604a1 1 0 0 1 -.984 -1.179l1.637 -9a1 1 0 0 1 .984 -.821z"></path>
                                    </svg>
                                </span>
                                <span class="nav-link-title">
                                    Weighbridge
                                </span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="dropdown-menu-columns">
                                    <div class="dropdown-menu-column">
                                        <a class="dropdown-item" href="<?= base_url('weighbridge/formAjaxHandson') ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-spreadsheet" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                                <path d="M8 11h8v7h-8z"></path>
                                                <path d="M8 15h8"></path>
                                                <path d="M11 11v7"></path>
                                            </svg>
                                            Upload Excel
                                        </a>
                                    </div>
                                </div>
                                <div class="dropdown-menu-columns">
                                    <div class="dropdown-menu-column">
                                        <a class="dropdown-item" href="<?= base_url('weighbridge/check') ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-zoom-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <circle cx="10" cy="10" r="7"></circle>
                                                <path d="M21 21l-6 -6"></path>
                                                <path d="M7 10l2 2l4 -4"></path>
                                            </svg>
                                            Cross Check
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                    <?php if (in_array($userName, array('ccradmin', 'dispatch'))) { ?>
                        <li class="nav-item dropdown <?= $activeDispatch ?>">
                            <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-analytics" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <rect x="3" y="4" width="18" height="12" rx="1"></rect>
                                        <line x1="7" y1="20" x2="17" y2="20"></line>
                                        <line x1="9" y1="16" x2="9" y2="20"></line>
                                        <line x1="15" y1="16" x2="15" y2="20"></line>
                                        <path d="M8 12l3 -3l2 2l3 -3"></path>
                                    </svg>
                                </span>
                                <span class="nav-link-title">
                                    Dispatch
                                </span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="dropdown-menu-columns">
                                    <div class="dropdown-menu-column">
                                        <a class="dropdown-item" href="<?= base_url('dispatch') ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-desktop-analytics" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <rect x="3" y="4" width="18" height="12" rx="1"></rect>
                                                <path d="M7 20h10"></path>
                                                <path d="M9 16v4"></path>
                                                <path d="M15 16v4"></path>
                                                <path d="M9 12v-4"></path>
                                                <path d="M12 12v-1"></path>
                                                <path d="M15 12v-2"></path>
                                                <path d="M12 12v-1"></path>
                                            </svg>
                                            Unit Monitoring
                                        </a>
                                    </div>
                                </div>
                                <div class="dropdown-menu-columns">
                                    <div class="dropdown-menu-column">
                                        <a class="dropdown-item" href="<?= base_url('dispatch/loadajaxhandsonKm6') ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-table-import" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M4 13.5v-7.5a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-6m-8 -10h16m-10 -6v11.5m-8 3.5h7m-3 -3l3 3l-3 3"></path>
                                            </svg>
                                            Upload Data Dispatch KM6
                                        </a>
                                    </div>
                                </div>
                                <div class="dropdown-menu-columns">
                                    <div class="dropdown-menu-column">
                                        <a class="dropdown-item" href="<?= base_url('dispatch/loadajaxhandsonKm38') ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-table-import" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M4 13.5v-7.5a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-6m-8 -10h16m-10 -6v11.5m-8 3.5h7m-3 -3l3 3l-3 3"></path>
                                            </svg>
                                            Upload Data Dispatch 38
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path>
                                    <path d="M7 12h14l-3 -3m0 6l3 -3"></path>
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Log Out
                            </span>
                        </a>
                    </li> -->
                </ul>
            </div>
        </div>
    </div>
</header>
