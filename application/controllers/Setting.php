<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    public function index()
    {
        if(!access_jabatan("access_read",15)){
            $this->load->view('auth/blocked');
            return false;
        }

        $data['title'] = "My Profile";
		$email = $this->session->userdata('email_undira');
        $data['user'] = $this->m_user->getUserByEmail($email);

        $data['data_keluarga'] = $this->m_auth->getDataKeluarga($data['user']['id']);
        $data['data_pendidikan'] = $this->m_auth->getDataPendidikan($data['user']['id']);
        $data['data_pengalaman'] = $this->m_auth->getDataPengalaman($data['user']['id']);
        $data['data_pelatihan'] = $this->m_auth->getDataPelatihan($data['user']['id']);
        $data['data_seminar'] = $this->m_auth->getDataSeminar($data['user']['id']);
        $data['user_jabatan'] = $this->db->query("
            SELECT * FROM user_jabatan 
            LEFT JOIN master_jabatan on user_jabatan.jabatan_id = master_jabatan.id_jabatan
            WHERE user_id = ".$data['user']['id']."
            ")->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('setting/myprofile', $data);
        $this->load->view('template/footer');
    }
    public function edit()
    {
        if(!access_jabatan("access_update",15)){
            $this->load->view('auth/blocked');
            return false;
        }

        $data['title'] = "Edit Profile";
        $data['user'] = $this->m_auth->getUserLogin();
        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('telp', 'Telepon', 'required|integer');
        $this->form_validation->set_rules('tmpt_lahir', 'Tempat Lahir', 'required');
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required');


        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('setting/edit', $data);
            $this->load->view('template/footer');
        } else {
            $name =  $this->input->post('name');
            $email =  $this->input->post('email');
            $emailUndira =  $this->input->post('email_undira');
            $telp =  $this->input->post('telp');
            $address =  $this->input->post('address');
            $tmpt_lahir =  $this->input->post('tmpt_lahir');
            $tgl_lahir =  $this->input->post('tgl_lahir');

            // cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['upload_path']   = './assets/img/profile/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']      = 2048;
                $config['max_width']     = 1024;
                $config['max_height']    = 768;

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.png') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                    redirect('setting');
                }
            }

			if($this->session->userdata('role_id') == 1) {
				$status = 'approved';
			} else {
				$status = 'review';
			}

            $this->db->set('name', $name);
            $this->db->set('email', $email);
            $this->db->set('telp', $telp);
            $this->db->set('tmpt_lahir', $tmpt_lahir);
            $this->db->set('address', $address);
            $this->db->set('tgl_lahir', $tgl_lahir);
            $this->db->set('approval', $status);
            $this->db->where('email_undira', $emailUndira);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profile Berhasil Di Edit !!!</div>');
            redirect('setting');
        }
    }
    public function changePassword()
    {
        if(!access_jabatan("access_update",15)){
            $this->load->view('auth/blocked');
            return false;
        }

        $data['title'] = "Change Password";
        $data['user'] = $this->m_auth->getUserLogin();

        $this->form_validation->set_rules('current_password',  'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1',  'New Password', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2',  'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('setting/changepassword', $data);
            $this->load->view('template/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Anda Tidak Sama Dengan Password Sekarang !!!</div>');
                redirect('setting/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Password Baru Tidak Boleh Sama Dengan Password Lama !!!</div>');
                    redirect('setting/changepassword');
                } else {
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                    $this->db->set('password', $password_hash);
                    $this->db->where('email_undira', $this->session->userdata('email_undira'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Password Telah di Ganti !!!</div>');
                    redirect('setting/changepassword');
                }
            }
        }
    }
    public function addKeluarga()
    {
        if(!access_jabatan("access_add",15)){
            $this->load->view('auth/blocked');
            return false;
        }

        $data['title'] = "Add Data Keluarga";
        $data['user'] = $this->m_auth->getUserLogin();
        // $user_id = $this->session->userdata('user_id');
        // var_dump($user_id);
        $this->form_validation->set_rules('nama_keluarga', 'Nama Keluarga', 'required');
        $this->form_validation->set_rules('hubungan', 'Hubungan', 'required');
        $this->form_validation->set_rules('telp_keluarga', 'Telpon', 'required|numeric');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('setting/keluarga_add', $data);
            $this->load->view('template/footer');
        } else {
            $this->m_auth->addKeluarga();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Keluarga Di Tambahkan !!!</div>');
            redirect('setting');
        }
    }
	public function editKeluarga_user($id)
	{
        if(!access_jabatan("access_update",15)){
            $this->load->view('auth/blocked');
            return false;
        }

		$data['title'] = "Edit Data Keluarga";
        $data['user'] = $this->m_auth->getUserLogin();
        $data['users'] = $this->m_user->getAllUser();
        $data['keluarga'] = $this->m_keluarga->getkeluargaId($id);

        $this->form_validation->set_rules('user_id', 'Nama Pegawai', 'required');
        $this->form_validation->set_rules('nama_keluarga', 'Nama Keluarga', 'required');
        $this->form_validation->set_rules('hubungan', 'Hubungan', 'required');
        $this->form_validation->set_rules('telp_keluarga', 'Telpon', 'required|numeric');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('setting/keluarga_edit', $data);
            $this->load->view('template/footer');
        } else {
            $this->m_keluarga->editKeluarga();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Keluarga Di Edit !!!</div>');
            redirect('setting');
        }
	}
	public function hapusKeluarga($id)
    {
        if(!access_jabatan("access_delete",15)){
            $this->load->view('auth/blocked');
            return false;
        }

        $this->m_keluarga->hapusKeluarga($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Keluarga di Hapus !!!</div>');
        redirect('setting');
    }
    public function addPendidikan()
    {
        if(!access_jabatan("access_add",15)){
            $this->load->view('auth/blocked');
            return false;
        }

        $data['title'] = "Add Data Pendidikan";
        $data['user'] = $this->m_auth->getUserLogin();
        // $data['users'] = $this->m_user->getAllUser();

        $this->form_validation->set_rules('tingkat_pendidikan', 'Tingkat Pendidikan', 'required');
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required');
        $this->form_validation->set_rules('universitas', 'Universitas', 'required');
        $this->form_validation->set_rules('alamat_univ', 'Alamat Universitas', 'required');
        $this->form_validation->set_rules('judul_skripsi', 'Judul Skripsi', 'required');
        $this->form_validation->set_rules('nama_dospem', 'Nama Dosen Pembimbing', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('tgl_mulai', 'Tanggal Mulai', 'required');
        $this->form_validation->set_rules('tgl_lulus', 'Tanggal Selesai', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('setting/pendidikan_add', $data);
            $this->load->view('template/footer');
        } else {
            $this->m_auth->addPendidikan();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pendidikan Di Tambahkan !!!</div>');
            redirect('setting');
        }
    }
	public function editPendidikan($id)
	{
        if(!access_jabatan("access_update",15)){
            $this->load->view('auth/blocked');
            return false;
        }

		$data['title'] = "Edit Data pendidikan";
        $data['user'] = $this->m_auth->getUserLogin();
        $data['users'] = $this->m_user->getAllUser();
        $data['pendidikan'] = $this->m_pendidikan->getPendidikanId($id); 

        $this->form_validation->set_rules('user_id', 'Nama Pegawai', 'required');
        $this->form_validation->set_rules('tingkat_pendidikan', 'Tingkat Pendidikan', 'required');
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required');
        $this->form_validation->set_rules('universitas', 'Universitas', 'required');
        $this->form_validation->set_rules('alamat_univ', 'Alamat Universitas', 'required');
        $this->form_validation->set_rules('judul_skripsi', 'Judul Skripsi', 'required');
        $this->form_validation->set_rules('nama_dospem', 'Nama Dosen Pembimbing', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('tgl_mulai', 'Tanggal Mulai', 'required');
        $this->form_validation->set_rules('tgl_lulus', 'Tanggal Selesai', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('setting/pendidikan_edit', $data);
            $this->load->view('template/footer');
        } else {
            $this->m_auth->editPendidikan();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pendidikan Di Edit !!!</div>');
            redirect('setting');
        }
	}
	public function hapusPendidikan($id)
	{
        if(!access_jabatan("access_delete",15)){
            $this->load->view('auth/blocked');
            return false;
        }

		$this->m_pendidikan->hapusPendidikan($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Pendidikan di Hapus !!!</div>');
        redirect('setting');
	}
    public function addPengalaman()
    {
        if(!access_jabatan("access_add",15)){
            $this->load->view('auth/blocked');
            return false;
        }

        $data['title'] = "Add Data Pengalaman";
        $data['user'] = $this->m_auth->getUserLogin();

        $this->form_validation->set_rules('nama_perusahaan', 'Nama Perusahaan', 'required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
        $this->form_validation->set_rules('tgl_mulai', 'Tanggal Mulai', 'required');
        $this->form_validation->set_rules('tgl_berakhir', 'Tanggal Berakhir', 'required');
        $this->form_validation->set_rules('alasan_berhenti', 'Alasan Berhenti', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('setting/Pengalaman_add', $data);
            $this->load->view('template/footer');
        } else {
            $this->m_auth->addPengalaman();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">pengalaman Di Tambahkan !!!</div>');
            redirect('setting');
        }
    }
	public function editPengalaman($id)
	{
        if(!access_jabatan("access_update",15)){
            $this->load->view('auth/blocked');
            return false;
        }

		$data['title'] = "Edit Data pengalaman";
        $data['user'] = $this->m_auth->getUserLogin();
        $data['users'] = $this->m_user->getAllUser();
        $data['pengalaman'] = $this->m_pengalaman->getPengalamanId($id);

        $this->form_validation->set_rules('user_id', 'Nama Pegawai', 'required');
        $this->form_validation->set_rules('nama_perusahaan', 'Nama Perusahaan', 'required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
        $this->form_validation->set_rules('tgl_mulai', 'Tanggal Mulai', 'required');
        $this->form_validation->set_rules('tgl_berakhir', 'Tanggal Berakhir', 'required');
        $this->form_validation->set_rules('alasan_berhenti', 'Alasan Berhenti', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('setting/pengalaman_edit', $data);
            $this->load->view('template/footer');
        } else {
            $this->m_auth->editPengalaman();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">pengalaman Di Edit !!!</div>');
            redirect('setting');
        }
	}
	public function hapusPengalaman($id)
    {
        if(!access_jabatan("access_delete",15)){
            $this->load->view('auth/blocked');
            return false;
        }

        $this->m_pengalaman->hapusPengalaman($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data pengalaman di Hapus !!!</div>');
        redirect('setting');
    }
    public function addPelatihan()
    {
        if(!access_jabatan("access_add",15)){
            $this->load->view('auth/blocked');
            return false;
        }

        $data['title'] = "Add Data Pelatihan";
        $data['user'] = $this->m_auth->getUserLogin();

        $this->form_validation->set_rules('nama_pelatihan', 'Nama Pelatihan', 'required');
        $this->form_validation->set_rules('organisasi_penerbit', 'Organisasi Penerbit', 'required');
        $this->form_validation->set_rules('lokasi_pelatihan', 'Lokasi Pelatihan', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi Pelatihan', 'required');
        $this->form_validation->set_rules('tgl_mulai', 'Tanggal Mulai', 'required');
        $this->form_validation->set_rules('tgl_selesai', 'Tanggal Selesai', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('data/pelatihan_add', $data);
            $this->load->view('template/footer');
        } else {
            $this->m_auth->addPelatihan();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pelatihan Di Tambahkan !!!</div>');
            redirect('setting');
        }
    }
    public function addSeminar(){
        if(!access_jabatan("access_add",15)){
            $this->load->view('auth/blocked');
            return false;
        }

        $data['title'] = "Add Data Seminar";
        $data['user'] = $this->m_auth->getUserLogin();

        $this->form_validation->set_rules('nama_seminar', 'Nama seminar', 'required');
        $this->form_validation->set_rules('deskripsi_seminar', 'Deskripsi Seminar', 'required');
        $this->form_validation->set_rules('organisasi_pelaksana', 'Organisasi pelaksana', 'required');
        $this->form_validation->set_rules('lokasi_seminar', 'Lokasi Seminar', 'required');
        $this->form_validation->set_rules('tgl_seminar', 'Tanggal seminar', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
    
        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('setting/seminar_add', $data);
            $this->load->view('template/footer');
        } else {
            $this->m_auth->addSeminar();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Seminar Di Tambahkan !!!</div>');
            redirect('setting');
        }
    }
	public function editSeminar($id)
	{
        if(!access_jabatan("access_update",15)){
            $this->load->view('auth/blocked');
            return false;
        }

		$data['title'] = "Edit Data Seminar";
        $data['user'] = $this->m_auth->getUserLogin();
        $data['users'] = $this->m_user->getAllUser();
        $data['seminar'] = $this->m_seminar->getSeminarId($id);

        $this->form_validation->set_rules('user_id', 'Nama Pegawai', 'required');
        $this->form_validation->set_rules('nama_seminar', 'Nama Seminar', 'required');
        $this->form_validation->set_rules('deskripsi_seminar', 'Deskripsi Seminar', 'required');
        $this->form_validation->set_rules('organisasi_pelaksana', 'Organisasi pelaksana', 'required');
        $this->form_validation->set_rules('lokasi_seminar', 'Lokasi Seminar', 'required');
        $this->form_validation->set_rules('tgl_seminar', 'Tanggal seminar', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('setting/seminar_edit', $data);
            $this->load->view('template/footer');
        } else {
            $this->m_seminar->editSeminar();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Seminar Di Edit !!!</div>');
            redirect('setting');
        }
	}
	public function hapusSeminar($id)
	{
        if(!access_jabatan("access_delete",15)){
            $this->load->view('auth/blocked');
            return false;
        }

		$this->m_seminar->hapusSeminar($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Seminar di Hapus !!!</div>');
        redirect('setting');
	}
}
