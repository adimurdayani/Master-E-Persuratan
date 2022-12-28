<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_menu');
        $this->load->model('m_sidebar');
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else if (!$this->ion_auth->is_admin()) {
            redirect('auth/block', 'refresh');
        } else {
            $data['title'] = 'Menu';
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();
            $data['get_kategori'] = $this->db->get('menu_groups')->result();
            $data['get_menu'] = $this->db->get('menu')->result();
            $data['get_submenu'] = $this->db->get('sub_menu')->result();

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
            $list = $this->m_menu->get_datatables();
            $data = array();
            $no = @$_POST['start'];
            foreach ($list as $field) {
                $no++;
                $row = array();
                $row[] = '<div class="btn-group">
                <button type="button" class="btn btn-xs btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fe-list"></i> Pilih aksi <i class="mdi mdi-chevron-down"></i> </button>
                <div class="dropdown-menu">
                    <a href="javascript: void(0);" id="' . base64_encode($field->id_menu) . '" class="dropdown-item btn_delete" title="Hapus menu"><i class="fe-trash"></i> Hapus Menu</a>
                    <a href="javascript: void(0);" data-id="' . base64_encode($field->id_menu) . '" class="dropdown-item edit-menu" title="Edit menu"><i class="fe-edit"></i> Edit Menu</a>
                    <a href="' . base_url('menu/detail/submenu/') . base64_encode($field->id_menu) . '"' . check_collapse_menu_button($field->dropdown_active) . ' class="dropdown-item" title="Lihat Submenu"><i class="fe-menu"></i> Lihat Submenu</a>
                </div>
                </div>';
                $row[] = '<div class="checkbox checkbox-success checkbox-single text-center">
                <input id="singleCheckbox2" type="checkbox" class="ubah-menu-aktif checkbox checkbox-success" ' . check_menu_aktif($field->active) . ' data-id="' . $field->id_menu . '"><label></label></div>';
                $row[] = '<div class="checkbox checkbox-success checkbox-single text-center">
                <input id="singleCheckbox2" type="checkbox" class="ubah-menu-collapse checkbox checkbox-success" ' . check_collapse_menu($field->dropdown_active) . ' data-id="' . $field->id_menu . ' data-collapsemenu="' . $field->dropdown_active . '"><label></label></div>';
                $row[] = $field->serial_number;
                $row[] = $field->menu_title;
                $row[] = $field->url;
                $row[] = $field->folder;
                $row[] = '<i class="' . $field->icon . '"></i> ' . $field->icon;

                $data[] = $row;
            }

            $csrf_name = $this->security->get_csrf_token_name();
            $csrf_hash = $this->security->get_csrf_hash();

            $output = array(
                "draw" => @$_POST['draw'],
                "recordsTotal" => $this->m_menu->count_all(),
                "recordsFiltered" => $this->m_menu->count_filtered(),
                "data" => $data,
            );

            $output[$csrf_name] = $csrf_hash;
            $this->output->set_output(json_encode($output));
        }
    }

    public function tambah()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else if (!$this->ion_auth->is_admin()) {
            redirect('auth/block', 'refresh');
        } else {
            $this->m_menu->tambah();
        }
    }

    public function edit()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else if (!$this->ion_auth->is_admin()) {
            redirect('auth/block', 'refresh');
        } else {
            $this->m_menu->edit();
        }
    }

    public function tambah_folder()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else if (!$this->ion_auth->is_admin()) {
            redirect('auth/block', 'refresh');
        } else {
            $this->form_validation->set_rules('folder', 'folder', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata(
                    'success',
                    '$(document).ready(function(e) {
                        $.NotificationApp.send("Gagal!", "Nama folder gagal diubah!", "top-right", "#bf441d", "error");
                    })'
                );
                redirect('menu');
            } else {
                $this->m_menu->tambah_folder();
                $this->session->set_flashdata(
                    'success',
                    '$(document).ready(function(e) {
                        $.NotificationApp.send("Sukses!", "Nama folder berhasil diubah!", "top-right", "#5ba035", "success");
                    })'
                );
                redirect('menu');
            }
        }
    }

    public function edit_folder()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else if (!$this->ion_auth->is_admin()) {
            redirect('auth/block', 'refresh');
        } else {
            $this->form_validation->set_rules('folder', 'folder', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata(
                    'success',
                    '$(document).ready(function(e) {
                        $.NotificationApp.send("Gagal!", "Nama folder gagal diubah!", "top-right", "#bf441d", "error");
                    })'
                );
                redirect('menu');
            } else {
                $this->m_menu->edit_folder();
                $this->session->set_flashdata(
                    'success',
                    '$(document).ready(function(e) {
                        $.NotificationApp.send("Sukses!", "Nama folder berhasil diubah!", "top-right", "#5ba035", "success");
                    })'
                );
                redirect('menu');
            }
        }
    }

    public function hapus()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else if (!$this->ion_auth->is_admin()) {
            redirect('auth/block', 'refresh');
        } else {
            $this->m_menu->hapus();
        }
    }

    public function ubah_menu_aktif()
    {
        $id = $this->input->post('id_menu');
        $menu = $this->db->get_where('menu', ['id_menu' => $id])->row_array();
        $nama = json_encode($menu['menu_title']);

        if ($menu['active'] == 0) {
            $this->m_menu->aktif($id);
            $this->session->set_flashdata(
                'success',
                '$(document).ready(function(e) {
                    $.NotificationApp.send("Sukses!", "' . json_decode($nama) . ' telah diaktifkan!", "top-right", "#5ba035", "success");
                })'
            );
        } else {
            $this->m_menu->nonaktif($id);
            $this->session->set_flashdata(
                'success',
                '$(document).ready(function(e) {
                    $.NotificationApp.send("Sukses!", "' . json_decode($nama) . ' telah dinonaktifkan!", "top-right", "#5ba035", "success");
                })'
            );
        }
    }

    public function ubah_collapse_menu()
    {
        $id = $this->input->post('id_menu');
        $menu = $this->db->get_where('menu', ['id_menu' => $id])->row_array();
        $nama = json_encode($menu['menu_title']);

        if ($menu['dropdown_active'] == 0) {
            $this->m_menu->collapse_aktif($id);
            $this->session->set_flashdata(
                'success',
                '$(document).ready(function(e) {
                    $.NotificationApp.send("Sukses!", "' . json_decode($nama) . ' telah diaktifkan!", "top-right", "#5ba035", "success");
                })'
            );
        } else {
            $this->m_menu->collapse_nonaktif($id);
            $this->session->set_flashdata(
                'success',
                '$(document).ready(function(e) {
                    $.NotificationApp.send("Sukses!", "' . json_decode($nama) . ' telah dinonaktifkan!", "top-right", "#5ba035", "success");
                })'
            );
        }
    }

    public function show_data()
    {
        $id = base64_decode($this->input->post('id'));
        $this->db->select('menu.*, menu_groups.name');
        $this->db->from('menu');
        $this->db->join('menu_groups', 'menu.id_menu_groups = menu_groups.id_menu_group', 'left');
        $this->db->where('id_menu', $id);
        $menu = $this->db->get()->row_array();
        $this->output->set_output(json_encode($menu));
    }
}

/* End of file Menu.php */
