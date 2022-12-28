<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Group extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_group');
        $this->load->model('m_sidebar');
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else if (!$this->ion_auth->is_admin()) {
            redirect('auth/block', 'refresh');
        } else {
            $data['title'] = 'Grup User';
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

    public function load_data()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else if (!$this->ion_auth->is_admin()) {
            redirect('auth/block', 'refresh');
        } else {
            $data =  $this->m_group->get_grup();
            $this->output->set_output(json_encode($data));
        }
    }

    public function tambah()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else if (!$this->ion_auth->is_admin()) {
            redirect('auth/block', 'refresh');
        } else {
            $this->m_group->tambah_grup();
        }
    }

    public function update()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else if (!$this->ion_auth->is_admin()) {
            redirect('auth/block', 'refresh');
        } else {
            $this->m_group->update_grup();
        }
    }

    public function delete()
    {
        $this->m_group->delete_grup();
    }

    public function akses_user($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else if (!$this->ion_auth->is_admin()) {
            redirect('auth/block', 'refresh');
        } else {
            $data['title'] = 'Akses Grup User';
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $decode = base64_decode($id);
            $data['get_grup'] = $this->db->get_where('groups', ['id' => $decode])->row();
            $data['menu_groups'] = $this->m_group->menu_group();
            $data['sub_menu'] = $this->m_group->sub_menu();

            foreach ($data['menu_groups'] as $key => $mg) {
                $data['menu_groups'][$key]['main_menu'] = $this->m_group->main_menu($mg['id_menu_group']);
            }

            $data['akses_menu'] = $this->m_sidebar->akses_menu();
            $data['submenu'] = $this->m_sidebar->submenu();

            foreach ($data['akses_menu'] as $k => $m) {
                $data['akses_menu'][$k]['menu'] = $this->m_sidebar->main_menu($m['id_menu_group']);
            }

            $this->load->view('template/header', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('akses-user', $data, FALSE);
        }
    }

    public function ubah_akses_user()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else if (!$this->ion_auth->is_admin()) {
            redirect('auth/block', 'refresh');
        } else {
            $idgrup = $this->input->post('idgrup');
            $idkategori = $this->input->post('idkategori');

            $this->db->where('id_groups', $idgrup);
            $this->db->where('id_menu_groups', $idkategori);
            $result = $this->db->get('menu_access');

            if ($result->num_rows() < 1) {
                $this->m_group->insert_akses($idgrup, $idkategori);
                $this->session->set_flashdata(
                    'success',
                    '$(document).ready(function(e) {
                    $.NotificationApp.send("Sukses!", "Akses grup user berhasil diaktifkan!", "top-right", "#5ba035", "success");
                })'
                );
            } else {
                $this->m_group->hapus_akses($idgrup, $idkategori);
                $this->session->set_flashdata(
                    'success',
                    '$(document).ready(function(e) {
                    $.NotificationApp.send("Sukses!", "Akses grup user berhasil dinonaktifkan!", "top-right", "#5ba035", "success");
                })'
                );
            }
        }
    }

    public function ubah_akses_menu()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else if (!$this->ion_auth->is_admin()) {
            redirect('auth/block', 'refresh');
        } else {
            $idmenugroup = $this->input->post('idmenugroup');
            $idgrup = $this->input->post('idgrup');
            $idmenu = $this->input->post('idmenu');

            $this->db->where('id_groups', $idmenu)->where('id_menu_groups', $idmenugroup)->where('id_menu', $idmenu);
            $result = $this->db->get('menu_access');

            if ($result->num_rows() == 0) {
                $this->m_group->update_use_akses_menu($idmenu, $idgrup, $idmenugroup);
                $this->session->set_flashdata(
                    'success',
                    '$(document).ready(function(e) {
                    $.NotificationApp.send("Sukses!", "Akses menu berhasil diaktifkan!", "top-right", "#5ba035", "success");
                })'
                );
            } else {
                $this->m_group->update_notakses_menu($idgrup, $idmenugroup);
                $this->session->set_flashdata(
                    'success',
                    '$(document).ready(function(e) {
                    $.NotificationApp.send("Sukses!", "Akses menu berhasil dinonaktifkan!", "top-right", "#5ba035", "success");
                })'
                );
            }
        }
    }

    public function ubah_akses_sub_menu()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else if (!$this->ion_auth->is_admin()) {
            redirect('auth/block', 'refresh');
        } else {
            $idgrup = $this->input->post('idgrup');
            $idsubmenu = $this->input->post('idsubmenu');

            $this->db->where('id_groups', $idgrup);
            $this->db->where('id_sub_menu', $idsubmenu);
            $result = $this->db->get('menu_access');

            if ($result->num_rows() == 0) {
                $this->m_group->update_use_akses_submenu($idgrup, $idsubmenu);
                $this->session->set_flashdata(
                    'success',
                    '$(document).ready(function(e) {
                    $.NotificationApp.send("Sukses!", "Akses submenu berhasil diaktifkan!", "top-right", "#5ba035", "success");
                })'
                );
            } else {
                $this->m_group->update_notakses_menu($idgrup, $idsubmenu);
                $this->session->set_flashdata(
                    'success',
                    '$(document).ready(function(e) {
                    $.NotificationApp.send("Sukses!", "Akses submenu berhasil dinonaktifkan!", "top-right", "#5ba035", "success");
                })'
                );
            }
        }
    }
}

/* End of file Group.php */
