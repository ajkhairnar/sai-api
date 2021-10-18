<?php

    class Area extends CI_Controller{

        public $res = array();

        public function __construct(){
            parent::__construct();
            // verify angularkey and jwt token
            $this->token->verify_auth_token($_SERVER);
            //get frontend data
            $this->data = json_decode(file_get_contents("php://input"));

            $this->load->model('admin/Area_m');
        }



        //get area
        public function get_areas()
        {
            $isService = $this->Area_m->get_areas_m();
            
            $res['status'] = $isService ? true : false;
            $res['message'] = $isService ? 'Areas fetched.' : 'Areas not found.';
            $res['count'] = $this->count_area();
            $res['data'] = $isService;
            
            http_response_code(200);

            echo json_encode($res);
        }



        //create area
        public function create_area() {

            if(!$this->data->is_status){

                $res['status'] = false;
                $res['message'] = 'Area not create.';
                http_response_code(404);

            }else{

                //check service exit or not
                $this->area_exist($this->data->area);

                $data = array( 
                                'area' => $this->data->area,
                                'is_status'=>$this->data->is_status,
                                'create_by' => $this->data->create_by,
                                'create_date' => date("d-m-Y h:i:s A",time())
                            );

                $isInserted = $this->Area_m->create_area_m($data);
                $res['status'] = $isInserted ? true : false;
                $res['message'] = $isInserted ? 'Area created.' : 'Area not create.';
                $isInserted ? http_response_code(200) : http_response_code(404);

            }

            echo json_encode($res);
        }


        //delete area
        public function delete_area()
        {
            if(!$this->data->id){

                $res['status'] = false;
                $res['message'] = 'Area id not pass.';
                http_response_code(400);

            }else{
                $isDeleted = $this->Area_m->delete_area_m($this->data->id);
                $res['status'] = $isDeleted ? true : false;
                $res['message'] = $isDeleted ? 'Area deleted.' : 'Area not found.';
                $isDeleted ? http_response_code(200) : http_response_code(404);
            }

            echo json_encode($res);
        }



        //edit area
        public function edit_area(){

            if(!$this->data->id){

                $res['status'] = false;
                $res['message'] = 'Area id not pass!';
                http_response_code(400);

            }else{

                $isData = $this->Area_m->edit_area_m($this->data->id);
                $res['status'] = $isData ? true : false;
                $res['message'] = $isData ? 'Area fetched!' : 'Area not found!';
                $res['data'] = $isData ? $isData : 'Record not found!';
                $isData ? http_response_code(200) : http_response_code(404);

            }

            echo json_encode($res);
        }



        //update area
        public function update_area() {

            if(!$this->data->id){

                $res['status'] = false;
                $res['message'] = 'Area id not found..!';
                http_response_code(404);

            }else{

                $data = array( 
                                'area' => $this->data->area,
                                'is_status'=>$this->data->is_status,
                                'update_by' => $this->data->update_by,
                                'update_date' => date("d-m-Y h:i:s A",time())
                            );

                $isUpdated = $this->Area_m->update_area_m($this->data->id,$data);
                $res['status'] = $isUpdated ? true : false;
                $res['message'] = $isUpdated ? 'Area updated..!' : 'Area id not found..!';
                $isUpdated ? http_response_code(200) : http_response_code(404);

            }

            echo json_encode($res);
        }


          //get active area
          public function get_active_area() {

            $isArea = $this->Area_m->get_active_areas_m('active');
            
            $res['status'] = $isArea ? true : false;
            $res['message'] = $isArea ? 'Areas fetched.' : 'Areas not found.';
            $res['data'] = $isArea;
            
            http_response_code(200);

            echo json_encode($res);

        }


        //count area
        public function count_area(){

            return $this->Area_m->count_area_m();
        }


        //check area exit or not
        public function area_exist($area) {

            $isExist = $this->Area_m->area_exist_m($area);

            if($isExist) {
                $res['status'] = false;
                $res['message'] = 'area aleready exist..!';
                http_response_code(404);
                echo json_encode($res);
                exit;
            }

        }

    }

