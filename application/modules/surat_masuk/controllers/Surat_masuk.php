<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Surat_masuk extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_smasuk');
        $this->load->model('m_sidebar');
        $this->load->library('upload');
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else {
            $data['title'] = 'Data Surat Masuk';
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

            $list = $this->m_smasuk->get_datatables();
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
                            <button type="button" class="btn btn-xs btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fe-list"></i> Pilih aksi <i class="mdi mdi-chevron-down"></i> </button>
                            <div class="dropdown-menu">
                            <a href="javascript: void(0);" id="' . base64_encode($field->id_smasuk) . '" class="dropdown-item text-success btn-verifikasi" title="Verifikasi data" ' . check_verifikasi($field->status_verifikasi) . '><i class="fe-user-check"></i> Verifikasi Surat</a>
                            <a href="' . base_url('disposisi/tambah/') . base64_encode($field->id_smasuk) . '" class="dropdown-item text-warning" title="Disposisi data" ' . check_active_disposisi($field->status_disposisi) . '><i class="fe-check"></i> Disposisi Surat</a>
                            <a href="' . base_url('surat_masuk/cetak/') . base64_encode($field->id_smasuk) . '" target="_blank" class="dropdown-item" title="Cetak data"><i class="fe-printer"></i> Cetak Surat</a>
                            <a href="' . base_url('surat_masuk/detail/') . base64_encode($field->id_smasuk) . '" class="dropdown-item" title="Detail data"><i class="fe-eye"></i> Detail</a>
                            <a href="' . base_url('surat_masuk/edit/') . base64_encode($field->id_smasuk) . '" class="dropdown-item" title="Edit data"><i class="fe-edit"></i> Edit</a>
                            <a href="javascript: void(0);" id="' . base64_encode($field->id_smasuk) . '" class="dropdown-item btn_delete" title="Hapus data"><i class="fe-trash"></i> Hapus</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <span><i class="fe-edit text-warning"></i> ' . $field->updated_at . '</span>
                    <br>
                    <span><i class="fe-eye text-info"></i> ' . $field->dibaca . '</span>';
                }
                if ($groups->name == "umum") {
                    $row[] = '
                    <div class="text-center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-xs btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fe-list"></i> Pilih aksi <i class="mdi mdi-chevron-down"></i> </button>
                            <div class="dropdown-menu">
                            <a href="' . base_url('disposisi/tambah/') . base64_encode($field->id_smasuk) . '" class="dropdown-item text-warning" title="Disposisi data" ' . check_active_disposisi($field->status_disposisi) . '><i class="fe-check"></i> Disposisi Surat</a>
                            <a href="' . base_url('surat_masuk/cetak/') . base64_encode($field->id_smasuk) . '" target="_blank" class="dropdown-item" title="Cetak data"><i class="fe-printer"></i> Cetak Surat</a>
                            <a href="' . base_url('surat_masuk/detail/') . base64_encode($field->id_smasuk) . '" class="dropdown-item" title="Detail data"><i class="fe-eye"></i> Detail</a>
                            <a href="' . base_url('surat_masuk/edit/') . base64_encode($field->id_smasuk) . '" class="dropdown-item" title="Edit data"><i class="fe-edit"></i> Edit</a>
                            </div>
                        </div>
                    </div>
                    
                    <hr>
                    <small><i class="fe-edit text-warning"></i> ' . $field->updated_at . '</small>
                    <br>
                    <span><i class="fe-eye text-info"></i> ' . $field->dibaca . '</span>';
                }
                if ($groups->name == "pimpinan") {
                    $row[] = '
                    <div class="text-center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-xs btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fe-list"></i> Pilih aksi <i class="mdi mdi-chevron-down"></i> </button>
                            <div class="dropdown-menu">
                            <a href="javascript: void(0);" id="' . base64_encode($field->id_smasuk) . '" class="dropdown-item text-success btn-verifikasi" title="Verifikasi data" ' . check_verifikasi($field->status_verifikasi) . '><i class="fe-user-check"></i> Verifikasi Surat</a>
                            <a href="' . base_url('surat_masuk/cetak/') . base64_encode($field->id_smasuk) . '" target="_blank" class="dropdown-item" title="Cetak data"><i class="fe-printer"></i> Cetak Surat</a>
                            <a href="' . base_url('surat_masuk/detail/') . base64_encode($field->id_smasuk) . '" class="dropdown-item" title="Detail data"><i class="fe-eye"></i> Detail</a>
                            </div>
                        </div>
                    </div>
                    
                    <hr>
                    <small><i class="fe-edit text-warning"></i> ' . $field->updated_at . '</small>
                    <br>
                    <span><i class="fe-eye text-info"></i> ' . $field->dibaca . '</span>';
                }
                if (!$this->ion_auth->is_admin() && !$groups->name == "umum" && !$groups->name == "pimpinan") {
                    $row[] = '
                    <div class="text-center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-xs btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fe-list"></i> Pilih aksi <i class="mdi mdi-chevron-down"></i> </button>
                            <div class="dropdown-menu">
                            <a href="' . base_url('surat_masuk/cetak/') . base64_encode($field->id_smasuk) . '" target="_blank" class="dropdown-item" title="Cetak data"><i class="fe-printer"></i> Cetak Surat</a>
                            <a href="' . base_url('surat_masuk/detail/') . base64_encode($field->id_smasuk) . '" class="dropdown-item" title="Detail data"><i class="fe-eye"></i> Detail</a>
                            <a href="' . base_url('surat_masuk/edit/') . base64_encode($field->id_smasuk) . '" class="dropdown-item" title="Edit data"><i class="fe-edit"></i> Edit</a>
                            <a href="javascript: void(0);" id="' . base64_encode($field->id_smasuk) . '" class="dropdown-item btn_delete" title="Hapus data"><i class="fe-trash"></i> Hapus</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <small><i class="fe-edit text-warning"></i> ' . $field->updated_at . '</small>
                    <br>
                    <span><i class="fe-eye text-info"></i> ' . $field->dibaca . '</span>';
                }

                if ($groups->name == "rekayasa" || $groups->name == "darat" || $groups->name == "laut" || $groups->name == "user") {
                    $row[] = '
                    <div class="text-center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-xs btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fe-list"></i> Pilih aksi <i class="mdi mdi-chevron-down"></i> </button>
                            <div class="dropdown-menu">
                            <a href="' . base_url('surat_masuk/cetak/') . base64_encode($field->id_smasuk) . '" target="_blank" class="dropdown-item" title="Cetak data"><i class="fe-printer"></i> Cetak Surat</a>
                            <a href="' . base_url('surat_masuk/detail/') . base64_encode($field->id_smasuk) . '" class="dropdown-item" title="Detail data"><i class="fe-eye"></i> Detail</a>
                            <a href="' . base_url('surat_masuk/edit/') . base64_encode($field->id_smasuk) . '" class="dropdown-item" title="Edit data"><i class="fe-edit"></i> Edit</a>
                            <a href="javascript: void(0);" id="' . base64_encode($field->id_smasuk) . '" class="dropdown-item btn_delete" title="Hapus data"><i class="fe-trash"></i> Hapus</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <small><i class="fe-edit text-warning"></i> ' . $field->updated_at . '</small>
                    <br>
                    <span><i class="fe-eye text-info"></i> ' . $field->dibaca . '</span>';
                }
                $row[] = '<div> 
                <span> Nomor Agenda: <strong>' . $field->no_agenda . '</strong></span> 
                <br>
                <span> Kode Klasifikasi: <strong>' . $field->kode_klasifikasi . '</strong></span>
                <hr>
                <div class="checkbox checkbox-success mb-2">
                    <input id="checkbox3" type="checkbox" ' . check_disposisi($field->status_disposisi) . ' disabled>
                    <label for="checkbox3">Status Disposisi</label>
                </div>
                <div class="checkbox checkbox-success ">
                    <input id="checkbox2" type="checkbox" ' . check_verifikasi($field->status_verifikasi) . ' disabled>
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
                            <div class="badge badge-info mt-1"><i class="fe-user"></i> ' . $field->penerima . '</div>
                        </div>';
                $row[] = $field->asal_surat;
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
                "recordsTotal" => $this->m_smasuk->count_all(),
                "recordsFiltered" => $this->m_smasuk->count_filtered(),
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
            $data['title'] = 'Tambah Surat Masuk';
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $data['akses_menu'] = $this->m_sidebar->akses_menu();
            $data['submenu'] = $this->m_sidebar->submenu();

            $data['no_agenda'] = $this->m_smasuk->get_data()->num_rows();
            $data['keterangan'] = $this->m_smasuk->data_enum('keterangan');
            $data['sifat_surat'] = $this->m_smasuk->data_enum('sifat_surat');

            foreach ($data['akses_menu'] as $k => $m) {
                $data['akses_menu'][$k]['menu'] = $this->m_sidebar->main_menu($m['id_menu_group']);
            }
            $this->m_smasuk->validasi();
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('template/header', $data, FALSE);
                $this->load->view('template/topbar', $data, FALSE);
                $this->load->view('template/sidebar', $data, FALSE);
                $this->load->view('tambah', $data, FALSE);
            } else {

                $config['upload_path']    = './assets/backend/images/surat_masuk/';
                $config['allowed_types']  = 'jpg|png|jpeg';
                $config['encrypt_name']    = TRUE;
                $this->upload->initialize($config);

                if (!empty($_FILES['file_surat']['name'])) {
                    if ($this->upload->do_upload('file_surat')) {
                        $gbr = $this->upload->data();
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = './assets/backend/images/surat_masuk/' . $gbr['file_name'];
                        $config['create_thumb'] = FALSE;
                        $config['maintain_ratio'] = FALSE;
                        $config['quality'] = '50%';
                        $config['new_image'] = './assets/backend/images/surat_masuk/' . $gbr['file_name'];
                        $this->load->library('image_lib', $config);
                        $this->image_lib->resize();

                        $gambar = $gbr['file_name'];

                        $this->m_smasuk->tambah($gambar);
                        $this->session->set_flashdata(
                            'success',
                            '$(document).ready(function(e) {
                                $.NotificationApp.send("Sukses!", "Data berhasil disimpan", "top-right", "#5ba035", "success")
                            })'
                        );
                        redirect('surat_masuk');
                    }
                } else {
                    $this->session->set_flashdata(
                        'success',
                        '$(document).ready(function(e) {
                            $.NotificationApp.send("Gagal!", "Tidak ada file yang diupload", "top-right", "#bf441d", "error")
                        })'
                    );
                    redirect('surat_masuk/tambah');
                }
            }
        }
    }

    public function edit($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else {
            $data['title'] = 'Edit Surat Masuk';
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $decode = base64_decode($id);
            $data['get_surat'] = $this->db->get_where('tb_surat_masuk', ['id_smasuk' => $decode])->row_array();

            $data['akses_menu'] = $this->m_sidebar->akses_menu();
            $data['submenu'] = $this->m_sidebar->submenu();

            $data['no_agenda'] = $this->m_smasuk->get_data()->num_rows();
            $data['keterangan'] = $this->m_smasuk->data_enum('keterangan');
            $data['sifat_surat'] = $this->m_smasuk->data_enum('sifat_surat');

            foreach ($data['akses_menu'] as $k => $m) {
                $data['akses_menu'][$k]['menu'] = $this->m_sidebar->main_menu($m['id_menu_group']);
            }

            $this->m_smasuk->validasi();
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('template/header', $data, FALSE);
                $this->load->view('template/topbar', $data, FALSE);
                $this->load->view('template/sidebar', $data, FALSE);
                $this->load->view('edit', $data, FALSE);
            } else {

                $config['upload_path']    = './assets/backend/images/surat_masuk/';
                $config['allowed_types']  = 'jpg|png|jpeg';
                $config['encrypt_name']    = TRUE;
                $this->upload->initialize($config);

                if (!empty($_FILES['file_surat']['name'])) {
                    if ($this->upload->do_upload('file_surat')) {
                        $gbr = $this->upload->data();
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = './assets/backend/images/surat_masuk/' . $gbr['file_name'];
                        $config['create_thumb'] = FALSE;
                        $config['maintain_ratio'] = FALSE;
                        $config['quality'] = '50%';
                        $config['new_image'] = './assets/backend/images/surat_masuk/' . $gbr['file_name'];
                        $this->load->library('image_lib', $config);
                        $this->image_lib->resize();

                        $gambar = $gbr['file_name'];

                        $this->m_smasuk->edit_file($gambar, $decode);
                        $this->session->set_flashdata(
                            'success',
                            '$(document).ready(function(e) {
                                $.NotificationApp.send("Sukses!", "Data berhasil disimpan", "top-right", "#5ba035", "success")
                            })'
                        );
                        redirect('surat_masuk');
                    }
                } else {
                    $this->m_smasuk->edit_data($decode);
                    $this->session->set_flashdata(
                        'success',
                        '$(document).ready(function(e) {
                            $.NotificationApp.send("Sukses!", "Data berhasil disimpan", "top-right", "#5ba035", "success")
                        })'
                    );
                    redirect('surat_masuk');
                }
            }
        }
    }

    public function hapus()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else {
            $this->m_smasuk->hapus();
        }
    }

    public function kode_klasifikasi()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else {
            if (isset($_GET['term'])) {
                $result = $this->m_smasuk->search_kode_klasifikasi($_GET['term']);
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
                $result = $this->m_smasuk->search_penerima($_GET['term']);
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
        } else {
            if (isset($_GET['term'])) {
                $result = $this->m_smasuk->search_jenis_surat($_GET['term']);
                if (count($result) > 0) {
                    foreach ($result as $row) {
                        $arr_result[] = $row['jenis_surat'];
                        $this->output->set_output(json_encode($arr_result));
                    }
                }
            }
        }
    }

    public function detail($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else {
            $data['title'] = 'Detail Surat Masuk';
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $decode = base64_decode($id);
            $data['get_surat'] = $this->db->get_where('tb_surat_masuk', ['id_smasuk' => $decode])->row_array();
            $data['get_disposisi'] = $this->db->get_where('tb_disposisi', ['kode_surat' => $data['get_surat']['kode_disposisi']])->row_array();

            $data['akses_menu'] = $this->m_sidebar->akses_menu();
            $data['submenu'] = $this->m_sidebar->submenu();

            $data['no_agenda'] = $this->m_smasuk->get_data()->num_rows();
            $data['keterangan'] = $this->m_smasuk->data_enum('keterangan');
            $data['sifat_surat'] = $this->m_smasuk->data_enum('sifat_surat');

            foreach ($data['akses_menu'] as $k => $m) {
                $data['akses_menu'][$k]['menu'] = $this->m_sidebar->main_menu($m['id_menu_group']);
            }

            $this->load->view('template/header', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('detail', $data, FALSE);
        }
    }

    public function cetak($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else {
            $data['title'] = 'Disposisi Surat Masuk';
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $decode = base64_decode($id);
            $data['get_surat'] = $this->db->get_where('tb_surat_masuk', ['id_smasuk' => $decode])->row_array();

            $this->load->view('cetak-disposisi', $data, FALSE);
        }
    }

    public function edit_verifikasi()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else {
            $this->m_smasuk->edit_verifikasi();
        }
    }
}

/* End of file Surat_masuk.php */
