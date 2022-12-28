<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_dashboard extends CI_Model
{
    var $table = 'users_visitor';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_total()
    {
        $this->db->group_by('date');
        $this->db->select('date');
        $this->db->select('hits');
        $this->db->select("count(*) as total");
        return $this->db->from($this->table)
            ->get()
            ->result();
    }

    public function get_total_userkoneksi()
    {
        $this->db->group_by('browser');
        $this->db->select('browser');
        $this->db->select('hits');
        $this->db->select("count(*) as total_koneksi");
        return $this->db->from($this->table)
            ->get()
            ->result();
    }

    public function jml_pengunjung()
    {
        $date = date("Y-m-d");
        return $this->db->query("SELECT * FROM " . $this->table . " WHERE date='" . $date . "' GROUP BY ip")->num_rows();
    }

    public function get_pengunjung()
    {
        return $this->db->query("SELECT COUNT(hits) as hits FROM " . $this->table . "")->row();
    }

    public function pengunjung_online()
    {
        $batas_waktu = time() - 300;
        return $this->db->query("SELECT * FROM " . $this->table . " WHERE online > '" . $batas_waktu . "'")->num_rows();
    }

    public function total_visitor()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {   //check ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   //to check ip is pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $date = date("Y-m-d");
        return $this->db->query("SELECT * FROM " . $this->table . " WHERE ip='" . $ip . "' AND date='" . $date . "'")->num_rows();
    }

    public function insert_visitor()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {   //check ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   //to check ip is pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $date = date("Y-m-d");
        $waktu = time();
        $timeinsert = date("Y-m-d H:i:s");
        // track data user 
        $browser = $this->agent->browser();
        $browser_versi = $this->agent->version();
        $os = $this->agent->platform();

        return $this->db->query("INSERT INTO " . $this->table . "(ip, date, hits, os, browser, versi, online, time) VALUES('" . $ip . "','" . $date . "','1','" . $os . "','" . $browser . "','" . $browser_versi . "','" . $waktu . "','" . $timeinsert . "')");
    }

    public function update_visitor()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {   //check ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   //to check ip is pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $date = date("Y-m-d");
        $waktu = time();
        // track data user 
        $browser = $this->agent->browser();
        $browser_versi = $this->agent->version();
        $os = $this->agent->platform();

        return $this->db->query("UPDATE " . $this->table . " SET hits=hits+1, os='" . $os . "', browser='" . $browser . "', versi='" . $browser_versi . "', online='" . $waktu . "' WHERE ip='" . $ip . "' AND date='" . $date . "'");
    }

    public function load_notifikasi()
    {
        $this->db->from('tb_surat_masuk');
        $this->db->where('dibaca', 0);
        $this->db->order_by('id_smasuk', 'desc');

        return $this->db->get();
    }

    public function load_data_surat_keluar()
    {
        $this->db->from('tb_surat_keluar');
        $this->db->where('dibaca', 0);
        $this->db->order_by('id_skeluar', 'desc');
        return $this->db->get();
    }

    public function dibaca()
    {
        $data = [
            'dibaca' => 1
        ];
        $this->db->where('id_smasuk', $this->input->post('id_smasuk'));
        return $this->db->update('tb_surat_masuk', $data);
    }

    public function baca_surat_keluar()
    {
        $data = [
            'dibaca' => 1
        ];
        $this->db->where('id_skeluar', $this->input->post('id_skeluar'));
        return $this->db->update('tb_surat_keluar', $data);
    }
}

/* End of file M_dashboard.php */
