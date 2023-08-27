<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Approval extends CI_Controller
{
    
    public function index()
    {
        if(!access_jabatan("access_read",38)){
            $this->load->view('auth/blocked');
            return false;
        }
        $data['title'] = "Approval User";
        $data['user'] = $this->m_auth->getUserLogin();
        $data['users'] = $this->m_user->getAllUserPending();
        $this->load->view('template/header', $data);
        $this->load->view('data/approval', $data);
        $this->load->view('template/footer');
    }
}