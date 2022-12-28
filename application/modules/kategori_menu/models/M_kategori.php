<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_kategori extends CI_Model
{

    var $table = 'menu_groups';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_data()
    {
        $this->db->order_by('serial_number', 'asc');
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    public function tambah()
    {
        $user = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
        $data = [
            'name'              => htmlspecialchars($this->input->post('name')),
            'serial_number'     => htmlspecialchars($this->input->post('serial_number'))
        ];
        $security       = $this->security->xss_clean($data);
        return $this->db->insert($this->table, $security);
    }

    public function update()
    {
        $id                = $this->input->post('id_menu_group');
        $security_id       = $this->security->xss_clean($id);

        $data = [
            $this->input->post('table_column')  => $this->input->post('value'),
            'created_at'                        => tanggal_indonesia_medium(date('Y-m-d'))
        ];
        $security       = $this->security->xss_clean($data);

        $this->db->where('id_menu_group', $security_id);
        return $this->db->update($this->table, $security);
    }

    public function delete()
    {
        $id                = $this->input->post('id_menu_group');
        $security_id       = $this->security->xss_clean($id);

        $this->db->where('id_menu_group', $security_id);
        return $this->db->delete($this->table);
    }
}

/* End of file M_kategori.php */
