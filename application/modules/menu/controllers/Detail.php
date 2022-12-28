<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Detail extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_detail');
        $this->load->model('m_sidebar');
    }

    public function submenu($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else if (!$this->ion_auth->is_admin()) {
            redirect('auth/block', 'refresh');
        } else {
            $data['title'] = 'Submenu';
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $data['get_config'] = $this->db->get('tb_konfigurasi')->row();

            $decode = base64_decode($id);
            $data['get_menu'] = $this->db->get_where('menu', ['id_menu' => $decode])->row();

            $this->db->order_by('serial_number', 'asc');
            $data['get_submenu'] = $this->db->get('sub_menu')->result();

            $data['akses_menu'] = $this->m_sidebar->akses_menu();
            $data['submenu'] = $this->m_sidebar->submenu();

            foreach ($data['akses_menu'] as $k => $m) {
                $data['akses_menu'][$k]['menu'] = $this->m_sidebar->main_menu($m['id_menu_group']);
            }

            $data['get_menu'] = $this->db->get_where('menu', ['id_menu' => $decode])->row();

            $this->load->view('template/header', $data, FALSE);
            $this->load->view('template/topbar', $data, FALSE);
            $this->load->view('template/sidebar', $data, FALSE);
            $this->load->view('detail-submenu', $data, FALSE);
        }
    }

    public function load_data($encode)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else if (!$this->ion_auth->is_admin()) {
            redirect('auth/block', 'refresh');
        } else {
            $id = base64_decode($encode);
            $data = $this->m_detail->get_data($id);
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
            $this->m_detail->tambah();
        }
    }

    public function update()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else if (!$this->ion_auth->is_admin()) {
            redirect('auth/block', 'refresh');
        } else {
            $this->m_detail->update();
        }
    }

    public function hapus()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else if (!$this->ion_auth->is_admin()) {
            redirect('auth/block', 'refresh');
        } else {
            $this->m_detail->hapus();
        }
    }

    public function ubah_submenu_aktif()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else if (!$this->ion_auth->is_admin()) {
            redirect('auth/block', 'refresh');
        } else {
            $id = $this->input->post('id_sub_menu');
            $submenu = $this->db->get_where('sub_menu', ['id_sub_menu' => $id])->row_array();

            if ($submenu['active'] == 0) {
                $this->m_detail->aktif($id);
            } else {
                $this->m_detail->nonaktif($id);
            }
        }
    }
}

/* End of file Detail.php */
