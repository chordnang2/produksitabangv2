<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library(['form_validation', 'session']);
        $this->load->database();
    }

    public function login()
    {

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/login');
        } else {

            $nama = $this->input->post('nama');
            $password = $this->input->post('password');
            $user = $this->db->get_where('tbl_user', ['nama' => $nama])->row();

            if (!$user) {
                $this->session->set_flashdata('login_error', 'Pastikan nama dan password benar!', 300);
                redirect(uri_string());
            }


            if (!password_verify($password, $user->password)) {
                $this->session->set_flashdata('login_error', 'Pastikan nama dan password benar!', 300);
                redirect(uri_string());
            }

            $data = array(
                'nama' => $user->nama,
            );


            $this->session->set_userdata($data);
            $namaUser = $data['nama'];

            if ($namaUser == 'timbangan') {
                redirect('weighbridge/formAjaxHandson');
            }
            if ($namaUser == 'ccradmin') {
                redirect('dashboard');
            }
            if ($namaUser == 'mpp') {
                redirect('mpp/sanksiSpView');
            }
            // echo 'Login sukses!';
            // exit;
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('user/login');
    }
}
    /* End of file  User.php */
