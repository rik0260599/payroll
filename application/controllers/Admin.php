<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    public function index()
    {
        if(!access_jabatan("access_read",1)){
            $this->load->view('auth/blocked');
            return false;
        }
        $data['title'] = "Dashboard";
        $data['user'] = $this->m_auth->getUserLogin();
        $data['total_user'] = $this->m_admin->total_user();
        $data['total_jabatan'] = $this->m_admin->total_jabatan();
        $data['total_pria'] = $this->m_admin->total_pria();
        //jenis kelamin
        $data['total_perempuan'] = $this->m_admin->total_perempuan();
        $data['total_agama_islam'] = $this->m_admin->total_agama_islam();
        //agama
        $data['total_agama_kristen'] = $this->m_admin->total_agama_kristen();
        $data['total_agama_katolik'] = $this->m_admin->total_agama_katolik();
        $data['total_agama_hindu'] = $this->m_admin->total_agama_hindu();
        $data['total_agama_buddha'] = $this->m_admin->total_agama_buddha();
        $data['total_agama_konghuchu'] = $this->m_admin->total_agama_konghuchu();
        //jenis pegawai
        $data['total_pegawai_tendik'] = $this->m_admin->total_pegawai_tendik();
        $data['total_pegawai_dosenTetap'] = $this->m_admin->total_pegawai_dosenTetap();
        $data['total_pegawai_dosenTidakTetap'] = $this->m_admin->total_pegawai_dosenTidakTetap();
        $data['total_pegawai_tetap'] = $this->m_admin->total_pegawai_tetap();
        $data['total_pegawai_kontrak'] = $this->m_admin->total_pegawai_kontrak();

        $this->load->view('template/header', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('template/footer');
    }
    public function role()
    {
        if(!access_jabatan("access_read",13)){
            $this->load->view('auth/blocked');
            return false;
        }

        $data['user'] = $this->m_auth->getUserLogin();
        $data['title'] = "Role";
        $data['role'] = $this->m_admin->getRole();

        $this->load->view('template/header', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('template/footer');
    }

    
    public function roleAccess($role_id)
    {
        $data['title'] = "Role Access";

        $data['user'] = $this->m_auth->getUserLogin();
        $data['role'] = $this->m_admin->getRoleId($role_id);
        $this->db->where('id !=', 1);
        $data['menu'] = $this->m_menu->getMenu();

        $this->load->view('template/header', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('template/footer');
    }

    public function roleAccessSubmenu()
    {
        $data['title'] = "Role Access";

        $data['user'] = $this->m_auth->getUserLogin();
        $data['menu'] = $this->m_menu->getMenu();

        $this->load->view('template/header', $data);
        $this->load->view('admin/role-access-submenu', $data);
        $this->load->view('template/footer');
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access di Ubah!!!!</div>');
    }
}
