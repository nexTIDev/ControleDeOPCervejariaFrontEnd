<?php

require_once 'RestApiClient.php';

// use the api to login
$url = "http://localhost:5122/api";
$data = array(
  "email" => "admin@teste.com",
  "senha" => "123456"
);
$rest = new RestApiClient($url);
$response = $rest->post("login", $data);
$token = $response['token'];
echo "Token: " . $token . "<br>";

// use the api to get all funcionarios
$response = $rest->get("funcionario", [
  "pagina" => 1,
  "tamanhoPagina" => 10
], $token);
$funcionarios = $response["funcionarios"];
foreach ($funcionarios as $funcionario) {
  echo $funcionario['nome'] . "<br>";
  echo $funcionario['email'] . "<br>";
}

// use the api to get funcionario by id
echo "<br>";
echo "Funcionario com id 7 (troque de acordo com o seu banco, eh apenas um teste): <br>";
$response = $rest->get("funcionario/7", [], $token);
$funcionario = $response["funcionario"];
echo $funcionario["nome"] . "<br>";

// login with wrong password
echo "<br>";
echo "Login com senha errada: <br>";
$data = array(
  "email" => "admin@teste.com",
  "senha" => "123456sdasd"
);
$response = $rest->post("funcionario", $data);
echo $response . "<br>";

// update user
echo "<br>";
echo "Atualizando um funcionário: <br>";
$data = array(
  "Nome" => "Administrador",
  "Email" => "admin@teste.com",
  "Senha" => "123456789",
  "cpf" => 11111111111,
  "cargo" => 1
);
$response = $rest->put("funcionario/7", $data, $token);
echo $response["mensagem"] . "<br>";

// delete user (cuidado ao executar esse codigo)
// echo "<br>";
// echo "Deletando um funcionário: <br>";
// $response = $rest->delete("funcionario/7", $token);
// echo $response["mensagem"] . "<br>";

// get all disabled users
echo "<br>";
echo "Funcionários desabilitados: <br>";
$response = $rest->get("funcionario/desativados", [], $token);
$funcionarios = $response["funcionarios"];
foreach ($funcionarios as $funcionario) {
  echo $funcionario['nome'] . "<br>";
  echo $funcionario['email'] . "<br>";
}

?>