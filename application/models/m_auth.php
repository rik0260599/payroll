<?php

class M_auth extends CI_Model
{
    public function getUserLogin()
    {
        return $this->db->get_where('user', ['email_undira' => $this->session->userdata('email_undira')])->row_array();
        // $user_id = $user['id'];
    }
    public function getDataKeluarga($user_id)
    {
        return $this->db->get_where('data_keluarga', ['user_id' => $user_id])->result_array();
    }
    public function addKeluarga(){
		if($this->session->userdata('role_id') == '1') {
			$status = 'approved';
		} else {
			$status = 'review';
		}
        $data = [
            "user_id" => $this->input->post('user_id', true),
            "nama_keluarga" => $this->input->post('nama_keluarga', true),
            "hubungan" => $this->input->post('hubungan', true),
            "telp_keluarga" => $this->input->post('telp_keluarga', true),
			"status" => $status,
        ];
        $this->db->insert('data_keluarga', $data);
    }
	public function addPendidikan()
	{
		if($this->session->userdata('role_id') == '1') {
			$status = 'approved';
		} else {
			$status = 'review';
		}
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
            "status" => $status
        ];
        $this->db->insert('master_pendidikan', $data);
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
        ];
        $this->db->where('id_pendidikan', $this->input->post('id_pendidikan'));
        $this->db->update('master_pendidikan', $data);
	}
	public function addPengalaman()
	{
		if($this->session->userdata('role_id') == '1') {
			$status = 'approved';
		} else {
			$status = 'review';
		}
		$data = [
			"user_id" => $this->input->post('user_id', true),
			"nama_perusahaan" => $this->input->post('nama_perusahaan', true),
			"jabatan" => $this->input->post('jabatan', true),
			"tgl_mulai" => $this->input->post('tgl_mulai', true),
			"tgl_berakhir" => $this->input->post('tgl_berakhir', true),
			"alasan_berhenti" => $this->input->post('alasan_berhenti', true),
			"status" => $status
		];
		$this->db->insert('data_pengalaman', $data);
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
        ];
        $this->db->where('id_pengalaman', $this->input->post('id_pengalaman'));
        $this->db->update('data_pengalaman', $data);
	}
	public function addSeminar()
	{
		if($this->session->userdata('role_id') == '1') {
			$status = 'approved';
		} else {
			$status = 'review';
		}
		$data = [
            "user_id" => $this->input->post('user_id', true),
            "nama_seminar" => $this->input->post('nama_seminar', true),
            "deskripsi_seminar" => $this->input->post('deskripsi_seminar', true),
            "organisasi_pelaksana" => $this->input->post('organisasi_pelaksana', true),
            "lokasi_seminar" => $this->input->post('lokasi_seminar', true),
            "tgl_seminar" => $this->input->post('tgl_seminar', true),
            "url" => $this->input->post('url', true),
            "status" => $status
        ];
		$this->db->insert('master_seminar', $data);
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
        ];
        $this->db->where('id_seminar', $this->input->post('id_seminar'));
        $this->db->update('master_seminar', $data);
	}
    public function getDataPendidikan($user_id)
    {
        return $this->db->get_where('master_pendidikan', ['user_id' => $user_id])->result_array();
    }
    public function getDataPengalaman($user_id)
    {
        return $this->db->get_where('data_pengalaman', ['user_id' => $user_id])->result_array();
    }
    public function getDataPelatihan($user_id)
    {
        return $this->db->get_where('data_pelatihan', ['user_id' => $user_id])->result_array();
    }
    // seminar
    public function getDataSeminar($user_id)
    {
        return $this->db->get_where('master_seminar', ['user_id' => $user_id])->result_array();
    }

}
