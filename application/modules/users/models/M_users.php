<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_users extends CI_Model
{

    var $table              = 'users';
    var $column_order       = array(null, 'first_name', 'last_name', 'email', 'phone', 'active');
    var $column_search      = array('first_name', 'last_name', 'email', 'phone', 'active');
    var $order              = array('id' => 'desc');


    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {

        $this->db->from($this->table);
        $this->db->where('id !=', 1);

        $i = 0;

        foreach ($this->column_search as $item) {
            if (@$_POST['search']['value']) {

                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if (@$_POST['length'] != -1)
            $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get()->result();
        return $query;
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function user_aktif()
    {
        $id = $this->input->post('id');

        $this->db->where('id', $id);
        return $this->db->update('users', array('active' => 1));
    }

    public function user_nonaktif()
    {
        $id = $this->input->post('id');

        $this->db->where('id', $id);
        return $this->db->update('users', array('active' => 0));
    }

    public function tambah()
    {
        $data = [
            'username'      => htmlspecialchars($this->input->post('username')),
            'password'      => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'email'         => htmlspecialchars($this->input->post('email')),
            'created_on'    => time(),
            'active'        => 1,
            'first_name'    => htmlspecialchars($this->input->post('first_name')),
            'last_name'     => htmlspecialchars($this->input->post('last_name')),
            'company'       => htmlspecialchars($this->input->post('company')),
            'phone'         => htmlspecialchars($this->input->post('phone'))
        ];
        $security       = $this->security->xss_clean($data);
        return $this->db->insert($this->table, $security);
    }

    public function edit($decode)
    {
        $data = [
            'username'      => htmlspecialchars($this->input->post('username')),
            'email'         => htmlspecialchars($this->input->post('email')),
            'created_on'    => time(),
            'active'        => 1,
            'first_name'    => htmlspecialchars($this->input->post('first_name')),
            'last_name'     => htmlspecialchars($this->input->post('last_name')),
            'company'       => htmlspecialchars($this->input->post('company')),
            'phone'         => htmlspecialchars($this->input->post('phone'))
        ];
        $security       = $this->security->xss_clean($data);
        $security_id    = $this->security->xss_clean($decode);

        $this->db->where('id', $security_id);
        return $this->db->update($this->table, $security);
    }

    public function hapus($id)
    {
        $security_id    = $this->security->xss_clean($id);

        $this->db->where('id', $security_id);
        return $this->db->delete($this->table);
    }

    public function validasi()
    {
        $this->form_validation->set_rules('first_name', 'nama depan', 'trim|required');
        $this->form_validation->set_rules('last_name', 'nama belakang', 'trim|required');
        $this->form_validation->set_rules('company', 'nama instansi', 'trim|required');
        $this->form_validation->set_rules('username', 'username', 'trim|required');
        $this->form_validation->set_rules('email', 'email', 'trim|required');
        $this->form_validation->set_rules('phone', 'phone', 'trim|required');
    }
}

/* End of file M_users.php */
