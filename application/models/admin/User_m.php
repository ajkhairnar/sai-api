<?php 

    class User_m extends CI_Model {

        public $table = "tbl_user";
        
        public function get_users_m() {
            $query = $this->db->get($this->table);
            return $query->result();
        }


        public function create_user_m($data) {
            $this->db->insert($this->table,$data);
            return ($this->db->affected_rows()) ? true : false;
        }

        public function delete_user_m($id) {

            $this->db->where("id",$id);
            $this->db->delete($this->table);
            return $this->db->affected_rows();

        }

        public function edit_user_m($id){
            $row = $this->db->get_where($this->table, array('id' => $id))->row();
            return $row;
        }

        public function update_user_m($id,$data) {

            $this->db->where('id', $id);
            $this->db->update($this->table, $data);
            return true;
        }

        public function status_service_m($id,$data) {

            $this->db->where('id', $id);
            $this->db->update($this->table, $data);

            return true;
        }

        public function count_user_m(){
            return $this->db->count_all($this->table);
        }

        public function mobile_exist_m($mobile){
            $query = $this->db->get_where($this->table, array('mobile' => $mobile));

            //exit record
            if ($query->num_rows() > 0 ) {
                return true;
            }
        }

        public function username_exist_m($username){
            $query = $this->db->get_where($this->table, array('username' => $username));

            //exit record
            if ($query->num_rows() > 0 ) {
                return true;
            }
        }



    }