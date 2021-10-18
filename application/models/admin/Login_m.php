
<?php

    class Login_m extends CI_Model{

        public $table='tbl_admin';

        function login($username,$password){

            $qry=$this->db->where('username',$username)->where('password',$password)->get($this->table);
		
            if($this->db->affected_rows() > 0)
            {
               $result=$qry->row();
               
                //update last_login date
                $lastlogin_update= $this->lastlogin_update($result->admin_id);

                if($lastlogin_update==1) {
                    return $qry->row();
                }
            } else {
                return false;
            }
        }


        function lastlogin_update($id) {

            $data = array('last_login' => date('Y-m-d h:i:s') );
		    return $this->db->where('id', $id)->update($this->table,$data);	
        }
        
    }