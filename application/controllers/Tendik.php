<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tendik extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in2();
        $this->load->model('m_tendik');
    }
    public function index()
    {
        $data['title'] = "Gaji Tendik";
        $data['user'] = $this->m_auth->getUserLogin();
        $data['tendik'] = $this->getAllDataTendik();
        
        //$data['total']= $this->getTotalGaji(1);

        $this->load->view('template/header', $data);
        $this->load->view('tendik/v_tendik', $data);
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

    public function getTotalGaji($id){
        $row = $this->m_tendik->getRowGaji($id);
        $data['total']=null;

        (float)$total = null;
        (float)$total_kotor = null;
        //(float)$nilai_bpjs_ketnaker = null;
        if(isset($row)){
            $total= (float)$row['gaji_pokok'] + (float)$row['t_jabatan_fungsional'] + (float)$row['transport_makan'] + (float)$row['t_jabatan_struktural'] + (float)$row['t_jabatan_rangkap'];
            $total_kotor = $total;
            
            $total += (((float)$row['bpjs_yayasan_ketnaker'] * $total_kotor)/100) + (((float)$row['bpjs_yayasan_kesehatan'] * $total_kotor)/100) + (float)$row['transisi']; 
            $total = $total -  (((float)$row['bpjs_pribadi_ketnaker'] * $total_kotor)/100) + (((float)$row['bpjs_pribadi_kesehatan'] * $total_kotor)/100);
            $total = $total - (float)$row['pinjaman'];
        }
        
        return number_format($total,2, ".", ",") ;
    }

    public function detailTendik($id)
    {
        $data['title'] = "Detail Gaji Tendik";
        $data['user'] = $this->m_auth->getUserLogin();
        $data['tendik'] = $this->detailDataTendik($id);
        
        //$data['total']= $this->getTotalGaji(1);

        $this->load->view('template/header', $data);
        $this->load->view('tendik/v_tendik_detail', $data);
        $this->load->view('template/footer');
    }

    public function detailDataTendik($id){
        $data_tendik= $this->m_tendik->getRowGaji($id);
        
            $total= (float)$data_tendik['gaji_pokok'] + (float)$data_tendik['t_jabatan_fungsional'] + (float)$data_tendik['transport_makan'] + (float)$data_tendik['t_jabatan_struktural'] + (float)$data_tendik['t_jabatan_rangkap'];
            $total_kotor = $total;
            $potongan_bpjs = 0.00;

                $potongan_bpjs = ((((float)$data_tendik['bpjs_pribadi_ketnaker'] * $total_kotor)/100) + (((float)$data_tendik['bpjs_pribadi_kesehatan'] * $total_kotor)/100));
            
        $newData = array();
        
            $newData['id']  = $data_tendik['id'];
            $newData['periode']  = $data_tendik['periode'];
            $newData['nip']  = $data_tendik['nip'];
            $newData['nama_karyawan']  = $data_tendik['nama_karyawan'];
            $newData['golongan']  = $data_tendik['golongan'];
            $newData['gaji_pokok']  = $data_tendik['gaji_pokok'];
            $newData['t_jabatan_fungsional']  = $data_tendik['t_jabatan_fungsional'];
            $newData['t_pendidikan_s3']  = $data_tendik['t_pendidikan_s3'];
            $newData['transport_makan']  = $data_tendik['transport_makan'];
            $newData['t_jabatan_struktural']  = $data_tendik['t_jabatan_struktural'];
            $newData['t_jabatan_rangkap']  = $data_tendik['t_jabatan_rangkap'];
            $newData['bpjs_yayasan_ketnaker']  = $data_tendik['bpjs_yayasan_ketnaker'];
            $newData['bpjs_yayasan_ketnaker_biaya']  = ((float)$data_tendik['bpjs_yayasan_ketnaker'] * $total_kotor)/100;
            $newData['bpjs_yayasan_kesehatan']  = $data_tendik['bpjs_yayasan_kesehatan'];
            $newData['bpjs_yayasan_kesehatan_biaya']  = ((float)$data_tendik['bpjs_yayasan_kesehatan'] * $total_kotor)/100;
            $newData['bpjs_pribadi_kesehatan']  = $data_tendik['bpjs_pribadi_kesehatan'];
            $newData['bpjs_pribadi_kesehatan_biaya']  = ((float)$data_tendik['bpjs_pribadi_kesehatan'] * $total_kotor)/100;
            $newData['bpjs_pribadi_ketnaker']  = $data_tendik['bpjs_pribadi_ketnaker'];
            $newData['bpjs_pribadi_ketnaker_biaya']  = ((float)$data_tendik['bpjs_pribadi_ketnaker'] * $total_kotor)/100;
            $newData['potongan_bpjs']  = $potongan_bpjs;
            $newData['transisi']  = $data_tendik['transisi'];
            $newData['pinjaman']  = $data_tendik['pinjaman'];
            $newData['total']  = $this->getTotalGaji($data_tendik['id']);
            $newData['status']  = $data_tendik['status'];
            
        

        return $newData;
    }

    
}