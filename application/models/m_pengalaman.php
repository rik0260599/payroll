<?php

class M_pengalaman extends CI_Model
{
    public function getAllPengalaman()
    {
        $this->db->select('*');
        $this->db->from('data_pengalaman');
        $this->db->join('user', 'data_pengalaman.user_id = user.id', 'left');
        return $this->db->get()->result_array();
    }
    public function addPengalaman()
    {
        $data = [
            "user_id" => $this->input->post('user_id', true),
            "nama_perusahaan" => $this->input->post('nama_perusahaan', true),
            "jabatan" => $this->input->post('jabatan', true),
            "tgl_mulai" => $this->input->post('tgl_mulai', true),
            "tgl_berakhir" => $this->input->post('tgl_berakhir', true),
            "alasan_berhenti" => $this->input->post('alasan_berhenti', true),
            "status" => $this->input->post('status', true)
        ];
        $this->db->insert('data_pengalaman', $data);
    }

    public function hapusPengalaman($id)
    {
        $this->db->delete('data_pengalaman', ['id_pengalaman' => $id]);
    }

    public function getPengalamanId($id)
    {
        return $this->db->get_where('data_pengalaman', ['id_pengalaman' => $id])->row_array();
    }

    public function editPengalaman()
    {
        $data = [
            "user_id" => $this->input->post('user_id', true),
            "nama_perusahaan" => $this->input->post('nama_perusahaan', true),
            "jabatan" => $this->input->post('jabatan', true),
            "tgl_mulai" => $this->input->post('tgl_mulai', true),
            "tgl_berakhir" => $this->input->post('tgl_berakhir', true),
            "alasan_berhenti" => $this->input->post('alasan_berhenti', true),
            "status" => $this->input->post('status', true)
        ];
        $this->db->where('id_pengalaman', $this->input->post('id_pengalaman'));
        $this->db->update('data_pengalaman', $data);
    }
    public function GetPengalamanByID($id)
    {
        $this->db->select('data_pengalaman.*, user.name');
        $this->db->from('data_pengalaman');
        $this->db->join('user', 'data_pengalaman.user_id = user.id');
        $this->db->where('data_pengalaman.id_pengalaman', $id);
        return $this->db->get()->row_array();
    }
}
