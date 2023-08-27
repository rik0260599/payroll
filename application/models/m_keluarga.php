<?php

class M_keluarga extends CI_Model
{
    public function getAllkeluarga()
    {
        $this->db->select('*');
        $this->db->from('data_keluarga');
        $this->db->join('user', 'data_keluarga.user_id = user.id', 'left');
        return $this->db->get()->result_array();
    }
    public function addkeluarga()
    {
        $data = [
            "user_id" => $this->input->post('user_id', true),
            "nama_keluarga" => $this->input->post('nama_keluarga', true),
            "hubungan" => $this->input->post('hubungan', true),
            "telp_keluarga" => $this->input->post('telp_keluarga', true),
        ];
        $this->db->insert('data_keluarga', $data);
    }

    public function hapuskeluarga($id)
    {
        $this->db->delete('data_keluarga', ['id_keluarga' => $id]);
    }
    public function getKeluargaId($id)
    {
        return $this->db->get_where('data_keluarga', ['id_keluarga' => $id])->row_array();
    }

    public function editKeluarga()
    {
        $data = [
            "user_id" => $this->input->post('user_id', true),
            "nama_keluarga" => $this->input->post('nama_keluarga', true),
            "hubungan" => $this->input->post('hubungan', true),
            "telp_keluarga" => $this->input->post('telp_keluarga', true),
        ];
        $this->db->where('id_keluarga', $this->input->post('id_keluarga'));
        $this->db->update('data_keluarga', $data);
    }
}
?>