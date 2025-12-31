<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library(['session', 'form_validation']);
        $this->load->helper('security');
    }

    // =====================
    // LOGIN
    // =====================
    public function login()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $email        = trim($this->input->post('email', true));
        $password_raw = $this->input->post('password', true);
        $password     = md5(md5($password_raw));

        if (!$email || !$password_raw) {
            echo json_encode([
                'status' => false,
                'msg'    => 'Email dan password wajib diisi'
            ]);
            return;
        }

        $user = $this->User_model->get_by_email($email);

        if (!$user || $password !== $user->password) {
            echo json_encode([
                'status' => false,
                'msg'    => 'Email atau password salah'
            ]);
            return;
        }

        if ((int)$user->status !== 1) {
            echo json_encode([
                'status' => false,
                'msg'    => 'Akun tidak aktif'
            ]);
            return;
        }

        // =====================
        // SESSION PAYLOAD
        // =====================
        $session = [];

        foreach ($user as $k => $v) {
            if (in_array($k, ['password', 'created_at'], true)) {
                continue;
            }
            $session[$k] = $v;
        }

        $session['user_id']   = (int)$user->id;
        $session['logged_in'] = true;
        $session['ua_hash']   = sha1($this->input->user_agent());

        // 🔐 Anti session fixation
        $this->session->sess_regenerate(true);
        $this->session->set_userdata($session);

        // =====================
        // REDIRECT BY ROLE
        // =====================
        $redirect = ($user->role === 'admin')
            ? site_url('B_Dashboard')
            : site_url('Marketplace');

        echo json_encode([
            'status'   => true,
            'msg'      => 'Login berhasil',
            'redirect' => $redirect
        ]);
    }




    // =====================
    // REGISTER
    // =====================
    public function register()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $data = [
            'name'     => $this->input->post('name', true),
            'email'    => $this->input->post('email', true),
            'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
            'phone'    => '',
            'role'     => 'user',
            'status'   => 1
        ];

        if (!$data['name'] || !$data['email'] || !$this->input->post('password')) {
            echo json_encode([
                'status' => false,
                'msg'    => 'Semua field wajib diisi'
            ]);
            return;
        }

        if ($this->User_model->email_exists($data['email'])) {
            echo json_encode([
                'status' => false,
                'msg'    => 'Email sudah terdaftar'
            ]);
            return;
        }

        $this->User_model->insert($data);

        echo json_encode([
            'status' => true,
            'msg'    => 'Registrasi berhasil, silakan login'
        ]);
    }

    // =====================
    // LOGOUT
    // =====================
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('/');
    }
}
