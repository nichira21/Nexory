<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart_model extends CI_Model
{

    protected $table = 'tb_cart';

    public function getUserCart($user_id)
    {
        return $this->db
            ->select('c.*, p.name, p.price, p.image')
            ->from('tb_cart c')
            ->join('tb_products p', 'p.id=c.product_id')
            ->where('c.user_id', $user_id)
            ->get()
            ->result();
    }

    public function add($data)
    {
        $exist = $this->db->get_where($this->table, [
            'user_id' => $data['user_id'],
            'product_id' => $data['product_id']
        ])->row();

        if ($exist) {
            return $this->db->set('qty', 'qty+' . $data['qty'], FALSE)
                ->where('id', $exist->id)
                ->update($this->table);
        }

        return $this->db->insert($this->table, $data);
    }

    public function remove($id)
    {
        return $this->db->delete($this->table, ['id' => $id]);
    }

    public function clear($user_id)
    {
        return $this->db->delete($this->table, ['user_id' => $user_id]);
    }
}
