<?php defined('BASEPATH') or exit('No direct script access allowed');

class Shopee extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('ShopeeApi');
    }

    // Step 1: Redirect ke Shopee (Authorize)
    public function connect()
    {
        $redirectUrl = 'https://nexory.id/shopee/callback';
        redirect($this->shopeeapi->authUrl($redirectUrl));
    }

    // Step 2: Callback dari Shopee
    public function callback()
    {
        $code    = $this->input->get('code', true);
        $shop_id = $this->input->get('shop_id', true);

        if (!$code || !$shop_id) {
            show_error('Authorization gagal atau dibatalkan oleh user', 400);
        }

        $token = $this->shopeeapi->getAccessToken($code, $shop_id);

        // Handle error dari Shopee
        if (isset($token['error'])) {
            echo '<pre>';
            print_r($token);
            exit;
        }

        // SUCCESS
        echo '<pre>';
        print_r($token);

        /**
         * NEXT (jangan lupa nanti):
         * - Simpan access_token ke database
         * - Simpan refresh_token
         * - Simpan shop_id
         */
    }
}
