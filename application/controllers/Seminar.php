<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Seminar extends CI_Controller
{
    public function index()
    {
        if(!access_jabatan("access_read",25)){
            $this->load->view('auth/blocked');
            return false;
        }
        $data['title'] = "Data Seminar";
        $data['user'] = $this->m_auth->getUserLogin();
        $data['seminar'] = $this->m_seminar->getAllseminar();
        $this->load->view('template/header', $data);
        $this->load->view('data/seminar', $data);
        $this->load->view('template/footer');
    }
    public function addSeminar()
    {
        $data['title'] = "Add Data Seminar";
        $data['user'] = $this->m_auth->getUserLogin();
        $data['users'] = $this->m_user->getAllUser();

        $this->form_validation->set_rules('user_id', 'Nama Pegawai', 'required');
        $this->form_validation->set_rules('nama_seminar', 'Nama seminar', 'required');
        $this->form_validation->set_rules('deskripsi_seminar', 'Deskripsi Seminar', 'required');
        $this->form_validation->set_rules('organisasi_pelaksana', 'Organisasi pelaksana', 'required');
        $this->form_validation->set_rules('lokasi_seminar', 'Lokasi Seminar', 'required');
        $this->form_validation->set_rules('tgl_seminar', 'Tanggal seminar', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('data/seminar_add', $data);
            $this->load->view('template/footer');
        } else {
            $this->m_seminar->addSeminar();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Seminar Di Tambahkan !!!</div>');
            redirect('seminar');
        }
    }

    public function hapusSeminar($id)
    {
        $this->m_seminar->hapusSeminar($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Seminar di Hapus !!!</div>');
        redirect('seminar');
    }

    public function editSeminar($id)
    {
        $data['title'] = "Edit Data Seminar";
        $data['user'] = $this->m_auth->getUserLogin();
        $data['users'] = $this->m_user->getAllUser();
        $data['seminar'] = $this->m_seminar->getSeminarId($id);

        $this->form_validation->set_rules('user_id', 'Nama Pegawai', 'required');
        $this->form_validation->set_rules('nama_seminar', 'Nama Seminar', 'required');
        $this->form_validation->set_rules('deskripsi_seminar', 'Deskripsi Seminar', 'required');
        $this->form_validation->set_rules('organisasi_pelaksana', 'Organisasi pelaksana', 'required');
        $this->form_validation->set_rules('lokasi_seminar', 'Lokasi Seminar', 'required');
        $this->form_validation->set_rules('tgl_seminar', 'Tanggal seminar', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('data/seminar_edit', $data);
            $this->load->view('template/footer');
        } else {
            $this->m_seminar->editSeminar();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Seminar Di Edit !!!</div>');
            redirect('seminar');
        }
    }
    public function detailSeminar()
    {
        $id = $this->uri->segment(3);

        $data['title'] = 'Detail Seminar';
        $data['user'] = $this->m_auth->getUserLogin();
        $data['seminar'] = $this->m_seminar->GetSeminarByID($id);

        $this->load->view('template/header', $data);
        $this->load->view('data/seminar_detail', $data);
        $this->load->view('template/footer');
    }
	public function approved($id)
	{
		$this->db->set('status', 'approved');
		$this->db->where('id_seminar', $id);
		$this->db->update('master_seminar');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Seminar Di Approve !!!</div>');
		redirect('seminar');
	}
	public function rejected($id)
	{
		$this->db->set('status', 'rejected');
		$this->db->where('id_seminar', $id);
		$this->db->update('master_seminar');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Seminar Di Reject !!!</div>');
		redirect('seminar');
	}
}
