<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Homebase extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in2();
        $this->load->model('m_homebase');
    }
    public function index()
    {
        $data['title'] = "Gaji Dosen Homebase";
        $data['user'] = $this->m_auth->getUserLogin();
        //$data['homebase'] = $this->getAllDataTendik();
        
        //$data['total']= $this->getTotalGaji(1);

        $this->load->view('template/header', $data);
        $this->load->view('homebase/v_homebase', $data);
        $this->load->view('template/footer');
        

    }

    public function getAllDataTendik(){
        $data['tendik']= $this->m_tendik->getAllGajiTendik();

        $newData = array();
        foreach($data['tendik'] as $key => $dt){
            $newData[$key]['id']  = $dt['id'];
            $newData[$key]['periode']  = $dt['periode'];
            $newData[$key]['nip']  = $dt['nip'];
            $newData[$key]['nama_karyawan']  = $dt['nama_karyawan'];
            $newData[$key]['golongan']  = $dt['golongan'];
            $newData[$key]['total']  = $this->getTotalGaji($dt['id']);
            $newData[$key]['status']  = $dt['status'];
            
        }

        return $newData;
    }
}