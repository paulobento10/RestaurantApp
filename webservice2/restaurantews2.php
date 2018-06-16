<?php
session_start();

if(isset($_SESSION['username']))
{
	$username=$_SESSION['username'];
}


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
			<a class="pure-menu-heading" href="">Pesquisa </a>
			<?php
			if(!isset($username))
			{
				echo '<li class="pure-menu-item"><a href="login.php" class="pure-button"> LOGIN </a></li>';
				echo '<li class="pure-menu-item"><a href="register.php" class="pure-button"> Registar </a></li>';
			}
			else
			{
				echo '<li class="pure-menu-item"><a href="logout.php" class="pure-button"> Logout </a></li>';
				echo '<li class="pure-menu-item"><a href="profile.php" class="pure-button"> Perfil </a></li>';
			}

			?>
		</div>
	</div>
	<div class="content">
		<div class="pure-g">
			<div class="l-box-lrg pure-u-2 pure-u-md-2-5">
				<form class="pure-form pure-form-stacked" action="restaurantews2.php" method="POST">

					<fieldset>
						<label for="username" style="margin-top: 20px" >Pesquisar Restaurante:</label>

						<input name="search" type="text" class="pure-input-rounded" placeholder="ex nome ou morada (começar por rua)" <?php echo isset($_POST['search']) ? "value='".$_POST['search']."'":""; ?> >
						<label for="option-one" class="pure-checkbox"> Brunch:
							<input id="option-one" name="brunch" type="checkbox" value="1">
						</label>
						<label for="takeaway" class="pure-checkbox"> Takeaway:
							<input id="option-one" name="takeaway" type="checkbox" value="1">
						</label>
						<label for="option-one" class="pure-checkbox"> Pequeno-almoco:
							<input id="option-one" name="pequeno_almoco" type="checkbox" value="1">
						</label>

					</fieldset>

					<button type="submit" name="pesquisar" class="pure-button pure-button-primary">Pesquisar</button>
					<label for="restaurante"> Restaurantes</label>
					<table name="restaurante" class="pure-table pure-table-horizontal" >
						<thead>
							<tr>
								<th>Reservar</th>
								<th>Imagem</th>
								<th>Nome</th>
								<th>Morada</th>
								<th>Localidade</th>
								<th>takeaway</th>
								<th>Tipo de restaurante</th>
								<th>Tipo de comida</th>
								<th>Brunch</th>
								<th>Pequeno Almoco</th>
								<th>Link_pagina</th>
								<th>Telemovel</th>
								<th>Email</th>
								<th>Preço medio</th>
								<th>Descrição</th>
								<th>tags</th>
								<th>dinheiro</th>
								<th>multibanco</th>
								<th>cheque</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$rota="";
							if(isset($_POST['pesquisar']))
							{
								if (strcmp($_POST['search'],"")==0 && !isset($_POST['pequeno_almoco']) && !isset($_POST['takeaway']) && !isset($_POST['brunch'])){
									$rota="http://engprows.dev/obtain/all";
								}
								else if(strcmp($_POST['search'],"")==0 && isset($_POST['brunch']) && isset($_POST['takeaway'])&& isset($_POST['pequeno_almoco'])){
									$rota="http://engprows.dev/obtain/brunch/takeaway/pequenoalmoco";
								}
								else if(strcmp($_POST['search'],"")==0 && isset($_POST['brunch']) && !isset($_POST['takeaway']) && !isset($_POST['pequeno_almoco'])) {
									$rota="http://engprows.dev/obtain/brunch";
								}
								else if(strcmp($_POST['search'],"")==0 && isset($_POST['takeaway']) && !isset($_POST['brunch']) && !isset($_POST['pequeno_almoco'])) {
									$rota="http://engprows.dev/obtain/takeaway";
								}
								else if(strcmp($_POST['search'],"")==0 && isset($_POST['pequeno_almoco']) && !isset($_POST['takeaway']) && !isset($_POST['brunch'])) {
									$rota="http://engprows.dev/obtain/pequenoalmoco";
								}
								else if(strcmp($_POST['search'],"")==0 && !isset($_POST['pequeno_almoco']) && isset($_POST['takeaway']) && isset($_POST['brunch'])) {
									$rota="http://engprows.dev/obtain/brunch/takeaway";
								}
								else if(strcmp($_POST['search'],"")==0 && isset($_POST['pequeno_almoco']) && !isset($_POST['takeaway']) && isset($_POST['brunch'])) {
									$rota="http://engprows.dev/obtain/brunch/pequenoalmoco";
								}
								else if(strcmp($_POST['search'],"")==0 && isset($_POST['pequeno_almoco']) && isset($_POST['takeaway']) && !isset($_POST['brunch'])) {
									$rota="http://engprows.dev/obtain/takeaway/pequenoalmoco";
								}
								else if (strcmp($_POST['search'],"")!=0) {
									if(isset($_POST['search']) && substr_compare($_POST['search'],"rua",0,2)==0 && isset($_POST['takeaway']) && isset($_POST['pequeno_almoco']) && isset($_POST['brunch'])){
										$morada_raw=$_POST['search'];
										$morada=explode(" ",$morada_raw);
										$morada=implode("+",$morada);
										$rota="http://engprows.dev/obtain/brunch/takeaway/pequenoalmoco/morada/".$morada;
									}
									else if(isset($_POST['search']) && substr_compare($_POST['search'],"rua",0,2)!=0 && isset($_POST['takeaway']) && isset($_POST['pequeno_almoco'])){
										$localidade_raw=$_POST['search'];
										$localidade=explode(" ",$localidade_raw);
										$localidade=implode("+",$localidade);
										$obj=file_get_contents("http://engprows.dev/localidade/existe/".$localidade);
										if (strcmp($obj,"Ok")==0) {
											$rota="http://engprows.dev/obtain/brunch/takeaway/pequenoalmoco/localidade/".$localidade;
										}else {
											$nome_raw=$_POST['search'];
											$nome=explode(" ",$nome_raw);
											$nome=implode("+",$nome);
											$rota="http://engprows.dev/obtain/brunch/takeaway/pequenoalmoco/nome/".$nome;
										}
									}
									else if(isset($_POST['search']) && substr_compare($_POST['search'],"rua",0,2)!=0 && isset($_POST['brunch']) && isset($_POST['pequeno_almoco'])){
										$localidade_raw=$_POST['search'];
										$localidade=explode(" ",$localidade_raw);
										$localidade=implode("+",$localidade);
										$obj=file_get_contents("http://engprows.dev/localidade/existe/".$localidade);
										if (strcmp($obj,"Ok")==0) {
											$rota="http://engprows.dev/obtain/brunch/pequenoalmoco/localidade/".$localidade;
										}else {
											$nome_raw=$_POST['search'];
											$nome=explode(" ",$nome_raw);
											$nome=implode("+",$nome);
											$rota="http://engprows.dev/obtain/brunch/pequenoalmoco/nome/".$nome;
										}
									}
									else if(isset($_POST['search']) && substr_compare($_POST['search'],"rua",0,2)==0 && isset($_POST['brunch']) && isset($_POST['pequeno_almoco']) && !isset($_POST['takeaway'])){
										$morada_raw=$_POST['search'];
										$morada=explode(" ",$morada_raw);
										$morada=implode("+",$morada);
										$rota="http://engprows.dev/obtain/brunch/pequenoalmoco/morada/".$morada;
									}
									else if(isset($_POST['search']) && substr_compare($_POST['search'],"rua",0,2)==0 && isset($_POST['brunch']) && !isset($_POST['pequeno_almoco']) && !isset($_POST['takeaway'])){
										$morada_raw=$_POST['search'];
										$morada=explode(" ",$morada_raw);
										$morada=implode("+",$morada);
										$rota="http://engprows.dev/obtain/brunch/morada/".$morada;
									}
									else if(isset($_POST['search']) && substr_compare($_POST['search'],"rua",0,2)==0 && isset($_POST['takeaway']) && isset($_POST['pequeno_almoco']) && !isset($_POST['brunch'])){
										$morada_raw=$_POST['search'];
										$morada=explode(" ",$morada_raw);
										$morada=implode("+",$morada);
										$rota="http://engprows.dev/obtain/takeaway/pequenoalmoco/morada/".$morada;
									}
									else if(isset($_POST['search']) && substr_compare($_POST['search'],"rua",0,2)==0 && isset($_POST['takeaway'])){
										$morada_raw=$_POST['search'];
										$morada=explode(" ",$morada_raw);
										$morada=implode("+",$morada);
										$rota="http://engprows.dev/obtain/takeaway/morada/".$morada;
									}
									else if(isset($_POST['search']) && substr_compare($_POST['search'],"rua",0,2)==0 && isset($_POST['pequeno_almoco'])){
										$morada_raw=$_POST['search'];
										$morada=explode(" ",$morada_raw);
										$morada=implode("+",$morada);
										$rota="http://engprows.dev/obtain/pequenoalmoco/morada/".$morada;
									}
									else if(isset($_POST['search']) && substr_compare($_POST['search'],"rua",0,2)!=0 && !isset($_POST['takeaway']) && !isset($_POST['pequeno_almoco']) && !isset($_POST['brunch'])){
										$localidade_raw=$_POST['search'];
										$localidade=explode(" ",$localidade_raw);
										$localidade=implode("+",$localidade);
										$obj=file_get_contents("http://engprows.dev/localidade/existe/".$localidade);
										if (strcmp($obj,"Ok")==0) {
											$rota="http://engprows.dev/obtain/localidade/".$localidade;
										}
										else{
											$nome_raw=$_POST['search'];
											$nome=explode(" ",$nome_raw);
											$nome=implode("+",$nome);
											$rota="http://engprows.dev/obtain/nome/".$nome;
											//$obj=json_decode($obj);
										}
										/*$obj=file_get_contents($rota);
										$obj=json_decode($obj);
										if (empty($obj)) {

									}*/
								}
								else if(isset($_POST['search']) && substr_compare($_POST['search'],"rua",0,2)!=0 && isset($_POST['brunch'])){
									$localidade_raw=$_POST['search'];
									$localidade=explode(" ",$localidade_raw);
									$localidade=implode("+",$localidade);
									$obj=file_get_contents("http://engprows.dev/localidade/existe/".$localidade);
									if (strcmp($obj,"Ok")==0) {
										$rota="http://engprows.dev/obtain/brunch/localidade/".$localidade;
									}else {
										$nome_raw=$_POST['search'];
										$nome=explode(" ",$nome_raw);
										$nome=implode("+",$nome);
										$rota="http://engprows.dev/obtain/brunch/nome/".$nome;
									}
								}
								else if(isset($_POST['search']) && substr_compare($_POST['search'],"rua",0,2)!=0 && isset($_POST['takeaway'])){
									$localidade_raw=$_POST['search'];
									$localidade=explode(" ",$localidade_raw);
									$localidade=implode("+",$localidade);
									$obj=file_get_contents("http://engprows.dev/localidade/existe/".$localidade);
									if (strcmp($obj,"Ok")==0) {
										$rota="http://engprows.dev/obtain/takeaway/localidade/".$localidade;
									}else {
										$nome_raw=$_POST['search'];
										$nome=explode(" ",$nome_raw);
										$nome=implode("+",$nome);
										$rota="http://engprows.dev/obtain/takeaway/nome/".$nome;
									}
								}
								else if(isset($_POST['search']) && substr_compare($_POST['search'],"rua",0,2)!=0 && isset($_POST['pequeno_almoco'])){
									$localidade_raw=$_POST['search'];
									$localidade=explode(" ",$localidade_raw);
									$localidade=implode("+",$localidade);
									$obj=file_get_contents("http://engprows.dev/localidade/existe/".$localidade);
									if (strcmp($obj,"Ok")==0) {
										$rota="http://engprows.dev/obtain/pequenoalmoco/localidade/".$localidade;
									}else {
										$nome_raw=$_POST['search'];
										$nome=explode(" ",$nome_raw);
										$nome=implode("+",$nome);
										$rota="http://engprows.dev/obtain/pequenoalmoco/nome/".$nome;
									}
								}
								else if(isset($_POST['search']) && substr_compare($_POST['search'],"rua",0,2)!=0 && isset($_POST['brunch']) && isset($_POST['takeaway'])){
									$localidade_raw=$_POST['search'];
									$localidade=explode(" ",$localidade_raw);
									$localidade=implode("+",$localidade);
									$obj=file_get_contents("http://engprows.dev/localidade/existe/".$localidade);
									if (strcmp($obj,"Ok")==0) {
										$rota="http://engprows.dev/obtain/brunch/takeaway/localidade/".$localidade;
									}else {
										$nome_raw=$_POST['search'];
										$nome=explode(" ",$nome_raw);
										$nome=implode("+",$nome);
										$rota="http://engprows.dev/obtain/brunch/takeaway/nome/".$nome;
									}

								}
								else if(isset($_POST['search']) && substr_compare($_POST['search'],"rua",0,2)!=0 && isset($_POST['takeaway']) && isset($_POST['pequeno_almoco'])){
									$localidade_raw=$_POST['search'];
									$localidade=explode(" ",$localidade_raw);
									$localidade=implode("+",$localidade);
									$obj=file_get_contents("http://engprows.dev/localidade/existe/".$localidade);
									if (strcmp($obj,"Ok")==0) {
										$rota="http://engprows.dev/obtain/takeaway/pequenoalmoco/localidade/".$localidade;
									}else {
										$nome_raw=$_POST['search'];
										$nome=explode(" ",$nome_raw);
										$nome=implode("+",$nome);
										$rota="http://engprows.dev/obtain/takeaway/pequenoalmoco/nome/".$nome;
									}
								}
								else if(isset($_POST['search']) && substr_compare($_POST['search'],"rua",0,2)!=0 && isset($_POST['takeaway']) && isset($_POST['pequeno_almoco']) && isset($_POST['brunch'])){
									$localidade_raw=$_POST['search'];
									$localidade=explode(" ",$localidade_raw);
									$localidade=implode("+",$localidade);
									$obj=file_get_contents("http://engprows.dev/localidade/existe/".$localidade);
									if (strcmp($obj,"Ok")==0) {
										$rota="http://engprows.dev/obtain/brunch/takeaway/pequenoalmoco/localidade/".$localidade;
									}else {
										$nome_raw=$_POST['search'];
										$nome=explode(" ",$nome_raw);
										$nome=implode("+",$nome);
										$rota="http://engprows.dev/obtain/brunch/takeaway/pequenoalmoco/nome/".$nome;
									}

								}
								else if(isset($_POST['search']) && substr_compare($_POST['search'],"rua",0,2)==0 && isset($_POST['brunch']) && isset($_POST['takeaway'])){
									$morada_raw=$_POST['search'];
									$morada=explode(" ",$morada_raw);
									$morada=implode("+",$morada);
									$rota="http://engprows.dev/obtain/brunch/takeaway/morada/".$morada;
								}
								else if(isset($_POST['search']) && substr_compare($_POST['search'],"rua",0,2)==0 && isset($_POST['brunch']) && isset($_POST['pequeno_almoco']) && !isset($_POST['takeaway'])){
									$morada_raw=$_POST['search'];
									$morada=explode(" ",$morada_raw);
									$morada=implode("+",$morada);
									$rota="http://engprows.dev/obtain/brunch/pequenoalmoco/morada/".$morada;
								}
								else if(isset($_POST['search']) && substr_compare($_POST['search'],"rua",0,2)==0 && isset($_POST['takeaway']) && isset($_POST['pequeno_almoco']) && !isset($_POST['brunch'])){
									$morada_raw=$_POST['search'];
									$morada=explode(" ",$morada_raw);
									$morada=implode("+",$morada);
									$rota="http://engprows.dev/obtain/takeaway/pequenoalmoco/morada/".$morada;
								}
								else if(isset($_POST['search']) && substr_compare($_POST['search'],"rua",0,2)==0 && !isset($_POST['takeaway']) && !isset($_POST['pequeno_almoco']) && !isset($_POST['brunch'])){
									$morada_raw=$_POST['search'];
									$morada=explode(" ",$morada_raw);
									$morada=implode("+",$morada);
									$rota="http://engprows.dev/obtain/morada/".$morada;
								}
								else {
									//echo '<div class="info">Sem Restaurantes!</div>';
									$rota="http://engprows.dev/obtain/all";
								}
							}
							$test=file_get_contents($rota);
							if(strcmp($_POST['search'],"")!=0 && strcmp($test,'[]')==0)
							{
								$wild_raw=$_POST['search'];
								$wild=explode(" ",$wild_raw);
								$wild=implode("+",$wild);
								$rota='http://engprows.dev/obtain/wildcard/'.$wild;
							}
						}
						else
						{
							$rota="http://engprows.dev/obtain/all";
						}
						$obj=file_get_contents($rota);
						$obj=json_decode($obj);
						$size=sizeof($obj);
						if ($size==0) {
							echo '<div class="info">Sem Restaurantes!</div>';
						}
						else {
							for($i=0;$i<$size;$i++)
							{
								if($obj[$i][0]!=null)
								{
									echo "<tr>";
									echo "<td>","<a ",'class="pure-button"'," href=reservar_restaurante.php?id=",$obj[$i][0]->rota_id,">  Reservar </a> </td>";
									echo '<td> <img src="data:image/jpg;base64,'.$obj[$i][0]->img1.'" height="200" width="200" ></td>';
									echo "<td>",$obj[$i][0]->nome,"</td>";
									echo "<td>",$obj[$i][0]->morada,"</td>";
									echo "<td>",$obj[$i][0]->localidade,"</td>";
									if(($obj[$i][0]->takeaway)==1)
									{
										echo '<td>aceita</td>';
									}
									else {
										echo '<td>não aceita</td>';
									}
									echo "<td>",$obj[$i][0]->tipo,"</td>";
									echo "<td>",$obj[$i][0]->tipocomida,"</td>";
									if(($obj[$i][0]->brunch)==1)
									{
										echo '<td>aceita</td>';
									}
									else {
										echo '<td>não aceita</td>';
									}
									if(($obj[$i][0]->pequeno_almoco)==1)
									{
										echo '<td>aceita</td>';
									}
									else {
										echo '<td>não aceita</td>';
									}
									echo "<td>",$obj[$i][0]->link_pagina,"</td>";
									echo "<td>",$obj[$i][0]->telemovel,"</td>";
									echo "<td>",$obj[$i][0]->email,"</td>";
									echo "<td>",$obj[$i][0]->preco_medio,"</td>";
									echo "<td>",$obj[$i][0]->descricao,"</td>";
									echo "<td>",$obj[$i][0]->tags,"</td>";
									if(($obj[$i][0]->dinheiro)==1)
									{
										echo '<td>aceita</td>';
									}
									else {
										echo '<td>não aceita</td>';
									}
									if(($obj[$i][0]->multibanco)==1)
									{
										echo '<td>aceita</td>';
									}
									else {
										echo '<td>não aceita</td>';
									}
									if(($obj[$i][0]->cheque)==1)
									{
										echo '<td>aceita</td>';
									}
									else {
										echo '<td>não aceita</td>';
									}
									echo "</tr>";
								}
							}
						}

						?>
					</tbody>
				</table>

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
