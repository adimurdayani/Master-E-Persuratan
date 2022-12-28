<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_users');
        $this->load->model('m_detail');
        $this->load->model('m_sidebar');
    }

    public function index()
    {
        $user_session = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
        $users_groups = $this->db->get_where('users_groups', ['user_id' => $user_session->id])->row();
        $groups_user = $this->db->get_where('groups', ['id' => $users_groups->group_id])->row();
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else if (!$this->ion_auth->is_admin() && $groups_user->name != 'pegawai' && $groups_user->name != 'camat') {
            $this->session->set_flashdata(
                'error',
                '$(document).ready(function(e) {
                    $.NotificationApp.send("Gagal!", "Maaf halaman yang anda tuju tidak bisa diakses!", "top-right", "#bf441d", "error");
                })'
            );
            redirect('dashboard');
        } else {
            $data['title'] = "User";

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
        $list = $this->m_users->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->first_name . ' ' . $field->last_name;
            $row[] = $field->email;
            $row[] = $field->phone;
            $row[] =
                '<div class="checkbox checkbox-success checkbox-single text-center">
                <input id="singleCheckbox2" type="checkbox" class="ubah-user-aktif checkbox checkbox-success" ' . check_users_aktif($field->active) . ' data-id="' . $field->id . ' data-aktif="' . $field->active . '">
                <label></label>
                </div>';
            $row[] =
                '<div class="btn-group" style="vertical-align:middle;"><a href="' . base_url('users/detail_user/') . base64_encode($field->id) . '"  class="btn btn-sm btn-info" title="Grup users"><i class="fe-list"></i></a>
                        <a href="' . base_url('users/edit/') . base64_encode($field->id) . '" class="btn btn-sm btn-warning" title="Edit users"><i class="fe-edit"></i></a>
                        <a href="javascript: void(0);" id="' . base64_encode($field->id) . '" class="btn btn-sm btn-danger btn_delete" title="Hapus users"><i class="fe-trash"></i> </a></div>';


            $data[] = $row;
        }

        $csrf_name = $this->security->get_csrf_token_name();
        $csrf_hash = $this->security->get_csrf_hash();

        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->m_users->count_all(),
            "recordsFiltered" => $this->m_users->count_filtered(),
            "data" => $data,
        );
        $output[$csrf_name] = $csrf_hash;
        $this->output->set_output(json_encode($output));
    }

    public function tambah()
    {
        $user_session = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
        $users_groups = $this->db->get_where('users_groups', ['user_id' => $user_session->id])->row();
        $groups_user = $this->db->get_where('groups', ['id' => $users_groups->group_id])->row();
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth-admin', 'refresh');
        } else if (!$this->ion_auth->is_admin() && $groups_user->name != 'pegawai' && $groups_user->name != 'camat') {
            $this->session->set_flashdata(
                'error',
                '$(document).ready(function(e) {
                    $.NotificationApp.send("Gagal!", "Maaf halaman yang anda tuju tidak bisa diakses!", "top-right", "#bf441d", "error");
                })'
            );
            redirect('dashboard');
        } else {
            $data['title'] = "Tambah User";

            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $data['akses_menu'] = $this->m_sidebar->akses_menu();
            $data['submenu'] = $this->m_sidebar->submenu();

            foreach ($data['akses_menu'] as $k => $m) {
                $data['akses_menu'][$k]['menu'] = $this->m_sidebar->main_menu($m['id_menu_group']);
            }

            $this->m_users->validasi();

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('template/header', $data, FALSE);
                $this->load->view('template/topbar', $data, FALSE);
                $this->load->view('template/sidebar', $data, FALSE);
                $this->load->view('tambah', $data, FALSE);
            } else {
                $this->m_users->tambah();
                $this->session->set_flashdata(
                    'success',
                    '$(document).ready(function(e) {
                        $.NotificationApp.send("Sukses!", "Pengguna berhasil ditambah!", "top-right", "#5ba035", "success");
                    })'
                );
                redirect('users');
            }
        }
    }

    public function edit($id)
    {
        $user_session = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
        $users_groups = $this->db->get_where('users_groups', ['user_id' => $user_session->id])->row();
        $groups_user = $this->db->get_where('groups', ['id' => $users_groups->group_id])->row();
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth-admin', 'refresh');
        } else if (!$this->ion_auth->is_admin() && $groups_user->name != 'pegawai' && $groups_user->name != 'camat') {
            $this->session->set_flashdata(
                'error',
                '$(document).ready(function(e) {
                    $.NotificationApp.send("Gagal!", "Maaf halaman yang anda tuju tidak bisa diakses!", "top-right", "#bf441d", "error");
                })'
            );
            redirect('dashboard');
        } else {
            $data['title'] = "Edit User";

            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $data['akses_menu'] = $this->m_sidebar->akses_menu();
            $data['submenu'] = $this->m_sidebar->submenu();

            foreach ($data['akses_menu'] as $k => $m) {
                $data['akses_menu'][$k]['menu'] = $this->m_sidebar->main_menu($m['id_menu_group']);
            }

            $decode = base64_decode($id);
            $data['get_user'] = $this->db->get_where('users', ['id' => $decode])->row();

            $this->m_users->validasi();

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('template/header', $data, FALSE);
                $this->load->view('template/topbar', $data, FALSE);
                $this->load->view('template/sidebar', $data, FALSE);
                $this->load->view('edit', $data, FALSE);
            } else {
                $this->m_users->edit($decode);
                $this->session->set_flashdata(
                    'success',
                    '$(document).ready(function(e) {
                        $.NotificationApp.send("Sukses!", "Pengguna berhasil diubah!", "top-right", "#5ba035", "success");
                    })'
                );
                redirect('users');
            }
        }
    }

    public function hapus()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else if (!$this->ion_auth->is_admin()) {
            redirect('auth/block');
        } else {
            $decode = base64_decode($this->input->post('id'));
            $this->m_users->hapus($decode);
        }
    }

    public function ubah_user_aktif()
    {
        $user = $this->db->get_where('users', ['id' => $this->input->post('id')])->row_array();

        if ($user['active'] == 0) {
            $this->m_users->user_aktif();
        } else {
            $this->m_users->user_nonaktif();
        }
    }

    public function detail_user($id)
    {
        $user_session = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
        $users_groups = $this->db->get_where('users_groups', ['user_id' => $user_session->id])->row();
        $groups_user = $this->db->get_where('groups', ['id' => $users_groups->group_id])->row();
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth-admin', 'refresh');
        } else if (!$this->ion_auth->is_admin() && $groups_user->name != 'pegawai' && $groups_user->name != 'camat') {
            $this->session->set_flashdata(
                'error',
                '$(document).ready(function(e) {
                    $.NotificationApp.send("Gagal!", "Maaf halaman yang anda tuju tidak bisa diakses!", "top-right", "#bf441d", "error");
                })'
            );
            redirect('dashboard');
        } else {
            $data['title'] = "Detail User";

            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $this->db->where('id!=', 1);

            $data['get_grup'] = $this->db->get('groups')->result();

            $data['akses_menu'] = $this->m_sidebar->akses_menu();
            $data['submenu'] = $this->m_sidebar->submenu();

            foreach ($data['akses_menu'] as $k => $m) {
                $data['akses_menu'][$k]['menu'] = $this->m_sidebar->main_menu($m['id_menu_group']);
            }

            $decode = base64_decode($id);
            $data['get_user'] = $this->m_detail->get_user($decode);
            $data['get_id_user'] = $this->db->get_where('users', ['id' => $decode])->row();
            foreach ($data['get_user'] as $k => $user) {
                $data['get_user'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
            }

            $this->load->view('template/header', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('detail-user', $data, FALSE);
        }
    }

    public function tambah_grup()
    {
        $user_session = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
        $users_groups = $this->db->get_where('users_groups', ['user_id' => $user_session->id])->row();
        $groups_user = $this->db->get_where('groups', ['id' => $users_groups->group_id])->row();
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth-admin', 'refresh');
        } else if (!$this->ion_auth->is_admin() && $groups_user->name != 'pegawai' && $groups_user->name != 'camat') {
            $this->session->set_flashdata(
                'error',
                '$(document).ready(function(e) {
                    $.NotificationApp.send("Gagal!", "Maaf halaman yang anda tuju tidak bisa diakses!", "top-right", "#bf441d", "error");
                })'
            );
            redirect('dashboard');
        } else {
            $this->m_detail->tambah_grup();
            $this->session->set_flashdata(
                'success',
                '$(document).ready(function(e) {
                    $.NotificationApp.send("Sukses!", "Grup user berhasil ditambah!", "top-right", "#5ba035", "success");
                })'
            );
        }
    }

    public function hapus_grup()
    {
        $user_session = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
        $users_groups = $this->db->get_where('users_groups', ['user_id' => $user_session->id])->row();
        $groups_user = $this->db->get_where('groups', ['id' => $users_groups->group_id])->row();
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth-admin', 'refresh');
        } else if (!$this->ion_auth->is_admin() && $groups_user->name != 'pegawai' && $groups_user->name != 'camat') {
            $this->session->set_flashdata(
                'error',
                '$(document).ready(function(e) {
                    $.NotificationApp.send("Gagal!", "Maaf halaman yang anda tuju tidak bisa diakses!", "top-right", "#bf441d", "error");
                })'
            );
            redirect('dashboard');
        } else {
            $this->m_detail->hapus_grup();
            $this->session->set_flashdata(
                'success',
                '$(document).ready(function(e) {
                    $.NotificationApp.send("Sukses!", "Grup user berhasil dihapus!", "top-right", "#5ba035", "success");
                })'
            );
        }
    }
}

/* End of file Users.php */
