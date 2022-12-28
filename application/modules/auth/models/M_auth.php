<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_auth extends CI_Model
{
    var $table = 'users_visitor';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
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

        system('ipconfig/all');
        $a = ob_get_contents();
        ob_clean();
        $mac = substr($a, (strpos($a, "Physical") + 36), 17);

        return $this->db->query("INSERT INTO " . $this->table . "(ip, date, hits, os, browser, versi, online, time, mac_address) VALUES('" . $ip . "','" . $date . "','1','" . $os . "','" . $browser . "','" . $browser_versi . "','" . $waktu . "','" . $timeinsert . "','" . $mac . "')");
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

        system('ipconfig/all');
        $a = ob_get_contents();
        ob_clean();
        $mac = substr($a, (strpos($a, "Physical") + 36), 17);

        return $this->db->query("UPDATE " . $this->table . " SET hits=hits+1, os='" . $os . "', browser='" . $browser . "', versi='" . $browser_versi . "', online='" . $waktu . "', mac_address='" . $mac . "' WHERE ip='" . $ip . "' AND date='" . $date . "'");
    }
}

/* End of file M_auth.php */
