<?php

    class User extends CI_Controller{

        public $res = array();

        public function __construct(){
            parent::__construct();
            // verify angularkey and jwt token
            $this->token->verify_auth_token($_SERVER);
            //get frontend data
            $this->data = json_decode(file_get_contents("php://input"));

            $this->load->model('admin/User_m');
        }



        //get user --> working
        public function get_users()
        {
            $isFetched = $this->User_m->get_users_m();
            
            $res['status'] = $isFetched ? true : false;
            $res['message'] = $isFetched ? 'Users fetched.' : 'Users not found.';
            $res['count'] = $this->count_user();
            $res['data'] = $isFetched;
            
            http_response_code(200);

            echo json_encode($res);
        }




        //create user
        public function create_user() {

            if(!$this->data->is_status){

                $res['status'] = false;
                $res['message'] = 'User not create.';
                http_response_code(404);

            }else{

                //check mobile already exit or not
                $this->mobile_exist($this->data->mobile);

                //check username already exit or not
                $this->username_exist($this->data->username);

                $date=date_create($this->data->start_delivery);


                $data = array( 
                                'first_name'    => $this->data->first_name,
                                'middle_name'   => $this->data->middle_name,
                                'last_name'     => $this->data->last_name,
                                'mobile'        => $this->data->mobile,
                                'email'         => $this->data->email,
                                'service'       => $this->data->service,
                                'area'          => $this->data->area,
                                'address'       => $this->data->address,
                                'cow_milk'      => $this->data->cow_milk,
                                'is_cow'        => $this->data->is_cow,
                                'buffelo_milk'  => $this->data->buffelo_milk,
                                'is_buffelo'    => $this->data->is_buffelo,
                                'username'      => $this->data->username,
                                'password'      => $this->data->password,
                                'start_delivery'=> $this->data->start_delivery,
                                'is_status'     => $this->data->is_status,
                                'create_by'     => $this->data->create_by,
                                'create_date'   => date("d-m-Y h:i:s A",time())
                            );

                $isInserted = $this->User_m->create_user_m($data);
                $res['status'] = $isInserted ? true : false;
                $res['message'] = $isInserted ? 'User created.' : 'User not create.';
                $isInserted ? http_response_code(200) : http_response_code(404);

            }

            echo json_encode($res);
        }


        //delete service
        public function delete_user()
        {
            if(!$this->data->id){

                $res['status'] = false;
                $res['message'] = 'User id not pass.';
                http_response_code(400);

            }else{
                $isDeleted = $this->User_m->delete_user_m($this->data->id);
                $res['status'] = $isDeleted ? true : false;
                $res['message'] = $isDeleted ? 'User deleted.' : 'User not found.';
                $isDeleted ? http_response_code(200) : http_response_code(404);
            }

            echo json_encode($res);
        }



        //edit user
        public function edit_user(){

            if(!$this->data->id){

                $res['status'] = false;
                $res['message'] = 'User id not pass!';
                http_response_code(400);

            }else{

                $isData = $this->User_m->edit_user_m($this->data->id);
                $res['status'] = $isData ? true : false;
                $res['message'] = $isData ? 'User fetched!' : 'User not found!';
                $res['data'] = $isData ? $isData : 'Record not found!';
                $isData ? http_response_code(200) : http_response_code(404);

            }

            echo json_encode($res);
        }



        //update service
        public function update_user() {

            if(!$this->data->id){

                $res['status'] = false;
                $res['message'] = 'User id not found..!';
                http_response_code(404);

            }else{

                $data = array( 
                    'first_name'    => $this->data->first_name,
                    'middle_name'   => $this->data->middle_name,
                    'last_name'     => $this->data->last_name,
                    'mobile'        => $this->data->mobile,
                    'email'         => $this->data->email,
                    'service'       => $this->data->service,
                    'area'          => $this->data->area,
                    'address'       => $this->data->address,
                    'cow_milk'      => $this->data->cow_milk,
                    'is_cow'        => $this->data->is_cow,
                    'buffelo_milk'  => $this->data->buffelo_milk,
                    'is_buffelo'    => $this->data->is_buffelo,
                    'username'      => $this->data->username,
                    'password'      => $this->data->password,
                    'is_status'     => $this->data->is_status,
                    'update_by'     => $this->data->update_by,
                    'update_date'   => date("d-m-Y h:i:s A",time())
                );

                $isUpdated = $this->User_m->update_user_m($this->data->id,$data);
                $res['status'] = $isUpdated ? true : false;
                $res['message'] = $isUpdated ? 'User updated..!' : 'User id not found..!';
                $isUpdated ? http_response_code(200) : http_response_code(404);

            }

            echo json_encode($res);
        }


        //update service status
        public function status_service() {
         
            if(!$this->data->id && !$this->data->is_status){

                $res['status'] = false;
                $res['message'] = 'Service id or status not found..!';
                http_response_code(404);

            }else{

                $data = array( 
                                'is_status'=>$this->data->is_status,
                                'update_by' => $this->data->update_by,
                                'update_date' => date("d-m-Y h:i:s A",time())
                            );

                $isUpdated = $this->Service_m->status_service_m($this->data->id,$data);
                $res['status'] = $isUpdated ? true : false;
                $res['message'] = $isUpdated ? 'Service status updated..!' : 'Service id not found..!';
                $isUpdated ? http_response_code(200) : http_response_code(404);

            }

            echo json_encode($res);
        }


        //count user
        public function count_user(){

            return $this->User_m->count_user_m();
        }


        //check mobile exit or not
        public function mobile_exist($mobile) {

            $isExist = $this->User_m->mobile_exist_m($mobile);

            if($isExist) {
                $res['status'] = false;
                $res['message'] = 'Mobile already exist..!';
                http_response_code(404);
                echo json_encode($res);
                exit;
            }

        }

        //check mobile exit or not
        public function username_exist($username) {

            $isExist = $this->User_m->username_exist_m($username);

            if($isExist) {
                $res['status'] = false;
                $res['message'] = 'Username already exist..! Pls Regenerate Username';
                http_response_code(404);
                echo json_encode($res);
                exit;
            }

        }

    }

