<?php
session_start();

$id=$_GET['id'];
$res=file_get_contents("http://engpro.dev/obtain/id/".$id);
$res=json_decode($res);
$nome=explode(" ",$res[0]->nome);
$nome=implode("+",$nome);

$morada=explode(" ",$res[0]->morada);
$morada=implode("+",$morada);

$descricao=explode(" ",$res[0]->descricao);
$descricao=implode("+",$descricao);


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
      <a class="pure-menu-heading" href="">Bem-vindo! faça a sua Edição </a>
      <li class="pure-menu-item"><a href="restaurante_hub.php" class="pure-button"> Back </a></li>
    </div>
  </div>
  <div class="content">
    <div class="pure-g">
      <div class="l-box-lrg pure-u-2 pure-u-md-2-5">
        <form class="pure-form pure-form-stacked" method="POST">
          <fieldset>
            <label for="username" style="margin-top: 20px" >Registar:</label>

            <label for="nome" style="margin-top: 20px"  >Registar restaurante:</label>

            <input name="nome" type="text" class="pure-input-rounded" value=<?php echo $nome;?> <?php echo isset($_POST['nome']) ? "value='".$_POST['nome']."'":""; ?> required >

            <input name="morada" type="text" class="pure-input-rounded" value=<?php echo $morada;?> <?php echo isset($_POST['morada']) ? "value='".$_POST['morada']."'":""; ?> required >

            <input name="localidade" type="text" class="pure-input-rounded" value=<?php echo $res[0]->localidade;?> <?php echo isset($_POST['localidade']) ? "value='".$_POST['localidade']."'":""; ?> required >

            <input name="imagem1" type="file" class="pure-input-rounded" value=<?php echo $res[0]->img1;?> >

            <select name="takeaway" class="pure-input-1-2" required>
              <option value=<?php echo $res[0]->takeaway;?> >Tem takeaway:</option>
              <option value="1">Sim</option>
              <option value="0">Não</option>
            </select>

            <input name="tipo" type="text" class="pure-input-rounded" value=<?php echo $res[0]->tipo;?>  <?php echo isset($_POST['tipo']) ? "value='".$_POST['tipo']."'":""; ?> required >

            <input name="tipocomida" type="text" class="pure-input-rounded" value=<?php echo $res[0]->tipocomida;?> <?php echo isset($_POST['tipocomida']) ? "value='".$_POST['tipocomida']."'":""; ?> required >

            <select name="pequeno_almoco" class="pure-input-1-2" required>
              <option value=<?php echo $res[0]->pequeno_almoco;?>>Serve pequeno almoço:</option>
              <option value="1">Sim</option>
              <option value="0">Não</option>
            </select>

            <select name="brunch" class="pure-input-1-2" required>
              <option value=<?php echo $res[0]->brunch;?>>Serve Brunch:</option>
              <option value="1">Sim</option>
              <option value="0">Não</option>
            </select>

            <input name="link_pagina" type="text" class="pure-input-rounded" value=<?php echo $res[0]->link_pagina;?> <?php echo isset($_POST['link_pagina']) ? "value='".$_POST['link_pagina']."'":""; ?> required >

            <input name="telemovel" type="text" class="pure-input-rounded" value=<?php echo $res[0]->telemovel;?> <?php echo isset($_POST['telemovel']) ? "value='".$_POST['telemovel']."'":""; ?> required >

            <input name="email" type="text" class="pure-input-rounded" value=<?php echo $res[0]->email;?> <?php echo isset($_POST['email']) ? "value='".$_POST['email']."'":""; ?> required >

            <input name="preco_medio" type="text" class="pure-input-rounded" value=<?php echo $res[0]->preco_medio;?> <?php echo isset($_POST['preco_medio']) ? "value='".$_POST['preco_medio']."'":""; ?> required >

            <input name="descricao" type="text" class="pure-input-rounded" value=<?php echo $descricao;?> <?php echo isset($_POST['descricao']) ? "value='".$_POST['descricao']."'":""; ?> required >

            <input name="capacidade" type="text" class="pure-input-rounded" value=<?php echo $res[0]->capacidade;?> <?php echo isset($_POST['capacidade']) ? "value='".$_POST['capacidade']."'":""; ?> required >

            <input name="tags" type="text" class="pure-input-rounded" value=<?php echo $res[0]->tags;?> <?php echo isset($_POST['tags']) ? "value='".$_POST['tags']."'":""; ?> required >

          </fieldset>

          <button type="submit" name="registo" class="pure-button pure-button-primary">Registar</button>
          <?php

          if(isset($_POST['registo'])){
            $nome=$_POST['nome'];
            $nome=explode("+",$nome);
            $nome=implode(" ",$nome);
            $morada=$_POST['morada'];
            $morada=explode("+",$morada);
            $morada=implode(" ",$morada);
            $localidade=$_POST['localidade'];
            $takeaway=$_POST['takeaway'];
            $tipo=$_POST['tipo'];
            $tipocomida=$_POST['tipocomida'];
            $tags=$_POST['tags'];
            $pequeno_almoco=$_POST['pequeno_almoco'];
            $brunch=$_POST['brunch'];
            $link_pagina=$_POST['link_pagina'];
            $telemovel=$_POST['telemovel'];
            $email=$_POST['email'];
            $preco_medio=$_POST['preco_medio'];
            $descricao=$_POST['descricao'];
            $descricao=explode("+",$descricao);
            $descricao=implode(" ",$descricao);
            $capacidade=$_POST['capacidade'];
            $target_dir = __DIR__."/"."img_res/";
            if(!isset($_POST['imagem1']))
            {
              $target_file_tmp1 =  $target_dir . basename($_FILES["imagem1"]["name"]);
              $info=pathinfo($target_file_tmp1);
              $target_file_tmp1=file_get_contents($target_file_tmp1);
            }
            else {
              $target_file_tmp1=$_POST['imagem1'];
            }
            $data=array(
              "nome" => $nome,
              "morada" => $morada,
              "localidade"=> $localidade,
              "img1" => $target_file_tmp1,
              "takeaway" => $takeaway,
              "tipo" => $tipo,
              "tipocomida" => $tipocomida,
              "tags" => $tags,
              "pequeno_almoco" => $pequeno_almoco,
              "brunch" => $brunch,
              "link_pagina" => $link_pagina,
              "telemovel" => $telemovel,
              "email" => $email,
              "preco_medio" => $preco_medio,
              "descricao" => $descricao,
              "capacidade" => $capacidade
            );
            $data=json_encode($data);
            $curl=curl_init("http://engpro.dev/edit/restaurante/".$id);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST,'PUT');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS,$data);
            $response=curl_exec($curl);
            if(strcmp($response,"ok")==0){
              header("Location: restaurante_hub.php");
            }
            echo $response;
            echo '<div id="erro" class="error">Algo correu mal !</div>';
          }
          ?>
        </form>
      </div>
    </div>
  </div>
  <div class="footer">
    © 2017! Projecto Laboratório Pedro Costa Nº: 31179 & Paulo Bento Nº:33959 .
  </div>
</div>
</body>
</html>
