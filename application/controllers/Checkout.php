<?php
class Checkout extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Cart_model', 'Order_model']);
        $this->load->library('midtrans');
    }

    public function create()
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['status' => false, 'msg' => 'Login required']);
            return;
        }

        $user_id = $this->session->userdata('user_id');
        $cart = $this->Cart_model->getUserCart($user_id);

        if (!$cart) {
            echo json_encode(['status' => false, 'msg' => 'Cart kosong']);
            return;
        }

        $this->db->trans_start();

        $total = 0;
        foreach ($cart as $c) {
            $total += $c->price * $c->qty;
        }

        $order_code = 'NX-' . date('YmdHis') . rand(100, 999);

        $order_id = $this->Order_model->create([
            'order_code' => $order_code,
            'user_id' => $user_id,
            'total' => $total,
            'payment_status' => 'unpaid',
            'order_status' => 'created',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        foreach ($cart as $c) {
            $this->db->insert('tb_order_items', [
                'order_id' => $order_id,
                'product_id' => $c->product_id,
                'price' => $c->price,
                'qty' => $c->qty,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }

        $this->db->trans_complete();

        // MIDTRANS
        $params = [
            'transaction_details' => [
                'order_id' => $order_code,
                'gross_amount' => $total
            ],
            'customer_details' => [
                'first_name' => $this->session->userdata('name'),
                'email' => $this->session->userdata('email')
            ]
        ];

        $snapToken = $this->midtrans->getSnapToken($params);

        echo json_encode([
            'status' => true,
            'snap_token' => $snapToken
        ]);
    }

    public function success()
    {
        $this->load->view('checkout/success');
    }
}
