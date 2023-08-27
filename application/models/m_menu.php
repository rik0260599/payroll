<?php

class M_menu extends CI_Model
{
    public function getMenu()
    {
        return $this->db->get('user_menu')->result_array();
    }
    public function addMenu()
    {
        $data = [
            "menu" => $this->input->post('menu', true)
        ];
        $this->db->insert('user_menu', $data);
    }
    public function hapusMenu($id)
    {
        $this->db->delete('user_menu', ['id' => $id]);
    }
    public function getMenuId($id)
    {
        return $this->db->get_where('user_menu', ['id' => $id])->row_array();
    }
    public function editMenu()
    {
        $data = [
            "menu" => $this->input->post('menu', true),
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user_menu', $data);
    }

    // Sub menu model
    public function getSubMenu()
    {
        $query = "SELECT `user_sub_menu`.*,`user_menu`.`menu`
                    FROM `user_sub_menu` JOIN `user_menu`
                    ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                ";
        return $this->db->query($query)->result_array();
    }
    public function addSubMenu()
    {
        $data = [
            "title" => $this->input->post('title', true),
            "menu_id" => $this->input->post('menu_id', true),
            "url" => $this->input->post('url', true),
            "icon" => $this->input->post('icon', true),
            "is_active" => $this->input->post('is_active', true)
        ];
        $this->db->insert('user_sub_menu', $data);
    }

    public function hapusSubMenu($id)
    {
        $this->db->delete('user_sub_menu', ['id' => $id]);
    }
    public function getSubMenuId($id)
    {
        return $this->db->get_where('user_sub_menu', ['id' => $id])->row_array();
    }
    public function editSubMenu()
    {
        $data = [
            "title" => $this->input->post('title', true),
            "menu_id" => $this->input->post('menu_id', true),
            "url" => $this->input->post('url', true),
            "icon" => $this->input->post('icon', true),
            "is_active" => $this->input->post('is_active', true)
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user_sub_menu', $data);
    }
}
