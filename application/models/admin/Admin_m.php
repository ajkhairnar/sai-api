<?php 

    class Admin_m extends CI_Model {

        public $table = "tbl_admin";
        
        public function get_admins_m() {
            $query = $this->db->get_where($this->table, array('role_name' => 'admin'));
            return $query->result();
        }


        public function create_admin_m($data) {
            $this->db->insert($this->table,$data);
            return ($this->db->affected_rows()) ? true : false;
        }

        public function delete_admin_m($id) {

            $this->db->where("id",$id);
            $this->db->delete($this->table);
            return $this->db->affected_rows();

        }

        public function edit_admin_m($id){
            $row = $this->db->get_where($this->table, array('id' => $id,'role_name'=>'admin'))->row();
            return $row;
        }

        public function update_admin_m($id,$data) {

            $this->db->where('id', $id);
            $this->db->update($this->table, $data);
            return true;
        }

        public function status_service_m($id,$data) {

            $this->db->where('id', $id);
            $this->db->update($this->table, $data);

            return true;
        }

        public function count_admin_m(){
            return $this->db->where('role_name','admin')->count_all_results($this->table);
        }

        public function service_exist_m($service){
            $query = $this->db->get_where($this->table, array('service' => $service));

            //exit record
            if ($query->num_rows() > 0 ) {
                return true;
            }
        }



    }