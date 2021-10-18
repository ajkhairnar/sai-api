<?php 

    class Service_m extends CI_Model {

        public $table = "tbl_service";
        
        public function get_services_m($active=0) {

            $query = $this->db->get($this->table);
            return $query->result();
        }


        public function create_service_m($data) {
            $this->db->insert($this->table,$data);
            return ($this->db->affected_rows()) ? true : false;
        }

        public function delete_service_m($id) {

            $this->db->where("id",$id);
            $this->db->delete($this->table);
            return $this->db->affected_rows();

        }

        public function edit_service_m($id){
            $row = $this->db->get_where($this->table, array('id' => $id))->row();
            return $row;
        }

        public function update_service_m($id,$data) {

            $this->db->where('id', $id);
            $this->db->update($this->table, $data);
            return true;
        }

        public function status_service_m($id,$data) {

            $this->db->where('id', $id);
            $this->db->update($this->table, $data);

            return true;
        }

        public function count_service_m(){
            return $this->db->count_all($this->table);
        }

        public function service_exist_m($service){
            $query = $this->db->get_where($this->table, array('service' => $service));

            //exit record
            if ($query->num_rows() > 0 ) {
                return true;
            }
        }

        public function get_active_services_m($status) {
            $query = $this->db->get_where($this->table, array('is_status' => $status));
            return $query->result();
        }


    }