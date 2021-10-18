<?php

    class Milk extends CI_Controller{

        public $res = array();

        public function __construct(){
            parent::__construct();
            // verify angularkey and jwt token
            $this->token->verify_auth_token($_SERVER);
            //get frontend data
            $this->data = json_decode(file_get_contents("php://input"));

            $this->load->model('admin/Milk_m');
        }



        //get milktype
        public function get_milktype() {

            $isFetched = $this->Milk_m->get_milktype_m();
            
            $res['status'] = $isFetched ? true : false;
            $res['message'] = $isFetched ? 'Milk type fetched.' : 'Milk type not found.';
            $res['count'] = $this->count_milktype();
            $res['data'] = $isFetched;
            
            http_response_code(200);

            echo json_encode($res);
        }


        //edit milktype
        public function edit_milktype() {

            if(!$this->data->id){

                $res['status'] = false;
                $res['message'] = 'Milktype id not pass!';
                http_response_code(400);

            }else{

                $isData = $this->Milk_m->edit_milktype_m($this->data->id);
                $res['status'] = $isData ? true : false;
                $res['message'] = $isData ? 'Milktype fetched!' : 'Milktype not found!';
                $res['data'] = $isData ? $isData : 'Record not found!';
                $isData ? http_response_code(200) : http_response_code(404);

            }

            echo json_encode($res);

        }

         //count services
         public function count_milktype(){

            return $this->Milk_m->count_milktype_m();
        }


       

      

    }

