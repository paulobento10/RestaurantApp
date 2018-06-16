<?php
session_start();
if(!isset($_SESSION['username']))
{
  header('location: login.php');
}
$username=$_SESSION['username'];
$id=$_GET['id'];
$rid=$_GET['rid'];
?>

<html>
<head>
	<meta charset="utf-8">
	<meta name="description" content="Edita reserva">
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
			<a class="pure-menu-heading" href="">Bem-vindo! Edite Reserva </a>
			<li class="pure-menu-item"><a href="restaurantews2.php" class="pure-button"> Back </a></li>
		</div>
	</div>
	<div class="content">
		<div class="pure-g">
			<div class="l-box-lrg pure-u-2 pure-u-md-2-5">
				<form class="pure-form pure-form-stacked" method="POST">
					<fieldset>
						<label for="data" style="margin-top: 20px" >Data & hora:</label>

						<input name="data" type="date" class="pure-input-rounded" placeholder="data" <?php echo isset($_POST['data']) ? "value='".$_POST['data']."'":""; ?> required >

						<input name="hora" type="time" class="pure-input-rounded" placeholder="hora" <?php echo isset($_POST['hora']) ? "value='".$_POST['hora']."'":""; ?> required >

            <input name="pessoas" type="int" class="pure-input-rounded" placeholder="Numero de pessoas" <?php echo isset($_POST['pessoas']) ? "value='".$_POST['pessoas']."'":""; ?> required >

					</fieldset>

					<button type="submit" name="send" class="pure-button pure-button-primary">Registar</button>

					<?php
					$userdata=file_get_contents("http://engprows.dev/obtain/user/username/".$username);
					$userdata=json_decode($userdata);
					if(isset($_POST['send'])){
						$data=$_POST['data'];
						$hora=$_POST['hora'];
						$qtd_pessoas=$_POST['pessoas'];

						$data=array(
							"nome"=> $userdata[0]->nome,
							"email"=> $userdata[0]->email,
							"telemovel"=> $userdata[0]->telemovel,
							"data" => $data,
							"hora" => $hora,
							"qtd_pessoas"=> $qtd_pessoas
						);
						$data=json_encode($data);
						$curl=curl_init("http://engprows.dev/reserva/edit/id/".$id."/".$rid);
						curl_setopt($curl, CURLOPT_POST,1);
						curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
						curl_setopt($curl, CURLOPT_POSTFIELDS,$data);
						$response=curl_exec($curl);
						if(strcmp($response,"ok")==0)
						{
							header('location: restaurantews2.php');
						}
						echo $response;

					}
					?>
				</form>
			</div>
		</div>
	</div>
	<div class="footer">
		© 2017! Engenharia Software Pedro Costa Nº: 31179 & Paulo Bento Nº:33959 .
	</div>
</div>
</body>
</html>
