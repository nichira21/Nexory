<?php
class Midtrans_callback extends CI_Controller
{
    public function index()
    {
        $json = json_decode(file_get_contents("php://input"), true);

        if (!$json || !isset($json['order_id'])) return;

        $order = $this->db->get_where('tb_orders', [
            'order_code' => $json['order_id']
        ])->row();

        if (!$order) return;

        // anti double callback
        if ($order->payment_status === 'paid') return;

        if (in_array($json['transaction_status'], ['settlement', 'capture'])) {

            $this->db->trans_start();

            $this->db->where('id', $order->id)->update('tb_orders', [
                'payment_status' => 'paid',
                'order_status'   => 'completed'
            ]);

            // clear cart
            $this->db->delete('tb_cart', ['user_id' => $order->user_id]);

            $this->db->trans_complete();

            // kirim invoice
            $this->_sendInvoice($order->id);
        }
    }

    private function _sendInvoice($order_id)
    {
        $order = $this->db
            ->select('o.*, u.email, u.name')
            ->from('tb_orders o')
            ->join('tb_users u', 'u.id=o.user_id')
            ->where('o.id', $order_id)
            ->get()->row();

        $items = $this->db
            ->select('i.*, p.name')
            ->from('tb_order_items i')
            ->join('tb_products p', 'p.id=i.product_id')
            ->where('i.order_id', $order_id)
            ->get()->result();

        $html = $this->load->view('emails/invoice', compact('order', 'items'), true);

        $this->email->from('noreply@nexory.id', 'Nexory');
        $this->email->to($order->email);
        $this->email->subject('Invoice ' . $order->order_code);
        $this->email->message($html);
        $this->email->send();
    }
}
