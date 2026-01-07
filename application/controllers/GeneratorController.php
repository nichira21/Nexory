<?php defined('BASEPATH') or exit('No direct script access allowed');

// LOAD DOMPDF
require_once(APPPATH.'third_party/dompdf/autoload.inc.php');

use Dompdf\Dompdf;
use Dompdf\Options;

class GeneratorController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model([
            'Sprite_model',
            'Tag_model',
            'Combination_model'
        ]);

        $this->load->database();
    }

    // =========================================================
    // UI GENERATOR PAGE
    // =========================================================
    public function index()
    {
        $data['is_dashboard'] = false;

        $data['judul_pendek']  = 'Design Generator';
        $data['judul_panjang'] = 'Design Generator | Nexory';

        $data['tags'] = $this->db->get('tb_tag')->result();

        $this->load->view('template_admin/header', $data);
        $this->load->view('generator/index', $data);
        $this->load->view('template_admin/footer');
    }

    // =========================================================
    // PROCESS GENERATE
    // =========================================================
    public function generate()
    {
        $tags        = $this->input->post('tags');
        $qty         = (int)$this->input->post('qty');
        $orientation = $this->input->post('orientation');

        if (!$tags || $qty < 1)
            show_error("Invalid input", 400);

        // ambil sprites berdasarkan tag
        $jams    = $this->Sprite_model->getWeightedByTags($tags, 'jam');
        $designs = $this->Sprite_model->getWeightedByTags($tags, 'design');
        $bgs     = $this->Sprite_model->getWeightedByTags($tags, 'background');

        if (!count($jams) || !count($designs) || !count($bgs))
            show_error("Insufficient sprites for selected tags", 400);

        // =====================================================
        // BUILD ALL POSSIBLE COMBINATIONS
        // =====================================================
        $combos = [];

        foreach ($jams as $j)
        foreach ($designs as $d)
        foreach ($bgs as $b)
            $combos[] = [$j,$d,$b];

        // weight priority by sales score
        usort($combos, function($a,$b){
            $wa = ($a[0]->sold_count + $a[1]->sold_count + $a[2]->sold_count);
            $wb = ($b[0]->sold_count + $b[1]->sold_count + $b[2]->sold_count);
            return $wb <=> $wa;
        });

        shuffle($combos);

        if ($qty > count($combos))
            show_error("Qty exceeds available unique combinations", 400);

        // =====================================================
        // CREATE BATCH
        // =====================================================
        $this->db->insert('tb_generate_batch', [
            'total_design' => $qty
        ]);

        $batch_id = $this->db->insert_id();

        // =====================================================
        // INIT DOMPDF
        // =====================================================
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $options->set('isHtml5ParserEnabled', true);

        $dompdf = new Dompdf($options);

        // 200 x 400 mm → convert → pt
        $page_width  = 200 * 2.83465;
        $page_height = 400 * 2.83465;

        $dompdf->setPaper(
            [$page_width,$page_height],
            ($orientation == 'landscape' ? 'landscape' : 'portrait')
        );

        $pages = [];

        // =====================================================
        // LOOP & RENDER EACH PAGE
        // =====================================================
        $selected = array_slice($combos, 0, $qty);

        foreach ($selected as $set)
        {
            [$jam,$design,$bg] = $set;

            $combination = $this->Combination_model
                ->createOrGetCombination($jam->id,$design->id,$bg->id);

            // auto-skip disabled
            if (!empty($combination->is_disabled) && $combination->is_disabled == 1)
                continue;

            // =========================
            // BUSINESS COUNTERS
            // =========================
            $this->db->trans_start();

            $this->Combination_model->incrementGenerated($combination->id);

            $this->Sprite_model->incrementUsedCount($jam->id);
            $this->Sprite_model->incrementUsedCount($design->id);
            $this->Sprite_model->incrementUsedCount($bg->id);

            $this->Tag_model->incrementUsedBySprite($jam->id);
            $this->Tag_model->incrementUsedBySprite($design->id);
            $this->Tag_model->incrementUsedBySprite($bg->id);

            $this->Sprite_model->logUsage($jam->id,'jam',$batch_id);
            $this->Sprite_model->logUsage($design->id,'design',$batch_id);
            $this->Sprite_model->logUsage($bg->id,'background',$batch_id);

            $this->db->trans_complete();

            if (!$this->db->trans_status())
                show_error("DB Transaction Failed",500);

            // =========================
            // BUILD PAGE HTML (LAYERING)
            // =========================
            $pages[] = '
            <div style="width:100%;height:100%;position:relative">

                <img src="'.base_url($bg->file_path).'"
                     style="width:100%;height:100%;position:absolute;left:0;top:0">

                <img src="'.base_url($jam->file_path).'"
                     style="width:80%;left:10%;top:20%;position:absolute">

                <img src="'.base_url($design->file_path).'"
                     style="width:60%;left:20%;top:60%;position:absolute">

            </div>';
        }

        // =====================================================
        // RENDER MULTIPAGE PDF
        // =====================================================
        $dompdf->loadHtml(
            implode('<div style="page-break-after:always"></div>', $pages)
        );

        $dompdf->render();

        // STREAM TO BROWSER (NO FILE WRITE)
        $dompdf->stream("design_batch_{$batch_id}.pdf", [
            "Attachment" => false
        ]);

        exit;
    }
}

}
