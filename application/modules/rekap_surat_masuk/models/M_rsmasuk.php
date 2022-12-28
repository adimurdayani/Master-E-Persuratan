<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_rsmasuk extends CI_Model
{

    var $table = 'tb_surat_masuk';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_data()
    {
        $tgl_awal = $this->input->post('tgl_awal');
        $tgl_akhir = $this->input->post('tgl_akhir');

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('tgl_surat >=', $tgl_awal);
        $this->db->where('tgl_surat <=', $tgl_akhir);
        return $this->db->get();
    }
}

/* End of file M_smasuk.php */
