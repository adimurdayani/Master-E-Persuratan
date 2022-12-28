<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Log_user extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_loguser');
        $this->load->model('m_sidebar');
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else if (!$this->ion_auth->is_admin()) {
            redirect('auth/block', 'refresh');
        } else {
            $data['title'] = "Log Users";
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
            $this->load->view('log-user', $data, FALSE);
        }
    }

    public function load_data()
    {
        $list = $this->m_loguser->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = '<input type="checkbox" class="check-item" name="id[]" value="' . $field->id . '">';
            $row[] = $no;
            $row[] = $field->ip;
            $row[] = $field->os;
            $row[] = $field->browser . ' - ' . $field->versi;
            $row[] = $field->time;
            $data[] = $row;
        }

        $csrf_name = $this->security->get_csrf_token_name();
        $csrf_hash = $this->security->get_csrf_hash();

        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->m_loguser->count_all(),
            "recordsFiltered" => $this->m_loguser->count_filtered(),
            "data" => $data,
        );
        $output[$csrf_name] = $csrf_hash;
        $this->output->set_output(json_encode($output));
    }

    public function hapus_all()
    {
        $id = $_POST['id'];
        if ($id == 0) {
            $this->session->set_flashdata(
                'error',
                '$(document).ready(function(e) {
                    $.NotificationApp.send("Gagal!", "Tidak ada data yang dipilih!", "top-right", "#bf441d", "error");
                })'
            );
            redirect('log_user');
        } else {
            $this->db->where_in('id', $id);
            $this->m_loguser->delete($id);
            redirect('log_user');
        }
    }

    public function cetak()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth-admin', 'refresh');
        } else if (!$this->ion_auth->is_admin()) {
            redirect('auth/block', 'refresh');
        } else {
            $data['title'] = "Cetak Log Users";
            $data['session'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row();
            $this->db->order_by('id', 'desc');
            $data['get_log'] = $this->db->get('tb_visitor')->result();
            $this->load->view('cetak', $data, FALSE);
        }
    }
}

/* End of file Log_user.php */
