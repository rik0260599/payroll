<?php

class M_slip extends CI_Model
{
    public function getAllGajiTendikApprove()
    {
        $this->db->select('*');
        $this->db->order_by('periode','desc');

        return $this->db->get_where('t_gaji_tendik',array('status'=>2, 'nik_karyawan' => $_SESSION['nip']))->result_array();
    }

}