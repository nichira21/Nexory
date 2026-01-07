<?php defined('BASEPATH') or exit('No direct script access allowed');

class Tag_model extends CI_Model
{
    public function incrementUsedBySprite($sprite_id)
    {
        $sql = "
            UPDATE tb_tag t
            JOIN tb_sprite_tag st ON st.tag_id = t.id
            SET t.used_count = t.used_count + 1
            WHERE st.sprite_id = ?
        ";
        $this->db->query($sql, [$sprite_id]);
    }

    public function incrementSoldBySprite($sprite_id, $qty)
    {
        $sql = "
            UPDATE tb_tag t
            JOIN tb_sprite_tag st ON st.tag_id = t.id
            SET t.sold_count = t.sold_count + {$qty}
            WHERE st.sprite_id = ?
        ";
        $this->db->query($sql, [$sprite_id]);
    }
}
