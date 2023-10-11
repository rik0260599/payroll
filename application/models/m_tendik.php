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
        
        $this->db->select('*');
        $this->db->from('t_gaji_tendik');
        $this->db->where('id_gaji_tendik', $id);
        return $this->db->get()->row_array();
    }

    public function submitApproval($id,$data){
        $this->db->where('id_gaji_tendik', $id);
        $this->db->update('t_gaji_tendik', $data);
    }
    
    public function getDataGajiTendik(){
        $this->db->select('*');
        $this->db->from('t_gaji_tendik');
        $this->db->order_by('periode','desc');
        return $this->db->get()->result_array();
    }

    public function insertToGajiTendik($data){
        return $this->db->insert_batch('t_gaji_tendik',$data);
    }

    public function insertToPinjaman($data){
        return $this->db->insert_batch('t_pinjaman_karyawan',$data);
    }

    public function submitAllApproval($data){
        $this->db->where('status', 0);
        $this->db->update('t_gaji_tendik', $data);
    }

    public function getDataGajiTendikById($id){
        return $this->db->get_where('t_gaji_tendik', ['id_gaji_tendik' => $id])->row_array();
    }

    public function getDataTendikAPI(){
        $api_url = "http://localhost:8080/api/api/gaji";

        $response = $this->curl->simple_get($api_url);

        if($response){
            $data = json_decode($response);
            return $data;
        }else{
            return false;
        }
    }

    public function getDataTendikAPIPinjaman(){
        $api_url = "http://localhost:8080/api/api/pinjaman";

        $response = $this->curl->simple_get($api_url);

        if($response){
            $data = json_decode($response);
            return $data;
        }else{
            return false;
        }
    }
}