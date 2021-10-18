<?php 

    class Area_m extends CI_Model {

        public $table = "tbl_area";
        
        public function get_areas_m() {
            $query = $this->db->get($this->table);
            return $query->result();
        }


        public function create_area_m($data) {
            $this->db->insert($this->table,$data);
            return ($this->db->affected_rows()) ? true : false;
        }

        public function delete_area_m($id) {

            $this->db->where("id",$id);
            $this->db->delete($this->table);
            return $this->db->affected_rows();

        }

        public function edit_area_m($id){
            $row = $this->db->get_where($this->table, array('id' => $id))->row();
            return $row;
        }

        public function update_area_m($id,$data) {

            $this->db->where('id', $id);
            $this->db->update($this->table, $data);
            return true;
        }


        public function count_area_m(){
            return $this->db->count_all($this->table);
        }

        public function area_exist_m($area){
            $query = $this->db->get_where($this->table, array('area' => $area));

            //exit record
            if ($query->num_rows() > 0 ) {
                return true;
            }
        }

        public function get_active_areas_m($status) {
            $query = $this->db->get_where($this->table, array('is_status' => $status));
            return $query->result();
        }




    }