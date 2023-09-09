<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Approve extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in2();
        $this->load->model('m_approve');
        
    }
    public function index()
    {

        $data['title'] = "Approval Gaji";
        $data['user'] = $this->m_auth->getUserLogin();
        $data['tendik'] = $this->getAllDataTendikPending();
        $data['count_tendik'] = count($this->getAllDataTendikPending());
        //$data['users'] = $this->m_user->getAllUserPending();
        $this->load->view('template/header', $data);
        $this->load->view('approve/v_approval_tendik', $data);
        $this->load->view('template/footer');
    }

    public function getAllDataTendikPending(){
        $data['tendik']= $this->m_approve->getGajiTendikPendingList();

        $newData = array();
        foreach($data['tendik'] as $key => $dt){
            $newData[$key]['id_gaji_tendik']  = $dt['id_gaji_tendik'];
            $newData[$key]['periode']  = $dt['periode'];
            $newData[$key]['nip']  = $dt['nik_karyawan'];
            $newData[$key]['nama_karyawan']  = $dt['nama_karyawan'];
            $newData[$key]['jabatan']  = $dt['jabatan'];
            $newData[$key]['golongan']  = $dt['golongan'];
            $newData[$key]['no_rek']  = $dt['no_rekening'];
            $newData[$key]['nama_bank']  = $dt['nama_bank'];
            $newData[$key]['total']  = $this->getTotalGaji($dt['id_gaji_tendik']);
            $newData[$key]['status']  = $dt['status'];
        }

        return $newData;
    }

    public function getTotalGaji($id){
        $row = $this->m_approve->getRowGajiPendingList($id);
        $data['total']=null;

        $BPSJKetnaker_yayasan = null;
        $BPSJKesehatan_yayasan = null;
        $BPSJKetnaker_pribadi = null;
        $BPSJKesehatan_pribadi = null;
        $total_bpjs = null;
        $total = null;
        $total_kotor = null;
        //(float)$nilai_bpjs_ketnaker = null;
        if(isset($row)){
            $total= $row['gaji_pokok'] + $row['t_jabatan_fungsional'] + $row['t_pendidikan_s3'] + $row['tunjangan_makan'] +$row['tunjangan_kehadiran'] + $row['t_jabatan_struktural'] + $row['t_jabatan_rangkap'] + $row['transisi'];
            
            $BPSJKetnaker_yayasan = (($row['bpjs_yayasan_ketnaker'] * $total)/100);
            $BPSJKesehatan_yayasan = (($row['bpjs_yayasan_kesehatan'] * $total)/100);
            $BPSJKetnaker_pribadi = (($row['bpjs_pribadi_ketnaker'] * $total)/100);
            $BPSJKesehatan_pribadi = (($row['bpjs_pribadi_kesehatan'] * $total)/100);
            
            $total_kotor = $total+ $BPSJKesehatan_yayasan + $BPSJKetnaker_yayasan;

            $total_bpjs = ($BPSJKetnaker_yayasan + $BPSJKesehatan_yayasan) - ($BPSJKetnaker_pribadi + $BPSJKesehatan_pribadi);
            
            $total = ($total + $total_bpjs) ;
        }
        
        return number_format($total,2, ".", ",") ;
    }

    public function detailApproveTendik($id)
    {
        $data['title'] = "Detail Gaji Tendik";
        $data['user'] = $this->m_auth->getUserLogin();
        $data['tendik'] = $this->detailApproveDataTendik($id);
        
        //$data['total']= $this->getTotalGaji(1);

        $this->load->view('template/header', $data);
        $this->load->view('approve/v_detail_approval_tendik', $data);
        $this->load->view('template/footer');
    }

    public function detailApproveDataTendik($id){
        $data_tendik= $this->m_approve->getRowGajiPendingList($id);
        
        $BPSJKetnaker_yayasan = null;
        $BPSJKesehatan_yayasan = null;
        $BPSJKetnaker_pribadi = null;
        $BPSJKesehatan_pribadi = null;
        $total_bpjs = null;
        $total = null;
        $total_terima = null;
        
        $total= $data_tendik['gaji_pokok'] + $data_tendik['t_jabatan_fungsional'] + $data_tendik['t_pendidikan_s3']+ $data_tendik['tunjangan_makan'] +$data_tendik['tunjangan_kehadiran'] + $data_tendik['t_jabatan_struktural'] + $data_tendik['t_jabatan_rangkap'] + $data_tendik['transisi'];
            
            $BPSJKetnaker_yayasan = (($data_tendik['bpjs_yayasan_ketnaker'] * $total)/100);
            $BPSJKesehatan_yayasan = (($data_tendik['bpjs_yayasan_kesehatan'] * $total)/100);
            $BPSJKetnaker_pribadi = (($data_tendik['bpjs_pribadi_ketnaker'] * $total)/100);
            $BPSJKesehatan_pribadi = (($data_tendik['bpjs_pribadi_kesehatan'] * $total)/100);
            $total_terima = $total + $BPSJKesehatan_yayasan + $BPSJKetnaker_yayasan;
            
            $total_bpjs = ($BPSJKetnaker_yayasan + $BPSJKesehatan_yayasan) - ($BPSJKetnaker_pribadi + $BPSJKesehatan_pribadi);
            
            $total = ($total + $total_bpjs) ;

        $newData = array();
        
            $newData['id']  = $data_tendik['id_gaji_tendik'];
            $newData['periode']  = $data_tendik['periode'];
            $newData['nip']  = $data_tendik['nik_karyawan'];
            $newData['nama_karyawan']  = $data_tendik['nama_karyawan'];
            $newData['golongan']  = $data_tendik['golongan'];
            $newData['jabatan']  = $data_tendik['jabatan'];
            $newData['no_rek']  = $data_tendik['no_rekening'];
            $newData['nama_bank']  = $data_tendik['nama_bank'];
            $newData['gaji_pokok']  = $data_tendik['gaji_pokok'];
            $newData['t_jabatan_fungsional']  = $data_tendik['t_jabatan_fungsional'];
            $newData['t_pendidikan_s3']  = $data_tendik['t_pendidikan_s3'];
            $newData['tunjangan_makan']  = $data_tendik['tunjangan_makan'];
            $newData['tunjangan_kehadiran']  = $data_tendik['tunjangan_kehadiran'];
            $newData['t_jabatan_struktural']  = $data_tendik['t_jabatan_struktural'];
            $newData['t_jabatan_rangkap']  = $data_tendik['t_jabatan_rangkap'];
            $newData['bpjs_yayasan_ketnaker']  = $data_tendik['bpjs_yayasan_ketnaker'];
            $newData['bpjs_yayasan_ketnaker_biaya']  = $BPSJKetnaker_yayasan;
            $newData['bpjs_yayasan_kesehatan']  = $data_tendik['bpjs_yayasan_kesehatan'];
            $newData['bpjs_yayasan_kesehatan_biaya']  = $BPSJKesehatan_yayasan;
            $newData['bpjs_pribadi_kesehatan']  = $data_tendik['bpjs_pribadi_kesehatan'];
            $newData['bpjs_pribadi_kesehatan_biaya']  = $BPSJKesehatan_pribadi;
            $newData['bpjs_pribadi_ketnaker']  = $data_tendik['bpjs_pribadi_ketnaker'];
            $newData['bpjs_pribadi_ketnaker_biaya']  = $BPSJKetnaker_pribadi;
            //$newData['potongan_bpjs']  = $potongan_bpjs;
            $newData['transisi']  = $data_tendik['transisi'];
            //$newData['pinjaman']  = $data_tendik['pinjaman'];
            $newData['total']  = $this->getTotalGaji($data_tendik['id_gaji_tendik']);
            $newData['total_terima']  = $total_terima;
            $newData['status']  = $data_tendik['status'];

        return $newData;
    }

    public function homebase()
    {

        $data['title'] = "Approval Gaji";
        $data['user'] = $this->m_auth->getUserLogin();
        $data['users'] = $this->m_user->getAllUserPending();
        $data['count_tendik'] = count($this->getAllDataTendikPending());
        $this->load->view('template/header', $data);
        $this->load->view('approve/v_approval_homebase', $data);
        $this->load->view('template/footer');
    }
}