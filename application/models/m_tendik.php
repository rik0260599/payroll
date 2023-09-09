<?php

class M_tendik extends CI_Model
{
    public function getAllGajiTendik()
    {
        $this->db->select('*');
        $this->db->from('t_gaji_tendik');
        $this->db->order_by('periode','desc');

        return $this->db->get()->result_array();
    }

    public function getRowGaji($id){
        
        $this->db->select('u.name, mg.golongan, u.no_rek, u.nama_bank, gt.*, mj.jabatan');
        $this->db->from('user_jabatan as uj');
        $this->db->join('user as u', 'u.id = uj.user_id');
        $this->db->join('master_jabatan as mj', 'mj.id_jabatan = uj.jabatan_id');
        $this->db->join('master_golongan_tendik as mg', 'mg.id_golongan = uj.golongan_id');
        $this->db->join('t_gaji_tendik as gt', 'gt.nik_karyawan = u.nik_karyawan','right');
        $this->db->where('gt.id_gaji_tendik', $id);
        return $this->db->get()->row_array();
    }

    public function submitApproval($id,$data){
        $this->db->where('id_gaji_tendik', $id);
        $this->db->update('t_gaji_tendik', $data);
    }
    
    public function getDataGajiTendik(){
        $this->db->select('u.nik_karyawan , u.name , u.no_rek, u.nama_bank , mg.golongan, mj.jabatan, mg.*, CAST(mg.pph AS int) as pphInt');
        $this->db->from('user_jabatan as uj');
        $this->db->join('user as u', 'u.id = uj.user_id');
        $this->db->join('master_jabatan as mj', 'mj.id_jabatan = uj.jabatan_id');
        $this->db->join('master_golongan_tendik as mg', 'mg.id_golongan = uj.golongan_id');
        $this->db->order_by('mg.periode','desc');
        return $this->db->get()->result_array();
    }

    public function insertToGajiTendik($data){
        return $this->db->insert_batch('t_gaji_tendik',$data);
    }
}