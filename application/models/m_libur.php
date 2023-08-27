<?php

class M_Libur extends CI_Model
{
    public function getAllLibur()
    {
        return $this->db->get('master_libur')->result_array();
    }

    public function addLibur()
    {
        $data = [
            "tgl_mulai" => $this->input->post('tgl_mulai', true),
            "tgl_akhir" => $this->input->post('tgl_akhir', true),
            "keterangan" => $this->input->post('keterangan', true)
        ];
        $this->db->insert('master_libur', $data);
    }
    public function hapusLibur($id)
    {
        $this->db->delete('master_libur', ['id_libur' => $id]);
    }

    public function getLiburId($id)
    {
        return $this->db->get_where('master_libur', ['id_libur' => $id])->row_array();
    }


    public function editLibur()
    {
        $data = [
            "tgl_mulai" => $this->input->post('tgl_mulai', true),
            "tgl_akhir" => $this->input->post('tgl_akhir', true),
            "keterangan" => $this->input->post('keterangan', true)
        ];
        $this->db->where('id_libur', $this->input->post('id_libur'));
        $this->db->update('master_libur', $data);
    }
}
