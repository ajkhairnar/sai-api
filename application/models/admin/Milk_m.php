<?php 

    class Milk_m extends CI_Model {

        public $tbl_milk_type = "tbl_milk_type";
        
        public function get_milktype_m() {
            $query = $this->db->get($this->tbl_milk_type);
            return $query->result();
        }

        public function count_milktype_m() {
            return $this->db->count_all($this->tbl_milk_type);
        }

        public function edit_milktype_m($id){
            $row = $this->db->get_where($this->table, array('id' => $id))->row();
            return $row;
        }


     

        




    }