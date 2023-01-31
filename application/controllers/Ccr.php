<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Ccr extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ccr_model', 'ccr_m');
        $this->load->library('Mcarbon');
    }
    public function loadAjaxHandson()
    {


        if ($this->input->get('tahun')) {
            $data['tahun'] = $this->input->get('tahun');
            $data['data'] = $this->ccr_m->ccr_hanson($data);
            $handson_data = array();
            foreach ($data['data'] as $key => $wb) {
                $temp = array();
                foreach ($wb as $key2 => $wb_value) {
                    if ($key2 == "id") {
                        continue;
                    } else {
                        $temp[] = '"' . $wb_value . '"';
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
        $tahunAll = $this->ccr_m->getTahun();
        if (isset($tahunAll)) {
            $tahunTambah = end($tahunAll)['tahun'] + 1;
            $tahunTambahModif['tahun'] = $tahunTambah;
        }
        array_push($tahunAll, $tahunTambahModif);
        // for ($i = 0; $i <= count($tahunAll) - 1; $i++) {
        // }
        $data['tahunAll'] =  $tahunAll;
        $this->load->view('ccr/handson', $data);
    }
    public function ajaxHandson()
    {
        $data = (array) json_decode(file_get_contents('php://input'), true);
        $data = $data['data'];
        $temp['result'] = $this->ccr_m->update_handson($data);
       
        echo json_encode($temp);
        // $data[0][5];
    }
}
        
    /* End of file  ccr.php */
