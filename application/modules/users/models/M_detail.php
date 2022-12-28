<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_detail extends CI_Model
{
    var $table = 'users';
    var $table_group = 'groups';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_user($decode)
    {
        $this->db->where('id', $decode);
        return $this->db->get($this->table)->result();
    }

    public function get_group()
    {
        return $this->db->get($this->table_group)->result();
    }

    public function hapus_grup()
    {
        $id             = htmlspecialchars($this->input->post('id'));
        $security_id    = $this->security->xss_clean($id);

        $this->db->where('user_id', $security_id);
        return $this->db->delete('users_groups');
    }

    public function tambah_grup()
    {
        $user_id = $this->input->post('user_id');
        $grup_id = $this->input->post('group_id');
        $data = [
            'user_id' => $user_id,
            'group_id' => $grup_id
        ];
        $security = $this->security->xss_clean($data);
        return $this->db->insert('users_groups', $security);
    }

    public function ubah_grup()
    {
        $user_id = $this->input->post('user_id');
        $grup_id = $this->input->post('group_id');
        $data = [
            'user_id' => $user_id,
            'group_id' => $grup_id
        ];
        $security       = $this->security->xss_clean($data);
        $security_id    = $this->security->xss_clean($user_id);

        $this->db->where('user_id', $security_id);
        return $this->db->update('users_groups', $security);
    }
}

/* End of file M_detail.php */
