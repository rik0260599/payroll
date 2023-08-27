<?php

class M_admin extends CI_Model
{
    public function getRole()
    {
        return $this->db->get('user_role')->result_array();
    }
    public function getRoleId($role_id)
    {
        return $this->db->get_where('user_role', ['id' => $role_id])->row_array();
    }
    public function total_user()
    {
        return $this->db->get('user')->num_rows();
    }
    public function total_jabatan()
    {
        return $this->db->get('master_jabatan')->num_rows();
    }
    //jenis kelamin pegawai
    public function total_pria()
    {
        $this->db->select('jenis_kelamin');
        $this->db->from('user');
        $this->db->where('jenis_kelamin = "pria"');
        return $this->db->get()->num_rows();
    }
    public function total_perempuan()
    {
        $this->db->select('jenis_kelamin');
        $this->db->from('user');
        $this->db->where('jenis_kelamin = "perempuan"');
        return $this->db->get()->num_rows();
    }
    //agama Pegawai
    public function total_agama_islam()
    {
        $this->db->select('agama');
        $this->db->from('user');
        $this->db->where('agama = "islam"');
        return $this->db->get()->num_rows();
    }
    public function total_agama_kristen()
    {
        $this->db->select('agama');
        $this->db->from('user');
        $this->db->where('agama = "kristen"');
        return $this->db->get()->num_rows();
    }
    public function total_agama_katolik()
    {
        $this->db->select('agama');
        $this->db->from('user');
        $this->db->where('agama = "katolik"');
        return $this->db->get()->num_rows();
    }
    public function total_agama_hindu()
    {
        $this->db->select('agama');
        $this->db->from('user');
        $this->db->where('agama = "hindu"');
        return $this->db->get()->num_rows();
    }
    public function total_agama_buddha()
    {
        $this->db->select('agama');
        $this->db->from('user');
        $this->db->where('agama = "buddha"');
        return $this->db->get()->num_rows();
    }
    public function total_agama_konghuchu()
    {
        $this->db->select('agama');
        $this->db->from('user');
        $this->db->where('agama = "konghuchu"');
        return $this->db->get()->num_rows();
    }
    //jenis Pegawai
    public function total_pegawai_tendik()
    {
        $this->db->select('jenis_pegawai');
        $this->db->from('user');
        $this->db->where('jenis_pegawai = "tendik"');
        return $this->db->get()->num_rows();
    }
    public function total_pegawai_dosenTetap()
    {
        $this->db->select('jenis_pegawai');
        $this->db->from('user');
        $this->db->where('jenis_pegawai = "dosen tetap"');
        return $this->db->get()->num_rows();
    }
    public function total_pegawai_dosenTidakTetap()
    {
        $this->db->select('jenis_pegawai');
        $this->db->from('user');
        $this->db->where('jenis_pegawai = "dosen tidak tetap"');
        return $this->db->get()->num_rows();
    }
    public function total_pegawai_tetap()
    {
        $this->db->select('jenis_pegawai');
        $this->db->from('user');
        $this->db->where('jenis_pegawai = "Pegawai tetap"');
        return $this->db->get()->num_rows();
    }
    public function total_pegawai_kontrak()
    {
        $this->db->select('jenis_pegawai');
        $this->db->from('user');
        $this->db->where('jenis_pegawai = "Kontrak"');
        return $this->db->get()->num_rows();
    }
}
