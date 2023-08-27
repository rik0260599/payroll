<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keluarga extends CI_Controller
{
    // public function __construct()
    // {
    //     parent::__construct();
    //     is_logged_in();
    // }
    public function index()
    {
        if(!access_jabatan("access_read",20)){
            $this->load->view('auth/blocked');
            return false;
        }
        $data['title'] = "Data Keluarga Pegawai";
        $data['user'] = $this->m_auth->getUserLogin();
        $data['keluarga'] = $this->m_keluarga->getAllKeluarga();
        $this->load->view('template/header', $data);
        $this->load->view('data/keluarga', $data);
        $this->load->view('template/footer');
    }
    public function addKeluarga()
    {
        $data['title'] = "Add Data Keluarga";
        $data['user'] = $this->m_auth->getUserLogin();
        $data['users'] = $this->m_user->getAllUser();

        $this->form_validation->set_rules('user_id', 'Nama Pegawai', 'required');
        $this->form_validation->set_rules('nama_keluarga', 'Nama Keluarga', 'required');
        $this->form_validation->set_rules('hubungan', 'Hubungan', 'required');
        $this->form_validation->set_rules('telp_keluarga', 'Telpon', 'required|numeric');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('data/keluarga_add', $data);
            $this->load->view('template/footer');
        } else {
            $this->m_keluarga->addKeluarga();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Keluarga Di Tambahkan !!!</div>');
            redirect('keluarga');
        }
    }

    public function hapusKeluarga($id)
    {
        $this->m_keluarga->hapusKeluarga($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Keluarga di Hapus !!!</div>');
        redirect('keluarga');
    }
    public function editKeluarga($id)
    {
        $data['title'] = "Edit Data Keluarga";
        $data['user'] = $this->m_auth->getUserLogin();
        $data['users'] = $this->m_user->getAllUser();
        $data['keluarga'] = $this->m_keluarga->getkeluargaId($id);

        $this->form_validation->set_rules('user_id', 'Nama Pegawai', 'required');
        $this->form_validation->set_rules('nama_keluarga', 'Nama Keluarga', 'required');
        $this->form_validation->set_rules('hubungan', 'Hubungan', 'required');
        $this->form_validation->set_rules('telp_keluarga', 'Telpon', 'required|numeric');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('data/keluarga_edit', $data);
            $this->load->view('template/footer');
        } else {
            $this->m_keluarga->editKeluarga();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Keluarga Di Edit !!!</div>');
            redirect('keluarga');
        }
    }
	public function approved($id)
	{
		$this->db->set('status', 'approved');
		$this->db->where('id_keluarga', $id);
		$this->db->update('data_keluarga');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Keluarga Di Approve !!!</div>');
		redirect('keluarga');
	}
	public function rejected($id)
	{
		$this->db->set('status', 'rejected');
		$this->db->where('id_keluarga', $id);
		$this->db->update('data_keluarga');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Keluarga Di Reject !!!</div>');
		redirect('keluarga');
	}
}
?>
