<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ccr_model extends CI_Model
{
    private $tableForecast = 'forecast_produksi';
    public function ccr_hanson($data = null, $limit = null, $not = null, $order = null)
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
                $order = " ORDER BY id ASC";
            } else {
                $order = " ORDER BY" . $order;
            }
            $sql = "SELECT * FROM $this->tableForecast WHERE 1=1 $condition  $order $limit";
            $model = $this->db->query($sql);
            $model = $model->result_array();
            return $model;
        }
    }
    public function update_handson($data)
    {

        $column = ["bulan", "tahun", "jumlah_hari", "day_off", "suspend", "target_kontrak_bulanan", "lokasi"];
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
                $insert_sql[] = "INSERT INTO $this->tableForecast $insert_column VALUES $value_dalam";
            }

            $value_date = $data[0][1];
            $this->db->trans_start();
            $delete_query = "DELETE FROM $this->tableForecast WHERE tahun LIKE '$value_date'";
            $this->db->query($delete_query);
            foreach ($insert_sql as $key => $value) {
                $this->db->query($value);
            }
            $this->db->trans_complete();
            return "ok";
        } else
            return "error";
    }

    public function getTahun()
    {
        $query = $this->db->query("SELECT tahun FROM $this->tableForecast GROUP BY tahun");
        return $query->result_array();
    }

 
}


/* End of file Ccr_model.php and path \application\models\Ccr_model.php */
