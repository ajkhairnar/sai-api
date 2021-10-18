<?php
    require "jwt_file/vendor/autoload.php";
    use \Firebase\JWT\JWT;

    class Login extends MY_Controller{

        function __construct(){

            parent::__construct();

            //set headers
            $method = $_SERVER['REQUEST_METHOD'];
            $this->check_header($method);

            //frontend data
            $this->data = json_decode(file_get_contents("php://input"));
            $angularkey=$this->data->key;

            if(!$this->angular_key($angularkey)) {
                echo json_encode(array('message'=>"You Can't Access"));
                exit;
            }

            $this->load->model('admin/Login_m');
            
           
        }

        public function index(){
            
            $username = $this->data->username;
            $password = $this->data->password;
            $isLogin = $this->Login_m->login($username,$password);
            $resp = array();

            if($isLogin) {

                $data = array(
                    "id" => $isLogin->id,
                    "name"=>$isLogin->first_name." ".$isLogin->last_name,
                    "email" => $isLogin->email,
                    "role" => $isLogin->role_name,
                    "last_login"=>$isLogin->last_login    
                );

                //generate token from token library
                $gettoken = $this->token->generate_token($data);

                $res['status'] = true;
                $res['message'] = "Login success";
                $res['token'] = $gettoken;
                http_response_code(200);

            } else {

                $res['status'] = true;
                $res['message'] = "Login Fail";
                http_response_code(401);
            }

            echo json_encode($res);

        }
    }