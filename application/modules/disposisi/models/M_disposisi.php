<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_disposisi extends CI_Model
{

    var $table          = 'tb_disposisi';
    var $column_order   = array(null, 'tujuan_disposisi',  'isi_disposisi', 'batas_waktu', 'sifat_disposisi'); //field yang ada di table user
    var $column_search  = array('tujuan_disposisi', 'isi_disposisi', 'batas_waktu', 'sifat_disposisi'); //field yang diizin untuk pencarian 
    var $order          = array('id_disposisi' => 'desc'); // default order 


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

    public function tambah($kode_surat)
    {
        $user = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
        $surat_masuk = $this->db->get_where('tb_surat_masuk', ['kode_disposisi' => $kode_surat])->row();
        $this->db->where('id_smasuk', $surat_masuk->id_smasuk);
        $this->db->update('tb_surat_masuk', array(
            'status_disposisi'  => 1,
            'dibaca'            => $surat_masuk->dibaca + 1,
            'updated_at'        => htmlspecialchars(date('Y-m-d H:i:s')),
            'user_id'           => htmlspecialchars($user->id)
        ));

        $data = [
            'kode_surat'        => htmlspecialchars($kode_surat),
            'tujuan_disposisi'  => htmlspecialchars($this->input->post('tujuan_disposisi')),
            'isi_disposisi'     => htmlspecialchars($this->input->post('isi_disposisi')),
            'sifat_disposisi'   => htmlspecialchars($this->input->post('sifat_disposisi')),
            'batas_waktu'       => htmlspecialchars(date('Y-m-d', strtotime($this->input->post('batas_waktu')))),
            'tgl_selesai'     => htmlspecialchars(date('Y-m-d', strtotime($this->input->post('tgl_selesai')))),
            'user_id'           => htmlspecialchars($user->id),
        ];
        return $this->db->insert($this->table, $data);
    }

    public function edit($id)
    {
        $user = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
        $data = [
            'tujuan_disposisi'  => htmlspecialchars($this->input->post('tujuan_disposisi')),
            'isi_disposisi'     => htmlspecialchars($this->input->post('isi_disposisi')),
            'sifat_disposisi'   => htmlspecialchars($this->input->post('sifat_disposisi')),
            'batas_waktu'       => htmlspecialchars(date('Y-m-d', strtotime($this->input->post('batas_waktu')))),
            'tgl_selesai'     => htmlspecialchars(date('Y-m-d', strtotime($this->input->post('tgl_selesai')))),
            'user_id'           => htmlspecialchars($user->id),
        ];
        $this->db->where('id_disposisi', $id);
        return $this->db->update($this->table, $data);
    }

    public function hapus()
    {
        $id = base64_decode($this->input->post('id_disposisi'));
        $disposisi = $this->db->get_where($this->table, ['id_disposisi' => $id])->row();
        $surat_masuk = $this->db->get_where('tb_surat_masuk', ['kode_disposisi' => $disposisi->kode_surat])->row();

        $this->db->where('id_smasuk', $surat_masuk->id_smasuk);
        $this->db->update('tb_surat_masuk', array(
            'status_disposisi' => 0,
            'updated_at' => htmlspecialchars(date('Y-m-d H:i:s'))
        ));

        $this->db->where('id_disposisi', $id);
        return $this->db->delete($this->table);
    }

    public function validasi()
    {
        $this->form_validation->set_rules('tujuan_disposisi', 'tujuan disposisi', 'trim|required');
        $this->form_validation->set_rules('isi_disposisi', 'isi disposisi', 'trim|required');
        $this->form_validation->set_rules('sifat_disposisi', 'sifat disposisi', 'trim|required');
        $this->form_validation->set_rules('tgl_selesai', 'tanggal disposisi', 'trim|required');
        $this->form_validation->set_rules('batas_waktu', 'batas waktu disposisi', 'trim|required');
    }

    public function data_enum($field)
    {
        $query = "SHOW COLUMNS FROM " . $this->table . " LIKE '" . $field . "'";
        $row = $this->db->query($query)->row()->Type;
        $regex = "/'(.*?)'/";
        preg_match_all($regex, $row, $enum_array);
        $enum_fields = $enum_array[1];
        $enums = [];
        foreach ($enum_fields as $key => $value) {
            $enums[$value] = $value;
        }
        return $enums;
    }
}

/* End of file M_disposisi.php */
