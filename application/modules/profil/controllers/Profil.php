<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_profil');
        $this->load->model('m_sidebar');
    }
    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else {
            $data['title'] = "Profil";

            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $data['akses_menu'] = $this->m_sidebar->akses_menu();
            $data['submenu'] = $this->m_sidebar->submenu();

            foreach ($data['akses_menu'] as $k => $m) {
                $data['akses_menu'][$k]['menu'] = $this->m_sidebar->main_menu($m['id_menu_group']);
            }

            $this->load->view('template/header', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('index', $data, FALSE);
        }
    }

    public function ubahpassword()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else {
            $data['title'] = "Profil";

            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $data['akses_menu'] = $this->m_sidebar->akses_menu();
            $data['submenu'] = $this->m_sidebar->submenu();

            foreach ($data['akses_menu'] as $k => $m) {
                $data['akses_menu'][$k]['menu'] = $this->m_sidebar->main_menu($m['id_menu_group']);
            }

            $user = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();

            $this->form_validation->set_rules('password', 'password', 'trim|required|min_length[6]');
            $this->form_validation->set_rules('konf_pass', 'konfirmasi password', 'trim|required|min_length[6]|matches[password]');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('template/header', $data, FALSE);
                $this->load->view('template/topbar', $data, FALSE);
                $this->load->view('template/sidebar', $data, FALSE);
                $this->load->view('index', $data, FALSE);
            } else {
                $this->m_profil->update_password($user->id);
                redirect('auth/logout', 'refresh');
            }
        }
    }

    public function ubahprofile()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else {
            $data['title'] = "Profil";

            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $data['akses_menu'] = $this->m_sidebar->akses_menu();
            $data['submenu'] = $this->m_sidebar->submenu();

            foreach ($data['akses_menu'] as $k => $m) {
                $data['akses_menu'][$k]['menu'] = $this->m_sidebar->main_menu($m['id_menu_group']);
            }

            $user = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();

            $this->form_validation->set_rules('first_name', 'nama depan', 'trim|required');
            $this->form_validation->set_rules('last_name', 'nama belakang', 'trim|required');
            $this->form_validation->set_rules('email', 'email', 'trim|required');
            $this->form_validation->set_rules('phone', 'no. telp', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('template/header', $data, FALSE);
                $this->load->view('template/topbar', $data, FALSE);
                $this->load->view('template/sidebar', $data, FALSE);
                $this->load->view('index', $data, FALSE);
            } else {
                $this->m_profil->update_profil($user->id);
                $this->session->set_flashdata(
                    'success',
                    '$(document).ready(function(e) {
                        $.NotificationApp.send("Sukses!", "Profile berhasil diupdate", "top-right", "#5ba035", "success")
                    })'
                );
                redirect('profil/ubahprofile');
            }
        }
    }
}

/* End of file Profil.php */
