<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Surat_keluar extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_skeluar');
        $this->load->model('m_sidebar');
        $this->load->library('upload');
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else {
            $data['title'] = 'Data Surat Keluar';
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
            $user = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $user_groups = $this->db->get_where('users_groups', ['user_id' => $user->id])->row();
            $groups = $this->db->get_where('groups', ['id' => $user_groups->group_id])->row();

            $list = $this->m_skeluar->get_datatables();
            $data = array();
            $no = @$_POST['start'];
            foreach ($list as $field) {
                $this->db->where('id', $field->user_id);
                $user = $this->db->get('users')->row();
                $no++;
                $row = array();
                if ($this->ion_auth->is_admin()) {
                    $row[] = '
                    <div class="text-center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-xs btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fe-list"></i> Pilih aksi <i class="mdi mdi-chevron-down"></i> </button>
                            <div class="dropdown-menu">
                            <a href="javascript: void(0);" id="' . base64_encode($field->id_skeluar) . '" class="dropdown-item text-success btn-verifikasi" title="Verifikasi data" ' . check_verifikasi($field->status_verifikasi) . '><i class="fe-user-check"></i> Verifikasi Surat</a>
                            <a href="' . base_url('surat_keluar/detail/') . base64_encode($field->id_skeluar) . '" class="dropdown-item" title="Detail data"><i class="fe-eye"></i> Detail</a>
                            <a href="' . base_url('surat_keluar/edit/') . base64_encode($field->id_skeluar) . '" class="dropdown-item" title="Edit data"><i class="fe-edit"></i> Edit</a>
                            <a href="javascript: void(0);" id="' . base64_encode($field->id_skeluar) . '" class="dropdown-item btn_delete" title="Hapus data"><i class="fe-trash"></i> Hapus</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <span><i class="fe-edit text-warning"></i> ' . $field->updated_at . '</span>
                    <br>
                    <span><i class="fe-eye text-info"></i> ' . $field->dibaca . '</span>';
                }
                if (!$groups->name == "pimpinan" && !$groups->name == "umum" && !$this->ion_auth->is_admin()) {
                    $row[] = '
                    <div class="text-center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-xs btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fe-list"></i> Pilih aksi <i class="mdi mdi-chevron-down"></i> </button>
                            <div class="dropdown-menu">
                            <a href="' . base_url('surat_keluar/detail/') . base64_encode($field->id_skeluar) . '" class="dropdown-item" title="Detail data"><i class="fe-eye"></i> Detail</a>
                            <a href="' . base_url('surat_keluar/edit/') . base64_encode($field->id_skeluar) . '" class="dropdown-item" title="Edit data"><i class="fe-edit"></i> Edit</a>
                            <a href="javascript: void(0);" id="' . base64_encode($field->id_skeluar) . '" class="dropdown-item btn_delete" title="Hapus data"><i class="fe-trash"></i> Hapus</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <span><i class="fe-edit text-warning"></i> ' . $field->updated_at . '</span>
                    <br>
                    <span><i class="fe-eye text-info"></i> ' . $field->dibaca . '</span>';
                }
                if ($groups->name == "darat" || $groups->name == "laut" || $groups->name == "rekayasa" ||  $groups->name == "user" || $groups->name == "umum") {
                    $row[] = '
                    <div class="text-center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-xs btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fe-list"></i> Pilih aksi <i class="mdi mdi-chevron-down"></i> </button>
                            <div class="dropdown-menu">
                            <a href="' . base_url('surat_keluar/detail/') . base64_encode($field->id_skeluar) . '" class="dropdown-item" title="Detail data"><i class="fe-eye"></i> Detail</a>
                            <a href="' . base_url('surat_keluar/edit/') . base64_encode($field->id_skeluar) . '" class="dropdown-item" title="Edit data"><i class="fe-edit"></i> Edit</a>
                            <a href="javascript: void(0);" id="' . base64_encode($field->id_skeluar) . '" class="dropdown-item btn_delete" title="Hapus data"><i class="fe-trash"></i> Hapus</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <span><i class="fe-edit text-warning"></i> ' . $field->updated_at . '</span>
                    <br>
                    <span><i class="fe-eye text-info"></i> ' . $field->dibaca . '</span>';
                }
                if ($groups->name == "pimpinan") {
                    $row[] = '
                    <div class="text-center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-xs btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fe-list"></i> Pilih aksi <i class="mdi mdi-chevron-down"></i> </button>
                            <div class="dropdown-menu">
                            <a href="javascript: void(0);" id="' . base64_encode($field->id_skeluar) . '" class="dropdown-item text-success btn-verifikasi" title="Verifikasi data" ' . check_verifikasi_keluar($field->status_verifikasi) . '><i class="fe-user-check"></i> Verifikasi Surat</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <span><i class="fe-edit text-warning"></i> ' . $field->updated_at . '</span>
                    <br>
                    <span><i class="fe-eye text-info"></i> ' . $field->dibaca . '</span>';
                }

                $row[] = '<div> 
                <span> Nomor Agenda: <strong>' . $field->no_agenda . '</strong></span> 
                <br>
                <span> Kode Klasifikasi: <strong>' . $field->kode_klasifikasi . '</strong></span>
                <hr>
                <div class="checkbox checkbox-success ">
                    <input id="checkbox2" type="checkbox" ' . check_verifikasi_keluar($field->status_verifikasi) . ' disabled>
                    <label for="checkbox2">Status Verifikasi</label>
                </div>
                </div>';
                $row[] = '<div>
                            <strong>' . $field->jenis_surat . ': </strong>
                            <br>' . $field->isi_surat . '
                            <hr> 
                            <a href="' . base_url('assets/backend/images/surat_masuk/') . $field->file_surat . '" target="_blank" class="badge badge-primary"><i class="fe-file"></i> Lihat file</a>
                            <br> 
                            <a href="' . $field->link_file . '" class="badge badge-success mt-1"><i class="fe-hard-drive"></i> Google drive</a>
                            <br> 
                            <div class="badge badge-info mt-1"><i class="fe-user"></i> ' . $field->pembuat_surat . '</div>
                        </div>';
                $row[] = $field->tujuan_surat;
                $row[] = $field->no_surat . '/' . $field->kode_klasifikasi . '/' . romawi(date('m', strtotime($field->tgl_surat))) . '/' . $field->tahun . '
                <hr>' .
                    '<small><i class="fe-calendar"></i> ' . tanggal_indonesia($field->tgl_surat) . '</small>
                <br>' .
                    '<small><i class="fe-edit text-success"></i> ' . $field->created_at . '</small>
                <br>' .
                    '<small><i class="fe-user"></i> ' . $user->first_name . '</small>
                <br>' .
                    '<small><i class="fe-archive text-success"></i> ' . $field->keterangan . '</small> ' .
                    '- <small><i class="fe-eye text-success"></i> ' . $field->sifat_surat . '</small>';

                $data[] = $row;
            }

            $csrf_name = $this->security->get_csrf_token_name();
            $csrf_hash = $this->security->get_csrf_hash();

            $output = array(
                "draw" => @$_POST['draw'],
                "recordsTotal" => $this->m_skeluar->count_all(),
                "recordsFiltered" => $this->m_skeluar->count_filtered(),
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
            $data['title'] = 'Tambah Surat Keluar';
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $data['akses_menu'] = $this->m_sidebar->akses_menu();
            $data['submenu'] = $this->m_sidebar->submenu();
            $data['keterangan'] = $this->m_skeluar->data_enum('keterangan');
            $data['sifat_surat'] = $this->m_skeluar->data_enum('sifat_surat');
            $data['no_agenda'] = $this->m_skeluar->get_data()->num_rows();

            foreach ($data['akses_menu'] as $k => $m) {
                $data['akses_menu'][$k]['menu'] = $this->m_sidebar->main_menu($m['id_menu_group']);
            }
            $this->m_skeluar->validasi();
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('template/header', $data, FALSE);
                $this->load->view('template/topbar', $data, FALSE);
                $this->load->view('template/sidebar', $data, FALSE);
                $this->load->view('tambah', $data, FALSE);
            } else {
                $config['upload_path']    = './assets/backend/images/surat_keluar/';
                $config['allowed_types']  = 'jpg|png|jpeg';
                $config['encrypt_name']    = TRUE;
                $this->upload->initialize($config);

                if (!empty($_FILES['file_surat']['name'])) {
                    if ($this->upload->do_upload('file_surat')) {
                        $gbr = $this->upload->data();
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = './assets/backend/images/surat_keluar/' . $gbr['file_name'];
                        $config['create_thumb'] = FALSE;
                        $config['maintain_ratio'] = FALSE;
                        $config['quality'] = '50%';
                        $config['new_image'] = './assets/backend/images/surat_keluar/' . $gbr['file_name'];
                        $this->load->library('image_lib', $config);
                        $this->image_lib->resize();

                        $gambar = $gbr['file_name'];

                        $this->m_skeluar->tambah($gambar);
                        $this->session->set_flashdata(
                            'success',
                            '$(document).ready(function(e) {
                                $.NotificationApp.send("Sukses!", "Data berhasil disimpan", "top-right", "#5ba035", "success")
                            })'
                        );
                        redirect('surat_keluar');
                    }
                } else {
                    $this->session->set_flashdata(
                        'success',
                        '$(document).ready(function(e) {
                            $.NotificationApp.send("Gagal!", "Tidak ada file yang diupload", "top-right", "#bf441d", "error")
                        })'
                    );
                    redirect('surat_keluar/tambah');
                }
            }
        }
    }

    public function edit($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else {
            $data['title'] = 'Edit Surat Keluar';
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $data['akses_menu'] = $this->m_sidebar->akses_menu();
            $data['submenu'] = $this->m_sidebar->submenu();
            $data['keterangan'] = $this->m_skeluar->data_enum('keterangan');
            $data['sifat_surat'] = $this->m_skeluar->data_enum('sifat_surat');
            $decode = base64_decode($id);
            $data['get_surat'] = $this->m_skeluar->get_data($decode)->row_array();

            foreach ($data['akses_menu'] as $k => $m) {
                $data['akses_menu'][$k]['menu'] = $this->m_sidebar->main_menu($m['id_menu_group']);
            }

            $this->m_skeluar->validasi();
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('template/header', $data, FALSE);
                $this->load->view('template/topbar', $data, FALSE);
                $this->load->view('template/sidebar', $data, FALSE);
                $this->load->view('edit', $data, FALSE);
            } else {
                $config['upload_path']    = './assets/backend/images/surat_keluar/';
                $config['allowed_types']  = 'jpg|png|jpeg';
                $config['encrypt_name']    = TRUE;
                $this->upload->initialize($config);

                if (!empty($_FILES['file_surat']['name'])) {
                    if ($this->upload->do_upload('file_surat')) {
                        $gbr = $this->upload->data();
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = './assets/backend/images/surat_keluar/' . $gbr['file_name'];
                        $config['create_thumb'] = FALSE;
                        $config['maintain_ratio'] = FALSE;
                        $config['quality'] = '50%';
                        $config['new_image'] = './assets/backend/images/surat_keluar/' . $gbr['file_name'];
                        $this->load->library('image_lib', $config);
                        $this->image_lib->resize();

                        $gambar = $gbr['file_name'];

                        $this->m_skeluar->edit_file($gambar, $decode);
                        $this->session->set_flashdata(
                            'success',
                            '$(document).ready(function(e) {
                                $.NotificationApp.send("Sukses!", "Data berhasil disimpan", "top-right", "#5ba035", "success")
                            })'
                        );
                        redirect('surat_keluar');
                    }
                } else {
                    $this->m_skeluar->edit_data($decode);
                    $this->session->set_flashdata(
                        'success',
                        '$(document).ready(function(e) {
                            $.NotificationApp.send("Sukses!", "Data berhasil disimpan", "top-right", "#5ba035", "success")
                        })'
                    );
                    redirect('surat_keluar');
                }
            }
        }
    }

    public function hapus()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else {
            $this->m_skeluar->hapus();
        }
    }

    public function kode_klasifikasi()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else if (!$this->ion_auth->is_admin()) {
            redirect('auth/block', 'refresh');
        } else {
            if (isset($_GET['term'])) {
                $result = $this->m_skeluar->search_kode_klasifikasi($_GET['term']);
                if (count($result) > 0) {
                    foreach ($result as $row) {
                        $arr_result[] = $row['kode'] . ' - ' . $row['klasifikasi'];
                        $this->output->set_output(json_encode($arr_result));
                    }
                }
            }
        }
    }

    public function penerima()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else {
            if (isset($_GET['term'])) {
                $result = $this->m_skeluar->search_penerima($_GET['term']);
                if (count($result) > 0) {
                    foreach ($result as $row) {
                        $arr_result[] = $row['nama'];
                        $this->output->set_output(json_encode($arr_result));
                    }
                }
            }
        }
    }

    public function jenis_surat()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else if (!$this->ion_auth->is_admin()) {
            redirect('auth/block', 'refresh');
        } else {
            if (isset($_GET['term'])) {
                $result = $this->m_skeluar->search_jenis_surat($_GET['term']);
                if (count($result) > 0) {
                    foreach ($result as $row) {
                        $arr_result[] = $row['jenis_surat'];
                        $this->output->set_output(json_encode($arr_result));
                    }
                }
            }
        }
    }

    public function bidang()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else {
            if (isset($_GET['term'])) {
                $result = $this->m_skeluar->search_bidang($_GET['term']);
                if (count($result) > 0) {
                    foreach ($result as $row) {
                        $arr_result[] = $row['nama'];
                        $this->output->set_output(json_encode($arr_result));
                    }
                }
            }
        }
    }

    public function edit_verifikasi()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else {
            $this->m_skeluar->edit_verifikasi();
        }
    }

    public function detail($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else {
            $data['title'] = 'Detail Surat Keluar';
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $decode = base64_decode($id);
            $data['get_surat'] = $this->m_skeluar->get_data($decode)->row_array();

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

/* End of file Surat_masuk.php */
