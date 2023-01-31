<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Weighbridge_model extends CI_Model
{

    private $tableWeighbridge = 'tbl_wb2';
    public function wb_hanson($data = null, $limit = null, $not = null, $order = null)
    {
        $condition = '';
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $condition .= ' AND ' . $key . " LIKE '$value'";
            }
            if (!empty($not)) {
                $not = string_esc($not);
                foreach ($not as $key => $value) {
                    $condition .= ' AND ' . $key . " NOT LIKE '$value'";
                }
            }
            if (!empty($limit)) {
                $limit = " LIMIT $limit";
            }
            if (empty($order)) {
                $order = " ORDER BY id_wb ASC";
            } else {
                $order = " ORDER BY" . $order;
            }
            $sql = "SELECT * FROM $this->tableWeighbridge WHERE 1=1 $condition $order $limit";
            $model = $this->db->query($sql);
            $model = $model->result_array();
            return $model;
        }
    }
    public function update_handson($data)
    {

        $column = ["shift", "no_unit", "tipe_vessel", "loading_point", "type", "weighbridge", "no_transaction", "gross", "tare", "nett", "time_in", "time_out", "tipping", "remaks", "target", "precentage", "loss_weight", "keterangan", "status", "date"];
        $final_data = array();
        // $final_data = str_replace(".", "", $final_data);
        $data_complete = 1;
        foreach ($data as $key => $detail_data) {
            if (!$detail_data[count($column) - 1]) {
                $data_complete = 0;
                break;
            }
            foreach ($detail_data as $key2 => $value) {
                $final_data[$key][] = "'" . $this->db->escape_str($value) . "'";
            }
        }
        if ($data_complete == 1) {
            $insert_column = "(" . implode(",", $column) . ")";
            $insert_sql = array();
            foreach ($final_data as $key => $value) {
                $value_dalam = "(" . implode(",", str_replace(",", "", $value)) . ")";
                $insert_sql[] = "INSERT INTO $this->tableWeighbridge $insert_column VALUES $value_dalam";
            }
            $value_date = $data[0][19];
            $this->db->trans_start();
            $delete_query = "DELETE FROM $this->tableWeighbridge WHERE date LIKE '$value_date'";
            $this->db->query($delete_query);
            foreach ($insert_sql as $key => $value) {
                $this->db->query($value);
            }
            $this->db->trans_complete();
            return "ok";
        } else
            return "error";
    }
    public function getTahunTerupdate()
    {

        $query = $this->db->query("SELECT DATE_FORMAT(date, '%Y') as 'year'  FROM $this->tableWeighbridge ORDER BY id_wb DESC LIMIT 1");
        return $query->row();
    }
    public function getAllTahun()
    {

        $query = $this->db->query("SELECT DATE_FORMAT(date, '%Y') as 'year'  FROM $this->tableWeighbridge WHERE date !='' GROUP BY DATE_FORMAT(date, '%Y')   ORDER BY id_wb DESC");
        return $query->result_array();
    }

    public function chartBulanan($year)
    {
        $query = $this->db->query("SELECT ROUND(sum(nett)/1000) as sum, DATE_FORMAT(date, '%m') as month2 , DATE_FORMAT(date, '%M') as month FROM $this->tableWeighbridge WHERE nett IS NOT NULL and date is NOT NULL and  DATE_FORMAT(date, '%Y')='$year' group by month order by month2 ASC");
        return $query->result_array();
    }


    public function getTanggalUpdateWb()
    {
        $query = $this->db->query("SELECT max(date) as maxDate,MONTH(max(date)) as maxMonth FROM tbl_wb2 LIMIT 1");
        return $query->result_array();
    }


    //Forecast
    public function getDailyActual($getTanggalDashboard)
    {
        $query = $this->db->query("SELECT SUM(nett) as dailyActualNett FROM tbl_wb2 WHERE  tbl_wb2.date LIKE '$getTanggalDashboard' AND status LIKE 'COMPLETE'");
        return $query->result_array();
    }
    public function getDailyPlan($getBulanDashboard, $getTahunDashboard)
    {
        $query = $this->db->query("SELECT target_kontrak_bulanan/(jumlah_hari - day_off + forecast_produksi.suspend) AS dailyPlanNett FROM forecast_produksi WHERE bulan LIKE '$getBulanDashboard' AND tahun LIKE '$getTahunDashboard'");
        return $query->result_array();
    }

    public function getMonthlyActual($getBulanDashboard, $getTahunDashboard)
    {
        $query = $this->db->query("SELECT SUM(nett)/1000 as monthlyActualNett FROM tbl_wb2 WHERE  MONTH(tbl_wb2.date) LIKE '$getBulanDashboard'  AND YEAR(tbl_wb2.date) LIKE '$getTahunDashboard' AND status LIKE 'COMPLETE'");
        return $query->result_array();
    }
    public function getMonthlyPlan($getBulanDashboard, $getTahunDashboard)
    {
        $query = $this->db->query("SELECT target_kontrak_bulanan AS monthlyPlanNett,target_kontrak_bulanan/jumlah_hari as targetHarian FROM forecast_produksi WHERE bulan LIKE '$getBulanDashboard' AND tahun LIKE '$getTahunDashboard'");
        return $query->result_array();
    }


    public function getYearlyActual($getTahunDashboard)
    {
        $query = $this->db->query("SELECT SUM(nett)/1000 as yearlyActualNett FROM tbl_wb2 WHERE   YEAR(tbl_wb2.date) LIKE '$getTahunDashboard' AND status LIKE 'COMPLETE'");
        return $query->result_array();
    }
    public function getYearlyPlan($getTahunDashboard)
    {
        $query = $this->db->query("SELECT sum(target_kontrak_bulanan) AS yearlyPlanNett FROM forecast_produksi WHERE tahun LIKE '$getTahunDashboard'");
        return $query->result_array();
    }
    public function getYtdSumNettAllMonthBefore($monthsImplode, $getTahunDashboard)
    {
        $query = $this->db->query("SELECT sum(target_kontrak_bulanan) AS yearlyPlanNett FROM forecast_produksi WHERE tahun LIKE '$getTahunDashboard' AND bulan in ($monthsImplode)");
        return $query->result_array();
    }

    //monitoring produksi

    public function getMonitoringProduksi($getTanggalDashboard)
    {
        $query = $this->db->query("SELECT
        ROUND(SUM(IF(HOUR(time_out)=7 , nett, 0))/1000) nettRaw7,
        ROUND(SUM(IF(HOUR(time_out) BETWEEN 7 AND 8 , nett, 0))/1000) nettRaw8,
        ROUND(SUM(IF(HOUR(time_out) BETWEEN 7 AND 9 , nett, 0))/1000) nettRaw9,
        ROUND(SUM(IF(HOUR(time_out) BETWEEN 7 AND 10 , nett, 0))/1000) nettRaw10,
        ROUND(SUM(IF(HOUR(time_out) BETWEEN 7 AND 11 , nett, 0))/1000) nettRaw11,
        ROUND(SUM(IF(HOUR(time_out) BETWEEN 7 AND 12 , nett, 0))/1000) nettRaw12,
        ROUND(SUM(IF(HOUR(time_out) BETWEEN 7 AND 13 , nett, 0))/1000) nettRaw13,
        ROUND(SUM(IF(HOUR(time_out) BETWEEN 7 AND 14 , nett, 0))/1000) nettRaw14,
        ROUND(SUM(IF(HOUR(time_out) BETWEEN 7 AND 15 , nett, 0))/1000) nettRaw15,
        ROUND(SUM(IF(HOUR(time_out) BETWEEN 7 AND 16 , nett, 0))/1000) nettRaw16,
        ROUND(SUM(IF(HOUR(time_out) BETWEEN 7 AND 17 , nett, 0))/1000) nettRaw17,
        ROUND(SUM(IF(HOUR(time_out) BETWEEN 7 AND 18 , nett, 0))/1000) nettRaw18,
        ROUND(SUM(IF(HOUR(time_out) = 19 , nett, 0))/1000) nettRaw19,
        ROUND(SUM(IF(HOUR(time_out) BETWEEN 19 AND 20 , nett, 0))/1000) nettRaw20,
        ROUND(SUM(IF(HOUR(time_out) BETWEEN 19 AND 21 , nett, 0))/1000) nettRaw21,
        ROUND(SUM(IF(HOUR(time_out) BETWEEN 19 AND 22 , nett, 0))/1000) nettRaw22,
        ROUND(SUM(IF(HOUR(time_out) BETWEEN 19 AND 23 , nett, 0))/1000) nettRaw23,
        ROUND((SUM(IF(HOUR(time_out) BETWEEN 19 AND 23 , nett, 0))+ SUM(IF(HOUR(time_out) = 00 , nett, 0)))/1000) nettRaw0,
        ROUND((SUM(IF(HOUR(time_out) BETWEEN 19 AND 23 , nett, 0))+ SUM(IF(HOUR(time_out) BETWEEN 00 AND 01 , nett, 0)))/1000) nettRaw1,
        ROUND((SUM(IF(HOUR(time_out) BETWEEN 19 AND 23 , nett, 0))+ SUM(IF(HOUR(time_out) BETWEEN 00 AND 02 , nett, 0)))/1000) nettRaw2,
        ROUND((SUM(IF(HOUR(time_out) BETWEEN 19 AND 23 , nett, 0))+ SUM(IF(HOUR(time_out) BETWEEN 00 AND 03 , nett, 0)))/1000) nettRaw3,
        ROUND((SUM(IF(HOUR(time_out) BETWEEN 19 AND 23 , nett, 0))+ SUM(IF(HOUR(time_out) BETWEEN 00 AND 04 , nett, 0)))/1000) nettRaw4,
        ROUND((SUM(IF(HOUR(time_out) BETWEEN 19 AND 23 , nett, 0))+ SUM(IF(HOUR(time_out) BETWEEN 00 AND 05 , nett, 0)))/1000) nettRaw5,
        ROUND((SUM(IF(HOUR(time_out) BETWEEN 19 AND 23 , nett, 0))+ SUM(IF(HOUR(time_out) BETWEEN 00 AND 06 , nett, 0)))/1000) nettRaw6,
        ROUND(SUM(IF(HOUR(time_out) BETWEEN 7 AND 19 , nett/1000, 0))) nettTotal7Ke19,
        ROUND(SUM(IF(HOUR(time_out) BETWEEN 7 AND 20 , nett/1000, 0))  ) nettTotal7Ke20,
        ROUND(SUM(IF(HOUR(time_out) BETWEEN 7 AND 21 , nett/1000, 0)) ) nettTotal7Ke21,
        ROUND(SUM(IF(HOUR(time_out) BETWEEN 7 AND 22 , nett/1000, 0)) ) nettTotal7Ke22,
        ROUND(SUM(IF(HOUR(time_out) BETWEEN 7 AND 23 , nett/1000, 0)) ) nettTotal7Ke23,
        ROUND(SUM(IF(HOUR(time_out) BETWEEN 7 AND 23 , nett/1000, 0)) + SUM(IF(HOUR(time_out) = 00 , nett/1000, 0) )) nettTotal7Ke0,
        ROUND(SUM(IF(HOUR(time_out) BETWEEN 7 AND 23 , nett/1000, 0)) + SUM(IF(HOUR(time_out) BETWEEN 00 AND 01 , nett/1000, 0))) nettTotal7Ke1,
        ROUND(SUM(IF(HOUR(time_out) BETWEEN 7 AND 23 , nett/1000, 0)) + SUM(IF(HOUR(time_out) BETWEEN 00 AND 02 , nett/1000, 0))) nettTotal7Ke2,
        ROUND(SUM(IF(HOUR(time_out) BETWEEN 7 AND 23 , nett/1000, 0)) + SUM(IF(HOUR(time_out) BETWEEN 00 AND 03 , nett/1000, 0))) nettTotal7Ke3,
        ROUND(SUM(IF(HOUR(time_out) BETWEEN 7 AND 23 , nett/1000, 0)) + SUM(IF(HOUR(time_out) BETWEEN 00 AND 04 , nett/1000, 0))) nettTotal7Ke4,
        ROUND(SUM(IF(HOUR(time_out) BETWEEN 7 AND 23 , nett/1000, 0)) + SUM(IF(HOUR(time_out) BETWEEN 00 AND 05 , nett/1000, 0))) nettTotal7Ke5,
        ROUND(SUM(IF(HOUR(time_out) BETWEEN 7 AND 23 , nett/1000, 0)) + SUM(IF(HOUR(time_out) BETWEEN 00 AND 06 , nett/1000, 0))) nettTotal7Ke6
        FROM tbl_wb2 WHERE date = '$getTanggalDashboard'
    ");
        return $query->result_array();
    }

    public function getRitasiProduksi1($getTanggalDashboard)
    {
        $query = $this->db->query("SELECT temp.*, ROUND(
            (temp.no_dist_7/temp.dist_7),2) avg_7, 
            ROUND((temp.no_dist_8/temp.dist_8),2) avg_8,
            ROUND((temp.no_dist_9/temp.dist_9),2) avg_9,
            ROUND((temp.no_dist_10/temp.dist_10),2) avg_10,
            ROUND((temp.no_dist_11/temp.dist_11),2) avg_11,
            ROUND((temp.no_dist_12/temp.dist_12),2) avg_12,
            ROUND((temp.no_dist_13/temp.dist_13),2) avg_13,
            ROUND((temp.no_dist_14/temp.dist_14),2) avg_14,
            ROUND((temp.no_dist_15/temp.dist_15),2) avg_15,
            ROUND((temp.no_dist_16/temp.dist_16),2) avg_16,
            ROUND((temp.no_dist_17/temp.dist_17),2) avg_17,
            ROUND((temp.no_dist_18/temp.dist_18),2) avg_18,
            ROUND((temp.no_dist_19/temp.dist_19),2) avg_19,
            ROUND((temp.no_dist_20/temp.dist_20),2) avg_20,
            ROUND((temp.no_dist_21/temp.dist_21),2) avg_21,
            ROUND((temp.no_dist_22/temp.dist_22),2) avg_22,
            ROUND((temp.no_dist_23/temp.dist_23),2) avg_23
            FROM ( SELECT 
                    COUNT(DISTINCT IF(HOUR(time_out) BETWEEN '7'AND '7', no_unit, NULL)) dist_7, COUNT(IF(HOUR(time_out) BETWEEN '7'AND '7', no_unit, NULL)) no_dist_7,
                    COUNT(DISTINCT IF(HOUR(time_out) BETWEEN '7'AND '8', no_unit, NULL)) dist_8, COUNT(IF(HOUR(time_out) BETWEEN '7'AND '8', no_unit, NULL)) no_dist_8,
                    COUNT(DISTINCT IF(HOUR(time_out) BETWEEN '7'AND '9', no_unit, NULL)) dist_9, COUNT(IF(HOUR(time_out) BETWEEN '7'AND '9', no_unit, NULL)) no_dist_9,
                    COUNT(DISTINCT IF(HOUR(time_out) BETWEEN '7'AND '10', no_unit, NULL)) dist_10, COUNT(IF(HOUR(time_out) BETWEEN '7'AND '10', no_unit, NULL)) no_dist_10,
                    COUNT(DISTINCT IF(HOUR(time_out) BETWEEN '7'AND '11', no_unit, NULL)) dist_11, COUNT(IF(HOUR(time_out) BETWEEN '7'AND '11', no_unit, NULL)) no_dist_11,
                    COUNT(DISTINCT IF(HOUR(time_out) BETWEEN '7'AND '12', no_unit, NULL)) dist_12, COUNT(IF(HOUR(time_out) BETWEEN '7'AND '12', no_unit, NULL)) no_dist_12,
                    COUNT(DISTINCT IF(HOUR(time_out) BETWEEN '7'AND '13', no_unit, NULL)) dist_13, COUNT(IF(HOUR(time_out) BETWEEN '7'AND '13', no_unit, NULL)) no_dist_13,
                    COUNT(DISTINCT IF(HOUR(time_out) BETWEEN '7'AND '14', no_unit, NULL)) dist_14, COUNT(IF(HOUR(time_out) BETWEEN '7'AND '14', no_unit, NULL)) no_dist_14,
                    COUNT(DISTINCT IF(HOUR(time_out) BETWEEN '7'AND '15', no_unit, NULL)) dist_15, COUNT(IF(HOUR(time_out) BETWEEN '7'AND '15', no_unit, NULL)) no_dist_15,
                    COUNT(DISTINCT IF(HOUR(time_out) BETWEEN '7'AND '16', no_unit, NULL)) dist_16, COUNT(IF(HOUR(time_out) BETWEEN '7'AND '16', no_unit, NULL)) no_dist_16,
                    COUNT(DISTINCT IF(HOUR(time_out) BETWEEN '7'AND '17', no_unit, NULL)) dist_17, COUNT(IF(HOUR(time_out) BETWEEN '7'AND '17', no_unit, NULL)) no_dist_17,
                    COUNT(DISTINCT IF(HOUR(time_out) BETWEEN '7'AND '18', no_unit, NULL)) dist_18, COUNT(IF(HOUR(time_out) BETWEEN '7'AND '18', no_unit, NULL)) no_dist_18,
                    COUNT(DISTINCT IF(HOUR(time_out) BETWEEN '19'AND '19', no_unit, NULL)) dist_19, COUNT(IF(HOUR(time_out) BETWEEN '19'AND '19', no_unit, NULL)) no_dist_19,
                    COUNT(DISTINCT IF(HOUR(time_out) BETWEEN '19'AND '20', no_unit, NULL)) dist_20, COUNT(IF(HOUR(time_out) BETWEEN '19'AND '20', no_unit, NULL)) no_dist_20,
                    COUNT(DISTINCT IF(HOUR(time_out) BETWEEN '19'AND '21', no_unit, NULL)) dist_21, COUNT(IF(HOUR(time_out) BETWEEN '19'AND '21', no_unit, NULL)) no_dist_21,
                    COUNT(DISTINCT IF(HOUR(time_out) BETWEEN '19'AND '22', no_unit, NULL)) dist_22, COUNT(IF(HOUR(time_out) BETWEEN '19'AND '22', no_unit, NULL)) no_dist_22,
                    COUNT(DISTINCT IF(HOUR(time_out) BETWEEN '19'AND '23', no_unit, NULL)) dist_23, COUNT(IF(HOUR(time_out) BETWEEN '19'AND '23', no_unit, NULL)) no_dist_23
                    FROM tbl_wb2
                    WHERE date = '$getTanggalDashboard'
                ) as temp;");
        return $query->result_array();
    }
    public function getRitasiProduksi2($getTanggalDashboard)
    {
        $query = $this->db->query("SELECT temp.*, 
        ROUND((temp_no_dist_0+no_dist_19),2) no_dist_0,ROUND(((temp_no_dist_0+no_dist_19)/dist_0),2) avg_0,
        ROUND((temp_no_dist_1+no_dist_19),2) no_dist_1,ROUND(((temp_no_dist_1+no_dist_19)/dist_1),2) avg_1,
        ROUND((temp_no_dist_2+no_dist_19),2) no_dist_2,ROUND(((temp_no_dist_2+no_dist_19)/dist_2),2) avg_2,
        ROUND((temp_no_dist_3+no_dist_19),2) no_dist_3,ROUND(((temp_no_dist_3+no_dist_19)/dist_3),2) avg_3,
        ROUND((temp_no_dist_4+no_dist_19),2) no_dist_4,ROUND(((temp_no_dist_4+no_dist_19)/dist_4),2) avg_4,
        ROUND((temp_no_dist_5+no_dist_19),2) no_dist_5,ROUND(((temp_no_dist_5+no_dist_19)/dist_5),2) avg_5,
        ROUND((temp_no_dist_6+no_dist_19),2) no_dist_6,ROUND(((temp_no_dist_6+no_dist_19)/dist_6),2) avg_6
        FROM ( SELECT 
                COUNT(DISTINCT IF(HOUR(time_out) BETWEEN 19 AND 23 OR HOUR(time_out) BETWEEN 0 and 0, no_unit, NULL)) dist_0, COUNT(IF(HOUR(time_out) BETWEEN 19 AND 23, no_unit, NULL)) no_dist_19,COUNT(IF(HOUR(time_out) BETWEEN 0 AND 0, no_unit, NULL)) temp_no_dist_0,
                COUNT(DISTINCT IF(HOUR(time_out) BETWEEN 19 AND 23 OR HOUR(time_out) BETWEEN 0 and 1, no_unit, NULL)) dist_1,COUNT(IF(HOUR(time_out) BETWEEN 0 AND 1, no_unit, NULL)) temp_no_dist_1,
                COUNT(DISTINCT IF(HOUR(time_out) BETWEEN 19 AND 23 OR HOUR(time_out) BETWEEN 0 and 2, no_unit, NULL)) dist_2,COUNT(IF(HOUR(time_out) BETWEEN 0 AND 2, no_unit, NULL)) temp_no_dist_2,
                COUNT(DISTINCT IF(HOUR(time_out) BETWEEN 19 AND 23 OR HOUR(time_out) BETWEEN 0 and 3, no_unit, NULL)) dist_3,COUNT(IF(HOUR(time_out) BETWEEN 0 AND 3, no_unit, NULL)) temp_no_dist_3,
                COUNT(DISTINCT IF(HOUR(time_out) BETWEEN 19 AND 23 OR HOUR(time_out) BETWEEN 0 and 4, no_unit, NULL)) dist_4,COUNT(IF(HOUR(time_out) BETWEEN 0 AND 4, no_unit, NULL)) temp_no_dist_4,
                COUNT(DISTINCT IF(HOUR(time_out) BETWEEN 19 AND 23 OR HOUR(time_out) BETWEEN 0 and 5, no_unit, NULL)) dist_5,COUNT(IF(HOUR(time_out) BETWEEN 0 AND 5, no_unit, NULL)) temp_no_dist_5,
                COUNT(DISTINCT IF(HOUR(time_out) BETWEEN 19 AND 23 OR HOUR(time_out) BETWEEN 0 and 6, no_unit, NULL)) dist_6,COUNT(IF(HOUR(time_out) BETWEEN 0 AND 6, no_unit, NULL)) temp_no_dist_6

                FROM tbl_wb2
                WHERE date = '$getTanggalDashboard'
            ) as temp;");
        return $query->result_array();
    }

    public function getAverageMuatanPerLokasi($getTanggalDashboard)
    {
        $query = $this->db->query("SELECT ROUND(AVG(nett)/1000,1) as perLokasiAverageMuatan,nett as perLokasinett,loading_point as perLokasiLoadingPoint ,no_unit as perLokasiNoUnit,nama_lokasi as perLokasiNamaLokasi
        FROM tbl_wb2 LEFT JOIN tbl_km_lokasi ON nama_lokasi = loading_point WHERE DATE = '$getTanggalDashboard' group by loading_point order by perLokasiAverageMuatan ASC  ");
        return $query->result_array();
    }
    public function getAverageMuatanPerTipevessel($getTanggalDashboard)
    {
        $query = $this->db->query("SELECT ROUND(AVG(nett)/1000,1) as perTipeVesselAverageMuatan,nett as perTipeVesselNett,tipe_vessel as perTipeVesselTipeVessel ,no_unit as perTipeVesselNoUnit,nama_lokasi as perTipeVesselNamaLokasi
        FROM tbl_wb2 LEFT JOIN tbl_km_lokasi ON nama_lokasi = loading_point WHERE DATE = '$getTanggalDashboard' group by tipe_vessel order by perTipeVesselAverageMuatan ASC  ");
        return $query->result_array();
    }

    public function getTipeVessel()
    {
        $query = $this->db->query("SELECT tipe_vessel FROM tbl_wb2 WHERE DATE = '2022-12-21' GROUP BY tipe_vessel ORDER BY tipe_vessel ASC");
        return $query->result_array();
    }

    public function getAverageMuatanPerTipeVesselRawCoal($getTanggalDashboard, $tipeVessel)
    {
        $query = $this->db->query("SELECT  IF(ROUND(AVG(nett)/1000,1), nett, 0)AS averageMuatanRawCoal FROM tbl_wb2 WHERE tipe_vessel LIKE '$tipeVessel' AND DATE LIKE '$getTanggalDashboard' AND `type` LIKE 'RAW COAL' ");
        return $query->result_array();
    }

    public function getAverageMuatanPerTipeVesselCrushCoal($getTanggalDashboard, $tipeVessel)
    {
        $query = $this->db->query("SELECT  IF(ROUND(AVG(nett)/1000,1), nett, 0)AS averageMuatanCrushCoal FROM tbl_wb2 WHERE tipe_vessel LIKE '$tipeVessel' AND DATE LIKE '$getTanggalDashboard' AND `type` LIKE 'CRUSH COAL'");
        return $query->result_array();
    }

    public function getTotalTripPerTipeVesselRawCoal($getTanggalDashboard, $tipeVessel)
    {
        $query = $this->db->query("SELECT  COUNT(IF(nett, 1, 0)) AS totalTripRawCoal FROM tbl_wb2 WHERE tipe_vessel LIKE '$tipeVessel' AND DATE LIKE '$getTanggalDashboard' AND `type` LIKE 'RAW COAL' ");
        return $query->result_array();
    }

    public function getTotalTripPerTipeVesselCrushCoal($getTanggalDashboard, $tipeVessel)
    {
        $query = $this->db->query("SELECT  COUNT(IF(nett, 1, 0)) AS totalTripCrushCoal FROM tbl_wb2 WHERE tipe_vessel LIKE '$tipeVessel' AND DATE LIKE '$getTanggalDashboard' AND `type` LIKE 'CRUSH COAL'");
        return $query->result_array();
    }


    // public function getTripPerLokasi($getTanggalDashboard)
    // {
    //     $query = $this->db->query("SELECT lokasi as lokasiTripPerLokasi,count(lokasi) as  countTripPerLokasi FROM (SELECT date as date,loading_point as lokasi 
    //     FROM `tbl_wb2`  
    //     ) a WHERE date='$getTanggalDashboard' GROUP BY a.lokasi;");
    //     return $query->result_array();
    // }
    // public function getUnderloadPerLokasi($getTanggalDashboard)
    // {
    //     $query = $this->db->query(" SELECT tbl_wb2.loading_point as lokasiUnderloadPerLokasi, COUNT(`no_transaction`) as countUnderloadPerLokasi FROM `tbl_wb2`   WHERE  date = '$getTanggalDashboard' AND keterangan='UNDERLOAD'  GROUP BY loading_point");
    //     return $query->result_array();
    // }
    // public function getTotalTonKmPerLokasi($getTanggalDashboard)
    // {
    //     $query = $this->db->query("SELECT sum(nett)/1000 as sumNettPerLokasi, COUNT(no_transaction)as countNettPerLokasi, tbl_km_lokasi.km as totalTonKmPerLokasi,`tbl_wb2`.loading_point as loadingPointTonKmPerLokasi,no_unit as noUnitTonKmPerLokasi
    //     FROM `tbl_wb2`LEFT JOIN `tbl_km_lokasi` ON `tbl_km_lokasi`.`nama_lokasi` = `tbl_wb2`.`loading_point` WHERE  date =  '$getTanggalDashboard'  GROUP BY loading_point");
    //     return $query->result_array();
    // }

    public function getLoadingPoint($getTanggalDashboard)
    {
        $query = $this->db->query("SELECT loading_point as loadingPoint  FROM `tbl_wb2` WHERE DATE='$getTanggalDashboard' GROUP BY loading_point");
        return $query->result_array();
    }

    public function getTripPerLokasi($getTanggalDashboard, $loadingPoint)
    {
        $query = $this->db->query("SELECT COUNT(IF(loading_point, 1, 0)) AS countTripLokasi FROM tbl_wb2 WHERE DATE='$getTanggalDashboard' AND loading_point = '$loadingPoint'");
        return $query->result_array();
    }
    public function getUnderloadPerLokasi($getTanggalDashboard, $loadingPoint)
    {
        $query = $this->db->query("SELECT COUNT(IF(loading_point, 1, 0)) AS countUnderloadPerLokasi FROM tbl_wb2 WHERE DATE='$getTanggalDashboard' AND loading_point = '$loadingPoint' AND keterangan='UNDERLOAD' ");
        return $query->result_array();
    }
    public function getTotalTonKmPerLokasi($getTanggalDashboard, $loadingPoint)
    {
        $query = $this->db->query("SELECT ROUND(IF(sum(nett)/1000, nett, 0),1) AS sumTotalTonKmPerLokasi FROM tbl_wb2 WHERE DATE ='$getTanggalDashboard' AND loading_point = '$loadingPoint'");
        return $query->result_array();
    }
}


/* End of file Weighbridge_model_model.php and path \application\models\Weighbridge_model_model.php */
