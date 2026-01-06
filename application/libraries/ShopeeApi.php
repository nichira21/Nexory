<?php defined('BASEPATH') or exit('No direct script access allowed');

class ShopeeApi
{
    protected $CI;
    protected $host;

    private $partner_id = 1207899;
    private $partner_key = 'shpk51737a516f55744e59756e58584e6f495848517476506a555670416b6244';

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->config('shopee');

        $this->host = ENVIRONMENT === 'production'
            ? $this->CI->config->item('shopee_live_host')
            : $this->CI->config->item('shopee_test_host');
    }

    /* ================= SIGN ================= */

    private function signAuth($path, $timestamp, $redirect)
    {
        $base = $this->partner_id . $path . $timestamp . $redirect;
        return hash_hmac('sha256', $base, $this->partner_key);
    }


    /* ================= AUTH ================= */

    public function authUrl($redirect_url)
    {
        $timestamp = time();
        $path = '/api/v2/shop/auth_partner';

        // redirect HARUS RAW (belum urlencode)
        $sign = $this->signAuth($path, $timestamp, $redirect_url);

        return $this->host . $path . '?'
            . 'partner_id=' . $this->partner_id
            . '&timestamp=' . $timestamp
            . '&sign=' . $sign
            . '&redirect=' . urlencode($redirect_url);
    }

    public function getAccessToken($code, $shop_id)
    {
        $timestamp = time();
        $path = '/api/v2/auth/token/get';
        $sign = $this->sign($path, $timestamp);

        $url = $this->host . $path . '?'
            . 'partner_id=' . $this->partner_id
            . '&timestamp=' . $timestamp
            . '&sign=' . $sign;

        $body = json_encode([
            'code' => $code,
            'shop_id' => (int) $shop_id
        ]);

        return $this->curl($url, $body);
    }

    /* ================= CURL ================= */

    private function curl($url, $body = null)
    {
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $body,
            CURLOPT_HTTPHEADER => ['Content-Type: application/json']
        ]);

        $res = curl_exec($ch);

        if ($res === false) {
            log_message('error', 'Shopee CURL error: ' . curl_error($ch));
        }

        curl_close($ch);
        return json_decode($res, true);
    }
}
