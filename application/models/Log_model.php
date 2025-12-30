<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Log_model extends CI_Model
{

    protected $table = 'tb_logs';

    public function write($user_id, $activity)
    {
        return $this->db->insert($this->table, [
            'user_id' => $user_id,
            'activity' => $activity
        ]);
    }

    public function getAll()
    {
        return $this->db->order_by('id', 'DESC')->get($this->table)->result();
    }
}
