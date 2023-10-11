<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pinjaman extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in2();   
        $this->load->model('m_pinjaman');
    }
    
    public function index()
    {
        $data['title'] = "Data Pinjaman Karyawan";
        $data['user'] = $this->m_auth->getUserLogin();
        $data['pinjaman'] = $this->m_pinjaman->getAllPinjaman();
        $data['script'] = null;
        //print_r($this->m_tendik->getAllGajiTendik());
        //$data['total']= $this->getTotalGaji(1);

        $this->load->view('template/header', $data);
        $this->load->view('admin/v_pinjaman', $data);
        $this->load->view('template/footer', $data);
        

    }
}