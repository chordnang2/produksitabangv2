<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dispatch_model extends CI_Model
{
    private $tableDispatch = 'tbl_dispatch_v2';
    public function wb_hansonKm6($data = null, $limit = null, $not = null, $order = null)
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
                $order = " ORDER BY id_dispatch ASC";
            } else {
                $order = " ORDER BY" . $order;
            }
            $sql = "SELECT * FROM $this->tableDispatch WHERE 1=1 $condition AND $this->tableDispatch.user LIKE 'dispatchKm6'  $order $limit";
            $model = $this->db->query($sql);
            $model = $model->result_array();
            return $model;
        }
    }
    public function update_handsonKm6($data)
    {

        $column = ["tbl_dispatch_v2.date", "shift", "no_unit", "problem", "activity", "preparation", "tbl_dispatch_v2.start", "tbl_dispatch_v2.out", "operation", "hm", "km", "location", "tbl_dispatch_v2.status", "tbl_dispatch_v2.user"];
        $final_data = array();
        // $final_data = str_replace(".", "", $final_data);
        $data_complete = 1;
        $userColumnData = 'dispatchKm6';
        for ($i = 0; $i <= count($data) - 1; $i++) {
            array_push($data[$i], $userColumnData);
        }

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
                $insert_sql[] = "INSERT INTO $this->tableDispatch $insert_column VALUES $value_dalam";
            }

            $value_date = $data[0][0];
            $this->db->trans_start();
            $delete_query = "DELETE FROM $this->tableDispatch WHERE date LIKE '$value_date' AND $this->tableDispatch.user LIKE 'dispatchKm6'";
            $this->db->query($delete_query);
            foreach ($insert_sql as $key => $value) {
                $this->db->query($value);
            }
            $this->db->trans_complete();
            return "ok";
        } else
            return "error";
    }
    public function wb_hansonKm38($data = null, $limit = null, $not = null, $order = null)
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
                $order = " ORDER BY id_dispatch ASC";
            } else {
                $order = " ORDER BY" . $order;
            }
            $sql = "SELECT * FROM $this->tableDispatch WHERE 1=1 $condition AND $this->tableDispatch.user LIKE 'dispatchKm38' $order $limit";
            $model = $this->db->query($sql);
            $model = $model->result_array();
            return $model;
        }
    }
    public function update_handsonKm38($data)
    {

        $column = ["tbl_dispatch_v2.date", "shift", "no_unit", "problem", "activity", "preparation", "tbl_dispatch_v2.start", "tbl_dispatch_v2.out", "operation", "hm", "km", "location", "tbl_dispatch_v2.status", "tbl_dispatch_v2.user"];
        $final_data = array();
        // $final_data = str_replace(".", "", $final_data);
        $data_complete = 1;
        $userColumnData = 'dispatchKm38';
        for ($i = 0; $i <= count($data) - 1; $i++) {
            array_push($data[$i], $userColumnData);
        }

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
                $insert_sql[] = "INSERT INTO $this->tableDispatch $insert_column VALUES $value_dalam";
            }

            $value_date = $data[0][0];
            $this->db->trans_start();
            $delete_query = "DELETE FROM $this->tableDispatch WHERE date LIKE '$value_date' AND $this->tableDispatch.user LIKE 'dispatchKm38' ";
            $this->db->query($delete_query);
            foreach ($insert_sql as $key => $value) {
                $this->db->query($value);
            }
            $this->db->trans_complete();
            return "ok";
        } else
            return "error";
    }
}


/* End of file Dispatch_model.php and path \application\models\Dispatch_model.php */
