<?php

    class Service extends CI_Controller{

        public $res = array();

        public function __construct(){
            parent::__construct();
            // verify angularkey and jwt token
            $this->token->verify_auth_token($_SERVER);
            //get frontend data
            $this->data = json_decode(file_get_contents("php://input"));

            $this->load->model('admin/Service_m');
        }



        //get service
        public function get_services() {

            $isService = $this->Service_m->get_services_m();
            
            $res['status'] = $isService ? true : false;
            $res['message'] = $isService ? 'Services fetched.' : 'Services not found.';
            $res['count'] = $this->count_service();
            $res['data'] = $isService;
            
            http_response_code(200);

            echo json_encode($res);
        }


        //create service
        public function create_service() {

            if(!$this->data->is_status){

                $res['status'] = false;
                $res['message'] = 'Service not create.';
                http_response_code(404);

            }else{

                //check service exit or not
                $this->service_exist($this->data->service);

                $data = array( 
                                'service' => $this->data->service,
                                'is_status'=>$this->data->is_status,
                                'create_by' => $this->data->create_by,
                                'create_date' => date("d-m-Y h:i:s A",time())
                            );

                $isInserted = $this->Service_m->create_service_m($data);
                $res['status'] = $isInserted ? true : false;
                $res['message'] = $isInserted ? 'Service created.' : 'Service not create.';
                $isInserted ? http_response_code(200) : http_response_code(404);

            }

            echo json_encode($res);
        }


        //delete service
        public function delete_service() {
            if(!$this->data->id){

                $res['status'] = false;
                $res['message'] = 'Service id not pass.';
                http_response_code(400);

            }else{
                $isDeleted = $this->Service_m->delete_service_m($this->data->id);
                $res['status'] = $isDeleted ? true : false;
                $res['message'] = $isDeleted ? 'Service deleted.' : 'Service not found.';
                $isDeleted ? http_response_code(200) : http_response_code(404);
            }

            echo json_encode($res);
        }



        //edit service
        public function edit_service(){

            if(!$this->data->id){

                $res['status'] = false;
                $res['message'] = 'Service id not pass!';
                http_response_code(400);

            }else{

                $isData = $this->Service_m->edit_service_m($this->data->id);
                $res['status'] = $isData ? true : false;
                $res['message'] = $isData ? 'Service fetched!' : 'Service not found!';
                $res['data'] = $isData ? $isData : 'Record not found!';
                $isData ? http_response_code(200) : http_response_code(404);

            }

            echo json_encode($res);
        }



        //update service
        public function update_service() {

            if(!$this->data->id){

                $res['status'] = false;
                $res['message'] = 'Service id not found..!';
                http_response_code(404);

            }else{

                $data = array( 
                                'service' => $this->data->service,
                                'is_status'=>$this->data->is_status,
                                'update_by' => $this->data->update_by,
                                'update_date' => date("d-m-Y h:i:s A",time())
                            );

                $isUpdated = $this->Service_m->update_service_m($this->data->id,$data);
                $res['status'] = $isUpdated ? true : false;
                $res['message'] = $isUpdated ? 'Service updated..!' : 'Service id not found..!';
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


        //get active service
        public function get_active_service() {

            $isService = $this->Service_m->get_active_services_m('active');
            
            $res['status'] = $isService ? true : false;
            $res['message'] = $isService ? 'Services fetched.' : 'Services not found.';
            $res['data'] = $isService;
            
            http_response_code(200);

            echo json_encode($res);

        }


        //count services
        public function count_service(){

            return $this->Service_m->count_service_m();
        }


        //check service exit or not
        public function service_exist($service) {

            $isExist = $this->Service_m->service_exist_m($service);

            if($isExist) {
                $res['status'] = false;
                $res['message'] = 'Service aleready exist..!';
                http_response_code(404);
                echo json_encode($res);
                exit;
            }

        }

      

    }

