<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Approve extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in2();
    }
    public function index()
    {

        $data['title'] = "Approval Gaji";
        $data['user'] = $this->m_auth->getUserLogin();
        $data['users'] = $this->m_user->getAllUserPending();
        $this->load->view('template/header', $data);
        $this->load->view('approve/v_approval_tendik', $data);
        $this->load->view('template/footer');
    }

    public function homebase()
    {

        $data['title'] = "Approval Gaji";
        $data['user'] = $this->m_auth->getUserLogin();
        $data['users'] = $this->m_user->getAllUserPending();
        $this->load->view('template/header', $data);
        $this->load->view('approve/v_approval_homebase', $data);
        $this->load->view('template/footer');
    }
}