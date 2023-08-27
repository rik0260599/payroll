<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Golongan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //is_logged_in();
    }
    public function index()
    {
        $data['title'] = "Master Golongan";
        $data['user'] = $this->m_auth->getUserLogin();
        $data['users'] = $this->m_user->getAllUser();
        $this->load->view('template/header', $data);
        $this->load->view('golongan/v_golongan', $data);
        $this->load->view('template/footer');
    }

    public function add_golongan(){
        $data['title'] = "Add Master Golongan";
        $data['user'] = $this->m_auth->getUserLogin();
        $data['users'] = $this->m_user->getAllUser();
        $this->load->view('template/header', $data);
        $this->load->view('golongan/v_golongan_add', $data);
        $this->load->view('template/footer');
    }
}
