<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_model extends CI_Model
{
    private $table = "tb_products";

    /* =====================================================
     * FRONTEND / PUBLIC
     * ===================================================== */

    public function getAll()
    {
        return $this->db
            ->select('p.*, c.name as category_name, i.image as image')
            ->from('tb_products p')
            ->join('tb_categories c', 'c.id = p.category_id', 'left')
            ->join('tb_product_images i', 'i.product_id = p.id', 'left')
            ->where('p.status', 1)
            ->group_by('p.id')
            ->order_by('p.created_at', 'DESC')
            ->get()
            ->result();
    }

    public function getFeatured()
    {
        return $this->db
            ->where('featured', 1)
            ->where('status', 1)
            ->order_by('created_at', 'DESC')
            ->limit(8)
            ->get($this->table)
            ->result();
    }

    public function getBySlug($slug)
    {
        return $this->db
            ->select('p.*, c.name as category_name, u.name as seller')
            ->from('tb_products p')
            ->join('tb_categories c', 'c.id = p.category_id', 'left')
            ->join('tb_users u', 'u.id = p.user_id', 'left')
            ->where('p.slug', $slug)
            ->get()
            ->row();
    }

    /* =====================================================
     * ADMIN / BACKEND
     * ===================================================== */

    public function getAllAdmin()
    {
        return $this->db
            ->select('p.*, c.name as category_name, i.image as image')
            ->from('tb_products p')
            ->join('tb_categories c', 'c.id = p.category_id', 'left')
            ->join('tb_product_images i', 'i.product_id = p.id', 'left')
            ->group_by('p.id')
            ->order_by('p.created_at', 'DESC')
            ->get()
            ->result();
    }

    public function getById($id)
    {
        return $this->db
            ->where('id', $id)
            ->get($this->table)
            ->row();
    }

    public function insertProduct($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function updateProduct($id, $data)
    {
        return $this->db
            ->where('id', $id)
            ->update($this->table, $data);
    }

    public function deleteProduct($id)
    {
        // SOFT DELETE (AMAN)
        return $this->db
            ->where('id', $id)
            ->update($this->table, [
                'status' => 0
            ]);
    }
}
