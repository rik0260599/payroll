<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Libur extends CI_Controller
{
    // public function __construct()
    // {
    //     parent::__construct();
    //     is_logged_in();
    // }
    public function index()
    {
        if(!access_jabatan("access_read",33)){
            $this->load->view('auth/blocked');
            return false;
        }
        $data['title'] = "Data Libur";
        $data['user'] = $this->m_auth->getUserLogin();
        $data['libur'] = $this->m_libur->getAllLibur();
        $this->load->view('template/header', $data);
        $this->load->view('data/libur', $data);
        $this->load->view('template/footer');
    }
    public function addLibur()
    {
        $data['title'] = "Add Libur";
        $data['user'] = $this->m_auth->getUserLogin();

        $this->form_validation->set_rules('tgl_mulai', 'Tanggal Mulai', 'required');
        $this->form_validation->set_rules('tgl_akhir', 'Tanggal Akhir', 'required');
        $this->form_validation->set_rules('keterangan', 'Keteranagan', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('data/libur_add', $data);
            $this->load->view('template/footer');
        } else {
            $this->m_libur->addLibur();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Libur Di Tambahkan !!!</div>');
            redirect('libur');
        }
    }

    public function hapusLibur($id)
    {
        $this->m_libur->hapusLibur($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Libur di Hapus !!!</div>');
        redirect('libur');
    }

    public function editLibur($id)
    {
        $data['title'] = "Edit Libur";
        $data['user'] = $this->m_auth->getUserLogin();
        $data['libur'] = $this->m_libur->getLiburId($id);

        $this->form_validation->set_rules('tgl_mulai', 'Tanggal Mulai', 'required');
        $this->form_validation->set_rules('tgl_akhir', 'Tanggal Akhir', 'required');
        $this->form_validation->set_rules('keterangan', 'Keteranagan', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('data/libur_edit', $data);
            $this->load->view('template/footer');
        } else {
            $this->m_libur->editLibur();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Libur Di Edit !!!</div>');
            redirect('libur');
        }
    }
}
