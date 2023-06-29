<?php

require_once 'RestApiClient.php';

// use the api to login
$url = "http://localhost:5122/api/login";
$data = array(
  "email" => "admin@teste.com",
  "senha" => "123456"
);
$rest = new RestApiClient($url);
$response = $rest->post($data);
$token = $response['token'];

// use the api to get all funcionarios
$url = "http://localhost:5122/api/funcionario";
$rest = new RestApiClient($url);
$response = $rest->get([], $token);
$funcionarios = $response["funcionarios"];
foreach ($funcionarios as $funcionario) {
  echo $funcionario['nome'] . "<br>";
}

// use the api to get funcionario by id
echo "<br>";
echo "Funcionario com id 7 (troque de acordo com o seu banco, eh apenas um teste): <br>";
$url = "http://localhost:5122/api/funcionario/7";
$rest = new RestApiClient($url);
$response = $rest->get([], $token);
$funcionario = $response["funcionario"];
echo $funcionario["nome"] . "<br>";

// login with wrong password
echo "<br>";
echo "Login com senha errada: <br>";
$url = "http://localhost:5122/api/login";
$data = array(
  "email" => "admin@teste.com",
  "senha" => "123456sdasd"
);
$rest = new RestApiClient($url);
$response = $rest->post($data);
echo $response . "<br>";
?>