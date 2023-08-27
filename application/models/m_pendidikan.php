<?php

class M_pendidikan extends CI_Model
{
    public function getAllPendidikan()
    {
        $this->db->select('*');
        $this->db->from('master_pendidikan');
        $this->db->join('user', 'master_pendidikan.user_id = user.id', 'left');
        return $this->db->get()->result_array();
    }
    public function addPendidikan()
    {
        $data = [
            "user_id" => $this->input->post('user_id', true),
            "tingkat_pendidikan" => $this->input->post('tingkat_pendidikan', true),
            "jurusan" => $this->input->post('jurusan', true),
            "universitas" => $this->input->post('universitas', true),
            "alamat_univ" => $this->input->post('alamat_univ', true),
            "tgl_mulai" => $this->input->post('tgl_mulai', true),
            "tgl_lulus" => $this->input->post('tgl_lulus', true),
            "judul_skripsi" => $this->input->post('judul_skripsi', true),
            "nama_dospem" => $this->input->post('nama_dospem', true),
            "url" => $this->input->post('url', true),
            "status" => $this->input->post('status', true)
        ];
        $this->db->insert('master_pendidikan', $data);
    }

    public function hapusPendidikan($id)
    {
        $this->db->delete('master_pendidikan', ['id_pendidikan' => $id]);
    }

    public function getPendidikanId($id)
    {
        return $this->db->get_where('master_pendidikan', ['id_pendidikan' => $id])->row_array();
    }

    public function editPendidikan()
    {
        $data = [
            "user_id" => $this->input->post('user_id', true),
            "tingkat_pendidikan" => $this->input->post('tingkat_pendidikan', true),
            "jurusan" => $this->input->post('jurusan', true),
            "universitas" => $this->input->post('universitas', true),
            "alamat_univ" => $this->input->post('alamat_univ', true),
            "tgl_mulai" => $this->input->post('tgl_mulai', true),
            "tgl_lulus" => $this->input->post('tgl_lulus', true),
            "judul_skripsi" => $this->input->post('judul_skripsi', true),
            "nama_dospem" => $this->input->post('nama_dospem', true),
            "url" => $this->input->post('url', true),
            "status" => $this->input->post('status', true)
        ];
        $this->db->where('id_pendidikan', $this->input->post('id_pendidikan'));
        $this->db->update('master_pendidikan', $data);
    }
    public function GetPendidikanByID($id)
    {
        $this->db->select('master_pendidikan.*, user.name');
        $this->db->from('master_pendidikan');
        $this->db->join('user', 'master_pendidikan.user_id = user.id');
        $this->db->where('master_pendidikan.id_pendidikan', $id);
        return $this->db->get()->row_array();
    }
}
