<?php

class M_jabatan extends CI_Model
{
    public function getAllJabatan()
    {
        $this->db->select('*');
        $this->db->from('master_jabatan');
        $this->db->join('master_parent_jabatan', 'master_jabatan.parent_jabatan_id = master_parent_jabatan.id_parent_jabatan', 'left');
        return $this->db->get()->result_array();
    }

    public function addJabatan()
    {
        $data = [
            "parent_jabatan_id" => $this->input->post('parent_jabatan_id', true),
            "jabatan" => $this->input->post('jabatan', true),
			"role_id" => $this->input->post('role_id', true)
        ];
        $this->db->insert('master_jabatan', $data);
    }
    public function hapusJabatan($id)
    {
        $this->db->delete('master_jabatan', ['id_jabatan' => $id]);
    }

    public function getJabatanId($id)
    {
        return $this->db->get_where('master_jabatan', ['id_jabatan' => $id])->row_array();
    }


    public function editJabatan()
    {
        $data = [
            "parent_jabatan_id" => $this->input->post('parent_jabatan_id', true),
            "jabatan" => $this->input->post('jabatan', true),
			"role_id" => $this->input->post('role_id', true)
        ];
        $this->db->where('id_jabatan', $this->input->post('id_jabatan'));
        $this->db->update('master_jabatan', $data);
    }

    //model parent jabatan
    public function getAllParentJabatan()
    {
        return $this->db->get('master_parent_jabatan')->result_array();
    }

    public function addParentJabatan()
    {
        $data = [
            "parent_jabatan" => $this->input->post('parent_jabatan', true),
        ];
        $this->db->insert('master_parent_jabatan', $data);
    }
    public function hapusParentJabatan($id)
    {
        $this->db->delete('master_parent_jabatan', ['id_parent_jabatan' => $id]);
    }

    public function getParentJabatanId($id)
    {
        return $this->db->get_where('master_parent_jabatan', ['id_parent_jabatan' => $id])->row_array();
    }

    public function editParentJabatan()
    {
        $data = [
            "parent_jabatan" => $this->input->post('parent_jabatan', true),
        ];
        $this->db->where('id_parent_jabatan', $this->input->post('id_parent_jabatan'));
        $this->db->update('master_parent_jabatan', $data);
    }
}
