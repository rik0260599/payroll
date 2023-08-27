<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    public function index()
    {
        if(!access_jabatan("access_read",5)){
            $this->load->view('auth/blocked');
            return false;
        }
        $data['title'] = "Menu Management";
        $data['user'] = $this->m_auth->getUserLogin();
        $data['menu'] = $this->m_menu->getMenu();

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('template/footer');
        } else {
            $this->m_menu->addMenu();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu Di Tambahkan !!!</div>');
            redirect('menu');
        }
    }
    public function hapus($id)
    {
        $this->m_menu->hapusMenu($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu di Hapus !!!</div>');
        redirect('menu');
    }
    public function edit($id)
    {
        $data['title'] = "Edit Menu";
        $data['user'] = $this->m_auth->getUserLogin();
        $data['menu'] = $this->m_menu->getMenuId($id);

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('menu/edit', $data);
            $this->load->view('template/footer');
        } else {
            $this->m_menu->editMenu();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu Berhasil di Edit !!!</div>');
            redirect('menu');
        }
    }

    // controller sub menu
    public function submenu()
    {
        $data['title'] = "Sub Menu Management";
        $data['user'] = $this->m_auth->getUserLogin();
        $data['submenu'] = $this->m_menu->getSubMenu();
        $data['menu'] = $this->m_menu->getMenu();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('template/footer');
        } else {
            $this->m_menu->addSubMenu();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sub Menu Di Tambahkan !!!</div>');
            redirect('menu/submenu');
        }
    }

    public function hapussubmenu($id)
    {
        $this->m_menu->hapusSubMenu($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sub Menu di Hapus !!!</div>');
        redirect('menu/submenu');
    }

    public function editsubmenu($id)
    {
        $data['user'] = $this->m_auth->getUserLogin();
        $data['title'] = "Edit Menu";
        $data['submenu'] = $this->m_menu->getSubMenuId($id);
        $data['menu'] = $this->m_menu->getMenu();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('menu/submenu_edit', $data);
            $this->load->view('template/footer');
        } else {
            $this->m_menu->editSubMenu();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sub Menu Berhasil di Edit !!!</div>');
            redirect('menu/submenu');
        }
    }
}
