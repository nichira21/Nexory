<?php defined('BASEPATH') or exit('No direct script access allowed');

class SalesController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Combination_model', 'Sprite_model', 'Tag_model']);
    }

    public function markAsSold()
    {
        $combination_id = $this->input->post('combination_id');
        $qty = (int)$this->input->post('qty');

        if (!$combination_id || $qty < 1)
            show_error("Invalid input", 400);

        $combo = $this->db
            ->get_where('tb_design_combination', ['id' => $combination_id])
            ->row();

        if (!$combo)
            show_error("Combination not found", 404);

        $this->db->trans_start();

        $this->Combination_model->incrementSold($combo->id, $qty);

        $this->Sprite_model->incrementSoldCount($combo->jam_id, $qty);
        $this->Sprite_model->incrementSoldCount($combo->design_id, $qty);
        $this->Sprite_model->incrementSoldCount($combo->background_id, $qty);

        $this->Tag_model->incrementSoldBySprite($combo->jam_id, $qty);
        $this->Tag_model->incrementSoldBySprite($combo->design_id, $qty);
        $this->Tag_model->incrementSoldBySprite($combo->background_id, $qty);

        $this->db->insert('tb_sales_log', [
            'combination_id' => $combo->id,
            'qty' => $qty
        ]);

        $this->db->trans_complete();

        if (!$this->db->trans_status())
            show_error("Sales transaction failed", 500);

        echo json_encode(['status' => 'ok']);
    }
}
