<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelatihan extends CI_Controller
{
    public function index()
    {
        if(!access_jabatan("access_read",23)){
            $this->load->view('auth/blocked');
            return false;
        }
        $data['title'] = "Data Pelatihan";
        $data['user'] = $this->m_auth->getUserLogin();
        $data['pelatihan'] = $this->m_pelatihan->getAllPelatihan();
        $this->load->view('template/header', $data);
        $this->load->view('data/pelatihan', $data);
        $this->load->view('template/footer');
    }
    public function addPelatihan()
    {
        $data['title'] = "Add Data Pelatihan";
        $data['user'] = $this->m_auth->getUserLogin();
        $data['users'] = $this->m_user->getAllUser();

        $this->form_validation->set_rules('user_id', 'Nama Pegawai', 'required');
        $this->form_validation->set_rules('nama_pelatihan', 'Nama Pelatihan', 'required');
        $this->form_validation->set_rules('organisasi_penerbit', 'Organisasi Penerbit', 'required');
        $this->form_validation->set_rules('lokasi_pelatihan', 'Lokasi Pelatihan', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi Pelatihan', 'required');
        $this->form_validation->set_rules('tgl_mulai', 'Tanggal Mulai', 'required');
        $this->form_validation->set_rules('tgl_selesai', 'Tanggal Selesai', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('data/pelatihan_add', $data);
            $this->load->view('template/footer');
        } else {
            $this->m_pelatihan->addPelatihan();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pelatihan Di Tambahkan !!!</div>');
            redirect('pelatihan');
        }
    }

    public function hapusPelatihan($id)
    {
        $this->m_pelatihan->hapusPelatihan($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Pelatihan di Hapus !!!</div>');
        redirect('pelatihan');
    }

    public function editPelatihan($id)
    {
        $data['title'] = "Edit Data Pelatihan";
        $data['user'] = $this->m_auth->getUserLogin();
        $data['users'] = $this->m_user->getAllUser();
        $data['pelatihan'] = $this->m_pelatihan->getPelatihanId($id);

        $this->form_validation->set_rules('user_id', 'Nama Karyawan', 'required');
        $this->form_validation->set_rules('nama_pelatihan', 'Nama Pelatihan', 'required');
        $this->form_validation->set_rules('organisasi_penerbit', 'Organisasi Penerbit', 'required');
        $this->form_validation->set_rules('lokasi_pelatihan', 'Lokasi Pelatihan', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi Pelatihan', 'required');
        $this->form_validation->set_rules('tgl_mulai', 'Tanggal Mulai', 'required');
        $this->form_validation->set_rules('tgl_selesai', 'Tanggal Selesai', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('data/pelatihan_edit', $data);
            $this->load->view('template/footer');
        } else {
            $this->m_pelatihan->editPelatihan();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pelatihan Di Edit !!!</div>');
            redirect('pelatihan');
        }
    }
    public function detailPelatihan()
    {
        $id = $this->uri->segment(3);

        $data['title'] = 'Detail Pelatihan';
        $data['user'] = $this->m_auth->getUserLogin();
        $data['pelatihan'] = $this->m_pelatihan->GetPelatihanByID($id);

        $this->load->view('template/header', $data);
        $this->load->view('data/pelatihan_detail', $data);
        $this->load->view('template/footer');
    }
}
