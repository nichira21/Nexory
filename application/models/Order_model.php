<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order_model extends CI_Model
{

    protected $table = 'tb_orders';

    public function create($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function getByUser($user_id)
    {
        return $this->db->where('user_id', $user_id)->order_by('id', 'DESC')->get($this->table)->result();
    }

    public function getByCode($code)
    {
        return $this->db->get_where($this->table, ['order_code' => $code])->row();
    }

    public function updateStatus($order_id, $status)
    {
        return $this->db->where('id', $order_id)->update($this->table, [
            'order_status' => $status
        ]);
    }
}
