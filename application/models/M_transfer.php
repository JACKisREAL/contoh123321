<?php 
class M_transfer extends CI_model {
    public function select_transfer() {
        $query = $this->db->get('transfer');
        var_dump($this->db->last_query());
        return $query->result_array();
    }
}
?>