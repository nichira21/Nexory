<?php
class PreviewController extends CI_Controller
{
    public function view($combination_id)
    {
        $c = $this->db
            ->get_where('tb_design_combination', ['id' => $combination_id])
            ->row();

        $data['jam'] = $this->db->get_where('tb_sprite', ['id' => $c->jam_id])->row()->file_path;
        $data['design'] = $this->db->get_where('tb_sprite', ['id' => $c->design_id])->row()->file_path;
        $data['background'] = $this->db->get_where('tb_sprite', ['id' => $c->background_id])->row()->file_path;


        $this->load->view('layouts/header');
        $this->load->view('canvas/index', $data);
        $this->load->view('layouts/footer');
    }
}
