<?php defined('BASEPATH') or exit('No direct script access allowed');

use TCPDF;

class GeneratorController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Sprite_model', 'Tag_model', 'Combination_model']);
    }

    public function generate()
    {
        $tags        = $this->input->post('tags');
        $qty         = (int)$this->input->post('qty');
        $orientation = $this->input->post('orientation'); // portrait|landscape

        $jams     = $this->Sprite_model->getWeightedByTags($tags, 'jam');
        $designs  = $this->Sprite_model->getWeightedByTags($tags, 'design');
        $bgs      = $this->Sprite_model->getWeightedByTags($tags, 'background');


        if (!$tags || $qty < 1)
            show_error("Invalid input", 400);

        // fetch sprites by tag
        $jams  = $this->Sprite_model->getSpritesByTags($tags, 'jam');
        $designs = $this->Sprite_model->getSpritesByTags($tags, 'design');
        $bgs   = $this->Sprite_model->getSpritesByTags($tags, 'background');

        if (!count($jams) || !count($designs) || !count($bgs))
            show_error("Insufficient sprites for selected tags", 400);

        // build all combinations
        $combos = [];
        foreach ($jams as $j)
            foreach ($designs as $d)
                foreach ($bgs as $b)
                    $combos[] = [$j, $d, $b];

        usort($combos, function ($a, $b) {
            $wa = ($a[0]->sold_count + $a[1]->sold_count + $a[2]->sold_count);
            $wb = ($b[0]->sold_count + $b[1]->sold_count + $b[2]->sold_count);
            return $wb <=> $wa;
        });

        shuffle($combos);


        if ($qty > count($combos))
            show_error("Qty exceeds available unique combinations", 400);

        // create batch
        $this->db->insert('tb_generate_batch', [
            'total_design' => $qty
        ]);
        $batch_id = $this->db->insert_id();

        // init pdf
        $pdf = new TCPDF(
            $orientation == 'landscape' ? 'L' : 'P',
            'mm',
            [200, 400],
            true,
            'UTF-8',
            false
        );
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);

        $selected = array_slice($combos, 0, $qty);

        foreach ($selected as $set) {
            [$jam, $design, $bg] = $set;

            $combination = $this->Combination_model
                ->createOrGetCombination($jam->id, $design->id, $bg->id);

            if ($combination->is_disabled)
                continue;

            $this->db->trans_start();

            // business counters
            $this->Combination_model->incrementGenerated($combination->id);

            $this->Sprite_model->incrementUsedCount($jam->id);
            $this->Sprite_model->incrementUsedCount($design->id);
            $this->Sprite_model->incrementUsedCount($bg->id);

            $this->Tag_model->incrementUsedBySprite($jam->id);
            $this->Tag_model->incrementUsedBySprite($design->id);
            $this->Tag_model->incrementUsedBySprite($bg->id);

            $this->Sprite_model->logUsage($jam->id, 'jam', $batch_id);
            $this->Sprite_model->logUsage($design->id, 'design', $batch_id);
            $this->Sprite_model->logUsage($bg->id, 'background', $batch_id);

            $this->db->trans_complete();

            if (!$this->db->trans_status())
                show_error("DB Transaction Failed", 500);

            // render PDF page
            $pdf->AddPage();

            // background
            $pdf->Image($bg->file_path, 0, 0, 200, 400, '', '', '', true);

            // jam sprite diameter 16cm = 160mm
            $pdf->Image($jam->file_path, 20, 60, 160, 160, '', '', '', true);

            // design / quote overlay
            $pdf->Image($design->file_path, 40, 240, 120, 120, '', '', '', true);
        }

        $file = FCPATH . 'exports/design_batch_' . $batch_id . '.pdf';
        $pdf->Output($file, 'F');

        header('Content-Type: application/pdf');
        readfile($file);
    }
}
