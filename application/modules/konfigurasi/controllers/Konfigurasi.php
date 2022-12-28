<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Konfigurasi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_konfig');
        $this->load->library('upload');
        $this->load->model('m_sidebar');
    }

    public function index()
    {
        $user_session = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
        $users_groups = $this->db->get_where('users_groups', ['user_id' => $user_session->id])->row();
        $groups_user = $this->db->get_where('groups', ['id' => $users_groups->group_id])->row();
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else if (!$this->ion_auth->is_admin() && $groups_user->name != 'user') {
            $this->session->set_flashdata(
                'error',
                '$(document).ready(function(e) {
                    $.NotificationApp.send("Gagal!", "Maaf halaman yang anda tuju tidak bisa diakses!", "top-right", "#bf441d", "error");
                })'
            );
            redirect('dashboard_surat');
        } else {
            $data['title'] = "Konfigurasi Website";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();
            $data['get_total'] = $this->db->get('tb_konfigurasi')->num_rows();
            $data['get_konfig'] = $this->db->get('tb_konfigurasi')->row();

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

    public function tambah()
    {
        $user_session = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
        $users_groups = $this->db->get_where('users_groups', ['user_id' => $user_session->id])->row();
        $groups_user = $this->db->get_where('groups', ['id' => $users_groups->group_id])->row();
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth-admin', 'refresh');
        } else if (!$this->ion_auth->is_admin() && $groups_user->name != 'user') {
            $this->session->set_flashdata(
                'error',
                '$(document).ready(function(e) {
                    $.NotificationApp.send("Gagal!", "Maaf halaman yang anda tuju tidak bisa diakses!", "top-right", "#bf441d", "error");
                })'
            );
            redirect('dashboard_surat');
        } else {
            $data['title'] = "Konfigurasi Website";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();
            $data['get_total'] = $this->db->get('tb_konfigurasi')->num_rows();
            $data['get_konfig'] = $this->db->get('tb_konfigurasi')->row();
            $data['akses_menu'] = $this->m_sidebar->akses_menu();
            $data['submenu'] = $this->m_sidebar->submenu();
            foreach ($data['akses_menu'] as $k => $m) {
                $data['akses_menu'][$k]['menu'] = $this->m_sidebar->main_menu($m['id']);
            }

            $this->form_validation->set_rules('nama_web', 'nama website', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('template/header', $data, FALSE);
                $this->load->view('template/topbar', $data, FALSE);
                $this->load->view('template/sidebar', $data, FALSE);
                $this->load->view('index', $data, FALSE);
            } else {
                $this->m_konfig->tambah();
                $this->session->set_flashdata(
                    'success',
                    '$(document).ready(function(e) {
                        $.NotificationApp.send("Sukses!", "Nama website berhasil disimpan", "top-right", "#5ba035", "success")
                    })'
                );
                redirect('konfigurasi');
            }
        }
    }

    public function icon_web()
    {
        $user_session = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
        $users_groups = $this->db->get_where('users_groups', ['user_id' => $user_session->id])->row();
        $groups_user = $this->db->get_where('groups', ['id' => $users_groups->group_id])->row();
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth-admin', 'refresh');
        } else if (!$this->ion_auth->is_admin() && $groups_user->name != 'user') {
            $this->session->set_flashdata(
                'error',
                '$(document).ready(function(e) {
                    $.NotificationApp.send("Gagal!", "Maaf halaman yang anda tuju tidak bisa diakses!", "top-right", "#bf441d", "error");
                })'
            );
            redirect('dashboard_surat');
        } else {
            $config['upload_path']    = './assets/backend/images/upload/';
            $config['allowed_types']  = 'jpg|png|jpeg|svg';
            $config['encrypt_name']    = TRUE;

            $this->upload->initialize($config);
            if (!empty($_FILES['icon_web']['name'])) {
                if ($this->upload->do_upload('icon_web')) {
                    $gbr = $this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/backend/images/upload/' . $gbr['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = FALSE;
                    $config['quality'] = '50%';
                    $config['width'] = 200;
                    $config['height'] = 200;
                    $config['new_image'] = './assets/backend/images/upload/' . $gbr['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    $gambar = $gbr['file_name'];

                    $this->m_konfig->update_icon($gambar);
                    $this->session->set_flashdata(
                        'success',
                        '$(document).ready(function(e) {
                                $.NotificationApp.send("Sukses!", "Icon website berhasil diupload", "top-right", "#5ba035", "success")
                            })'
                    );
                    redirect('konfigurasi');
                }
            } else {
                $this->session->set_flashdata(
                    'success',
                    '$(document).ready(function(e) {
                            $.NotificationApp.send("Gagal!", "Tidak ada file yang diupload", "top-right", "#bf441d", "error")
                        })'
                );
                redirect('konfigurasi');
            }
        }
    }

    public function logo_web()
    {
        $user_session = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
        $users_groups = $this->db->get_where('users_groups', ['user_id' => $user_session->id])->row();
        $groups_user = $this->db->get_where('groups', ['id' => $users_groups->group_id])->row();
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth-admin', 'refresh');
        } else if (!$this->ion_auth->is_admin() && $groups_user->name != 'user') {
            $this->session->set_flashdata(
                'error',
                '$(document).ready(function(e) {
                    $.NotificationApp.send("Gagal!", "Maaf halaman yang anda tuju tidak bisa diakses!", "top-right", "#bf441d", "error");
                })'
            );
            redirect('dashboard_surat');
        } else {
            $config['upload_path']    = './assets/backend/images/upload/';
            $config['allowed_types']  = 'jpg|png|jpeg|svg';
            $config['encrypt_name']    = TRUE;

            $this->upload->initialize($config);
            if (!empty($_FILES['logo_web']['name'])) {
                if ($this->upload->do_upload('logo_web')) {
                    $gbr = $this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/backend/images/upload/' . $gbr['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = FALSE;
                    $config['quality'] = '50%';
                    $config['width'] = 200;
                    $config['height'] = 200;
                    $config['new_image'] = './assets/backend/images/upload/' . $gbr['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    $gambar = $gbr['file_name'];

                    $this->m_konfig->update_logo($gambar);
                    $this->session->set_flashdata(
                        'success',
                        '$(document).ready(function(e) {
                                $.NotificationApp.send("Sukses!", "Logo website berhasil diupload", "top-right", "#5ba035", "success")
                            })'
                    );
                    redirect('konfigurasi');
                }
            } else {
                $this->session->set_flashdata(
                    'success',
                    '$(document).ready(function(e) {
                            $.NotificationApp.send("Gagal!", "Tidak ada file yang diupload", "top-right", "#bf441d", "error")
                        })'
                );
                redirect('konfigurasi');
            }
        }
    }

    public function edit()
    {
        $user_session = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
        $users_groups = $this->db->get_where('users_groups', ['user_id' => $user_session->id])->row();
        $groups_user = $this->db->get_where('groups', ['id' => $users_groups->group_id])->row();
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth-admin', 'refresh');
        } else if (!$this->ion_auth->is_admin() && $groups_user->name != 'user') {
            $this->session->set_flashdata(
                'error',
                '$(document).ready(function(e) {
                    $.NotificationApp.send("Gagal!", "Maaf halaman yang anda tuju tidak bisa diakses!", "top-right", "#bf441d", "error");
                })'
            );
            redirect('dashboard_surat');
        } else {
            $data['title'] = "Konfigurasi Website";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();
            $data['get_total'] = $this->db->get('tb_konfigurasi')->num_rows();
            $data['get_konfig'] = $this->db->get('tb_konfigurasi')->row();
            $data['akses_menu'] = $this->m_sidebar->akses_menu();
            $data['submenu'] = $this->m_sidebar->submenu();
            foreach ($data['akses_menu'] as $k => $m) {
                $data['akses_menu'][$k]['menu'] = $this->m_sidebar->main_menu($m['id']);
            }

            $this->form_validation->set_rules('nama_web', 'nama website', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('template/header', $data, FALSE);
                $this->load->view('template/topbar', $data, FALSE);
                $this->load->view('template/sidebar', $data, FALSE);
                $this->load->view('index', $data, FALSE);
            } else {
                $this->m_konfig->edit();
                $this->session->set_flashdata(
                    'success',
                    '$(document).ready(function(e) {
                        $.NotificationApp.send("Sukses!", "Nama website berhasil diubah", "top-right", "#5ba035", "success")
                    })'
                );
                redirect('konfigurasi');
            }
        }
    }

    public function edit_data_web()
    {
        $user_session = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
        $users_groups = $this->db->get_where('users_groups', ['user_id' => $user_session->id])->row();
        $groups_user = $this->db->get_where('groups', ['id' => $users_groups->group_id])->row();
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else if (!$this->ion_auth->is_admin() && $groups_user->name != 'user') {
            $this->session->set_flashdata(
                'error',
                '$(document).ready(function(e) {
                    $.NotificationApp.send("Gagal!", "Maaf halaman yang anda tuju tidak bisa diakses!", "top-right", "#bf441d", "error");
                })'
            );
            redirect('dashboard_surat');
        } else {

            $this->form_validation->set_rules('instansi', 'nama instansi', 'trim|required');
            $this->form_validation->set_rules('phone', 'No. Telp', 'trim|required');
            $this->form_validation->set_rules('email', 'nama email', 'trim|required');
            $this->form_validation->set_rules('pimpinan', 'nama pimpinan', 'trim|required');
            $this->form_validation->set_rules('nidn_pimpinan', 'NIDN pimpinan', 'trim|required');
            $this->form_validation->set_rules('link_website', 'link website', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata(
                    'error',
                    '$(document).ready(function(e) {
                        $.NotificationApp.send("Gagal!", "Data gagal disimpan!", "top-right", "#bf441d", "error");
                    })'
                );
                redirect('konfigurasi');
            } else {
                $this->m_konfig->edit_data_web();
                $this->session->set_flashdata(
                    'success',
                    '$(document).ready(function(e) {
                        $.NotificationApp.send("Sukses!", "Nama website berhasil diubah", "top-right", "#5ba035", "success")
                    })'
                );
                redirect('konfigurasi');
            }
        }
    }
}
