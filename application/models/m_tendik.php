<?php

class M_tendik extends CI_Model
{
    public function getAllGajiTendik()
    {
        $this->db->select('*');
        $this->db->from('t_gaji_tendik');

        return $this->db->get()->result_array();
    }

    public function getRowGaji($id){
        return $this->db->get_where('t_gaji_tendik', ['id' => $id])->row_array();

    }

}