<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dispatch extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dispatch_model', 'dis_m');
    }

    public function index()
    {
        $this->load->view('dispatch/monitoring');
    }

    public function loadAjaxHandsonKm6()
    {
        if ($this->input->get('date')) {
            $data['date'] = $this->input->get('date');
            $data['data'] = $this->dis_m->wb_hansonKm6($data);
            $handson_data = array();
            foreach ($data['data'] as $key => $wb) {
                $temp = array();
                foreach ($wb as $key2 => $wb_value) {
                    if ($key2 == "id_dispatch") {
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

        $this->load->view('dispatch/handsonKm6', $data);
    }
    public function ajaxHandsonKm6()
    {
        $data = (array) json_decode(file_get_contents('php://input'), true);
        $data = $data['data'];
        $temp['result'] = $this->dis_m->update_handsonKm6($data);
        echo json_encode($temp);
    }

    public function loadAjaxHandsonKm38()
    {
        if ($this->input->get('date')) {
            $data['date'] = $this->input->get('date');
            $data['data'] = $this->dis_m->wb_hansonKm38($data);
            $handson_data = array();
            foreach ($data['data'] as $key => $wb) {
                $temp = array();
                foreach ($wb as $key2 => $wb_value) {
                    if ($key2 == "id_dispatch") {
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

        $this->load->view('dispatch/handsonKm38', $data);
    }
    public function ajaxHandsonKm38()
    {
        $data = (array) json_decode(file_get_contents('php://input'), true);
        $data = $data['data'];
        $temp['result'] = $this->dis_m->update_handsonKm38($data);
        echo json_encode($temp);
    }
}
        
    /* End of file  Dispatch.php */
