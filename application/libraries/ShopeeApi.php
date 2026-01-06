<?php defined('BASEPATH') or exit('No direct script access allowed');

class ShopeeApi
{

    private $partner_id = 1207899;
    private $partner_key = 'shpk51737a516f55744e59756e58584e6f495848517476506a555670416b6244';
    private $host = 'https://partner.test-stable.shopeemobile.com';

    private function sign($path, $timestamp, $shop_id = null)
    {
        $base = $this->partner_id . $path . $timestamp;
        if ($shop_id) {
            $base .= $shop_id;
        }
        return hash_hmac('sha256', $base, $this->partner_key);
    }

    public function authUrl($redirect_url)
    {
        $timestamp = time();
        $path = "/api/v2/shop/auth_partner";
        $sign = $this->sign($path, $timestamp);

        return $this->host . $path . "?"
            . "partner_id={$this->partner_id}"
            . "&timestamp={$timestamp}"
            . "&sign={$sign}"
            . "&redirect={$redirect_url}";
    }

    public function getAccessToken($code, $shop_id)
    {
        $timestamp = time();
        $path = "/api/v2/auth/token/get";
        $sign = $this->sign($path, $timestamp, $shop_id);

        $url = $this->host . $path . "?"
            . "partner_id={$this->partner_id}"
            . "&timestamp={$timestamp}"
            . "&sign={$sign}";

        $body = json_encode([
            "code" => $code,
            "shop_id" => (int)$shop_id
        ]);

        return $this->curl($url, $body);
    }

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
        curl_close($ch);
        return json_decode($res, true);
    }
}
