<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_group extends CI_Model
{

    public function get_grup()
    {
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('groups');
        return $query->result_array();
    }

    public function tambah_grup()
    {
        $data = [
            'name'          => $this->input->post('name'),
            'description'   => $this->input->post('description')
        ];
        $security    = $this->security->xss_clean($data);
        return $this->db->insert('groups', $security);
    }

    public function update_grup()
    {
        $data = [
            $this->input->post('table_column') => $this->input->post('value')
        ];
        $id             = $this->input->post('id');
        $security       = $this->security->xss_clean($data);
        $security_id    = $this->security->xss_clean($id);

        $this->db->where('id', $security_id);
        $this->db->update('groups', $security);
    }

    public function delete_grup()
    {

        $id             = $this->input->post('id');
        $security_id    = $this->security->xss_clean($id);

        $this->db->where('id', $security_id);
        $this->db->delete('groups');
    }

    public function menu_group()
    {
        $this->db->order_by('serial_number', 'asc');
        return $this->db->get('menu_groups')->result_array();
    }
    public function main_menu($id_menu_groups)
    {
        $this->db->order_by('serial_number', 'asc');
        $this->db->where('id_menu_groups', $id_menu_groups);

        return $this->db->get('menu')->result_array();
    }
    public function sub_menu()
    {
        $this->db->order_by('serial_number', 'asc');
        return $this->db->get('sub_menu')->result_array();
    }

    public function insert_akses($idgrup, $idkategori)
    {
        $user = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
        $data =   [
            'id_groups'             => $idgrup,
            'id_menu_groups'        => $idkategori
        ];
        $security       = $this->security->xss_clean($data);
        return $this->db->insert('menu_access', $security);
    }

    public function hapus_akses($idgrup, $idkategori)
    {
        $user = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
        $data =   [
            'id_groups'             => $idgrup,
            'id_menu_groups'        => $idkategori
        ];

        $security       = $this->security->xss_clean($data);
        return $this->db->delete('menu_access', $security);
    }

    public function update_use_akses_menu($idmenu, $idgrup, $idmenugroup)
    {
        $data =   [
            'id_menu'               => $idmenu
        ];
        $security       = $this->security->xss_clean($data);

        $this->db->where('id_groups', $idgrup)->where('id_menu_groups', $idmenugroup);
        return $this->db->update('menu_access', $security);
    }

    public function update_notakses_menu($idgrup, $idmenugroup)
    {
        $data =   [
            'id_menu'               => 0
        ];
        $security       = $this->security->xss_clean($data);

        $this->db->where('id_groups', $idgrup)->where('id_menu_groups', $idmenugroup);
        return $this->db->update('menu_access', $security);
    }
}

/* End of file M_group.php */
