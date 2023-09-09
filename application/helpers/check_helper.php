<?php

function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email_undira')) {
        redirect('auth');
    } else {
        $role_id = $ci->session->userdata('role_id');
        $menu = $ci->uri->segment(1);

        $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
        $menu_id = $queryMenu['id'];

        $userAccess = $ci->db->get_where('user_access_menu', [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ]);
        if ($userAccess->num_rows() < 1) {
            redirect('auth/blocked');   
        }
    }
}

function is_logged_in2(){
    $ci = get_instance();
    if (!$ci->session->userdata('email_undira')) {
        redirect('auth');
    } 
}

// test with submenu
// function is_logged_in()
// {
//     $ci = get_instance();
//     if (!$ci->session->userdata('email_undira')) {
//         redirect('auth');
//     } else {
//         $role_id = $ci->session->userdata('role_id');
//         $menu = $ci->uri->segment(1);
//         $sub_menu = $ci->uri->segment(2);

//         $query_menu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
//         $menu_id = $query_menu['id'];

//         $query_sub_menu = $ci->db->get_where('user_sub_menu', [
//             'menu_id' => $menu_id,
//             'url' => $sub_menu
//         ])->row_array();
//         $sub_menu_id = $query_sub_menu['id'];

//         $user_access = $ci->db->get_where('user_access_menu', [
//             'role_id' => $role_id,
//             'menu_id' => $menu_id,
//             'sub_menu_id' => $sub_menu_id
//         ]);

//         if ($user_access->num_rows() < 1) {
//             redirect('auth/blocked');
//         }
//     }
// }



//gagal
// function is_logged_in()
// {
//     $ci = get_instance();
//     if (!$ci->session->userdata('email_undira')) {
//         redirect('auth');
//     } else {
//         $role_id = $ci->session->userdata('role_id');
//         $menu = $ci->uri->segment(1);

//         $query_menu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
//         if (empty($query_menu)) {
//             return true;
//         }
//         $menu_id = $query_menu['id'];

//         $user_access = $ci->db->get_where('user_access_menu', [
//             'role_id' => $role_id,
//             'menu_id' => $menu_id
//         ]);
//         if ($user_access->num_rows() < 1) {
//             redirect('auth/blocked');
//         }
//     }
// }

function check_access($role_id, $menu_id)
{
    $ci = get_instance();

    $ci->db->where('role_id', $role_id);
    $ci->db->where('menu_id', $menu_id);
    $result = $ci->db->get('user_access_menu');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}

function access_jabatan($access_type = "access_read", $id_user_sub_menu = 0)
{
    $ci = get_instance();
    $data = $ci->db->query("
        SELECT * 
        from access_jabatan 
        where id_jabatan = ".$ci->session->userdata('jabatan_id').
        " and id_user_sub_menu = ".$id_user_sub_menu
    )->row_array();

    return (
        !isset($data[$access_type]) || 
        (
            isset($data[$access_type]) && 
            $data[$access_type] == 1
        )
    );
}