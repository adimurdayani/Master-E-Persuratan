<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_sidebar extends CI_Model
{

    public function akses_menu()
    {
        $user = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $users_groups = $this->db->get_where('users_groups', ['user_id' => $user['id']])->row_array();

        $this->db->select('menu_groups.id_menu_group, name');
        $this->db->from('menu_groups');
        $this->db->join('menu_access', 'menu_access.id_menu_groups = menu_groups.id_menu_group');
        $this->db->where('menu_access.id_groups', $users_groups['group_id']);
        $this->db->order_by('menu_groups.serial_number', 'asc');

        return $this->db->get()->result_array();
    }

    public function main_menu($id_kategori)
    {
        $this->db->select('*');
        $this->db->from('menu');
        $this->db->where('id_menu_groups', $id_kategori);
        $this->db->order_by('serial_number', 'asc');
        return $this->db->get()->result_array();
    }

    public function submenu()
    {
        $this->db->select('*');
        $this->db->from('sub_menu');
        $this->db->order_by('serial_number', 'asc');
        $this->db->where('active', 1);
        return $this->db->get()->result_array();
    }
}

/* End of file M_sidebar.php */
