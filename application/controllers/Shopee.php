<?php defined('BASEPATH') or exit('No direct script access allowed');

class Shopee extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('ShopeeApi');
    }

    // Step 1: redirect ke Shopee
    public function connect()
    {
        $redirect = 'https://nexory.id/shopee/callback';
        redirect($this->shopeeapi->authUrl($redirect));
    }

    // Step 2: callback dari Shopee
    public function callback()
    {
        $code = $this->input->get('code');
        $shop_id = $this->input->get('shop_id');

        if (!$code || !$shop_id) {
            show_error('Authorization gagal');
        }

        $token = $this->shopeeapi->getAccessToken($code, $shop_id);
        echo "<pre>";
        print_r($token);
    }
}
