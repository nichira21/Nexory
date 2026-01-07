<?php defined('BASEPATH') or exit('No direct script access allowed');

class SpriteController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Sprite_model', 'Tag_model']);
        $this->load->database();
    }

    // =========================================================
    // LIST SPRITE + TAG
    // =========================================================
    public function index()
    {
        $sprites = $this->db->get('tb_sprite')->result();

        foreach ($sprites as &$s) {
            $tags = $this->db->select('t.tag_name')
                ->from('tb_sprite_tag st')
                ->join('tb_tag t', 't.id = st.tag_id')
                ->where('st.sprite_id', $s->id)
                ->get()->result();

            $s->tags = array_column($tags, 'tag_name');
        }

        $data['sprites'] = $sprites;
        $data['tags'] = $this->db->get('tb_tag')->result();


        $this->load->view('template_admin/header', $data);
        $this->load->view('sprite/index', $data);
        $this->load->view('template_admin/footer');
    }

    // =========================================================
    // FORM CREATE (modal-friendly)
    // =========================================================
    public function create()
    {
        $data['tags'] = $this->db->get('tb_tag')->result();

        $this->load->view('layouts/header');
        $this->load->view('sprite/create', $data);
        $this->load->view('layouts/footer');
    }

    // =========================================================
    // STORE SPRITE + UPLOAD + TAG RELATION
    // =========================================================
    public function store()
    {
        $sprite_name = $this->input->post('sprite_name');
        $sprite_type = $this->input->post('sprite_type');
        $tags        = $this->input->post('tags');

        // upload config
        $config['upload_path']   = './uploads/sprites/';
        $config['allowed_types'] = 'png';
        $config['max_size']      = 4096;
        $config['encrypt_name']  = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('sprite_file'))
            show_error($this->upload->display_errors(), 400);

        $file = $this->upload->data('file_name');
        $path = 'uploads/sprites/' . $file;

        $this->db->trans_start();

        $this->db->insert('tb_sprite', [
            'sprite_name' => $sprite_name,
            'sprite_type' => $sprite_type,
            'file_path'   => $path,
            'is_active'   => 1
        ]);

        $sprite_id = $this->db->insert_id();

        if (!empty($tags)) {
            foreach ($tags as $tag_id) {
                $this->db->insert('tb_sprite_tag', [
                    'sprite_id' => $sprite_id,
                    'tag_id' => $tag_id
                ]);
            }
        }

        $this->db->trans_complete();

        if (!$this->db->trans_status())
            show_error("Failed saving sprite", 500);

        redirect('sprite');
    }

    // =========================================================
    // EDIT
    // =========================================================
    public function edit($id)
    {
        $data['sprite'] = $this->db
            ->get_where('tb_sprite', ['id' => $id])
            ->row();

        if (!$data['sprite'])
            show_404();

        $tags = $this->db->select('tag_id')
            ->from('tb_sprite_tag')
            ->where('sprite_id', $id)
            ->get()->result();

        $data['selected_tags'] = array_column($tags, 'tag_id');
        $data['tags'] = $this->db->get('tb_tag')->result();

        $this->load->view('sprite/edit', $data);
    }

    // =========================================================
    // UPDATE SPRITE + TAG RELINK
    // =========================================================
    public function update($id)
    {
        $sprite_name = $this->input->post('sprite_name');
        $sprite_type = $this->input->post('sprite_type');
        $tags        = $this->input->post('tags');

        $file_path = null;

        // optional file replace
        if (!empty($_FILES['sprite_file']['name'])) {
            $config['upload_path']   = './uploads/sprites/';
            $config['allowed_types'] = 'png';
            $config['max_size']      = 4096;
            $config['encrypt_name']  = TRUE;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('sprite_file'))
                show_error($this->upload->display_errors(), 400);

            $upload = $this->upload->data('file_name');
            $file_path = 'uploads/sprites/' . $upload;

            $this->db->set('file_path', $file_path);
        }

        $this->db->set('sprite_name', $sprite_name)
            ->set('sprite_type', $sprite_type)
            ->where('id', $id)
            ->update('tb_sprite');

        // refresh tag relations
        $this->db->delete('tb_sprite_tag', ['sprite_id' => $id]);

        if (!empty($tags)) {
            foreach ($tags as $tag_id) {
                $this->db->insert('tb_sprite_tag', [
                    'sprite_id' => $id,
                    'tag_id' => $tag_id
                ]);
            }
        }

        redirect('sprite');
    }

    // =========================================================
    // ENABLE / DISABLE SPRITE
    // =========================================================
    public function toggle($id)
    {
        $sprite = $this->db
            ->get_where('tb_sprite', ['id' => $id])
            ->row();

        if (!$sprite) show_404();

        $new = $sprite->is_active ? 0 : 1;

        $this->db->set('is_active', $new)
            ->where('id', $id)
            ->update('tb_sprite');

        redirect('sprite');
    }

    // =========================================================
    // DELETE SPRITE (SOFT-SAFE)
    // =========================================================
    public function delete($id)
    {
        // optional: prevent deletion if used in combinations
        $exists = $this->db->where('jam_id', $id)
            ->or_where('design_id', $id)
            ->or_where('background_id', $id)
            ->get('tb_design_combination')
            ->num_rows();

        if ($exists)
            show_error("Sprite sudah dipakai di kombinasi dan tidak boleh dihapus.", 400);

        $this->db->delete('tb_sprite', ['id' => $id]);
        $this->db->delete('tb_sprite_tag', ['sprite_id' => $id]);

        redirect('sprite');
    }
}
