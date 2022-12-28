<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_bidang extends CI_Model
{

    var $table = 'tb_bidang';
    var $column_order   = array(null, 'nama'); //field yang ada di table user
    var $column_search  = array('nama'); //field yang diizin untuk pencarian 
    var $order          = array('id' => 'desc'); // default order 


    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        $this->db->from($this->table);

        $i = 0;

        foreach ($this->column_search as $item) // looping awal
        {
            if (@$_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {

                if ($i === 0) // looping awal
                {
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

    public function get_data()
    {
        $id = base64_decode($this->input->post('id'));

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);
        return $this->db->get();
    }

    public function tambah()
    {
        $user = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama')),
            'created_at' => htmlspecialchars(date('Y-m-d')),
            'user_id' => htmlspecialchars($user->id)
        ];

        return $this->db->insert($this->table, $data);
    }

    public function edit()
    {
        $id = $this->input->post('id');
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama')),
            'created_at' => htmlspecialchars(date('Y-m-d'))
        ];

        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function hapus()
    {
        $id = base64_decode($this->input->post('id'));
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }
}

/* End of file M_klasifikasi.php */
