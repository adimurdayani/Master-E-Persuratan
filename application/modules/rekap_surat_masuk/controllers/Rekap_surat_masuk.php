<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Rekap_surat_masuk extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_rsmasuk');
        $this->load->model('m_sidebar');
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else {
            $data['title'] = 'Rekap Agenda Surat Masuk';
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

    public function cetak()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else {
            $data['title'] = 'Rekapitulasi Laporan Surat Masuk';
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row_array();
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $this->form_validation->set_rules('tgl_awal', 'tanggal awal', 'trim|required');
            $this->form_validation->set_rules('tgl_akhir', 'tanggal akhir', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata(
                    'success',
                    '$(document).ready(function(e) {
                        $.NotificationApp.send("Gagal!", "Tanggal awal dan tanggal akhir tidak boleh kosong!", "top-right", "#bf441d", "error")
                    })'
                );
                redirect('rekap_surat_masuk');
            } else {
                $data['get_surat'] = $this->m_rsmasuk->get_data()->result_array();
                // var_dump($data['get_surat']);
                // die;
                $this->load->view('cetak-surat-masuk', $data, FALSE);
            }
        }
    }
}

/* End of file Surat_masuk.php */
