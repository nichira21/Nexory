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

        $message = '
            <!DOCTYPE html>
            <html lang="id">
            <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>SMTP Test Nexory</title>
            </head>
            <body style="margin:0;padding:0;background-color:#f4f4f4;font-family:Arial,Helvetica,sans-serif;">

            <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4;padding:30px 0;">
            <tr>
                <td align="center">

                <!-- CONTAINER -->
                <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:10px;overflow:hidden;box-shadow:0 8px 30px rgba(0,0,0,0.08);">

                    <!-- HEADER -->
                    <tr>
                    <td align="center" style="padding:30px 20px 20px;">
                        <img src="https://nexory.id/assets/img/nexory-logo-black-transparent.png"
                            alt="Nexory"
                            width="180"
                            style="display:block;border:0;outline:none;">
                    </td>
                    </tr>

                    <!-- BODY -->
                    <tr>
                    <td style="padding:20px 40px;color:#111;line-height:1.6;">
                        <h2 style="margin:0 0 15px;font-weight:700;">
                        SMTP Test Berhasil 🎉
                        </h2>

                        <p style="margin:0 0 15px;font-size:15px;">
                        Jika Anda menerima email ini, maka konfigurasi
                        <strong>SMTP Nexory</strong> telah berjalan dengan baik.
                        </p>

                        <p style="margin:0 0 25px;font-size:15px;">
                        Server email berhasil melakukan autentikasi,
                        mengirim email HTML, dan memuat aset gambar eksternal.
                        </p>

                        <div style="background:#f8f8f8;border-radius:8px;padding:15px;font-size:14px;">
                        <strong>Detail Pengujian:</strong><br>
                        • SMTP Authentication: OK<br>
                        • SSL / TLS: OK<br>
                        • HTML Email: OK<br>
                        • Image Load: OK
                        </div>
                    </td>
                    </tr>

                    <!-- FOOTER -->
                    <tr>
                    <td style="padding:25px 30px;background:#f8f8f8;color:#777;font-size:12px;text-align:center;">
                        <p style="margin:0 0 8px;">
                        © ' . date('Y') . ' Nexory — Precision Engineered Exhibition Objects
                        </p>
                        <p style="margin:0;">
                        Email ini dikirim sebagai pengujian sistem SMTP Nexory.
                        </p>
                    </td>
                    </tr>

                </table>
                <!-- /CONTAINER -->

                </td>
            </tr>
            </table>

            </body>
            </html>
            ';

        $this->email->from('noreply@nexory.id', 'Nexory');
        $this->email->to('alfreditdgi@gmail.com');
        $this->email->subject('SMTP Nexory OK');
        $this->email->message($message);

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

        $message = '
            <!DOCTYPE html>
            <html lang="id">
            <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Verifikasi Akun Nexory</title>
            </head>
            <body style="margin:0;padding:0;background-color:#f4f4f4;font-family:Arial,Helvetica,sans-serif;">

            <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4;padding:30px 0;">
            <tr>
                <td align="center">

                <!-- CONTAINER -->
                <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:10px;overflow:hidden;box-shadow:0 8px 30px rgba(0,0,0,0.08);">

                    <!-- HEADER -->
                    <tr>
                    <td align="center" style="padding:30px 20px 20px;background:#ffffff;">
                        <img src="https://nexory.id/assets/img/nexory-logo-black-transparent.png"
                            alt="Nexory"
                            width="180"
                            style="display:block;border:0;outline:none;">
                    </td>
                    </tr>

                    <!-- BODY -->
                    <tr>
                    <td style="padding:20px 40px;color:#111111;line-height:1.6;">
                        <h2 style="margin:0 0 15px;font-weight:700;">Verifikasi Akun Anda</h2>

                        <p style="margin:0 0 15px;font-size:15px;">
                        Terima kasih telah mendaftar di <strong>Nexory</strong>.
                        </p>

                        <p style="margin:0 0 25px;font-size:15px;">
                        Untuk mengaktifkan akun dan mulai menjelajahi koleksi kami,
                        silakan verifikasi email Anda dengan menekan tombol di bawah ini.
                        </p>

                        <div style="text-align:center;margin:35px 0;">
                        <a href="' . $verifyLink . '"
                            style="background:#000000;color:#ffffff;
                                    padding:14px 34px;
                                    font-size:15px;
                                    font-weight:600;
                                    text-decoration:none;
                                    border-radius:30px;
                                    display:inline-block;">
                            Verifikasi Akun
                        </a>
                        </div>

                        <p style="margin:25px 0 0;font-size:14px;color:#555;">
                        Jika tombol di atas tidak berfungsi, salin dan tempel tautan berikut
                        ke browser Anda:
                        </p>

                        <p style="font-size:13px;word-break:break-all;color:#000;">
                        ' . $verifyLink . '
                        </p>
                    </td>
                    </tr>

                    <!-- FOOTER -->
                    <tr>
                    <td style="padding:25px 30px;background:#f8f8f8;color:#777;font-size:12px;text-align:center;">
                        <p style="margin:0 0 8px;">
                        © ' . date('Y') . ' Nexory — Precision Engineered Exhibition Objects
                        </p>
                        <p style="margin:0;">
                        Jika Anda tidak merasa mendaftar di Nexory, abaikan email ini.
                        </p>
                    </td>
                    </tr>

                </table>
                <!-- /CONTAINER -->

                </td>
            </tr>
            </table>

            </body>
            </html>
            ';

        $this->email->from('noreply@nexory.id', 'Nexory');
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
