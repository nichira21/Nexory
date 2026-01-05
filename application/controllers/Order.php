<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('user_id')) {
            redirect('/');
        }

        $this->load->model('Order_model');
    }

    public function index()
    {
        $user_id = $this->session->userdata('user_id');

        $data['orders'] = $this->Order_model->getByUser($user_id);

        $this->load->view('layouts/header');
        $this->load->view('order/index', $data);
        $this->load->view('layouts/footer');
    }

    public function detail($code)
    {
        $user_id = $this->session->userdata('user_id');

        $order = $this->Order_model->getByCode($code);

        if (!$order || $order->user_id != $user_id) {
            show_404();
            return;
        }

        $items = $this->db
            ->select('i.*, p.name')
            ->from('tb_order_items i')
            ->join('tb_products p', 'p.id=i.product_id')
            ->where('i.order_id', $order->id)
            ->get()->result();

        $this->load->view('layouts/header');
        $this->load->view('order/detail', compact('order', 'items'));
        $this->load->view('layouts/footer');
    }

    public function invoice($code)
    {
        $this->load->library('pdf');

        $order = $this->Order_model->getByCode($code);

        if (!$order || $order->user_id != $this->session->userdata('user_id')) {
            show_404();
            return;
        }

        $items = $this->db
            ->select('i.*, p.name')
            ->from('tb_order_items i')
            ->join('tb_products p', 'p.id=i.product_id')
            ->where('i.order_id', $order->id)
            ->get()->result();

        $html = $this->load->view('order/invoice_pdf', compact('order', 'items'), true);

        $this->pdf->loadHtml($html);
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->render();
        $this->pdf->stream("Invoice-{$order->order_code}.pdf", ['Attachment' => 1]);
    }



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
