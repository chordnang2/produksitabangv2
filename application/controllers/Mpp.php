<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mpp extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mpp_model', 'mpp_m');
        $this->load->library('Mcarbon');
    }
    public function sanksiSpView()
    {
        if (!empty($this->input->post('selectTahun'))) {

            $tahunUpdate = $this->input->post('selectTahun');
        } else {
            $tahunUpdate = $this->mpp_m->getYearUpdateSanksi()[0]['tahunUpdate'];
        }
        $data['tahunUpdate'] = $tahunUpdate;
        $data['getAlllistTahun'] = $this->mpp_m->getAlllistTahun($tahunUpdate);
        $data['getAllistSanksi'] = $this->mpp_m->getAllistSanksi($tahunUpdate);
        $data['title'] = 'Surat Peringatan';
        $this->load->view('mpp/sanksiSp/viewSp', $data);
    }
    public function sanksiSpAdd()
    {
        if (!empty($_POST)) {
            if ($this->input->post('lobang_kimper') == 'on') {
                $lobang_kimper = 'ya';
            } else {
                $lobang_kimper = 'tidak';
            }
            $dataInsert = array(
                "tanggal" => $this->input->post('tanggal'),
                "nik" => $this->input->post('nik'),
                "jenis_kejadian" => $this->input->post('jenis_kejadian'),
                "kejadian" => $this->input->post('kejadian'),
                "sanksi_sp" => $this->input->post('sanksi_sp'),
                "lobang_kimper" => $lobang_kimper,
                "sesuai_pp" => $this->input->post('sesuai_pp'),
                "bunyi_pasal" => $this->input->post('bunyi_pasal'),
                "startTanggalSanksi" => $this->input->post('startTanggalSanksi'),
                "endTanggalSanksi" => $this->input->post('endTanggalSanksi'),
                "diberikan_oleh" => $this->input->post('diberikan_oleh'),
                "sifat_surat" => $this->input->post('sifat_surat'),
            );
            $insertSp = $this->db->insert('tbl_sanksi_sp_operator', $dataInsert);
            if ($insertSp == 1) {
                $this->session->set_flashdata('sukses_sp', 'Berhasil menambah Data');
            } else {
                $this->session->set_flashdata('error_sp', 'Ups.. Error menambahkan data');
            }
            redirect("mpp/sanksiSpView");
        }
        $data['listJenisSanksi'] = $this->mpp_m->getListSanksi();
        $data['title'] = 'Surat Peringatan';
        $this->load->view('mpp/sanksiSp/addSp', $data);
    }
    public function sanksiSpEdit($id = null)
    {
        if (!empty($_POST)) {
            if ($this->input->post('lobang_kimper') == 'on') {
                $lobang_kimper = 'ya';
            } else {
                $lobang_kimper = 'tidak';
            }
            $dataInsert = array(
                "tanggal" => $this->input->post('tanggal'),
                "nik" => $this->input->post('nik'),
                "jenis_kejadian" => $this->input->post('jenis_kejadian'),
                "kejadian" => $this->input->post('kejadian'),
                "sanksi_sp" => $this->input->post('sanksi_sp'),
                "lobang_kimper" => $lobang_kimper,
                "sesuai_pp" => $this->input->post('sesuai_pp'),
                "bunyi_pasal" => $this->input->post('bunyi_pasal'),
                "startTanggalSanksi" => $this->input->post('startTanggalSanksi'),
                "endTanggalSanksi" => $this->input->post('endTanggalSanksi'),
                "diberikan_oleh" => $this->input->post('diberikan_oleh'),
                "sifat_surat" => $this->input->post('sifat_surat'),
            );
            $updateDataSp = $this->db->update('tbl_sanksi_sp_operator', $dataInsert, array('id' => $this->input->post('id')));
            if ($updateDataSp == 1) {
                $this->session->set_flashdata('sukses_sp', 'Berhasil Mengedit Data');
            } else {
                $this->session->set_flashdata('error_sp', 'Ups.. Error Mengedit data');
            }
            redirect("mpp/sanksiSpView");
        }
        if (!empty($id)) {
            $data['edit'] = $this->db->query("SELECT * FROM tbl_sanksi_sp_operator WHERE id LIKE '$id' ")->row_array();
        } else {
            redirect("mpp/sanksiSpView");
        }
        $data['listJenisSanksi'] = $this->mpp_m->getListSanksi();
        $data['title'] = 'Surat Peringatan';
        $this->load->view('mpp/sanksiSp/editSp', $data);
    }

    public function sanksiSpDelete($id = null)
    {
        $this->db->where('id', $id);
        $deleteDataSp = $this->db->delete('tbl_sanksi_sp_operator');

        if ($deleteDataSp == 1) {
            $this->session->set_flashdata('sukses_sp', 'Berhasil Menghapus Data');
        } else {
            $this->session->set_flashdata('error_sp', 'Ups.. Error Menghapus data');
        }
        redirect("mpp/sanksiSpView");
    }


    public function konselingView()
    {
        if (!empty($this->input->post('selectTahun'))) {

            $tahunUpdate = $this->input->post('selectTahun');
        } else {

            $tahunUpdate = $this->mpp_m->getYearUpdateKonseling()[0]['tahunUpdate'];
        }
        $data['tahunUpdate'] = $tahunUpdate;
        $data['getAlllistTahunKonseling'] = $this->mpp_m->getAlllistTahunKonseling($tahunUpdate);
        $data['getAllistKonseling'] = $this->mpp_m->getAllistKonseling($tahunUpdate);
        $data['title'] = 'Konseling';
        $this->load->view('mpp/konseling/viewKonseling', $data);
    }

    public function konselingAdd()
    {
        if (!empty($_POST)) {
            $dataInsert = array(
                "nik" => $this->input->post('nik'),
                "jenis_konseling" => $this->input->post('jenis_konseling'),
                "isu_permasalahan" => $this->input->post('isu_permasalahan'),
                "tanggapan" => $this->input->post('tanggapan'),
                "tindakan" => $this->input->post('tindakan'),
                "tanggal" => $this->input->post('tanggal'),
                "saksi1" => $this->input->post('saksi1'),
                "saksi2" => $this->input->post('saksi2'),
                "diberikan_oleh" => $this->input->post('diberikan_oleh'),
                "sanksi" => $this->input->post('sanksi'),
                "sifat_surat" => $this->input->post('sifat_surat'),
            );

            $insertKonseling = $this->db->insert('tbl_konseling_operator', $dataInsert);
            if ($insertKonseling == 1) {
                $this->session->set_flashdata('sukses_konseling', 'Berhasil menambah Data');
            } else {
                $this->session->set_flashdata('error_konseling', 'Ups.. Error menambahkan data');
            }
            redirect("mpp/konselingView");
        }
        $data['listJenisSanksi'] = $this->mpp_m->getListSanksi();
        $data['title'] = 'Konseling';
        $this->load->view('mpp/konseling/addKonseling', $data);
    }

    public function konselingEdit($id = null)
    {
        if (!empty($_POST)) {
            $dataInsert = array(
                "nik" => $this->input->post('nik'),
                "jenis_konseling" => $this->input->post('jenis_konseling'),
                "isu_permasalahan" => $this->input->post('isu_permasalahan'),
                "tanggapan" => $this->input->post('tanggapan'),
                "tindakan" => $this->input->post('tindakan'),
                "tanggal" => $this->input->post('tanggal'),
                "saksi1" => $this->input->post('saksi1'),
                "saksi2" => $this->input->post('saksi2'),
                "diberikan_oleh" => $this->input->post('diberikan_oleh'),
                "sanksi" => $this->input->post('sanksi'),
                "sifat_surat" => $this->input->post('sifat_surat'),
            );
            $updateDataKonseling = $this->db->update('tbl_konseling_operator', $dataInsert, array('id' => $this->input->post('id')));
            if ($updateDataKonseling == 1) {
                $this->session->set_flashdata('sukses_konseling', 'Berhasil Mengedit Data');
            } else {
                $this->session->set_flashdata('error_konseling', 'Ups.. Error Mengedit data');
            }
            redirect("mpp/konselingView");
        }
        if (!empty($id)) {
            $data['edit'] = $this->db->query("SELECT * FROM tbl_konseling_operator WHERE id LIKE '$id' ")->row_array();
        } else {
            redirect("mpp/konselingView");
        }
        $data['listJenisSanksi'] = $this->mpp_m->getListSanksi();
        $data['title'] = 'Konseling';
        $this->load->view('mpp/konseling/editKonseling', $data);
    }

    public function konselingDelete($id = null)
    {
        $this->db->where('id', $id);
        $deleteDataSp = $this->db->delete('tbl_konseling_operator');

        if ($deleteDataSp == 1) {
            $this->session->set_flashdata('sukses_konseling', 'Berhasil Menghapus Data');
        } else {
            $this->session->set_flashdata('error_konseling', 'Ups.. Error Menghapus data');
        }
        redirect("mpp/konselingView");
    }
}
        
    /* End of file  mpp.php */
