<?php

class M_pinjaman extends CI_Model
{
    public function getAllPinjaman()
    {
        $this->db->select('*');
        $this->db->from('t_pinjaman_karyawan');

        return $this->db->get()->result_array();
    }
}