<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| EMAIL CONFIGURATION (CPANEL SMTP SSL)
|--------------------------------------------------------------------------
| Nexory — Production Ready
|--------------------------------------------------------------------------
*/

$config['protocol'] = 'smtp';

/*
|--------------------------------------------------------------------------
| SMTP SERVER (SSL)
|--------------------------------------------------------------------------
*/
$config['smtp_host'] = 'ssl://mail.nexory.id';   // 🔥 WAJIB ssl://
$config['smtp_port'] = 465;

/*
|--------------------------------------------------------------------------
| AUTHENTICATION
|--------------------------------------------------------------------------
*/
$config['smtp_user'] = 'noreply@nexory.id';
$config['smtp_pass'] = 'hqUnfwHSxx1c47'; // password email cPanel
$config['smtp_timeout'] = 30;

/*
|--------------------------------------------------------------------------
| FORMAT & ENCODING
|--------------------------------------------------------------------------
*/
$config['charset']  = 'utf-8';
$config['newline']  = "\r\n";
$config['crlf']     = "\r\n";

$config['mailtype'] = 'html';
$config['wordwrap'] = TRUE;
$config['wrapchars'] = 900;   // 🔥 anti error "lines too long"

/*
|--------------------------------------------------------------------------
| BEHAVIOR
|--------------------------------------------------------------------------
*/
$config['validate'] = TRUE;
$config['priority'] = 3;
$config['smtp_keepalive'] = TRUE;

/*
|--------------------------------------------------------------------------
| DEFAULT SENDER
|--------------------------------------------------------------------------
*/
$config['from_email'] = 'noreply@nexory.id';
$config['from_name']  = 'Nexory';
