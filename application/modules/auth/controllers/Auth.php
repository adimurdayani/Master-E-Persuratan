<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public $data = [];

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library(['ion_auth', 'form_validation']);
        $this->load->helper(['url', 'language']);

        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth');
        $this->load->model('m_auth');
    }

    public function index()
    {
        $this->data['title'] = 'Login';

        // cek berdasarkan IP, apakah user sudah pernah mengakses hari ini
        $cek_ip = $this->m_auth->total_visitor();
        $cek_user_ip = isset($cek_ip) ? ($cek_ip) : 0;

        // kalau belum ada, simpan data user tersebut ke database
        if ($cek_user_ip == 0) {
            $this->m_auth->insert_visitor();
        } else {
            $this->m_auth->update_visitor();
        }

        // validate form input
        $this->form_validation->set_rules('identity', str_replace(':', '', $this->lang->line('login_identity_label')), 'required');
        $this->form_validation->set_rules('password', str_replace(':', '', $this->lang->line('login_password_label')), 'required');

        if ($this->form_validation->run() === TRUE) {
            $remember = (bool)$this->input->post('remember');

            if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)) {
                $user = $this->db->get_where('users', ['email' => $this->input->post('identity')])->row();
                $user_groups = $this->db->get_where('users_groups', ['user_id' => $user->id])->row();
                $groups = $this->db->get_where('groups', ['id' => $user_groups->group_id])->row();
                if ($groups->name == "admin") {
                    # code...
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-success" role="alert"><i class="mdi mdi-check-all mr-2"></i> Login sukses! Selamat datang di admin panel Kecamatan Wara</div>'
                    );
                    redirect('dashboard', 'refresh');
                } else {
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-success" role="alert"><i class="mdi mdi-check-all mr-2"></i> Login sukses! Selamat datang di admin panel Kecamatan Wara</div>'
                    );
                    redirect('dashboard_surat', 'refresh');
                }
            } else {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect('auth', 'refresh');
            }
        } else {
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            $this->data['identity'] = [
                'name' => 'identity',
                'id' => 'identity',
                'type' => 'text',
                'value' => $this->form_validation->set_value('identity'),
            ];

            $this->data['password'] = [
                'name' => 'password',
                'id' => 'password',
                'type' => 'password',
            ];

            $this->_render_page(DIRECTORY_SEPARATOR . 'login_temp', $this->data);
        }
    }

    public function logout()
    {
        $this->data['title'] = "Logout";
        $this->ion_auth->logout();
        redirect('auth-admin', 'refresh');
    }

    public function _get_csrf_nonce()
    {
        $this->load->helper('string');
        $key = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return [$key => $value];
    }

    public function _valid_csrf_nonce()
    {
        $csrfkey = $this->input->post($this->session->flashdata('csrfkey'));
        if ($csrfkey && $csrfkey === $this->session->flashdata('csrfvalue')) {
            return TRUE;
        }
        return FALSE;
    }

    public function _render_page($view, $data = NULL, $returnhtml = FALSE)
    {

        $viewdata = (empty($data)) ? $this->data : $data;

        $view_html = $this->load->view($view, $viewdata, $returnhtml);
        if ($returnhtml) {
            return $view_html;
        }
    }

    public function block()
    {
        $this->load->view('auth/blocked');
    }
}

/* End of file Auth.php */
