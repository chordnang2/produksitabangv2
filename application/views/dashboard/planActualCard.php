<div class="col-sm-6 col-lg-2">

    <div class="card">

        <div class="card-body">

            <div class="card-title">

                Daily(ton)

            </div>

            <div class="d-flex align-items-center">

                <div class="subheader">Plan</div>

            </div>

            <div class="h5 "><?= $dailyPlan ?></div>

            <div class="d-flex align-items-center">

                <div class="subheader">Actual</div>

            </div>

            <div class="h5 "><?= $dailyActual ?></div>

            <div class="d-flex mb-2">

                <div class="h5">Percent</div>

                <div class="ms-auto">

                    <span class="text-blue d-inline-flex align-items-center lh-1">

                        <?= $dailyPercent ?>%

                    </span>

                </div>

            </div>

            <div class="progress progress-sm">

                <div class="progress-bar <?= $progressBarColorDaily ?>" style="width:  <?= $dailyPercent ?>%" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" aria-label=" <?= $dailyPercent ?>% Complete">

                    <span class="visually-hidden"> <?= $dailyPercent ?>% Complete</span>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="col-sm-6 col-lg-2">

    <div class="card">

        <div class="card-body">

            <div class="card-title">

                Monthly(ton)

            </div>

            <div class="d-flex align-items-center">

                <div class="subheader">Plan</div>

            </div>

            <div class="h5 "><?= $monthlyPlan ?></div>

            <div class="d-flex align-items-center">

                <div class="subheader">Actual</div>

            </div>

            <div class="h5 "><?= $monthlyActual ?></div>

            <div class="d-flex mb-2">

                <div class="h5">Percent</div>

                <div class="ms-auto">

                    <span class="text-blue d-inline-flex align-items-center lh-1">

                        <?= $monthlyPercent ?>%

                    </span>

                </div>

            </div>

            <div class="progress progress-sm">

                <div class="progress-bar bg-danger" style="width: <?= $monthlyPercent ?>%" role="progressbar" aria-valuenow="<?= $monthlyPercent ?>" aria-valuemin="0" aria-valuemax="100" aria-label="<?= $monthlyPercent ?>% Complete">

                    <span class="visually-hidden"><?= $monthlyPercent ?>% Complete</span>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="col-sm-6 col-lg-2">

    <div class="card">

        <div class="card-body">

            <div class="card-title">

                Yearly(ton)

            </div>

            <div class="d-flex align-items-center">

                <div class="subheader">Plan</div>

            </div>

            <div class="h5 "><?= $yearlyPlan ?></div>

            <div class="d-flex align-items-center">

                <div class="subheader">Actual</div>

            </div>

            <div class="h5 "><?= $yearlyActual ?></div>

            <div class="d-flex mb-2">

                <div class="h5">Percent</div>

                <div class="ms-auto">

                    <span class="text-blue d-inline-flex align-items-center lh-1">

                        <?= $yearlyPercent ?>%

                    </span>

                </div>

            </div>

            <div class="progress progress-sm">

                <div class="progress-bar bg-danger" style="width: <?= $yearlyPercent ?>%" role="progressbar" aria-valuenow="<?= $yearlyPercent ?>" aria-valuemin="0" aria-valuemax="100" aria-label="<?= $yearlyPercent ?>% Complete">

                    <span class="visually-hidden"><?= $yearlyPercent ?>% Complete</span>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="col-sm-6 col-lg-2">

    <div class="card">

        <div class="ribbon ribbon-top bg-yellow">

            <!-- Download SVG icon from http://tabler-icons.io/i/star -->

            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">

                <path stroke="none" d="M0 0h54v24H0z" fill="none"></path>

                <path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"></path>

            </svg>

        </div>

        <div class="card-body">

            <div class="card-title">

                MTD(ton)

            </div>

            <div class="d-flex align-items-center">

                <div class="subheader">Plan</div>

            </div>

            <div class="h5 "><?= $mtdPlan ?></div>

            <div class="d-flex align-items-center">

                <div class="subheader">Actual</div>

            </div>

            <div class="h5 "><?= $mtdActual ?></div>

            <div class="d-flex mb-2">

                <div class="h5">Percent</div>

                <div class="ms-auto">

                    <span class="text-blue d-inline-flex align-items-center lh-1">

                        <?= $mtdPercent ?>%

                    </span>

                </div>

            </div>

            <div class="progress progress-sm">

                <div class="progress-bar <?= $progressBarColorMtd ?>" style="width: <?= $mtdPercent ?>%" role="progressbar" aria-valuenow="<?= $mtdPercent ?>" aria-valuemin="0" aria-valuemax="100" aria-label="<?= $mtdPercent ?>% Complete">

                    <span class="visually-hidden"><?= $mtdPercent ?>% Complete</span>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="col-sm-6 col-lg-2">

    <div class="card">

        <div class="ribbon ribbon-top bg-yellow">

            <!-- Download SVG icon from http://tabler-icons.io/i/star -->

            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">

                <path stroke="none" d="M0 0h54v24H0z" fill="none"></path>

                <path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"></path>

            </svg>

        </div>

        <div class="card-body">

            <div class="card-title">

                YTD(ton)

            </div>

            <div class="d-flex align-items-center">

                <div class="subheader">Plan</div>

            </div>

            <div class="h5 "><?= $ytdPlan ?></div>

            <div class="d-flex align-items-center">

                <div class="subheader">Actual</div>

            </div>

            <div class="h5 "><?= $yearlyActual ?></div>

            <div class="d-flex mb-2">

                <div class="h5">Percent</div>

                <div class="ms-auto">

                    <span class="text-blue d-inline-flex align-items-center lh-1">

                        <?= $ytdPercent ?>%

                    </span>

                </div>

            </div>

            <div class="progress progress-sm">

                <div class="progress-bar <?= $progressBarColorYtd ?>" style="width: <?= $ytdPercent ?>%" role="progressbar" aria-valuenow="<?= $ytdPercent ?>" aria-valuemin="0" aria-valuemax="100" aria-label="<?= $ytdPercent ?>% Complete">

                    <span class="visually-hidden"><?= $ytdPercent ?>% Complete</span>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="col-sm-6 col-lg-2">

    <div class="card">

        <div class="card-body">

            <div class="card-title">

                AVG(ton/HM)

            </div>

            <div class="d-flex align-items-center">

                <div class="subheader">Plan</div>

            </div>

            <div class="h5 ">0</div>

            <div class="d-flex align-items-center">

                <div class="subheader">Actual</div>

            </div>

            <div class="h5 ">0</div>

            <div class="d-flex mb-2">

                <div class="h5">Percent</div>

                <div class="ms-auto">

                    <span class="text-blue d-inline-flex align-items-center lh-1">

                        0%

                    </span>

                </div>

            </div>

            <div class="progress progress-sm">

                <div class="progress-bar bg-danger" style="width: 0%" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" aria-label="0% Complete">

                    <span class="visually-hidden">0% Complete</span>

                </div>

            </div>

        </div>

    </div>

</div>