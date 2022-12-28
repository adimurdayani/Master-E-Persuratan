<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_dashboard');
        $this->load->model('m_sidebar');
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else if (!$this->ion_auth->is_admin()) {
            redirect('auth/block', 'refresh');
        } else {
            $data['title'] = 'Dashboard';
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            // cek berdasarkan IP, apakah user sudah pernah mengakses hari ini
            $cek_ip = $this->m_dashboard->total_visitor();
            $cek_user_ip = isset($cek_ip) ? ($cek_ip) : 0;

            // kalau belum ada, simpan data user tersebut ke database
            if ($cek_user_ip == 0) {
                $this->m_dashboard->insert_visitor();
            } else { //jika sudah ada, update
                $this->m_dashboard->update_visitor();
            }

            // jumlah pengujung sekarang
            $pengunjung_hariini = $this->m_dashboard->jml_pengunjung();
            $db_pengunjung = $this->m_dashboard->get_pengunjung();

            // total pengunjung
            $total_pengunjung = isset($db_pengunjung->hits) ? ($db_pengunjung->hits) : 0;

            // jumlah pengujung online
            $pengunjung_online = $this->m_dashboard->pengunjung_online();

            $data['pengunjung_hariini'] = $pengunjung_hariini;
            $data['total_pengunjung'] = $total_pengunjung;
            $data['pengunjung_online'] = $pengunjung_online;

            $data['get_total_hits'] = $this->m_dashboard->get_total();
            $data['get_total_userkoneksi'] = $this->m_dashboard->get_total_userkoneksi();
            $data['get_total'] = $this->db->get('users_visitor')->num_rows();
            $data['total_kategori'] = $this->db->get('menu_groups')->num_rows();
            $data['total_menu'] = $this->db->get('menu')->num_rows();
            $data['total_submenu'] = $this->db->get('sub_menu')->num_rows();
            $data['total_groups'] = $this->db->get('groups')->num_rows();
            $data['total_users'] = $this->db->get('users')->num_rows();

            $users_group = $this->db->get_where('users_groups', ['user_id' => $data['session']->id])->row();
            $data['groups'] = $this->db->get_where('groups', ['id' => $users_group->group_id])->row();

            $data['akses_menu'] = $this->m_sidebar->akses_menu();
            $data['submenu'] = $this->m_sidebar->submenu();

            foreach ($data['akses_menu'] as $k => $m) {
                $data['akses_menu'][$k]['menu'] = $this->m_sidebar->main_menu($m['id_menu_group']);
            }

            // var_dump($data['akses_menu']);
            // die;

            $this->load->view('template/header', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('index', $data, FALSE);
        }
    }

    public function load_notifikasi()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else {
            $data['jml'] = $this->m_dashboard->load_notifikasi()->num_rows();
            $this->output->set_output(json_encode($data));
        }
    }

    public function load_data_notifikasi()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else {
            $result = $this->m_dashboard->load_notifikasi()->result_array();
            $this->output->set_output(json_encode($result));
        }
    }

    public function dibaca()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else {
            $this->m_dashboard->dibaca();
        }
    }

    public function load_jml_surat_keluar()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else {
            $data['jml_surat_keluar'] = $this->m_dashboard->load_data_surat_keluar()->num_rows();
            $this->output->set_output(json_encode($data));
        }
    }

    public function load_data_surat_keluar()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else {
            $result = $this->m_dashboard->load_data_surat_keluar()->result_array();
            $this->output->set_output(json_encode($result));
        }
    }

    public function baca_surat_keluar()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else {
            $this->m_dashboard->baca_surat_keluar();
        }
    }
}

/* End of file Dashboard.php */
