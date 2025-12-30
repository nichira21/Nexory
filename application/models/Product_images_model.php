<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProductImages_model extends CI_Model
{

    private $table = "tb_product_images";

    public function getByProduct($product_id)
    {
        return $this->db
            ->where('product_id', $product_id)
            ->get($this->table)
            ->result();
    }
}
