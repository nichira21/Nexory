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

        if ((int)$user->email_verified !== 1) {
            echo json_encode([
                'status' => false,
                'msg'    => 'Email belum diverifikasi. Silakan cek inbox email.'
            ]);
            return;
        }


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


    public function smtp_test()
    {
        $this->load->config('email');
        $this->load->library('email');

        $this->email->from('noreply@nexory.id', 'Nexory'); // 🔥 WAJIB
        $this->email->to('alfreditdgi@gmail.com');
        $this->email->subject('SMTP Nexory OK');
        $this->email->message('<b>Email berhasil dikirim 🎉</b>');

        if ($this->email->send()) {
            echo 'EMAIL TERKIRIM ✅';
        } else {
            echo '<pre>';
            print_r($this->email->print_debugger());
            echo '</pre>';
        }
    }



    // =====================
    // REGISTER
    // =====================
    public function register()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $name     = trim($this->input->post('name', true));
        $email    = trim($this->input->post('email', true));
        $password = $this->input->post('password', true);

        if (!$name || !$email || !$password) {
            echo json_encode([
                'status' => false,
                'msg'    => 'Semua field wajib diisi'
            ]);
            return;
        }

        if ($this->User_model->email_exists($email)) {
            echo json_encode([
                'status' => false,
                'msg'    => 'Email sudah terdaftar'
            ]);
            return;
        }

        // 🔐 Generate token verifikasi
        $token = bin2hex(random_bytes(32));

        $data = [
            'name'               => $name,
            'email'              => $email,
            'password'           => md5(md5($password)),
            'phone'              => '',
            'role'               => 'user',
            'status'             => 1,
            'email_verified'     => 0,
            'email_verify_token' => $token
        ];

        $this->User_model->insert($data);

        // 📧 Kirim email verifikasi
        $this->_send_verification_email($email, $token);

        echo json_encode([
            'status' => true,
            'msg'    => 'Registrasi berhasil. Silakan cek email untuk verifikasi akun.'
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

    private function _send_verification_email($email, $token)
    {
        $this->load->config('email');
        $this->load->library('email');

        $verifyLink = site_url('User/verify_email?token=' . $token);

        $message = "
        <h3>Verifikasi Akun Nexory</h3>
        <p>Terima kasih telah mendaftar di Nexory.</p>
        <p>Klik tombol di bawah untuk mengaktifkan akun Anda:</p>
        <p>
            <a href='{$verifyLink}'
               style='background:#000;color:#fff;padding:10px 20px;
                      text-decoration:none;border-radius:6px;'>
               Verifikasi Akun
            </a>
        </p>
    ";

        $this->email->from('noreply@nexory.id', 'Nexory'); // 🔥 FIX UTAMA
        $this->email->to($email);
        $this->email->subject('Verifikasi Akun Nexory');
        $this->email->message($message);

        if (!$this->email->send()) {
            log_message('error', $this->email->print_debugger());
        }
    }


    public function verify_email()
    {
        $token = $this->input->get('token', true);

        if (!$token) {
            show_error('Token tidak valid');
        }

        $user = $this->User_model->get_by_token($token);

        if (!$user) {
            show_error('Token tidak ditemukan atau sudah digunakan');
        }

        // Update status verifikasi
        $this->User_model->verify_email($user->id);

        // Redirect ke homepage + info
        $this->session->set_flashdata('success', 'Email berhasil diverifikasi. Silakan login.');
        redirect('/');
    }
}
