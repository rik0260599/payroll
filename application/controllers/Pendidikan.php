<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendidikan extends CI_Controller
{
    // public function __construct()
    // {
    //     parent::__construct();
    //     is_logged_in();
    // }
    public function index()
    {
        if(!access_jabatan("access_read",22)){
            $this->load->view('auth/blocked');
            return false;
        }
        $data['title'] = "Data Pendidikan";
        $data['user'] = $this->m_auth->getUserLogin();
        $data['pendidikan'] = $this->m_pendidikan->getAllPendidikan();
        $this->load->view('template/header', $data);
        $this->load->view('data/pendidikan', $data);
        $this->load->view('template/footer');
    }

    public function addPendidikan()
    {
        $data['title'] = "Add Data Pendidikan";
        $data['user'] = $this->m_auth->getUserLogin();
        $data['users'] = $this->m_user->getAllUser();

        $this->form_validation->set_rules('user_id', 'Nama Pegawai', 'required');
        $this->form_validation->set_rules('tingkat_pendidikan', 'Tingkat Pendidikan', 'required');
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required');
        $this->form_validation->set_rules('universitas', 'Universitas', 'required');
        $this->form_validation->set_rules('alamat_univ', 'Alamat Universitas', 'required');
        $this->form_validation->set_rules('judul_skripsi', 'Judul Skripsi', 'required');
        $this->form_validation->set_rules('nama_dospem', 'Nama Dosen Pembimbing', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('tgl_mulai', 'Tanggal Mulai', 'required');
        $this->form_validation->set_rules('tgl_lulus', 'Tanggal Selesai', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('data/pendidikan_add', $data);
            $this->load->view('template/footer');
        } else {
            $this->m_pendidikan->addPendidikan();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pendidikan Di Tambahkan !!!</div>');
            redirect('pendidikan');
        }
    }

    public function hapusPendidikan($id)
    {
        $this->m_pendidikan->hapusPendidikan($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Pendidikan di Hapus !!!</div>');
        redirect('pendidikan');
    }

    public function editPendidikan($id)
    {
        $data['title'] = "Edit Data pendidikan";
        $data['user'] = $this->m_auth->getUserLogin();
        $data['users'] = $this->m_user->getAllUser();
        $data['pendidikan'] = $this->m_pendidikan->getPendidikanId($id);

        $this->form_validation->set_rules('user_id', 'Nama Pegawai', 'required');
        $this->form_validation->set_rules('tingkat_pendidikan', 'Tingkat Pendidikan', 'required');
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required');
        $this->form_validation->set_rules('universitas', 'Universitas', 'required');
        $this->form_validation->set_rules('alamat_univ', 'Alamat Universitas', 'required');
        $this->form_validation->set_rules('judul_skripsi', 'Judul Skripsi', 'required');
        $this->form_validation->set_rules('nama_dospem', 'Nama Dosen Pembimbing', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('tgl_mulai', 'Tanggal Mulai', 'required');
        $this->form_validation->set_rules('tgl_lulus', 'Tanggal Selesai', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('data/pendidikan_edit', $data);
            $this->load->view('template/footer');
        } else {
            $this->m_pendidikan->editPendidikan();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pendidikan Di Edit !!!</div>');
            redirect('pendidikan');
        }
    }
    public function detailPendidikan()
    {
        $id = $this->uri->segment(3);

        $data['title'] = 'Detail Pendidikan';
        $data['user'] = $this->m_auth->getUserLogin();
        $data['pendidikan'] = $this->m_pendidikan->GetPendidikanByID($id);

        $this->load->view('template/header', $data);
        $this->load->view('data/pendidikan_detail', $data);
        $this->load->view('template/footer');
    }
	public function approved($id)
	{
		$this->db->set('status', 'approved');
		$this->db->where('id_pendidikan', $id);
		$this->db->update('master_pendidikan');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pendidikan Di Approve !!!</div>');
		redirect('pendidikan');
	}
	public function rejected($id)
	{
		$this->db->set('status', 'rejected');
		$this->db->where('id_pendidikan', $id);
		$this->db->update('master_pendidikan');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pendidikan Di Reject !!!</div>');
		redirect('pendidikan');
	}
}
