<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="image/x-icon" href="./imagens/favicon.ico">
  <link rel="stylesheet" type="text/css" href="css/estilo.css">
  <link rel="stylesheet" type="text/css" href="css/autenticacao.css">
</head>

<body>

  <div class="loginbox">
    <img src="imagens/user.png" class="avatar">

    <?php
    session_start();

    function rest_call($method, $url, $data = false, $contentType = false, $token = false)
    {
      $curl = curl_init();

      if ($token) { //Add Bearer Token header in the request
        curl_setopt(
          $curl,
          CURLOPT_HTTPHEADER,
          array(
            'Authorization: ' . $token
          )
        );
      }

      switch ($method) {
        case "POST":
          curl_setopt($curl, CURLOPT_POST, 1);
          if ($data) {
            if ($contentType) {
              curl_setopt(
                $curl,
                CURLOPT_HTTPHEADER,
                array(
                  'Content-Type: ' . $contentType
                )
              );
            }
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
          }
          break;
        case "PUT":
          curl_setopt($curl, CURLOPT_PUT, 1);
          break;
        default:
          if ($data)
            $url = sprintf("%s?%s", $url, http_build_query($data));
      }

      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

      $result = curl_exec($curl);

      curl_close($curl);

      return $result;
    }

    $login = $_POST["login"];
    $senha = $_POST["senha"];

    $postData = array("login" => $login, "senha" => $senha);
    $jsonData = json_encode($postData);
    // Send the request
    $url = 'http://localhost:5122/api/login';
    $jsonResponse = rest_call('POST', $url, $jsonData, 'appplication/json');

    //Decode JSON back to PHP object
    $response = json_decode($jsonResponse);
    var_dump($response);

    ?>
  </div>
</body>

</html>