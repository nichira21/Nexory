<?php
defined('BASEPATH') or exit('No direct script access allowed');

class B_Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->model('Category_model');

        if (
            !$this->session->userdata('logged_in') ||
            $this->session->userdata('role') !== 'admin'
        ) {
            redirect('Marketplace');
        }
    }

    public function index()
    {
        $data['judul_pendek']  = "Dashboard";
        $data['judul_panjang'] = $data['judul_pendek'] . ' | Nexory';
        $data['deskripsi'] = "Memberikan ringkasan cepat kondisi penjualan + alat analisis untuk keputusan bisnis.";


        $this->load->view('template_admin/header', $data);
        $this->load->view('B_Dashboard/index', $data);
        $this->load->view('template_admin/footer');
    }
}
