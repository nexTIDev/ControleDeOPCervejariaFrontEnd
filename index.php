<!DOCTYPE html>

<html lang="pt-br">

<head>
<meta charset="utf-8">
<title>Sistema Motions'Beer</title>
<link rel="shortcut icon" type="image/x-icon" href="./imagens/favicon.ico">
<link rel="stylesheet" type="text/css" href="css/estilo.css">
</head>

<style>
	body {
		background: url(./imagens/Cervejaria.jpg)no-repeat;
	}

	@media (max-width: 980px) {

		h1 {
			margin: 0;
			padding: 0 0 70px;
			text-align: center;
			font-size: 2vh;
			line-height: 160px;
		}

		.loginbox {
			width: 66%;
			height: 42%;
			background: #fff;
			color: #344a6d;
			top: 50%;
			left: 50%;
			position: absolute;
			transform: translate(-50%, -50%);
			box-sizing: border-box;
			padding: 70px 30px;
			border-radius: 60px;
		}

		.avatar {
			width: 300px;
			height: 300px;
			border-radius: 50%;
			position: absolute;
			top: -24%;
			left: calc(50% - 150px);
			border: none;
		}

		.loginbox input[type="submit"] {
			border: none;
			outline: none;
			margin-left: 150px;
			width: 300px;
			height: 80px;
			background: #3f3b3c;
			color: #ffffff;
			font-size: 50px;
			border-radius: 20px;
			-webkit-transition: all 0.3s;
			-o-transition: all 0.3s;
		}

		.loginbox input[type="text"],
		input[type="password"] {
			border: none;
			border-bottom: 1px solid #000;
			background: transparent;
			outline: none;
			height: 200px;
			color: #000;
			font-size: 50px;
			text-align: center;
		}

		.loginbox input[type="text"],
		input[type="password"] {
			border: none;
			border-bottom: 1px solid #000;
			background: transparent;
			outline: none;
			height: 80px;
			color: #000;
			font-size: 58px;
			text-align: center;
		}

		.loginbox a {
			text-decoration: none;
			font-size: 36px;
			line-height: 150px;
			color: #000;
		}

		body {
			background: url(./imagens/Cervejaria.jpg) no-repeat;
			background-position: center center;
			/* Centraliza o wallpaper horizontal e verticalmente */
			background-size: cover;
			/* Ajusta o tamanho do wallpaper para cobrir todo o fundo */
		}
	}
</style>

<body>
	<div class="loginbox">
		<img src="imagens/beer.png" class="avatar">
		<h1>Bem vindo a
			Motions'Beer
		</h1>

		<form method="post" action="autenticacao.php">
			<input type="text" name="login" id="login" placeholder="Digite seu login" required>
			<input type="password" name="senha" id="senha" placeholder="Digite sua senha" required>
			<input type="submit" name="" value="Logar">
			<center>
				<p><u><a href="/cervejaria/esqueci.html">Cadastrar</a></u></p>
			</center>
		</form>
	</div>
</body>

</html>