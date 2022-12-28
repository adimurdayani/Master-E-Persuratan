<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_profil extends CI_Model
{
    public function update_password($id)
    {
        $data = [
            'password'      =>  password_hash($this->input->post('password'), PASSWORD_DEFAULT)
        ];
        $security_id        = $this->security->xss_clean($id);
        $security           = $this->security->xss_clean($data);

        $this->db->where('id', $security_id);
        return $this->db->update('users', $security);
    }

    public function update_profil($id)
    {
        $data = [
            'first_name'    =>  $this->input->post('first_name'),
            'last_name'     =>  $this->input->post('last_name'),
            'email'         =>  $this->input->post('email'),
            'company'       =>  $this->input->post('company'),
            'phone'         =>  $this->input->post('phone'),
            'nidn'          =>  $this->input->post('nidn'),
        ];
        $security_id        = $this->security->xss_clean($id);
        $security           = $this->security->xss_clean($data);

        $this->db->where('id', $security_id);
        return $this->db->update('users', $security);
    }
}

/* End of file M_profil.php */
