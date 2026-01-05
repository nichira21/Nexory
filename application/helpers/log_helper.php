<?php
defined('BASEPATH') or exit('No direct script access allowed');

function log_activity($data)
{
    $CI = &get_instance();

    $insert = [
        'user_id'    => $data['user_id'],
        'activity'   => $data['activity'],
        'created_at' => date('Y-m-d H:i:s')
    ];

    $CI->db->insert('tb_logs', $insert);
}
