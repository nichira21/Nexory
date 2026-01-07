<?php defined('BASEPATH') or exit('No direct script access allowed');

class Combination_model extends CI_Model
{

    public function getUniqueCombinations($jam, $design, $bg)
    {
        $hash = md5("{$jam}-{$design}-{$bg}");
        return $this->db->get_where('tb_design_combination', [
            'hash_key' => $hash
        ])->row();
    }
    private function makeSku($jam, $design, $bg, $hash)
    {
        $short = substr($hash, 0, 8);
        return "{$jam}-{$design}-{$bg}-{$short}";
    }

    public function createOrGetCombination($jam, $design, $bg)
    {
        $hash = md5("{$jam}-{$design}-{$bg}");

        $existing = $this->db
            ->get_where('tb_design_combination', ['hash_key' => $hash])
            ->row();

        if ($existing)
            return $existing;

        $sku = $this->makeSku($jam, $design, $bg, $hash);

        $this->db->insert('tb_design_combination', [
            'jam_id' => $jam,
            'design_id' => $design,
            'background_id' => $bg,
            'hash_key' => $hash,
            'sku_code' => $sku
        ]);

        return $this->db->get_where('tb_design_combination', [
            'id' => $this->db->insert_id()
        ])->row();
    }

    public function incrementGenerated($id)
    {
        $this->db->set('generated_count', 'generated_count+1', FALSE)
            ->where('id', $id)->update('tb_design_combination');

        $this->recalculatePerformance($id);
    }

    public function incrementSold($id, $qty)
    {
        $this->db->set('sold_count', "sold_count+{$qty}", FALSE)
            ->where('id', $id)->update('tb_design_combination');

        $this->recalculatePerformance($id);
    }

    public function recalculatePerformance($id)
    {
        $row = $this->db
            ->get_where('tb_design_combination', ['id' => $id])
            ->row();

        if (!$row) return;

        $score = $row->sold_count / max($row->generated_count, 1);

        $update = ['performance_score' => $score];

        if ($row->generated_count >= 10 && $score < 0.1)
            $update['is_disabled'] = 1;

        $this->db->where('id', $id)->update('tb_design_combination', $update);
    }

    public function getWeightedCandidates($limit)
    {
        return $this->db
            ->where('is_disabled', 0)
            ->order_by('performance_score', 'DESC')
            ->limit($limit)
            ->get('tb_design_combination')
            ->result();
    }

    public function getTopRanked($limit = 20)
    {
        return $this->db
            ->order_by('performance_score', 'DESC')
            ->order_by('sold_count', 'DESC')
            ->limit($limit)
            ->get('tb_design_combination')
            ->result();
    }
}
