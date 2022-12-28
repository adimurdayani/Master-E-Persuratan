<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_detail extends CI_Model
{

    var $table = 'sub_menu';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_data($id)
    {
        $this->db->order_by('sub_menu.serial_number', 'asc');
        $this->db->where('id_menus', $id);
        return $this->db->get($this->table)->result();
    }

    public function aktif($id)
    {
        $data = [
            'active' => 1
        ];
        $security        = $this->security->xss_clean($data);
        $security_id     = $this->security->xss_clean($id);

        $this->db->where('id_sub_menu', $security_id);
        return $this->db->update($this->table, $security);
    }
    public function nonaktif($id)
    {
        $data = [
            'active' => 0
        ];
        $security        = $this->security->xss_clean($data);
        $security_id     = $this->security->xss_clean($id);

        $this->db->where('id_sub_menu', $security_id);
        return $this->db->update($this->table, $security);
    }

    public function hapus()
    {
        $id             = $this->input->post('id_sub_menu');
        $security_id    = $this->security->xss_clean($id);

        $this->db->where('id_sub_menu', $security_id);
        return $this->db->delete($this->table);
    }

    public function tambah()
    {
        $data = [
            'id_menus'          => htmlspecialchars($this->input->post('id_menu')),
            'id_menu_groups'    => htmlspecialchars($this->input->post('id_kategori')),
            'serial_number'     => htmlspecialchars($this->input->post('no_urut')),
            'submenu_title'     => htmlspecialchars($this->input->post('nama_submenu')),
            'url'               => htmlspecialchars($this->input->post('url')),
            'active'            => 1
        ];
        $security        = $this->security->xss_clean($data);

        return $this->db->insert($this->table, $security);
    }

    public function update()
    {
        $data = [
            $this->input->post('table_column') => $this->input->post('value')
        ];

        $id                 = $this->input->post('id_sub_menu');
        $security           = $this->security->xss_clean($data);
        $security_id        = $this->security->xss_clean($id);

        $this->db->where('id_sub_menu', $security_id);
        return $this->db->update($this->table, $security);
    }
}

/* End of file M_detail.php */
