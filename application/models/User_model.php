<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

    private $table = 'tb_users';

    public function get_by_email($email)
    {
        return $this->db
            ->where('email', $email)
            ->limit(1)
            ->get($this->table)
            ->row();
    }

    public function email_exists($email)
    {
        return $this->db
            ->where('email', $email)
            ->count_all_results($this->table) > 0;
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function get_by_token($token)
    {
        return $this->db
            ->where('email_verify_token', $token)
            ->limit(1)
            ->get($this->table)
            ->row();
    }

    public function verify_email($user_id)
    {
        return $this->db
            ->where('id', $user_id)
            ->update($this->table, [
                'email_verified'     => 1,
                'email_verify_token' => null
            ]);
    }
}
