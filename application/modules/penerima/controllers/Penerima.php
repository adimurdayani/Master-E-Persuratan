<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Penerima extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_penerima');
        $this->load->model('m_sidebar');
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else {
            $data['title'] = 'Data Penerima Surat';
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
        } else {
            $list = $this->m_penerima->get_datatables();
            $data = array();
            $no = @$_POST['start'];
            foreach ($list as $field) {
                $no++;
                $row = array();
                $row[] = '<div class="text-center">' . $no . '</div>';
                $row[] = $field->nama;
                $row[] = '<div class="text-center">' . tanggal_indonesia_medium($field->created_at) . '</div>';
                $row[] = '<div class="text-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-xs btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fe-list"></i> Pilih aksi <i class="mdi mdi-chevron-down"></i> </button>
                    <div class="dropdown-menu">
                        <a href="javascript: void(0);" data-id="' . base64_encode($field->id) . '" class="dropdown-item edit-penerima" title="Edit data"><i class="fe-edit"></i> Edit data</a>
                        <a href="javascript: void(0);" id="' . base64_encode($field->id) . '" class="dropdown-item btn_delete" title="Hapus data"><i class="fe-trash"></i> Hapus data</a>
                    </div>
                </div></div>';

                $data[] = $row;
            }

            $csrf_name = $this->security->get_csrf_token_name();
            $csrf_hash = $this->security->get_csrf_hash();

            $output = array(
                "draw" => @$_POST['draw'],
                "recordsTotal" => $this->m_penerima->count_all(),
                "recordsFiltered" => $this->m_penerima->count_filtered(),
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
        } else {
            $this->m_penerima->tambah();
        }
    }

    public function show_data()
    {
        $penerima = $this->m_penerima->get_data()->row_array();
        $this->output->set_output(json_encode($penerima));
    }

    public function edit()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else {
            $this->m_penerima->edit();
        }
    }

    public function hapus()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else {
            $this->m_penerima->hapus();
        }
    }
}

/* End of file Klasifikasi.php */
