<?php

  require_once("autoloader.php");
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST,DELETE");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  $method = $_SERVER["REQUEST_METHOD"];

  if(!in_array($method, ['GET'])) {
    http_response_code(405);
    echo json_encode(["error" => "Method $method is not allowed. Use GET to access this end point"]);
    exit;
  }

  if(!array_key_exists("initial", $_GET)) {
    http_response_code(400);
    echo json_encode(["error" => "Bad Request"]);
    exit;
  }

  $initial = (int) $_GET['initial'];
  $token = $_GET['token'];
  $db = new Database();
  $valid = Login::validateToken( $token, $db );

  if(false === $valid) {
    header("Location: /"); //Invalid token, redirect to the login page
    exit;
  }

  $format = new Format( new Students( $db ) );
  $result = $format->createJson($initial);

  if($result) {
    http_response_code(200);
    echo $result;
  } else {
    http_response_code(401);
    echo json_encode(["Unauthorized" => "Invalid or empty request. Try again"]);
  }
