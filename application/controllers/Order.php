<?php

class Order extends CI_Controller
{
    public function sync()
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['status' => false]);
            return;
        }

        $user_id = $this->session->userdata('user_id');
        $cart = json_decode($this->input->post('cart'), true) ?: [];

        // 1️⃣ PUSH localStorage → DB
        foreach ($cart as $item) {
            $this->_upsert_cart($user_id, $item);
        }

        // 2️⃣ PULL DB → response
        $db_cart = $this->db
            ->select('
                c.product_id as id,
                p.name,
                p.price,
                c.qty,
                CONCAT("' . base_url('uploads/products/') . '", (
                    SELECT i.image
                    FROM tb_product_images i
                    WHERE i.product_id = p.id
                    ORDER BY i.created_at ASC
                    LIMIT 1
                )) as image
            ')
            ->from('tb_cart c')
            ->join('tb_products p', 'p.id = c.product_id')
            ->where('c.user_id', $user_id)
            ->get()
            ->result_array();


        echo json_encode([
            'status' => true,
            'cart' => $db_cart
        ]);
    }


    private function _upsert_cart($user_id, $item)
    {
        $p = $this->db->get_where('tb_products', [
            'id' => $item['id'],
            'status' => 1
        ])->row();

        if (!$p) return;

        $qty = min((int)$item['qty'], (int)$p->stock);

        $exist = $this->db->get_where('tb_cart', [
            'user_id' => $user_id,
            'product_id' => $item['id']
        ])->row();

        if ($exist) {
            // 🔥 PENTING: ambil MAX, bukan tambah
            $this->db->where('id', $exist->id)
                ->update('tb_cart', [
                    'qty' => max($exist->qty, $qty)
                ]);
        } else {
            $this->db->insert('tb_cart', [
                'user_id' => $user_id,
                'product_id' => $item['id'],
                'qty' => $qty,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }
    }
}
