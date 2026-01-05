<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Marketplace extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->model('Category_model');
    }

    public function index()
    {
        $data['categories'] = $this->Category_model->getAll();
        $data['products']   = $this->Product_model->getAll();
        $data['featured']   = $this->Product_model->getFeatured();

        $this->load->view('layouts/header');
        $this->load->view('layouts/cookie_banner');
        $this->load->view('marketplace/cart');
        $this->load->view('marketplace/home', $data);
        $this->load->view('layouts/footer');
    }

    public function terms()
    {

        $this->load->view('layouts/header');
        $this->load->view('layouts/cookie_banner');
        $this->load->view('marketplace/terms');
        $this->load->view('layouts/footer');
    }

    public function listing()
    {
        $data['products'] = $this->Product_model->getProducts();
        $this->load->view('layouts/header', $data);
        $this->load->view('marketplace/listing');
        $this->load->view('layouts/footer');
    }

    public function detail($slug)
    {
        $data['product'] = $this->Product_model->getBySlug($slug);
        $this->load->view('layouts/header', $data);
        $this->load->view('marketplace/detail');
        $this->load->view('layouts/footer');
    }

    public function cart()
    {
        $this->load->view('layouts/header');
        $this->load->view('cart/index');
        $this->load->view('layouts/footer');
    }
}
