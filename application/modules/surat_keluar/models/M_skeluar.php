<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_skeluar extends CI_Model
{
    var $table          = 'tb_surat_keluar';
    var $column_order   = array(null, 'no_agenda',  'no_surat', 'isi_surat', 'pembuat_surat', 'tujuan_surat', 'sifat_surat', 'keterangan'); //field yang ada di table user
    var $column_search  = array('no_agenda', 'no_surat', 'isi_surat', 'pembuat_surat', 'tujuan_surat', 'sifat_surat', 'keterangan'); //field yang diizin untuk pencarian 
    var $order          = array('id_skeluar' => 'desc'); // default order 


    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        if ($this->input->post('sifat_surat')) {
            $this->db->where('sifat_surat', $this->input->post('sifat_surat'));
        }
        if ($this->input->post('keterangan')) {
            $this->db->like('keterangan', $this->input->post('keterangan'));
        }

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

    public function get_data($id = null)
    {
        if ($id == null) {
            $this->db->select('*');
            $this->db->from($this->table);
            return $this->db->get();
        } else {
            $this->db->select('*');
            $this->db->from($this->table);
            $this->db->where('id_skeluar', $id);
            return $this->db->get();
        }
    }

    public function tambah($gambar)
    {
        $user = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
        $data = [
            'no_agenda'         => htmlspecialchars($this->input->post('no_agenda')),
            'tujuan_surat'      => htmlspecialchars($this->input->post('tujuan_surat')),
            'no_surat'          => htmlspecialchars($this->input->post('no_surat')),
            'tgl_surat'         => htmlspecialchars(date('Y-m-d', strtotime($this->input->post('tgl_surat')))),
            'isi_surat'         => htmlspecialchars($this->input->post('isi_surat')),
            'jenis_surat'       => htmlspecialchars($this->input->post('jenis_surat')),
            'sifat_surat'       => htmlspecialchars($this->input->post('sifat_surat')),
            'kode_klasifikasi'  => htmlspecialchars($this->input->post('kode_klasifikasi')),
            'pembuat_surat'     => htmlspecialchars($this->input->post('pembuat_surat')),
            'bidang'            => htmlspecialchars($this->input->post('bidang')),
            'file_surat'        => htmlspecialchars($gambar),
            'link_file'         => htmlspecialchars($this->input->post('link_file')),
            'keterangan'        => htmlspecialchars($this->input->post('keterangan')),
            'created_at'        => htmlspecialchars(date('Y-m-d H:i:s')),
            'user_id'           => htmlspecialchars($user->id)
        ];
        return $this->db->insert($this->table, $data);
    }

    public function edit_file($gambar, $id)
    {
        $user = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
        $surat_keluar = $this->db->get_where($this->table, ['id_skeluar' => $id])->row_array();
        if ($surat_keluar['file_surat'] != null) {
            $target_file = './assets/backend/images/surat_keluar/' . $surat_keluar['file_surat'];
            unlink($target_file);
        }

        $data = [
            'no_agenda'         => htmlspecialchars($this->input->post('no_agenda')),
            'tujuan_surat'      => htmlspecialchars($this->input->post('tujuan_surat')),
            'no_surat'          => htmlspecialchars($this->input->post('no_surat')),
            'tgl_surat'         => htmlspecialchars(date('Y-m-d', strtotime($this->input->post('tgl_surat')))),
            'isi_surat'         => htmlspecialchars($this->input->post('isi_surat')),
            'jenis_surat'       => htmlspecialchars($this->input->post('jenis_surat')),
            'sifat_surat'       => htmlspecialchars($this->input->post('sifat_surat')),
            'kode_klasifikasi'  => htmlspecialchars($this->input->post('kode_klasifikasi')),
            'pembuat_surat'     => htmlspecialchars($this->input->post('pembuat_surat')),
            'bidang'            => htmlspecialchars($this->input->post('bidang')),
            'file_surat'        => htmlspecialchars($gambar),
            'link_file'         => htmlspecialchars($this->input->post('link_file')),
            'keterangan'        => htmlspecialchars($this->input->post('keterangan')),
            'created_at'        => htmlspecialchars(date('Y-m-d H:i:s')),
            'user_id'           => htmlspecialchars($user->id)
        ];
        $this->db->where('id_skeluar', $id);
        return $this->db->update($this->table, $data);
    }

    public function edit_data($id)
    {
        $user = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
        $data = [
            'no_agenda'         => htmlspecialchars($this->input->post('no_agenda')),
            'tujuan_surat'      => htmlspecialchars($this->input->post('tujuan_surat')),
            'no_surat'          => htmlspecialchars($this->input->post('no_surat')),
            'tgl_surat'         => htmlspecialchars(date('Y-m-d', strtotime($this->input->post('tgl_surat')))),
            'isi_surat'         => htmlspecialchars($this->input->post('isi_surat')),
            'jenis_surat'       => htmlspecialchars($this->input->post('jenis_surat')),
            'sifat_surat'       => htmlspecialchars($this->input->post('sifat_surat')),
            'kode_klasifikasi'  => htmlspecialchars($this->input->post('kode_klasifikasi')),
            'pembuat_surat'     => htmlspecialchars($this->input->post('pembuat_surat')),
            'bidang'            => htmlspecialchars($this->input->post('bidang')),
            'link_file'         => htmlspecialchars($this->input->post('link_file')),
            'keterangan'        => htmlspecialchars($this->input->post('keterangan')),
            'created_at'        => htmlspecialchars(date('Y-m-d H:i:s')),
            'user_id'           => htmlspecialchars($user->id)
        ];
        $this->db->where('id_skeluar', $id);
        return $this->db->update($this->table, $data);
    }

    public function hapus()
    {
        $id = base64_decode($this->input->post('id_skeluar'));
        $surat_keluar = $this->db->get_where($this->table, ['id_skeluar' => $id])->row_array();
        if ($surat_keluar['file_surat'] != null) {
            $target_file = './assets/backend/images/surat_keluar/' . $surat_keluar['file_surat'];
            unlink($target_file);
        }

        $this->db->where('id_skeluar', $id);
        return $this->db->delete($this->table);
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

    public function validasi()
    {
        $this->form_validation->set_rules('no_agenda', 'No. Agenda', 'trim|required');
        $this->form_validation->set_rules('tujuan_surat', 'tujuan surat', 'trim|required');
        $this->form_validation->set_rules('no_surat', 'No. surat', 'trim|required');
        $this->form_validation->set_rules('tgl_surat', 'tanggal surat', 'trim|required');
        $this->form_validation->set_rules('isi_surat', 'isi surat', 'trim|required');
        $this->form_validation->set_rules('jenis_surat', 'jenis surat', 'trim|required');
        $this->form_validation->set_rules('sifat_surat', 'sifat surat', 'trim|required');
        $this->form_validation->set_rules('kode_klasifikasi', 'kode klasifikasi surat', 'trim|required');
        $this->form_validation->set_rules('pembuat_surat', 'pembuat surat', 'trim|required');
        $this->form_validation->set_rules('link_file', 'link file surat', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'keterangan surat', 'trim|required');
    }

    public function search_kode_klasifikasi($kode)
    {
        $this->db->select('*');
        $this->db->from('tb_klasifikasi_surat');
        $this->db->like('kode', $kode, 'both');
        $this->db->order_by('id_klasifikasi', 'desc');
        return $this->db->get()->result_array();
    }

    public function search_penerima($nama)
    {
        $this->db->select('*');
        $this->db->from('tb_penerima_surat');
        $this->db->like('nama', $nama, 'both');
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result_array();
    }

    public function search_jenis_surat($jenis_surat)
    {
        $this->db->select('*');
        $this->db->from('tb_jenis_surat');
        $this->db->like('jenis_surat', $jenis_surat, 'both');
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result_array();
    }

    public function search_bidang($nama)
    {
        $this->db->select('*');
        $this->db->from('tb_bidang');
        $this->db->like('nama', $nama, 'both');
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result_array();
    }

    public function edit_verifikasi()
    {
        $id = base64_decode($this->input->post('id_skeluar'));
        $user = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
        $surat_keluar = $this->db->get_where('tb_surat_keluar', ['id_skeluar' => $id])->row();
        $data = [
            'catatan_kelengkapan' => htmlspecialchars($this->input->post('catatan_kelengkapan')),
            'status_verifikasi' => htmlspecialchars($this->input->post('status_verifikasi')),
            'dibaca'            => $surat_keluar->dibaca + 1,
            'updated_at'        => htmlspecialchars(date('Y-m-d H:i:s')),
            'user_id'           => htmlspecialchars($user->id)
        ];
        $this->db->where('id_skeluar', $id);
        return $this->db->update($this->table, $data);
    }
}

/* End of file M_smasuk.php */
