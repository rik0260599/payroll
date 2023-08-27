<?php

class M_seminar extends CI_Model
{
    public function getAllseminar()
    {
        $this->db->select('*');
        $this->db->from('master_seminar');
        $this->db->join('user', 'master_seminar.user_id = user.id', 'left');
        return $this->db->get()->result_array();
    }

    public function addSeminar()
    {
        $data = [
            "user_id" => $this->input->post('user_id', true),
            "nama_seminar" => $this->input->post('nama_seminar', true),
            "deskripsi_seminar" => $this->input->post('deskripsi_seminar', true),
            "organisasi_pelaksana" => $this->input->post('organisasi_pelaksana', true),
            "lokasi_seminar" => $this->input->post('lokasi_seminar', true),
            "tgl_seminar" => $this->input->post('tgl_seminar', true),
            "url" => $this->input->post('url', true),
            "status" => $this->input->post('status', true)
        ];
        $this->db->insert('master_seminar', $data);
    }

    public function hapusSeminar($id)
    {
        $this->db->delete('master_seminar', ['id_seminar' => $id]);
    }

    public function getSeminarId($id)
    {
        return $this->db->get_where('master_seminar', ['id_seminar' => $id])->row_array();
    }

    public function editSeminar()
    {
        $data = [
            "user_id" => $this->input->post('user_id', true),
            "nama_seminar" => $this->input->post('nama_seminar', true),
            "deskripsi_seminar" => $this->input->post('deskripsi_seminar', true),
            "organisasi_pelaksana" => $this->input->post('organisasi_pelaksana', true),
            "lokasi_seminar" => $this->input->post('lokasi_seminar', true),
            "tgl_seminar" => $this->input->post('tgl_seminar', true),
            "url" => $this->input->post('url', true),
            "status" => $this->input->post('status', true)
        ];
        $this->db->where('id_seminar', $this->input->post('id_seminar'));
        $this->db->update('master_seminar', $data);
    }
    public function GetSeminarByID($id)
    {
        $this->db->select('master_seminar.*, user.name');
        $this->db->from('master_seminar');
        $this->db->join('user', 'master_seminar.user_id = user.id');
        $this->db->where('master_seminar.id_seminar', $id);
        return $this->db->get()->row_array();
    }
}
