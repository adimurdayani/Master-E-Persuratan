<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Disposisi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_disposisi');
        $this->load->model('m_sidebar');
    }
    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else {
            $data['title'] = 'Data Disposisi Surat';
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
            $list = $this->m_disposisi->get_datatables();
            $data = array();
            $no = @$_POST['start'];
            foreach ($list as $field) {
                $no++;
                $row = array();
                $row[] = '<div class="text-center">' . $no . '</div>';
                $row[] = $field->tujuan_disposisi;
                $row[] = $field->isi_disposisi;
                $row[] = '<div class="text-center"><h5><div class="badge badge-info">' . $field->sifat_disposisi . '</div></h5></div>';
                $row[] = tanggal_indonesia($field->batas_waktu);
                if ($this->ion_auth->is_admin()) {
                    $row[] = '
                    <div class="text-center"><div class="btn btn-group">
                    <a href="' . base_url('disposisi/detail/') . base64_encode($field->id_disposisi) . '" class="btn btn-sm btn-info" title="Detail data"><i class="fe-info"></i> Detail</a>
                    <a href="' . base_url('disposisi/edit/') . base64_encode($field->id_disposisi) . '" class="btn btn-sm btn-warning" title="Edit data"><i class="fe-edit  "></i> Edit</a>
                    <a href="javascript:void(0);" id="' . base64_encode($field->id_disposisi) . '" class="btn btn-sm btn-danger btn_delete" title="Hapus data"><i class="fe-trash"></i> Hapus</a>
                    </div></div>';
                } else {
                    $row[] = '
                    <div class="text-center">
                    <a href="' . base_url('disposisi/detail/') . base64_encode($field->id_disposisi) . '" class="btn btn-sm btn-info" title="Detail data"><i class="fe-info"></i> Detail</a>
                    </div>';
                }
                $data[] = $row;
            }

            $csrf_name = $this->security->get_csrf_token_name();
            $csrf_hash = $this->security->get_csrf_hash();

            $output = array(
                "draw" => @$_POST['draw'],
                "recordsTotal" => $this->m_disposisi->count_all(),
                "recordsFiltered" => $this->m_disposisi->count_filtered(),
                "data" => $data,
            );

            $output[$csrf_name] = $csrf_hash;
            $this->output->set_output(json_encode($output));
        }
    }

    public function tambah($id_smasuk)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else {
            $data['title'] = 'Tambah Disposisi Surat';
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $decode = base64_decode($id_smasuk);
            $data['get_surat'] = $this->db->get_where('tb_surat_masuk', ['id_smasuk' => $decode])->row_array();
            $data['sifat_disposisi'] = $this->m_disposisi->data_enum('sifat_disposisi');

            $data['akses_menu'] = $this->m_sidebar->akses_menu();
            $data['submenu'] = $this->m_sidebar->submenu();

            foreach ($data['akses_menu'] as $k => $m) {
                $data['akses_menu'][$k]['menu'] = $this->m_sidebar->main_menu($m['id_menu_group']);
            }

            $this->m_disposisi->validasi();
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('template/header', $data, FALSE);
                $this->load->view('template/topbar', $data, FALSE);
                $this->load->view('template/sidebar', $data, FALSE);
                $this->load->view('tambah', $data, FALSE);
            } else {
                $this->m_disposisi->tambah($data['get_surat']['kode_disposisi']);
                $this->session->set_flashdata(
                    'success',
                    '$(document).ready(function(e) {
                        $.NotificationApp.send("Sukses!", "Disposisi berhasil disimpan", "top-right", "#5ba035", "success")
                    })'
                );
                redirect('disposisi/tambah/' . $id_smasuk);
            }
        }
    }

    public function edit($id_disposisi)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else {
            $data['title'] = 'Edit Disposisi Surat';
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $decode = base64_decode($id_disposisi);
            $data['get_disposisi'] = $this->db->get_where('tb_disposisi', ['id_disposisi' => $decode])->row_array();
            $data['get_surat'] = $this->db->get_where('tb_surat_masuk', ['kode_disposisi' => $data['get_disposisi']['kode_surat']])->row_array();
            $data['sifat_disposisi'] = $this->m_disposisi->data_enum('sifat_disposisi');

            $data['akses_menu'] = $this->m_sidebar->akses_menu();
            $data['submenu'] = $this->m_sidebar->submenu();

            foreach ($data['akses_menu'] as $k => $m) {
                $data['akses_menu'][$k]['menu'] = $this->m_sidebar->main_menu($m['id_menu_group']);
            }

            $this->m_disposisi->validasi();
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('template/header', $data, FALSE);
                $this->load->view('template/topbar', $data, FALSE);
                $this->load->view('template/sidebar', $data, FALSE);
                $this->load->view('edit', $data, FALSE);
            } else {
                $this->m_disposisi->edit($decode);
                $this->session->set_flashdata(
                    'success',
                    '$(document).ready(function(e) {
                        $.NotificationApp.send("Sukses!", "Disposisi berhasil diubah", "top-right", "#5ba035", "success")
                    })'
                );
                redirect('disposisi/edit/' . $id_disposisi);
            }
        }
    }

    public function hapus()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else {
            $this->m_disposisi->hapus();
        }
    }

    public function detail($id_disposisi)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else {
            $data['title'] = 'Detail Disposisi Surat';
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $decode = base64_decode($id_disposisi);
            $data['get_disposisi'] = $this->db->get_where('tb_disposisi', ['id_disposisi' => $decode])->row_array();
            $data['get_surat'] = $this->db->get_where('tb_surat_masuk', ['kode_disposisi' => $data['get_disposisi']['kode_surat']])->row_array();

            $data['akses_menu'] = $this->m_sidebar->akses_menu();
            $data['submenu'] = $this->m_sidebar->submenu();

            foreach ($data['akses_menu'] as $k => $m) {
                $data['akses_menu'][$k]['menu'] = $this->m_sidebar->main_menu($m['id_menu_group']);
            }

            $this->load->view('template/header', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('detail', $data, FALSE);
        }
    }
}

/* End of file Disposisi.php */
