<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Access extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        if(!access_jabatan("access_read",42)){
            $this->load->view('auth/blocked');
            return false;
        }
        

        $data['user'] = $this->m_auth->getUserLogin();
        $jabatan_id = $data['user']['jabatan_id'];
        $data['title'] = "Access Menu";
        $data['role'] = $this->db->query("SELECT * from master_jabatan where parent_jabatan_id = $jabatan_id and id_jabatan != $jabatan_id")->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('user/role', $data);
        $this->load->view('template/footer');
    }

    
    public function roleAccess($id_jabatan)
    {

        if(!access_jabatan("access_update",42)){
            $this->load->view('auth/blocked');
            return false;
        }

        $data['title'] = "Role Access";

        $data['user'] = $this->m_auth->getUserLogin();
        $role = $data['user']['role_id'];

        $data['user_access_menu'] = $this->db->query("
            SELECT user_sub_menu.* , user_menu.menu
            from user_access_menu 
            right join user_menu on user_menu.id = user_access_menu.menu_id
            left join user_sub_menu on user_sub_menu.menu_id = user_menu.id
            where user_access_menu.role_id = $role
        ")->result_array();

        $data['access_jabatan'] = $this->db->query("
            SELECT * from access_jabatan
        ")->result_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->m_menu->getMenu();

        $this->load->view('template/header', $data);
        $this->load->view('user/role-access', $data);
        $this->load->view('template/footer');
    }

    public function changeAccess()
    {
        if(!access_jabatan("access_update",42)){
            $this->load->view('auth/blocked');
            return false;
        }
        
        $type = $this->input->post('type');
        $id_user_sub_menu = $this->input->post('submenu');
        $id_jabatan = $this->input->post('idjabatan');
        $checked = $this->input->post('checked');



        $result = $this->db->get_where('access_jabatan', [
            'id_user_sub_menu' => $id_user_sub_menu,
            'id_jabatan' => $id_jabatan,
        ]);

        if ($result->num_rows() < 1) {
            $this->db->insert('access_jabatan', [
                'id_user_sub_menu' => $id_user_sub_menu,
                'id_jabatan' => $id_jabatan,
                $type => $checked
            ]);
        } else {
            $this->db->update('access_jabatan', [
                'id_user_sub_menu' => $id_user_sub_menu,
                'id_jabatan' => $id_jabatan,
                $type => $checked
            ],[
                'id_user_sub_menu' => $id_user_sub_menu,
                'id_jabatan' => $id_jabatan,
            ]);
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access di Ubah!!!!</div>');
    }
}
