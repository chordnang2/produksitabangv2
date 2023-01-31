<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Singapore');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Weighbridge extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Weighbridge_model', 'wb_m');
        $this->load->library('Mcarbon');
    }
    public function index()
    {
        $this->load->view('weighbridge/data');
    }
    public function formAjaxHandson()
    {
        if ($this->input->get('date')) {
            $data['date'] = $this->input->get('date');
            $data['data'] = $this->wb_m->wb_hanson($data);
            $handson_data = array();
            foreach ($data['data'] as $key => $wb) {
                $temp = array();
                foreach ($wb as $key2 => $wb_value) {
                    if ($key2 == "id_wb") {
                        continue;
                    } elseif ($key2 == "payment") {
                        break;
                    } else {
                        $temp[] = "'" . $wb_value . "'";
                    }
                }
                if ($temp) {
                    if ($key + 1 == count($data['data']))
                        $comma = "";
                    else
                        $comma = ",";
                    $handson_data[] = "[" . implode(",", $temp) . "]" . $comma;
                }
            }
            $data['handson'] = $handson_data;
        } else {
            $data['date'] = "";
        }
        $data['thisDate'] = $this->db->query("SELECT max(date) as maxDate FROM tbl_wb2  LIMIT 1")->result_array()[0]['maxDate'];
        $thisDate =  $data['thisDate'];
        $data['lastupdate'] = $this->db->query("SELECT date as maxDate,time_out as maxHour FROM tbl_wb2 WHERE date= '$thisDate' ORDER BY id_wb DESC LIMIT 1")->result_array();
        $this->load->view('weighbridge/form', $data);
    }
    public function ajaxHandson()
    {
        $data = (array) json_decode(file_get_contents('php://input'), true);
        $data = $data['data'];
        $temp['result'] = $this->wb_m->update_handson($data);
        // print_r($data[0][19]);
        // die();
        // DATA UNTUK DICONTROLLER WB MENCARI DATA PRODUKSI BERDASARKAN TANGGAL
        if ($temp['result'] == 'ok') {

            // $getTanggalUpdateActual = Mcarbon::now()->locale('id')->format('Y-m-d');
            // $getTanggalUpdateWb = $this->wb_m->getTanggalUpdateWb()[0]['maxDate'];
            // if ($getTanggalUpdateActual == $getTanggalUpdateWb) {
            //     $getTanggalDashboard = $getTanggalUpdateActual;
            //     $getBulanDashboard = Mcarbon::createFromFormat('Y-m-d', $getTanggalUpdateActual)->format('m');
            //     $getTahunDashboard = Mcarbon::createFromFormat('Y-m-d', $getTanggalUpdateActual)->format('Y');
            // } else {
            //     $getTanggalDashboard = $getTanggalUpdateWb;
            //     $getBulanDashboard = Mcarbon::createFromFormat('Y-m-d', $getTanggalUpdateWb)->format('m');
            //     $getTahunDashboard = Mcarbon::createFromFormat('Y-m-d', $getTanggalUpdateWb)->format('Y');
            // }
            $getTanggalDashboard = $data[0][19];
            $getBulanDashboard = Mcarbon::createFromFormat('Y-m-d', $getTanggalDashboard)->format('n');
            $getTahunDashboard = Mcarbon::createFromFormat('Y-m-d', $getTanggalDashboard)->format('Y');
            $getTanggalOnlyDashboard = Mcarbon::createFromFormat('Y-m-d', $getTanggalDashboard)->format('j');
            //daily
            $getDailyActual = ROUND($this->wb_m->getDailyActual($getTanggalDashboard)[0]['dailyActualNett'] / 1000, 2);
            $getDailyPlan = ROUND($this->wb_m->getDailyPlan($getBulanDashboard, $getTahunDashboard)[0]['dailyPlanNett'], 2);

            if (isset($getDailyActual) && isset($getDailyPlan)) {
                $getDailyPercent = ROUND($getDailyActual / $getDailyPlan * 100);
            } else {
                $getDailyPercent = 0;
            }
            //monthly
            $getMonthlyActual = ROUND($this->wb_m->getMonthlyActual($getBulanDashboard, $getTahunDashboard)[0]['monthlyActualNett'], 2);
            $getMonthlyPlan = ROUND($this->wb_m->getMonthlyPlan($getBulanDashboard, $getTahunDashboard)[0]['monthlyPlanNett'], 2);
            if (isset($getMonthlyActual) && isset($getMonthlyPlan)) {
                $getMonthlyPercent = ROUND($getMonthlyActual / $getMonthlyPlan * 100);
            } else {
                $getMonthlyPercent = 0;
            }

            //mtd
            $getMtdPlan = ROUND($this->wb_m->getMonthlyPlan($getBulanDashboard, $getTahunDashboard)[0]['targetHarian'] * $getTanggalOnlyDashboard, 2);
            if (isset($getMtdPlan)) {
                $getMtdPercent = ROUND($getMonthlyActual / $getMtdPlan * 100);
            } else {
                $getMtdPercent = 0;
            }
            $getMtdPlan = ROUND($this->wb_m->getMonthlyPlan($getBulanDashboard, $getTahunDashboard)[0]['targetHarian'] * $getTanggalOnlyDashboard, 2);
            if (isset($getMtdPlan)) {
                $getMtdPercent = ROUND($getMonthlyActual / $getMtdPlan * 100);
            } else {
                $getMtdPercent = 0;
            }
            //yearly
            $getYearlyActual = ROUND($this->wb_m->getYearlyActual($getTahunDashboard)[0]['yearlyActualNett'], 2);
            $getYearlyPlan = ROUND($this->wb_m->getYearlyPlan($getTahunDashboard)[0]['yearlyPlanNett'], 2);
            if (isset($getYearlyActual) && isset($getYearlyPlan)) {
                $getYearlyPercent = ROUND($getYearlyActual / $getYearlyPlan * 100);
            } else {
                $getYearlyPercent = 0;
            }
            //Ytd

            $startDateYtd = "$getTahunDashboard-01-01";
            $endDateYtd = date("Y-m-d", strtotime($getTanggalDashboard . ' -1 months'));

            if ($getBulanDashboard == '1') {
                $getYtdPlan = $getMtdPlan;
            } else {
                $start    = new DateTime($startDateYtd); // Today date
                $end      = new DateTime($endDateYtd);
                $interval = DateInterval::createFromDateString('1 month');
                $period   = new DatePeriod($start, $interval, $end);
                $months = array();
                foreach ($period as $dt) {
                    $months[] = "'" . $dt->format("n") . "'";
                }
                $monthsImplode = implode(',', $months);
                $getYtdPlan = $this->wb_m->getYtdSumNettAllMonthBefore($monthsImplode, $getTahunDashboard)[0]['yearlyPlanNett'] + $getMtdPlan;
            }

            if (isset($getMtdPlan)) {
                $getYtdPercent = ROUND($getYearlyActual / $getYtdPlan * 100);
            } else {
                $getYtdPercent = 0;
            }
            //Allin
            $forecast = array(
                'getDailyActual' => $getDailyActual,
                'getDailyPlan' => $getDailyPlan,
                'getDailyPercent' => $getDailyPercent,
                'getMonthlyActual' => $getMonthlyActual,
                'getMonthlyPlan' => $getMonthlyPlan,
                'getMonthlyPercent' => $getMonthlyPercent,
                'getYearlyActual' => $getYearlyActual,
                'getYearlyPlan' => $getYearlyPlan,
                'getYearlyPercent' => $getYearlyPercent,
                'getMtdPlan' => $getMtdPlan,
                'getMtdPercent' => $getMtdPercent,
                'getYtdPlan' => $getYtdPlan,
                'getYtdPercent' => $getYtdPercent
            );
            // $tipeVessel = array('SCANIA sst 82-82', 'VOLVO sdt 85-85', 'SCANIA sst 105-120', 'VOLVO sst 105-120', 'VOLVO sdt 110-115', 'SCANIA sdt 110-125');
            $tipeVesselRaw = $this->wb_m->getTipeVessel($getTanggalDashboard);
            foreach ($tipeVesselRaw as $key => $value) {
                $tipeVessel[] = $value['tipe_vessel'];
            }
            $loadingPointRaw = $this->wb_m->getLoadingPoint($getTanggalDashboard);
            foreach ($loadingPointRaw as $key => $value) {
                $loadingPoint[] = $value['loadingPoint'];
            }
            $rawSingle[0] = $this->wb_m->getMonitoringProduksi($getTanggalDashboard);
            $rawSingle[1] = $this->wb_m->getRitasiProduksi1($getTanggalDashboard);
            $rawSingle[2] = $this->wb_m->getRitasiProduksi2($getTanggalDashboard);
            $rawMulti[0] = $this->wb_m->getAverageMuatanPerLokasi($getTanggalDashboard);
            $rawMulti[1] = $this->wb_m->getAverageMuatanPerTipevessel($getTanggalDashboard);

            for ($i = 0; $i < count($tipeVessel); $i++) {
                $rawMulti[2][$i] = $this->wb_m->getAverageMuatanPerTipeVesselRawCoal($getTanggalDashboard, $tipeVessel[$i]);
                $rawMulti[3][$i] = $this->wb_m->getAverageMuatanPerTipeVesselCrushCoal($getTanggalDashboard, $tipeVessel[$i]);
                $rawMulti[4][$i] = $this->wb_m->getTotalTripPerTipeVesselRawCoal($getTanggalDashboard, $tipeVessel[$i]);
                $rawMulti[5][$i] = $this->wb_m->getTotalTripPerTipeVesselCrushCoal($getTanggalDashboard, $tipeVessel[$i]);
            }
            for ($i = 0; $i < count($loadingPoint); $i++) {
                $rawMulti[6][$i] = $this->wb_m->getTripPerLokasi($getTanggalDashboard, $loadingPoint[$i]);
                $rawMulti[7][$i] = $this->wb_m->getUnderloadPerLokasi($getTanggalDashboard, $loadingPoint[$i]);
                $rawMulti[8][$i] = $this->wb_m->getTotalTonKmPerLokasi($getTanggalDashboard, $loadingPoint[$i]);
            }
            foreach ($forecast as $key => $value) {
                $dataInsertColumn[] = $key;
                $dataInsertValue[] = $value;
                $dataInsertDate[] = $getTanggalDashboard;
            }
            for ($i = 0; $i < 3; $i++) {
                foreach ($rawSingle[$i][0] as $key => $value) {
                    $dataInsertColumn[] = $key;
                    $dataInsertValue[] = $value;
                    $dataInsertDate[] = $getTanggalDashboard;
                }
            }
            for ($i = 0; $i < 2; $i++) {
                foreach ($rawMulti[$i] as $key => $value) {
                    foreach ($value as $key2 => $value2) {
                        $dataInsertColumn[] = $key2 . "$key";
                        $dataInsertValue[] = $value2;
                        $dataInsertDate[] = $getTanggalDashboard;
                    }
                }
            }
            for ($a = 2; $a < 6; $a++) {
                for ($i = 0; $i < count($tipeVessel); $i++) {
                    foreach ($rawMulti[$a][$i] as $key => $value) {
                        foreach ($value as $key2 => $value2) {
                            $dataInsertColumn[] = $key2 . "$i";
                            $dataInsertValue[] = $value2;
                            $dataInsertDate[] = $getTanggalDashboard;
                        }
                    }
                }
            }
            for ($a = 6; $a < 9; $a++) {
                for ($i = 0; $i < count($loadingPoint); $i++) {
                    foreach ($rawMulti[$a][$i] as $key => $value) {
                        foreach ($value as $key2 => $value2) {
                            $dataInsertColumn[] = $key2 . "$i";
                            $dataInsertValue[] = $value2;
                            $dataInsertDate[] = $getTanggalDashboard;
                        }
                    }
                }
            }
            foreach ($tipeVesselRaw as $key => $value) {
                $dataInsertColumn[] = 'getTipeVessel' . $key;
                $dataInsertValue[] = $value['tipe_vessel'];
                $dataInsertDate[] = $getTanggalDashboard;
            }
            foreach ($loadingPointRaw as $key => $value) {
                $dataInsertColumn[] = 'getTipeLoading' . $key;
                $dataInsertValue[] = $value['loadingPoint'];
                $dataInsertDate[] = $getTanggalDashboard;
            }
            foreach ($dataInsertColumn as $key => $dataInsert) {
                $dataArray[] = array(
                    'dashboardIndexName' => $dataInsert,
                    'dashboardIndexValue' => $dataInsertValue[$key],
                    'dashboardDateValue' => $dataInsertDate[$key],
                );
            }
            // print_r($dataInsertColumn);
            // die();
            $this->db->where('dashboardDateValue', $getTanggalDashboard);
            $this->db->delete('tbl_dashboard');

            $this->db->insert_batch('tbl_dashboard', $dataArray);
        }
        echo json_encode($temp);
    }
    public function check()
    {
        $data['year'] = $this->wb_m->getTahunTerupdate()->year;
        $data['yearAll'] = $this->wb_m->getAllTahun();
        $this->load->view('weighbridge/checkData', $data);
    }
    public function ajaxData()
    {
        $year = $this->input->post('select');
        if ($year) {
            $ChartBulanan = $this->wb_m->chartBulanan($year);
            if ($ChartBulanan) {
                foreach ($ChartBulanan as $key => $value) {
                    $json['ChartBulananBulan'][] = $value['month'];
                    $json['ChartBulananTon'][] = $value['sum'];
                }
                echo json_encode($json);
            } else {
                echo "false";
            }
        } else {
            $year = $this->wb_m->getTahunTerupdate()->year;
            $ChartBulanan = $this->wb_m->chartBulanan($year);
            if ($ChartBulanan) {
                foreach ($ChartBulanan as $key => $value) {
                    $json['ChartBulananBulan'][] = $value['month'];
                    $json['ChartBulananTon'][] = $value['sum'];
                }
                echo json_encode($json);
            } else {
                echo "false";
            }
        }
    }
}
/* End of file Dashboard.php and path \application\controllers\Dashboard.php */
