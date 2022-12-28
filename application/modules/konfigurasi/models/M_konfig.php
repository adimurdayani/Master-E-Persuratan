<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Konfig extends CI_Model
{

    public function tambah()
    {
        $data = [
            'nama_web' => htmlspecialchars($this->input->post('nama_web')),
        ];
        return $this->db->insert('tb_konfigurasi', $data);
    }

    public function update_icon($file_icon)
    {
        $data = [
            'icon_web'      => $file_icon,
            'updated_at'    => date("Y-m-d"),
        ];

        $id             = base64_decode($this->input->post('id'));
        $security_id    = $this->security->xss_clean($id);
        $security       = $this->security->xss_clean($data);

        $this->db->where('id', $security_id);
        return $this->db->update('tb_konfigurasi', $security);
    }

    public function edit_data_web()
    {
        $data = [
            'instansi'      => htmlspecialchars($this->input->post('instansi')),
            'phone'         => htmlspecialchars($this->input->post('phone')),
            'email'         => htmlspecialchars($this->input->post('email')),
            'pimpinan'      => htmlspecialchars($this->input->post('pimpinan')),
            'nidn_pimpinan' => htmlspecialchars($this->input->post('nidn_pimpinan')),
            'link_website'  => htmlspecialchars($this->input->post('link_website')),
            'alamat'  => htmlspecialchars($this->input->post('alamat')),
        ];

        $id             = base64_decode($this->input->post('id'));
        $security_id    = $this->security->xss_clean($id);
        $security       = $this->security->xss_clean($data);

        $this->db->where('id', $security_id);
        return $this->db->update('tb_konfigurasi', $security);
    }

    public function update_logo($file_logo)
    {
        $data = [
            'logo_web'      => $file_logo
        ];

        $id             = base64_decode($this->input->post('id'));
        $security_id    = $this->security->xss_clean($id);
        $security       = $this->security->xss_clean($data);

        $this->db->where('id', $security_id);
        return $this->db->update('tb_konfigurasi', $security);
    }

    public function edit()
    {
        $data = [
            'nama_web'      => htmlspecialchars($this->input->post('nama_web'))
        ];

        $id             = base64_decode($this->input->post('id'));
        $security_id    = $this->security->xss_clean($id);
        $security       = $this->security->xss_clean($data);

        $this->db->where('id', $security_id);
        return $this->db->update('tb_konfigurasi', $security);
    }
}

/* End of file M_Konfig.php */
