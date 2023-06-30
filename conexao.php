<?php
	$host = "localhost";
    $user = "root";
    $pass = "database2023";
    $banco = "database";
    //Cria a conexao
    $conexao = mysqli_connect($host, $user, $pass)or die (mysqli_error());
    mysqli_select_db($conexao, $banco) or die (mysqli_error());
?>