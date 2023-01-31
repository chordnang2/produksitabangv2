<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Singapore');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $platform = $this->agent->platform();

        if ($this->agent->platform() == 'Windows 10' || $this->agent->platform() == 'Windows 11') {
            $height = '100';
            $heightRitasi = '150';
            $width = '';
        } elseif ($this->agent->platform() == 'Android' || $this->agent->platform() == 'iPhone') {
            $height = '300';
            $heightRitasi = '300';
            $width = 'width:700,';
        }
        $data['height'] = $height;
        $data['width'] = $width;
        $data['heightRitasi'] = $heightRitasi;
        $this->load->view('dashboard/core', $data);
    }
    public function top()
    {
        $data['thisDate'] = $this->db->query("SELECT max(dashboardDateValue) as maxDate,MONTH(max(dashboardDateValue)) as maxMonth FROM tbl_dashboard LIMIT 1")->result_array()[0]['maxDate'];

        $thisDate =  $data['thisDate'];
        $data['lastupdate'] = $this->db->query("SELECT date as maxDate,time_out as maxHour FROM tbl_wb2 WHERE DATE= '$thisDate' ORDER BY id_wb DESC LIMIT 1")->result_array();

        $this->load->view('dashboard/top', $data);
    }
    public function planActualCard()
    {
        $maxDate = $this->db->query("SELECT max(dashboardDateValue) as maxDate,MONTH(max(dashboardDateValue)) as maxMonth FROM tbl_dashboard LIMIT 1")->result_array()[0]['maxDate'];


        if (isset($maxDate)) {
            $data['maxDate'] = $maxDate;
            $forecast = $this->db->query("SELECT dashboardIndexValue FROM tbl_dashboard WHERE dashboardIndexName LIKE 'get%' AND dashboardDateValue LIKE '$maxDate'")->result_array();

            if (isset($forecast)) {
                //daily
                $data['dailyActual'] =  number_format($forecast[0]['dashboardIndexValue'], 0, ',', '.');
                $data['dailyPlan'] =  number_format($forecast[1]['dashboardIndexValue'], 0, ',', '.');
                $dailyPercent =  number_format($forecast[2]['dashboardIndexValue'], 0, ',', '');
                $data['dailyPercent'] =  $dailyPercent;
                //monthly
                $data['monthlyActual'] =  number_format($forecast[3]['dashboardIndexValue'], 0, ',', '.');
                $data['monthlyPlan'] =  number_format($forecast[4]['dashboardIndexValue'], 0, ',', '.');
                $monthlyPercent =  number_format($forecast[5]['dashboardIndexValue'], 0, ',', '');
                $data['monthlyPercent'] =  $monthlyPercent;
                //yearly
                $data['yearlyActual'] =  number_format($forecast[6]['dashboardIndexValue'], 0, ',', '.');
                $yearlyPlan =  number_format($forecast[7]['dashboardIndexValue'], 0, ',', '.');
                $yearlyPercent =  number_format($forecast[8]['dashboardIndexValue'], 0, ',', '');
                if ($yearlyPlan <= '14000000') {
                    $data['yearlyPlan'] = number_format('14000000', 0, ',', '.');;
                    $data['yearlyPercent'] =   number_format($forecast[6]['dashboardIndexValue'] / 14000000, 0, ',', '');
                } else {
                    $data['yearlyPlan'] =  $yearlyPlan;
                    $data['yearlyPercent'] =  $yearlyPercent;
                }
                //mtd
                $data['mtdActual'] =  number_format($forecast[3]['dashboardIndexValue'], 0, ',', '.');
                $data['mtdPlan'] =  number_format($forecast[9]['dashboardIndexValue'], 0, ',', '.');
                $mtdPercent =  number_format($forecast[10]['dashboardIndexValue'], 0, ',', '');
                $data['mtdPercent'] =  $mtdPercent;
                //ytd
                $data['ytdActual'] =  number_format($forecast[6]['dashboardIndexValue'], 0, ',', '.');
                $data['ytdPlan'] =  number_format($forecast[11]['dashboardIndexValue'], 0, ',', '.');
                $ytdPercent =  number_format($forecast[12]['dashboardIndexValue'], 0, ',', '');
                $data['ytdPercent'] =  $ytdPercent;
            } else {
                $data['dailyPlan'] = 0;
                $data['dailyActual'] = 0;
                $data['dailyPercent'] = 0;
                $data['monthlyPlan'] = 0;
                $data['monthlyActual'] = 0;
                $data['monthlyPercent'] = 0;
                $data['yearlyPlan'] = 0;
                $data['yearlyActual'] = 0;
                $data['yearlyPercent'] = 0;
                $data['mtdPlan'] = 0;
                $data['mtdActual'] = 0;
                $data['mtdPercent'] = 0;
                $data['ytdPlan'] = 0;
                $data['ytdActual'] = 0;
                $data['ytdPercent'] = 0;
            }

            //daily
            if ($dailyPercent >= 100) {
                $progressBarColorDaily = 'bg-success';
            } elseif ($dailyPercent <= 100) {
                $progressBarColorDaily = 'bg-danger';
            } else {
                $progressBarColorDaily = '';
            }
            //monthly
            if ($monthlyPercent >= 100) {
                $progressBarColorMonthly = 'bg-success';
            } elseif ($monthlyPercent <= 100) {
                $progressBarColorMonthly = 'bg-danger';
            } else {
                $progressBarColorMonthly = '';
            }
            //yealy
            if ($yearlyPercent >= 100) {
                $progressBarColorYearly = 'bg-success';
            } elseif ($yearlyPercent <= 100) {
                $progressBarColorYearly = 'bg-danger';
            } else {
                $progressBarColorYearly = '';
            }
            //mtd
            if ($mtdPercent >= 100) {
                $progressBarColorMtd = 'bg-success';
            } elseif ($mtdPercent <= 100) {
                $progressBarColorMtd = 'bg-danger';
            } else {
                $progressBarColorMtd = '';
            }
            //Ytd
            if ($ytdPercent >= 100) {
                $progressBarColorYtd = 'bg-success';
            } elseif ($ytdPercent <= 100) {
                $progressBarColorYtd = 'bg-danger';
            } else {
                $progressBarColorYtd = '';
            }

            $data['progressBarColorDaily'] = $progressBarColorDaily;
            $data['progressBarColorMonthly'] = $progressBarColorMonthly;
            $data['progressBarColorYearly'] = $progressBarColorYearly;
            $data['progressBarColorMtd'] = $progressBarColorMtd;
            $data['progressBarColorYtd'] = $progressBarColorYtd;
        }
        $this->load->view('dashboard/planActualCard', $data);
    }

    public function ajaxChartData()
    {

        // date_default_timezone_set('Asia/Singapore');
        // $todayHour =  date('G');

        $maxDate = $this->db->query("SELECT max(dashboardDateValue) as maxDate,MONTH(max(dashboardDateValue)) as maxMonth FROM tbl_dashboard LIMIT 1")->result_array()[0]['maxDate'];
        $hourOnlyRaw = $this->db->query("SELECT date as maxDate,time_out as maxHour FROM tbl_wb2 WHERE DATE= '$maxDate' ORDER BY id_wb DESC LIMIT 1")->result_array()[0]['maxHour'];
        $hourOnlyWb = date('G', strtotime("0000-00-00 $hourOnlyRaw"));
        //monitoringproduksi
        $chartMonitoringProduksi = $this->db->query("SELECT dashboardIndexValue FROM tbl_dashboard WHERE dashboardIndexName LIKE 'nettRaw%' AND dashboardDateValue LIKE '$maxDate'")->result_array();
        $chartMonitoringProduksiTotal = $this->db->query("SELECT dashboardIndexValue FROM tbl_dashboard WHERE dashboardIndexName LIKE 'nettTotal%' AND dashboardDateValue LIKE '$maxDate'")->result_array();
        //ritasi
        $chartAverageRitasi = $this->db->query("SELECT dashboardIndexValue FROM tbl_dashboard WHERE dashboardIndexName LIKE 'avg%' AND dashboardDateValue LIKE '$maxDate'")->result_array();
        $chartTotalUnit = $this->db->query("SELECT dashboardIndexValue FROM tbl_dashboard WHERE dashboardIndexName LIKE 'dist%' AND dashboardDateValue LIKE '$maxDate'")->result_array();
        $chartTotalRitasi = $this->db->query("SELECT dashboardIndexValue FROM tbl_dashboard WHERE dashboardIndexName LIKE 'no_dist%' AND dashboardDateValue LIKE '$maxDate'")->result_array();


        if ($hourOnlyWb >= 7 && $hourOnlyWb <= 18) {
            for ($i = 0; $i <= 11; $i++) {
                unset($chartMonitoringProduksiTotal[$i]);
            }
        }


        if ($hourOnlyWb == 7) {
            for ($i = 1; $i <= 23; $i++) {
                unset($chartMonitoringProduksi[$i]);
                $chartMonitoringProduksi[$i]['dashboardIndexValue']  = 0;
                unset($chartAverageRitasi[$i]);
                $chartAverageRitasi[$i]['dashboardIndexValue']  = 0;
                unset($chartTotalUnit[$i]);
                $chartTotalUnit[$i]['dashboardIndexValue']  = 0;
                unset($chartTotalRitasi[$i]);
                $chartTotalRitasi[$i]['dashboardIndexValue']  = 0;
            }
        }
        for ($a = 1; $a <= 16; $a++) {
            if ($hourOnlyWb == 7 + $a) {
                for ($i = 1 + $a; $i <= 23; $i++) {
                    unset($chartMonitoringProduksi[$i]);
                    $chartMonitoringProduksi[$i]['dashboardIndexValue']  = 0;
                    $chartAverageRitasi[$i]['dashboardIndexValue']  = 0;
                    unset($chartTotalUnit[$i]);
                    $chartTotalUnit[$i]['dashboardIndexValue']  = 0;
                    unset($chartTotalRitasi[$i]);
                    $chartTotalRitasi[$i]['dashboardIndexValue']  = 0;
                }
            }
        }
        if ($hourOnlyWb == 0) {
            for ($i = 18; $i <= 23; $i++) {
                unset($chartMonitoringProduksi[$i]);
                $chartMonitoringProduksi[$i]['dashboardIndexValue']  = 0;
                $chartAverageRitasi[$i]['dashboardIndexValue']  = 0;
                unset($chartTotalUnit[$i]);
                $chartTotalUnit[$i]['dashboardIndexValue']  = 0;
                unset($chartTotalRitasi[$i]);
                $chartTotalRitasi[$i]['dashboardIndexValue']  = 0;
            }
        }
        for ($a = 1; $a <= 6; $a++) {
            if ($hourOnlyWb == 0 + $a) {
                for ($i = 18 + $a; $i <= 23; $i++) {
                    unset($chartMonitoringProduksi[$i]);
                    $chartMonitoringProduksi[$i]['dashboardIndexValue']  = 0;
                    $chartAverageRitasi[$i]['dashboardIndexValue']  = 0;
                    unset($chartTotalUnit[$i]);
                    $chartTotalUnit[$i]['dashboardIndexValue']  = 0;
                    unset($chartTotalRitasi[$i]);
                    $chartTotalRitasi[$i]['dashboardIndexValue']  = 0;
                }
            }
        }


        //averageMuatanPerLokasi
        $chartAverageMuatanPerLokasi = $this->db->query("SELECT dashboardIndexValue FROM tbl_dashboard WHERE dashboardIndexName LIKE 'perLokasiAverageMuatan%' AND dashboardDateValue LIKE '$maxDate'")->result_array();
        $chartPerLokasiLoadingPoint = $this->db->query("SELECT dashboardIndexValue FROM tbl_dashboard WHERE dashboardIndexName LIKE 'perLokasiLoadingPoint%' AND dashboardDateValue LIKE '$maxDate'")->result_array();
        //averageMuatanPerTipeVessel
        $chartAverageMuatanPerTipeVessel = $this->db->query("SELECT dashboardIndexValue FROM tbl_dashboard WHERE dashboardIndexName LIKE 'perTipeVesselAverageMuatan%' AND dashboardDateValue LIKE '$maxDate'")->result_array();
        $chartPerTipeVesselLoadingPoint = $this->db->query("SELECT dashboardIndexValue FROM tbl_dashboard WHERE dashboardIndexName LIKE 'perTipeVesselTipeVessel%' AND dashboardDateValue LIKE '$maxDate'")->result_array();
        //totalTripPerTipeVessel
        $chartTipeVesselList =  $this->db->query("SELECT dashboardIndexValue FROM tbl_dashboard WHERE dashboardIndexName LIKE 'getTipeVesse%' AND dashboardDateValue LIKE '$maxDate'")->result_array();
        $chartTotalTripRawCoalPerTipeVessel = $this->db->query("SELECT dashboardIndexValue FROM tbl_dashboard WHERE dashboardIndexName LIKE 'totalTripRawCoal%' AND dashboardDateValue LIKE '$maxDate'")->result_array();
        $chartTotalTripCrushCoalPerTipeVessel = $this->db->query("SELECT dashboardIndexValue FROM tbl_dashboard WHERE dashboardIndexName LIKE 'totalTripCrushCoal%' AND dashboardDateValue LIKE '$maxDate'")->result_array();
        //perLoadingPoint
        $chartLoadingPoint = $this->db->query("SELECT dashboardIndexValue FROM tbl_dashboard WHERE dashboardIndexName LIKE 'getTipeLoading%' AND dashboardDateValue LIKE '$maxDate'")->result_array();
        $chartTripPerLoadingPoint = $this->db->query("SELECT dashboardIndexValue FROM tbl_dashboard WHERE dashboardIndexName LIKE 'countTripLokasi%' AND dashboardDateValue LIKE '$maxDate'")->result_array();
        $chartUnderloadPerLoadingPoint = $this->db->query("SELECT dashboardIndexValue FROM tbl_dashboard WHERE dashboardIndexName LIKE 'countUnderloadPerLokasi%' AND dashboardDateValue LIKE '$maxDate'")->result_array();
        $chartTotalTonKmPerLoadingPoint = $this->db->query("SELECT dashboardIndexValue FROM tbl_dashboard WHERE dashboardIndexName LIKE 'sumTotalTonKmPerLokasi%' AND dashboardDateValue LIKE '$maxDate'")->result_array();




        if ($chartMonitoringProduksi) {
            $json['chartMonitoringProduksiHour'] =
                [
                    '7',
                    '8',
                    '9',
                    '10',
                    '11',
                    '12',
                    '13',
                    '14',
                    '15',
                    '16',
                    '17',
                    '18',
                    '19',
                    '20',
                    '21',
                    '22',
                    '23',
                    '00',
                    '01',
                    '02',
                    '03',
                    '04',
                    '05',
                    '06',
                ];
            $json['chartMonitoringProduksiValueTotal'] =
                [
                    '0',
                    '0',
                    '0',
                    '0',
                    '0',
                    '0',
                    '0',
                    '0',
                    '0',
                    '0',
                    '0',
                    '0',
                ];
            foreach ($chartMonitoringProduksi as $key => $value) {
                $json['chartMonitoringProduksiValue'][] = $value['dashboardIndexValue'];
            }

            foreach ($chartMonitoringProduksiTotal as $key => $value) {
                $json['chartMonitoringProduksiValueTotal'][] = $value['dashboardIndexValue'];
            }


            foreach ($chartAverageRitasi as $key => $value) {
                $json['chartAverageRitasi'][] = $value['dashboardIndexValue'];
                $json['chartTotalUnit'][] = $chartTotalUnit[$key]['dashboardIndexValue'];
                $json['chartTotalRitasi'][] = $chartTotalRitasi[$key]['dashboardIndexValue'];
            }
            foreach ($chartAverageMuatanPerLokasi as $key => $value) {
                $json['chartAverageMuatanPerLokasi'][] = $value['dashboardIndexValue'];
                $json['chartPerLokasiLoadingPoint'][] = $chartPerLokasiLoadingPoint[$key]['dashboardIndexValue'];
            }
            foreach ($chartAverageMuatanPerTipeVessel as $key => $value) {
                $json['chartAverageMuatanPerTipeVessel'][] = $value['dashboardIndexValue'];
                $json['chartPerTipeVesselLoadingPoint'][] = $chartPerTipeVesselLoadingPoint[$key]['dashboardIndexValue'];
            }
            foreach ($chartTotalTripRawCoalPerTipeVessel as $key => $value) {
                $json['chartTipeVesselList'][] = $chartTipeVesselList[$key]['dashboardIndexValue'];
                $json['chartTotalTripRawCoalPerTipeVessel'][] = $value['dashboardIndexValue'];
                $json['chartTotalTripCrushCoalPerTipeVessel'][] = $chartTotalTripCrushCoalPerTipeVessel[$key]['dashboardIndexValue'];
            }
            foreach ($chartTripPerLoadingPoint as $key => $value) {
                $json['chartLoadingPoint'][] = $chartLoadingPoint[$key]['dashboardIndexValue'];
                $json['chartTripPerLoadingPoint'][] = $value['dashboardIndexValue'];
                $json['chartUnderloadPerLoadingPoint'][] = $chartUnderloadPerLoadingPoint[$key]['dashboardIndexValue'];
                $json['chartTotalTonKmPerLoadingPoint'][] = $chartTotalTonKmPerLoadingPoint[$key]['dashboardIndexValue'];
            }
            echo json_encode($json);
        } else {
            echo "false";
        }


        // if ($chartAverageRitasi && $chartTotalUnit && $chartTotalRitasi) {
        //     $json2['chartMonitoringRitasiHour'] =
        //         [
        //             '7',
        //             '8',
        //             '9',
        //             '10',
        //             '11',
        //             '12',
        //             '13',
        //             '14',
        //             '15',
        //             '16',
        //             '17',
        //             '18',
        //             '19',
        //             '20',
        //             '21',
        //             '22',
        //             '23',
        //             '00',
        //             '01',
        //             '02',
        //             '03',
        //             '04',
        //             '05',
        //             '06'
        //         ];



        //     echo json_encode($json);
        // } else {
        //     echo "false";
        // }
    }
}

/* End of file Dashboard.php and path \application\controllers\Dashboard.php */
