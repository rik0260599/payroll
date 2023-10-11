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
        $data['script'] = "dashboard/dashboard_admin";

        $this->load->view('template/header', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('template/footer',$data);
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