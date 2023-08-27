<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengalaman extends CI_Controller
{
    // public function __construct()
    // {
    //     parent::__construct();
    //     is_logged_in();
    // }
    public function index()
    {
        if(!access_jabatan("access_read",30)){
            $this->load->view('auth/blocked');
            return false;
        }
        $data['title'] = "Data Pengalaman";
        $data['user'] = $this->m_auth->getUserLogin();
        $data['pengalaman'] = $this->m_pengalaman->getAllPengalaman();
        $this->load->view('template/header', $data);
        $this->load->view('data/pengalaman', $data);
        $this->load->view('template/footer');
    }

    public function addPengalaman()
    {
        $data['title'] = "Add Data Pengalaman";
        $data['user'] = $this->m_auth->getUserLogin();
        $data['users'] = $this->m_user->getAllUser();

        $this->form_validation->set_rules('user_id', 'Nama Pegawai', 'required');
        $this->form_validation->set_rules('nama_perusahaan', 'Nama Perusahaan', 'required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
        $this->form_validation->set_rules('tgl_mulai', 'Tanggal Mulai', 'required');
        $this->form_validation->set_rules('tgl_berakhir', 'Tanggal Berakhir', 'required');
        $this->form_validation->set_rules('alasan_berhenti', 'Alasan Berhenti', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('data/Pengalaman_add', $data);
            $this->load->view('template/footer');
        } else {
            $this->m_pengalaman->addPengalaman();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">pengalaman Di Tambahkan !!!</div>');
            redirect('pengalaman');
        }
    }

    public function hapusPengalaman($id)
    {
        $this->m_pengalaman->hapusPengalaman($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data pengalaman di Hapus !!!</div>');
        redirect('pengalaman');
    }

    public function editPengalaman($id)
    {
        $data['title'] = "Edit Data pengalaman";
        $data['user'] = $this->m_auth->getUserLogin();
        $data['users'] = $this->m_user->getAllUser();
        $data['pengalaman'] = $this->m_pengalaman->getPengalamanId($id);

        $this->form_validation->set_rules('user_id', 'Nama Pegawai', 'required');
        $this->form_validation->set_rules('nama_perusahaan', 'Nama Perusahaan', 'required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
        $this->form_validation->set_rules('tgl_mulai', 'Tanggal Mulai', 'required');
        $this->form_validation->set_rules('tgl_berakhir', 'Tanggal Berakhir', 'required');
        $this->form_validation->set_rules('alasan_berhenti', 'Alasan Berhenti', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('data/pengalaman_edit', $data);
            $this->load->view('template/footer');
        } else {
            $this->m_pengalaman->editPengalaman();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">pengalaman Di Edit !!!</div>');
            redirect('pengalaman');
        }
    }
    public function detailPengalaman()
    {
        $id = $this->uri->segment(3);

        $data['title'] = 'Detail Pengalaman';
        $data['user'] = $this->m_auth->getUserLogin();
        $data['pengalaman'] = $this->m_pengalaman->GetPengalamanByID($id);

        $this->load->view('template/header', $data);
        $this->load->view('data/pengalaman_detail', $data);
        $this->load->view('template/footer');
    }
	public function approved($id)
	{
		$this->db->set('status', 'approved');
		$this->db->where('id_pengalaman', $id);
		$this->db->update('data_pengalaman');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pengalaman Di Approve !!!</div>');
		redirect('pengalaman');
	}
	public function rejected($id)
	{
		$this->db->set('status', 'rejected');
		$this->db->where('id_pengalaman', $id);
		$this->db->update('data_pengalaman');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pengalaman Di Reject !!!</div>');
		redirect('pengalaman');
	}
}
