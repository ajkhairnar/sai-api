<?php

require "jwt_file/vendor/autoload.php";
use \Firebase\JWT\JWT;
error_reporting(0);

class MY_Controller extends CI_Controller {


	// angular_key check
	public function angular_key($angularkey) {

		if($angularkey == "jk"){
			return true;
		}else{
			return false;
		}

	}



	// 	public function angular_key($angular_key) {

	// 	if($angular_key == "jk"){
	// 		$response['message']="angular key success..!";
	// 		$response['success']=true;
	// 		return $array;
	// 	}else{
	// 		$response['message']="angular key fail..!";
	// 		$response['success']=false;
	// 	}

	// 	return $response;
	// }




	// //Generate token
	// public function generate_token($data){
		
	// 	$secret_key = "jayesh123";
	// 	$issuer_claim = "localhost"; // this can be the servername
	// 	$audience_claim = "login_admin";
	// 	$issuedat_claim = time(); // issued at
	// 	$notbefore_claim = $issuedat_claim + 10; //not before in seconds
	// 	$expire_claim =  $notbefore_claim+60; // expire time in seconds

	// 	$payload_info = array(
	// 	   	"iss" => $issuer_claim,
	// 		"aud" => $audience_claim,
	// 	   	"iat" => $issuedat_claim,
	// 	   	"nbf" => $notbefore_claim,
	// 	   	"exp" => $expire_claim,
	// 		"data" => $data 
	// 	);

	// 	$token = JWT::encode($payload_info, $secret_key);
	// 	return $token;
	// }


	//jwt token check
	// public function verify_auth_token($server)
	// {
	// 	$res = array();
	// 	$authHeader = $server['HTTP_AUTHORIZATION'];
	// 	$temp_header = explode(" ", $authHeader);
	// 	$jwt = $temp_header[1];
		
	// 	if($server['HTTP_KEY'] != 'jk'){

	// 		$res['message'] = " You can't access";
	// 		http_response_code(401);
	// 		echo json_encode($res);
    //         exit;
	// 	}

	// 	// if jwt is not empty
	// 	if($jwt){
		
	// 	    // if decode succeed, show user details
	// 	    try {
	// 	        // decode jwt
	// 	        $decoded = JWT::decode($jwt,"jayesh123", array('HS256'));
	// 	        // set response code
	// 	        // http_response_code(200);
	// 	        // show user details
	// 	        // echo json_encode(array(
	// 	        //     "message" => "Access granted.",
	// 	        //     "data" => $decoded->data
	// 	        // ));

	// 	        // return true;
	// 	    }
		 
	// 	    // if decode fails, it means jwt is invalid
	// 		catch (Exception $e){
			 
	// 		    // set response code
	// 		    // http_response_code(401);
			 
	// 		    // tell the user access denied  & show error message
	// 		    // echo json_encode(array(
	// 		    //     "message" => "Access denied.",
	// 		    //     "error" => $e->getMessage()
	// 		    // ));

	// 		    //  return false;
	// 			$res['message'] = " You are not authorized";
	// 			http_response_code(401);
	// 			echo json_encode($res);
	// 			exit;
	// 		}
	// 	}
	// 	else{
		 
	// 	    // set response code
	// 	    // http_response_code(401);
	// 	    // // tell the user access denied
	// 	    // echo json_encode(array("message" => "Access denied/Token Error."));
	// 	    //  return false;

	// 		$res['message'] = " You are not authorized";
	// 			http_response_code(401);
	// 			echo json_encode($res);
	// 			exit;
	// 	}
	// }



    public function check_header($method) {
        if ($method == 'POST') {
            header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Methods: POST");
            header("Access-Control-Allow-Headers: Content-Type, Authorization");
            header("Content-Type: application/json; charset=UTF-8");
            } elseif ($method == 'GET') {
            header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Methods: GET");
            header("Access-Control-Allow-Headers: Content-Type, Authorization");
            header("Content-Type: application/json; charset=UTF-8");
            } elseif ($method == 'PUT') {
                // Method is PUT
            } elseif ($method == 'DELETE') {
                // Method is DELETE
            } else {
                // Method unknown
            }
    }

	



}

?>