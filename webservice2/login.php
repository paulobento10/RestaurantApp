<?php

include 'send_email_geral.php';

error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ALL & ~WARNING);

session_start();

?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="description" content="login">
	<title>web page of &ndash; Pedro Costa and Paulo Bento &ndash; Pure</title>


	<link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/grids-responsive-min.css">
	<link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title></title>

</head>

<style></style>

<body>
	<div class="header">
		<div class="home-menu pure-menu pure-menu-horizontal pure-menu-fixed">
			<a class="pure-menu-heading" href="">Bem-vindo! faça o seu login</a>
		</div>
	</div>
	<div class="content">
		<div class="pure-g">
			<div class="l-box-lrg pure-u-2 pure-u-md-2-5">
				<form class="pure-form pure-form-stacked" action="login.php" method="POST">
					<fieldset>
						<label for="username" style="margin-top: 20px" >Login:</label>
						<input name="username" type="text" class="pure-input-rounded" placeholder="Usermane" <?php echo isset($_POST['username']) ? "value='" .$_POST['username']."'":""; ?> required >
						<input name="password" type="password" class="pure-input-rounded" placeholder="Password">
						<button type="submit" name="login" class="pure-button pure-button-primary">login</button>
					</fieldset>
				</form>
				<form class="pure-form pure-form-stacked" method="POST">
					<button type="submit" name="login" class="pure-button pure-button-primary">Registar</button>
				</form>
			</div>
		</div>
	</div>
	<?php
	//$user=$_POST['username'];
	if(isset($_POST['login']))
	{

		$data=array(
			"username" => $_POST['username'],
			"password" => $_POST['password']
		);
		$data=json_encode($data);
		$curl=curl_init("http://engprows.dev/login");
		curl_setopt($curl, CURLOPT_POST,1);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS,$data);
		$response=curl_exec($curl);
		if(strcmp($response,"Ok")==0)
		{
			$_SESSION['username']=$_POST['username'];
			header('location: restaurantews2.php');
		}
		echo $response;
	}
	if(isset($_POST['registo']))
	{
		header('location: register.php');
	}
	if(isset($_POST['lost']))
	{
		$pass= new Mail();
		$pass->mail_Send_recover($_POST['username']);
		echo '<div class="success">Verifique o seu email para mais informações!</div>';
	}
	?>
	<div class="footer">
		© 2017! Projecto Laboratório Pedro Costa Nº: 31179 & Paulo Bento Nº:33959 .
	</div>
</div>
</body>
</html>
