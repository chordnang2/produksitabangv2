<div class="col">
    <!-- Page pre-title -->
    <div class="page-pretitle">
        Overview
    </div>
    <h2 class="page-title">
        Dashboard &nbsp<i style="font-size: 11px;"><?php if ($thisDate) {
                                                            echo date_format(date_create($thisDate), "d M Y");
                                                        } ?> </i>
    </h2>
</div>
<!-- Page title actions -->
<div class="col-auto ms-auto d-print-none">
    <div class="btn-list">
        <span class="d-none d-sm-inline">
            <a href="#" class="btn btn-dark">
                Last update : <?php if ($lastupdate) {
                                    echo date_format(date_create($lastupdate[0]['maxDate']), "d M Y") . ' ' . $lastupdate[0]['maxHour'];
                                } ?>
            </a>
        </span>
    </div>
</div>