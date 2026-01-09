<?php defined('BASEPATH') or exit('No direct script access allowed');

class Sprite_model extends CI_Model
{
    public function getSpritesByTags($tag_ids, $type)
    {
        return $this->db
            ->select('s.*')
            ->from('tb_sprite s')
            ->join('tb_sprite_tag st', 'st.sprite_id = s.id')
            ->where_in('st.tag_id', $tag_ids)
            ->where('s.sprite_type', $type)
            ->where('s.is_active', 1)
            ->group_by('s.id')
            ->get()
            ->result();
    }


    public function incrementUsedCount($sprite_id)
    {
        $this->db->set('used_count', 'used_count+1', FALSE)
            ->where('id', $sprite_id)
            ->update('tb_sprite');
    }

    public function incrementSoldCount($sprite_id, $qty)
    {
        $this->db->set('sold_count', "sold_count+{$qty}", FALSE)
            ->where('id', $sprite_id)
            ->update('tb_sprite');
    }

    public function logUsage($sprite_id, $type, $batch_id)
    {
        $this->db->insert('tb_sprite_usage', [
            'sprite_id' => $sprite_id,
            'sprite_type' => $type,
            'batch_id' => $batch_id
        ]);
    }

    public function getWeightedByTags($tags, $type)
    {
        $this->db->select('s.*, 
        (s.sold_count / GREATEST(s.used_count,1)) AS weight_score')
            ->from('tb_sprite s')
            ->join('tb_sprite_tag st', 'st.sprite_id=s.id')
            ->join('tb_tag t', 't.id=st.tag_id')
            ->where_in('t.tag_name', $tags)
            ->where('s.sprite_type', $type)
            ->where('s.is_active', 1)
            ->group_by('s.id')
            ->order_by('weight_score', 'DESC');

        return $this->db->get()->result();
    }
}
