<?php

class M_approve extends CI_Model
{
    public function getGajiTendikPendingList()
    {
        $this->db->select('*');
        $this->db->from('t_gaji_tendik');
        $this->db->where('status',1);
        $this->db->order_by('periode','desc');

        return $this->db->get()->result_array();
    }

    public function getRowGajiPendingList($id){
        
        $this->db->select('*');
        $this->db->from('t_gaji_tendik');
        $this->db->where('id_gaji_tendik',$id);
        return $this->db->get()->row_array();
    }
}