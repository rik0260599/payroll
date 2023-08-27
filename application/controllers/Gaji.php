<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gaji extends CI_Controller {

	public function slip()
	{
        if(!access_jabatan("access_read",32)){
            $this->load->view('auth/blocked');
            return false;
        }
        
        $data['title'] = "Slip Gaji";
        $data['user'] = $this->m_auth->getUserLogin();

		$this->load->view('template/header', $data);
        $this->load->view('gaji/slip', $data);
        $this->load->view('template/footer');
	}
    public function detailSlip()
	{
        if(!access_jabatan("access_read",32)){
            $this->load->view('auth/blocked');
            return false;
        }
        
        $data['title'] = "Detail Gaji";
        $data['user'] = $this->m_auth->getUserLogin();
		$this->load->view('template/header', $data);
        $this->load->view('gaji/slip_detail', $data);
        $this->load->view('template/footer');
	}
}
