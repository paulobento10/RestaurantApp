<?php
session_start();
if(isset($_SESSION['username']))
{
	$username=$_SESSION['username'];
}

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="description" content="Profile">
	<title>web page of &ndash; Pedro Costa and Paulo Bento &ndash; Pure</title>


	<link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/grids-responsive-min.css">
	<link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<div class="header">
		<div class="home-menu pure-menu pure-menu-horizontal pure-menu-fixed">
			<a class="pure-menu-heading" href="">Bem-vindo ao seu perfil</a>
			<li class="pure-menu-item"><a href="restaurantews2.php" class="pure-button"> Back </a></li>
			<li class="pure-menu-item"><a href="logout.php" class="pure-button"> Logout </a></li>
		</div>
	</div>
	<div class="content">
		<div class="pure-g">
			<div class="l-box-lrg pure-u-2 pure-u-md-2-5">
				<form class="pure-form pure-form-stacked" action="login.php" method="GET">
					<fieldset>
						<?php
						$user=file_get_contents("http://engprows.dev/obtain/user/username/".$username);
						$user=json_decode($user);
						$obj=file_get_contents("http://engprows.dev/obtain/user/reserva/".$user[0]->nome."/".$user[0]->email."/".$user[0]->telemovel);
						$reserva=json_decode($obj);
						foreach ($reserva as $key => $res)
						{
							for($i=0;$i<sizeof($res);$i++)
							{
								if(!isset($res->result))
								{
									$rid=$key+1;
									$re=file_get_contents('http://engprows.dev/obtain/id/'.$rid);
									$re=json_decode($re);
									?>
									<label for="reserva">Reservas</label>
									<table name="reserva" class="pure-table pure-table-horizontal"  >
										<thead>
											<tr>
												<th>Nome do restaurante</th>
												<th>morada do restaurante</th>
												<th>Nome da reserva</th>
												<th>email</th>
												<th>telemovel</th>
												<th>Data</th>
												<th>Hora</th>
												<th>Quantidade pessoas</th>
												<th>delete</th>
												<th>EDITAR</th>
											</tr>
										</thead>
										<tbody>
											<?php
											echo "<tr>";
											echo "<td>",$re[0]->nome,"</td>";
											echo "<td>",$re[0]->morada,"</td>";
											echo "<td>",$res[$i]->nome_utilizador,"</td>";
											echo "<td>",$res[$i]->email_utilizador,"</td>";
											echo "<td>",$res[$i]->telemovel_utilizador,"</td>";
											echo "<td>",$res[$i]->data,"</td>";
											echo "<td>",$res[$i]->hora,"</td>";
											echo "<td>",$res[$i]->qtd_pessoas,"</td>";
											echo "<td>","<a ",'class="pure-button"'," href=delete_reserva.php?rid=".$rid."&id=",$res[$i]->id,"> X </a></td>";
											echo "<td>","<a ",'class="pure-button"'," href=edit_reserva.php?rid=".$rid."&id=",$res[$i]->id,">  Editar </a> </td>";
											echo "</tr>";
											?>
										</tbody>
									</table>
									<?php
								}
							}
						}
						?>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
	<div class="footer">
		© 2017! Engenharia Software Pedro Costa Nº: 31179 & Paulo Bento Nº:33959 .
	</div>
</body>
</html>
