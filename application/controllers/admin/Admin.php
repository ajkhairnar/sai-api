<?php

    class Admin extends CI_Controller{

        public $res = array();

        public function __construct(){
            parent::__construct();
            // verify angularkey and jwt token
            $this->token->verify_auth_token($_SERVER);
            //get frontend data
            $this->data = json_decode(file_get_contents("php://input"));

            $this->load->model('admin/Admin_m');
        }



        //get admin
        public function get_admins()
        {
            $isService = $this->Admin_m->get_admins_m();
            
            $res['status'] = $isService ? true : false;
            $res['message'] = $isService ? 'Admins fetched.' : 'Admins not found.';
            $res['count'] = $this->count_admin();
            $res['data'] = $isService;
            
            http_response_code(200);

            echo json_encode($res);
        }


        //create admin
        public function create_admin() {

            if(!$this->data->is_status){

                $res['status'] = false;
                $res['message'] = 'Admin not create.';
                http_response_code(404);

            }else{

                //check service exit or not
                // $this->service_exist($this->data->service);

                $data = array( 
                                'first_name'  => $this->data->first_name,
                                'middle_name' => $this->data->middle_name,
                                'last_name'   => $this->data->last_name,
                                'mobile'      => $this->data->mobile,
                                'username'    => $this->data->username,
                                'email'       => $this->data->email,
                                'password'    => $this->data->password,
                                'role_name'   => $this->data->role_name,
                                'is_status'   =>$this->data->is_status,
                                'create_by'   => $this->data->create_by,
                                'create_date' => date("d-m-Y h:i:s A",time())
                            );

                $isInserted = $this->Admin_m->create_admin_m($data);
                $res['status'] = $isInserted ? true : false;
                $res['message'] = $isInserted ? 'Admin created.' : 'Admin not create.';
                $isInserted ? http_response_code(200) : http_response_code(404);

            }

            echo json_encode($res);
        }



        //delete admin
        public function delete_admin()
        {
            if(!$this->data->id){

                $res['status'] = false;
                $res['message'] = 'admin id not pass.';
                http_response_code(400);

            }else{
                $isDeleted = $this->Admin_m->delete_admin_m($this->data->id);
                $res['status'] = $isDeleted ? true : false;
                $res['message'] = $isDeleted ? 'Admin deleted.' : 'Admin not found.';
                $isDeleted ? http_response_code(200) : http_response_code(404);
            }

            echo json_encode($res);
        }


        //edit admin
        public function edit_admin(){

            if(!$this->data->id){

                $res['status'] = false;
                $res['message'] = 'Admin id not pass!';
                http_response_code(400);

            }else{

                $isData = $this->Admin_m->edit_admin_m($this->data->id);
                $res['status'] = $isData ? true : false;
                $res['message'] = $isData ? 'Admin fetched!' : 'Admin not found!';
                $res['data'] = $isData ? $isData : 'Record not found!';
                $isData ? http_response_code(200) : http_response_code(404);

            }

            echo json_encode($res);
        }


        //update admin
        public function update_admin() {

            if(!$this->data->id){

                $res['status'] = false;
                $res['message'] = 'Admin id not found..!';
                http_response_code(404);

            }else{

                $data = array( 
                                'first_name'  => $this->data->first_name,
                                'middle_name' => $this->data->middle_name,
                                'last_name'   => $this->data->last_name,
                                'mobile'      => $this->data->mobile,
                                'username'    => $this->data->username,
                                'email'       => $this->data->email,
                                'password'    => $this->data->password,
                                'role_name'   => $this->data->role_name,
                                'is_status'   =>$this->data->is_status,
                                'update_by' => $this->data->update_by,
                                'update_date' => date("d-m-Y h:i:s A",time())
                            );

                $isUpdated = $this->Admin_m->update_admin_m($this->data->id,$data);
                $res['status'] = $isUpdated ? true : false;
                $res['message'] = $isUpdated ? 'Admin updated..!' : 'Admin id not found..!';
                $isUpdated ? http_response_code(200) : http_response_code(404);

            }

            echo json_encode($res);
        }


          //count admin
          public function count_admin(){

            return $this->Admin_m->count_admin_m();
        }
    }
?>