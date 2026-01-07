<?php defined('BASEPATH') or exit('No direct script access allowed');

class TagController extends CI_Controller
{
    public function index()
    {
        $data['is_dashboard'] = false;

        $data['tags'] = $this->db->get('tb_tag')->result();

        $data['judul_pendek']  = 'Manage Tags';
        $data['judul_panjang'] = 'Manage Tags | Nexory';

        $this->load->view('template_admin/header', $data);
        $this->load->view('tag/index', $data);
        $this->load->view('template_admin/footer');
    }

    public function create()
    {
        $this->load->view('tag/create');
    }

    public function store()
    {
        $tag_name = trim($this->input->post('tag_name'));

        if ($tag_name == '')
            show_error('Nama tag tidak boleh kosong', 400);

        $exists = $this->db
            ->get_where('tb_tag', ['tag_name' => $tag_name])
            ->row();

        if ($exists)
            show_error('Tag sudah ada', 400);

        $this->db->insert('tb_tag', [
            'tag_name' => $tag_name,
            'used_count' => 0,
            'sold_count' => 0
        ]);

        redirect('tag');
    }

    public function edit($id)
    {
        $data['tag'] = $this->db
            ->get_where('tb_tag', ['id' => $id])
            ->row();

        if (!$data['tag'])
            show_404();

        $this->load->view('tag/edit', $data);
    }

    public function update($id)
    {
        $tag_name = trim($this->input->post('tag_name'));

        $this->db->set('tag_name', $tag_name)
            ->where('id', $id)
            ->update('tb_tag');

        redirect('tag');
    }

    public function delete($id)
    {
        $in_use = $this->db
            ->get_where('tb_sprite_tag', ['tag_id' => $id])
            ->num_rows();

        if ($in_use)
            show_error("Tag sedang dipakai sprite — tidak bisa dihapus", 400);

        $this->db->delete('tb_tag', ['id' => $id]);

        redirect('tag');
    }
}
