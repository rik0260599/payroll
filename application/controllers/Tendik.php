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
        $row = $this->m_tendik->getRowGaji($id);
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
            $newData['nama_karyawan']  = $data_tendik['name'];
            $newData['golongan']  = $data_tendik['golongan'];
            $newData['jabatan']  = $data_tendik['jabatan'];
            $newData['no_rek']  = $data_tendik['no_rek'];
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

    public function sendForApproval($id){
        $data = [
            "status" => 1
        ];

        $this->m_tendik->submitApproval($id,$data);
        redirect('tendik');
    }

    public function getGajiTendikFromOut(){
        $data = array();
        $data_gaji = $this->m_tendik->getDataGajiTendik();
        $index = 0;
        foreach($data_gaji as $data_gaji){
            $data[$index]['nik_karyawan'] = $data_gaji['nik_karyawan'];
            $data[$index]['nama_karyawan'] = $data_gaji['name'];
            $data[$index]['no_rekening'] = $data_gaji['no_rek'];
            $data[$index]['nama_bank'] = $data_gaji['nama_bank'];
            $data[$index]['golongan'] = $data_gaji['golongan'];
            $data[$index]['jabatan'] = $data_gaji['jabatan'];
            $data[$index]['gaji_pokok'] = $data_gaji['gaji_pokok'];
            $data[$index]['t_jabatan_fungsional'] = $data_gaji['t_jabatan_fungsional'];
            $data[$index]['t_pendidikan_s3'] = $data_gaji['t_pendidikan_s3'];
            $data[$index]['tunjangan_kehadiran'] = $data_gaji['tunjangan_kehadiran'];
            $data[$index]['tunjangan_makan'] = $data_gaji['tunjangan_makan'];
            $data[$index]['t_jabatan_struktural'] = $data_gaji['t_jabatan_struktural'];
            $data[$index]['t_jabatan_rangkap'] = $data_gaji['t_jabatan_rangkap'];
            $data[$index]['bpjs_yayasan_ketnaker'] = $data_gaji['bpjs_yayasan_ketnaker'];
            $data[$index]['bpjs_yayasan_kesehatan'] = $data_gaji['bpjs_yayasan_kesehatan'];
            $data[$index]['bpjs_pribadi_ketnaker'] = $data_gaji['bpjs_pribadi_ketnaker'];
            $data[$index]['bpjs_pribadi_kesehatan'] = $data_gaji['bpjs_pribadi_kesehatan'];
            $data[$index]['transisi'] = $data_gaji['transisi'];
            $data[$index]['pph'] = $data_gaji['pphInt'];
            $data[$index]['periode'] = $data_gaji['periode'];
            $data[$index]['status']= 0;
            $data[$index]['pesan'] = '';
            $index++;
        }
        
        $this->m_tendik->insertToGajiTendik($data);
        redirect('tendik');
    }
}