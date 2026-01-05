<?php
class B_Manage_products extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->helper('log');

        if (
            !$this->session->userdata('logged_in') ||
            $this->session->userdata('role') !== 'admin'
        ) {
            redirect('Marketplace');
        }
    }

    public function index()
    {
        $data['is_dashboard'] = false;

        $data['judul_pendek']  = 'Manage Products';
        $data['judul_panjang'] = 'Manage Products | Nexory';
        $data['products']     = $this->Product_model->getAllAdmin();

        $this->load->view('template_admin/header', $data);
        $this->load->view('B_Products/index', $data);
        $this->load->view('B_Products/modal_form', $data);
        $this->load->view('B_Products/script');
        $this->load->view('template_admin/footer');
    }

    public function store()
    {
        $input = $this->input->post(null, true);

        $data = [
            'category_id' => $input['category_id'],
            'user_id'     => $this->session->userdata('user_id'),
            'name'        => $input['name'],
            'slug'        => url_title($input['name'], '-', true),
            'price'       => $input['price'],
            'stock'       => $input['stock'],
            'description' => $input['description'],
            'shopee_url'     => $input['shopee_url'] ?? null,
            'tokopedia_url' => $input['tokopedia_url'] ?? null,
            'tiktokshop_url' => $input['tiktokshop_url'] ?? null,
            'lazada_url'    => $input['lazada_url'] ?? null,
            'featured'    => $input['featured'],
            'sell_mode' => $input['sell_mode'] ?? 'web',
            'status'      => 1,
            'created_at'  => date('Y-m-d H:i:s')
        ];

        $product_id = $this->Product_model->insertProduct($data);

        log_activity([
            'user_id'  => $this->session->userdata('user_id'),
            'activity' => 'Tambah produk: ' . $input['name'] . ' (ID ' . $product_id . ')'
        ]);

        echo json_encode(['status' => true]);
    }

    public function update($id)
    {
        $input = $this->input->post(null, true);

        $data = [
            'category_id'    => $input['category_id'],
            'name'           => $input['name'],
            'price'          => $input['price'],
            'stock'          => $input['stock'],
            'description'    => $input['description'],
            'featured'       => $input['featured'],
            'sell_mode'      => $input['sell_mode'] ?? 'web',

            'shopee_url'     => $input['shopee_url'] ?? null,
            'tokopedia_url'  => $input['tokopedia_url'] ?? null,
            'tiktokshop_url' => $input['tiktokshop_url'] ?? null,
            'lazada_url'     => $input['lazada_url'] ?? null,
        ];


        $this->Product_model->updateProduct($id, $data);

        log_activity([
            'user_id'  => $this->session->userdata('user_id'),
            'activity' => 'Edit produk: ' . $input['name'] . ' (ID ' . $id . ')'
        ]);

        echo json_encode(['status' => true]);
    }


    public function delete($id)
    {
        $this->Product_model->deleteProduct($id);

        log_activity([
            'user_id'  => $this->session->userdata('user_id'),
            'activity' => 'Hapus produk ID ' . $id
        ]);

        echo json_encode(['status' => true]);
    }
}
