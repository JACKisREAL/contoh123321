<?php 
class M_label_transfer extends CI_model {
    public function select_label_transfer() {
        $query = $this->db->get('label_transfer');
        var_dump($this->db->last_query());
        return $query->result_array();
    }
}
?>