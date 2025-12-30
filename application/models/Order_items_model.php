<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order_items_model extends CI_Model
{

    protected $table = 'tb_order_items';

    public function insertBatch($data)
    {
        return $this->db->insert_batch($this->table, $data);
    }

    public function getByOrder($order_id)
    {
        return $this->db
            ->select('i.*, p.name, p.image')
            ->from('tb_order_items i')
            ->join('tb_products p', 'p.id=i.product_id')
            ->where('i.order_id', $order_id)
            ->get()
            ->result();
    }
}
