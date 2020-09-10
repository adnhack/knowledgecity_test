<?php

  require_once("autoloader.php");
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST,DELETE");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  $method = $_SERVER["REQUEST_METHOD"];

  if(!in_array($method, ['POST', 'DELETE'])) {
    http_response_code(405);
    echo json_encode(["error" => "Method $method is not allowed. Use POST or DELETE to access this end point"]);
    exit;
  }

  parse_str(file_get_contents("php://input"), $data);

  switch($method) {
    case 'POST':
      if(array_key_exists('useremail', $data)) {
        $validate_user = new Login( new Users($data), new Database() );
        $result = $validate_user->LogIn();
      } else {
        $result = Login::validateToken( key($data), new Database() );
      }
      break;
    case 'DELETE':
      $result = Login::logOut( key($data), new Database() );
      break;
  }

  if($result) {
    http_response_code(200);
  } else {
    http_response_code(401);
    echo json_encode(["Unauthorized" => "Invalid or empty request. Try again"]);
  }
