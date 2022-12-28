<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_surat extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_dashboard_surat');
        $this->load->model('m_sidebar');
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else {
            $data['title'] = 'Dashboard Statistik';
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            // cek berdasarkan IP, apakah user sudah pernah mengakses hari ini
            $cek_ip = $this->m_dashboard_surat->total_visitor();
            $cek_user_ip = isset($cek_ip) ? ($cek_ip) : 0;

            // kalau belum ada, simpan data user tersebut ke database
            if ($cek_user_ip == 0) {
                $this->m_dashboard_surat->insert_visitor();
            } else { //jika sudah ada, update
                $this->m_dashboard_surat->update_visitor();
            }

            $data['jml_surat_masuk'] = $this->db->get('tb_surat_masuk')->num_rows();
            $data['jml_surat_keluar'] = $this->db->get('tb_surat_keluar')->num_rows();
            $data['jml_klasifikasi'] = $this->db->get('tb_klasifikasi_surat')->num_rows();
            $data['jml_jenis_surat'] = $this->db->get('tb_jenis_surat')->num_rows();
            $data['jml_disposisi'] = $this->db->get('tb_disposisi')->num_rows();
            $data['jml_group'] = $this->db->get('groups')->num_rows();
            $data['jml_user'] = $this->db->get('users')->num_rows();
            $data['jml_penerima'] = $this->db->get('tb_penerima_surat')->num_rows();
            $data['jml_bidang'] = $this->db->get('tb_bidang')->num_rows();


            $data['get_surat'] = $this->m_dashboard_surat->get_surat()->result_array();

            $data['get_total_surat_masuk'] = $this->m_dashboard_surat->get_total_surat_masuk();
            $data['get_total_surat_keluar'] = $this->m_dashboard_surat->get_total_surat_keluar();

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
}

/* End of file Dashboard_surat.php */
