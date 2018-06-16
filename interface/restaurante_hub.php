<?php
session_start();
if(!isset($_SESSION['N_id']))
{
  header('location: login.php');
}
?>
<html>
<head>
  <meta charset="utf-8">
  <meta name="description" content="Registo">
  <title>web page of &ndash; Pedro Costa & Paulo Bento &ndash; Pure</title>

  <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/grids-responsive-min.css">
  <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title></title>


</head>

<body>
  <div>
    <div class="header">
      <div class="home-menu pure-menu pure-menu-horizontal pure-menu-fixed">
        <a class="pure-menu-heading" href="">Bem-vindo ! </a>
        <li class="pure-menu-item"><a href="register_restaurante.php" class="pure-button"> Adiconar restaurante </a></li>
        <li class="pure-menu-item"><a href="adicionar_ementa.php" class="pure-button"> Adiconar ementa </a></li>
        <li class="pure-menu-item"><a href="adicionar_horario.php" class="pure-button"> Adiconar Horario </a></li>
      </div>
    </div>

    <div class="content">
      <div class="pure-g">
        <div class="l-box-lrg pure-u-2 pure-u-md-2-5">
          <form class="pure-form pure-form-stacked" method="POST">
            <fieldset>
              <label for="restaurante"> Restaurantes</label>
              <table name="restaurante" class="pure-table pure-table-horizontal" >
                <thead>
                  <tr>
                    <th>nome</th>
                    <th>Morada</th>
                    <th>localidade</th>
                    <th>takeaway</th>
                    <th>tipo de restaurante</th>
                    <th>tipo de comida</th>
                    <th>brunch</th>
                    <th>
                      Pequeno Almoço
                    </th>
                    <th>link_pagina</th>
                    <th>telemovel</th>
                    <th>email</th>
                    <th>preço medio</th>
                    <th>descrição</th>
                    <th>tags</th>
                    <th>capacidade</th>
                    <th>delete</th>
                    <th>EDIT</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $res=file_get_contents("http://engpro.dev/obtain/id");
                  $res=json_decode($res);
                  $size=sizeof($res);
                  if(isset($res->result))
                  {
                    echo '<div class="info">Sem Restaurantes!</div>';
                  }
                  else {
                    for($i=0;$i<$size;$i++)
                    {
                      echo "<tr>";
                      echo "<td>",$res[$i]->nome,"</td>";
                      echo "<td>",$res[$i]->morada,"</td>";
                      echo "<td>",$res[$i]->localidade,"</td>";
                      if($res[$i]->takeaway==1)
                      {
                          echo "<td>Tem serviço</td>";
                      }
                      else {
                            echo "<td>Não tem serviço</td>";
                      }
                      echo "<td>",$res[$i]->tipo,"</td>";
                      echo "<td>",$res[$i]->tipocomida,"</td>";
                      if($res[$i]->brunch==1)
                      {
                          echo "<td>Tem serviço</td>";
                      }
                      else {
                            echo "<td>Não tem serviço</td>";
                      }
                      if($res[$i]->pequeno_almoco==1)
                      {
                          echo "<td>Tem serviço</td>";
                      }
                      else {
                            echo "<td>Não tem serviço</td>";
                      }
                      echo "<td>",$res[$i]->link_pagina,"</td>";
                      echo "<td>",$res[$i]->telemovel,"</td>";
                      echo "<td>",$res[$i]->email,"</td>";
                      echo "<td>",$res[$i]->preco_medio,"</td>";
                      echo "<td>",$res[$i]->descricao,"</td>";
                      echo "<td>",$res[$i]->tags,"</td>";
                      echo "<td>",$res[$i]->capacidade,"</td>";
                      echo "<td>","<a ",'class="pure-button"'," href=delete_restaurante.php?id=",$res[$i]->id,"> X </a></td>";
                      echo "<td>","<a ",'class="pure-button"'," href=edit_restaurante.php?id=",$res[$i]->id,">  Editar </a> </td>";
                      echo "</tr>";
                    }
                  }
                  ?>
                </tbody>
              </table>
              <label for="ementas">Ementas</label>
              <table name="ementas" class="pure-table pure-table-horizontal"  >
                <thead>
                  <tr>
                    <th>Prato/produto</th>
                    <th>Categoria</th>
                    <th>Preco</th>
                    <th>Extras</th>
                    <th>Apagar</th>
                    <th>EDIT</th>
                  </tr>
                </thead>
                <tbody>
                  <?php

                  $res=file_get_contents("http://engpro.dev/obtain/ementa");
                  $res=json_decode($res);
                  $size=sizeof($res);
                  if(isset($res->result))
                  {
                    echo '<div class="info">Sem Ementa!</div>';
                  }
                  else {
                    for($i=0;$i<$size;$i++)
                    {
                      echo "<tr>";
                      echo "<td>",$res[$i]->produto,"</td>";
                      echo "<td>",$res[$i]->tipo,"</td>";
                      echo "<td>",$res[$i]->preco," euros</td>";
                      echo "<td>",$res[$i]->extras,"</td>";
                        echo "<td>","<a ",'class="pure-button"'," href=delete_ementa.php?id=",$res[$i]->id,">  Apagar </a> </td>";
                      echo "<td>","<a ",'class="pure-button"'," href=edit_ementa.php?id=",$res[$i]->id,">  Editar </a> </td>";
                      echo "</tr>";
                    }
                  }?>
                </tbody>
              </table>
              <label for="horario">Horarios</label>
              <table name="horario" class="pure-table pure-table-horizontal"  >
                <thead>
                  <tr>
                    <th>segunda-feira</th>
                    <th>terça-feira</th>
                    <th>quarta-feira</th>
                    <th>quinta-feira</th>
                    <th>sexta-feira</th>
                    <th>sabado</th>
                    <th>domingo</th>
                    <th>feriados</th>
                    <th>Apagar</th>
                    <th>EDIT</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $res=file_get_contents("http://engpro.dev/obtain/horario");
                  $res=json_decode($res);
                  $size=sizeof($res);
                  if(isset($res->result))
                  {
                    echo '<div class="info">Sem Horario!</div>';
                  }
                  else {
                    for($i=0;$i<$size;$i++)
                    {
                      echo "<tr>";
                      echo "<td>",$res[$i]->segunda,"</td>";
                      echo "<td>",$res[$i]->terca,"</td>";
                      echo "<td>",$res[$i]->quarta,"</td>";
                      echo "<td>",$res[$i]->quinta,"</td>";
                      echo "<td>",$res[$i]->sexta,"</td>";
                      echo "<td>",$res[$i]->sabado,"</td>";
                      echo "<td>",$res[$i]->domingo,"</td>";
                      echo "<td>",$res[$i]->feriados,"</td>";
                      echo "<td>","<a ",'class="pure-button"'," href=delete_horario.php?id=",$res[$i]->id,">  Apagar </a> </td>";
                      echo "<td>","<a ",'class="pure-button"'," href=edit_horario.php?id=",$res[$i]->id,">  Editar </a> </td>";
                      echo "</tr>";
                    }
                  }?>
                </tbody>
              </table>
              <label for="pag">Metodos Pagamento</label>
              <table name="pag" class="pure-table pure-table-horizontal"  >
                <thead>
                  <tr>
                    <th>Dinheiro</th>
                    <th>Multibanco</th>
                    <th>Cheque</th>
                    <th>EDITAR</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $res=file_get_contents("http://engpro.dev/obtain/pagamento");
                  $res=json_decode($res);
                  $size=sizeof($res);
                  if(isset($res->result))
                  {
                    echo '<div class="info">Sem Metodos de pagamento!</div>';
                  }
                  else {
                    for($i=0;$i<$size;$i++)
                    {
                      echo "<tr>";
                      if($res[0]->dinheiro==1)
                      {
                        echo "<td> aceita";
                      }
                      else {
                        echo "<td> não aceita";
                      }
                      echo "</td>";
                      if($res[0]->multibanco==1)
                      {
                        echo "<td> aceita";
                      }
                      else {
                        echo "<td> não aceita";
                      }
                      if($res[0]->cheque==1)
                      {
                        echo "<td> aceita";
                      }
                      else {
                        echo "<td> não aceita";
                      }
                      echo "</td>";
                      echo "</td>";
                      echo "<td>","<a ",'class="pure-button"'," href=edit_pagamento.php?id=".$res[0]->id.">Editar</a> </td>";
                      echo "</tr>";
                    }
                  }?>
                </tbody>
              </table>
              <label for="reserva">Reservas</label>
              <table name="reserva" class="pure-table pure-table-horizontal"  >
                <thead>
                  <tr>
                    <th>Nome</th>
                    <th>email</th>
                    <th>telemovel</th>
                    <th>Data</th>
                    <th>Hora</th>
                    <th>Quantidade de pessoas</th>
                    <th>delete</th>
                    <th>EDITAR</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $res=file_get_contents("http://engpro.dev/obtain/reservas/all");
                  $res=json_decode($res);
                  $size=sizeof($res);

                  if(isset($res->result))
                  {
                    echo '<div class="info">Sem Reservas!</div>';
                  }
                  else {
                    for($i=0;$i<$size;$i++)
                    {
                      echo "<tr>";

                      echo "<td>",$res[$i]->nome_utilizador,"</td>";
                      echo "<td>",$res[$i]->email_utilizador,"</td>";
                      echo "<td>",$res[$i]->telemovel_utilizador,"</td>";
                      echo "<td>",$res[$i]->data,"</td>";
                      echo "<td>",$res[$i]->hora,"</td>";
                      echo "<td>",$res[$i]->qtd_pessoas,"</td>";
                      echo "<td>","<a ",'class="pure-button"'," href=delete_reserva.php?id=",$res[$i]->id,"> X </a></td>";
                      echo "<td>","<a ",'class="pure-button"'," href=edit_reserva.php?id=",$res[$i]->id,">  Editar </a> </td>";
                      echo "</tr>";
                    }
                  }?>
                </tbody>
              </table>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
    <div>
      <div class="footer">
        © 2017! Projecto engenharia Pedro Costa Nº: 31179, Paulo Bento Nº 33959
      </div>
    </div>

  </body>
  </html>
