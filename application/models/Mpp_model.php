<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mpp_model extends CI_Model
{

    //SP
    public function getListSanksi()
    {
        $query = $this->db->query("SELECT jenis FROM tbl_jenis_sp");
        return $query->result_array();
    }
    public function getYearUpdateSanksi()
    {
        $query = $this->db->query("SELECT YEAR(tanggal) AS tahunUpdate FROM tbl_sanksi_sp_operator ORDER BY tanggal DESC LIMIT 1");
        return $query->result_array();
    }
    public function getAllistSanksi($tanggalUpdate)
    {
        $query = $this->db->query("SELECT *,tbl_sanksi_sp_operator.nik as nikSP,jabatan,departemen FROM tbl_sanksi_sp_operator 
        LEFT JOIN tbl_karyawan_sanksi ON tbl_sanksi_sp_operator.nik = tbl_karyawan_sanksi.nik
        WHERE YEAR(tanggal) LIKE '$tanggalUpdate' ");
        return $query->result_array();
    }
    public function getAlllistTahun($tanggalUpdate)
    {
        $query = $this->db->query("SELECT DISTINCT(YEAR(tanggal)) AS tahunList  FROM tbl_sanksi_sp_operator WHERE YEAR(tanggal) NOT LIKE '$tanggalUpdate' ");
        return $query->result_array();
    }

    //konseling

    public function getYearUpdateKonseling()
    {
        $query = $this->db->query("SELECT YEAR(tanggal) AS tahunUpdate FROM tbl_konseling_operator ORDER BY id DESC LIMIT 1");
        return $query->result_array();
    }
    public function getAlllistTahunKonseling($tanggalUpdate)
    {
        $query = $this->db->query("SELECT DISTINCT(YEAR(tanggal)) AS tahunList  FROM tbl_konseling_operator WHERE YEAR(tanggal) NOT LIKE '$tanggalUpdate' ");
        return $query->result_array();
    }
    public function getAllistKonseling($tanggalUpdate)
    {
        $query = $this->db->query("SELECT *,tbl_konseling_operator.nik as nikSP,jabatan,departemen FROM tbl_konseling_operator 
        LEFT JOIN tbl_karyawan_sanksi ON tbl_konseling_operator.nik = tbl_karyawan_sanksi.nik
        WHERE YEAR(tanggal) LIKE '$tanggalUpdate' ");
        return $query->result_array();
    }
}


/* End of file Mpp_model.php and path \application\models\Mpp_model.php */
