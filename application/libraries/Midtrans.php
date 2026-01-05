<?php
require_once APPPATH . 'third_party/midtrans/Midtrans.php';

class Midtrans
{
    public function __construct()
    {
        \Midtrans\Config::$serverKey = 'Mid-server-0YmBSsJVreAoZnsqO15GdxRy';
        \Midtrans\Config::$isProduction = false; // SANDBOX
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
    }

    public function getSnapToken($params)
    {
        return \Midtrans\Snap::getSnapToken($params);
    }
}
