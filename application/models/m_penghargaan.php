<?php

class M_penghargaan extends CI_Model
{
    public function getPenghargaan()
    {
        return $this->db->get('master_penghargaan')->result_array();
    }
    public function addPenghargaan()
    {
        $data = [
            "name" => $this->input->post('name', true)
        ];
        $this->db->insert('master_penghargaan', $data);
    }
    public function hapusPenghargaan($id)
    {
        $this->db->delete('master_penghargaan', ['id' => $id]);
    }
    public function getPenghargaanId($id)
    {
        return $this->db->get_where('master_penghargaan', ['id' => $id])->row_array();
    }
    public function editPenghargaan()
    {
        $data = [
            "name" => $this->input->post('name', true),
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('master_penghargaan', $data);
    }
}
