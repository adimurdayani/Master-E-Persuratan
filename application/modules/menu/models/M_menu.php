<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_menu extends CI_Model
{

    var $table          = 'menu';
    var $column_order   = array(null, 'menu_title',  'url', 'icon', 'serial_number', 'active', 'dropdown_active', 'folder'); //field yang ada di table user
    var $column_search  = array('menu_title', 'url', 'serial_number', 'icon'); //field yang diizin untuk pencarian 
    var $order          = array('id_menu' => 'desc'); // default order 


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

    public function tambah()
    {
        $data = [
            'id_menu_groups'    => htmlspecialchars($this->input->post('id_kategori')),
            'serial_number'     => htmlspecialchars($this->input->post('no_urut')),
            'menu_title'        => htmlspecialchars($this->input->post('nama_menu')),
            'url'               => htmlspecialchars($this->input->post('url')),
            'icon'              => htmlspecialchars($this->input->post('icon')),
            'active'            => 1

        ];
        $security = $this->security->xss_clean($data);

        return $this->db->insert($this->table, $security);
    }

    public function tambah_folder()
    {
        $nama_folder = $this->input->post('folder');
        $data = [
            'folder'            => htmlspecialchars($nama_folder)
        ];
        mkdir("application/modules/" . $nama_folder);

        if (is_dir("application/modules/" . $nama_folder)) {
            mkdir("application/modules/" . $nama_folder . "/controllers");
            mkdir("application/modules/" . $nama_folder . "/models");
            mkdir("application/modules/" . $nama_folder . "/views");
        }
    }

    public function edit()
    {
        $data = [
            'id_menu_groups'    => htmlspecialchars($this->input->post('id_menu_groups')),
            'serial_number'     => htmlspecialchars($this->input->post('serial_number')),
            'menu_title'        => htmlspecialchars($this->input->post('menu_title')),
            'url'               => htmlspecialchars($this->input->post('url')),
            'icon'              => htmlspecialchars($this->input->post('icon'))

        ];

        $security = $this->security->xss_clean($data);
        $security_id = $this->security->xss_clean($this->input->post('id_menu'));

        $this->db->where('id_menu', $security_id);
        return $this->db->update($this->table, $security);
    }

    public function aktif($id)
    {
        $data = [
            'active'            => 1
        ];
        $security_id = $this->security->xss_clean($id);
        $security = $this->security->xss_clean($data);

        $this->db->where('id_menu', $security_id);
        return $this->db->update($this->table, $security);
    }

    public function nonaktif($id)
    {
        $data = [
            'active'            => 0
        ];

        $security_id = $this->security->xss_clean($id);
        $security = $this->security->xss_clean($data);

        $this->db->where('id_menu', $security_id);
        return $this->db->update($this->table, $security);
    }

    public function collapse_aktif($id)
    {
        $data = [
            'dropdown_active'       => 1
        ];

        $security_id = $this->security->xss_clean($id);
        $security = $this->security->xss_clean($data);

        $this->db->where('id_menu', $security_id);
        return $this->db->update($this->table, $security);
    }

    public function collapse_nonaktif($id)
    {
        $data = [
            'dropdown_active'       => 0
        ];

        $security_id = $this->security->xss_clean($id);
        $security = $this->security->xss_clean($data);

        $this->db->where('id_menu', $security_id);
        return $this->db->update($this->table, $security);
    }

    public function hapus()
    {
        $id = base64_decode($this->input->post('id_menu'));
        $security_id = $this->security->xss_clean($id);

        $this->db->where('id_menu', $security_id);
        return $this->db->delete($this->table);
    }
}

/* End of file M_menu.php */
