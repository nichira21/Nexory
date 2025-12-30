<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category_model extends CI_Model
{

    private $table = "tb_categories";

    public function getAll()
    {
        return $this->db->order_by('name', 'ASC')->get($this->table)->result();
    }
}
