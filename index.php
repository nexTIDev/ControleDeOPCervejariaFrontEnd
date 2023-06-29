<?php

require_once 'RestApiClient.php';


$url = "http://localhost:5122/api/login";
$data = array(
  "email" => "admin@teste.com",
  "senha" => "1234567"
);

$rest = new RestApiClient($url);
$response = $rest->post($data);
var_dump($response);
?>