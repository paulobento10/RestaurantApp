<?php
/**
* This is the file description
*
* @author Pedro Costa
* @author Paulo Bento
* rota para restaurante 1: engpro.dev
*rota para restaurante2: engprorest.dev
*/
require_once __DIR__ . '/../vendor/autoload.php';

Logger::configure('config.xml');

// Fetch a logger, it will inherit settings from the root logger
$log = Logger::getLogger('myLogger');

// Start logging
//$log->trace("My first message.");   // Not logged because TRACE < WARN
//$log->debug("My second message.");  // Not logged because DEBUG < WARN
//$log->info("My third message.");    // Not logged because INFO < WARN
//$log->warn("My fourth message.");   // Logged because WARN >= WARN
//$log->error("My fifth message.");   // Logged because ERROR >= WARN
//$log->fatal("My sixth message.");   // Logged because FATAL >= WARN

// namespaces
use Silex\Application;
use Silex\Provider\SerializerServiceProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


// create the app
$app = new Silex\Application();

// using for serialize data for xml and json format
$app->register(new SerializerServiceProvider());


/*! \brief Este "try" vai criar a base de dados se ela não existir
* Permitindo assim a segurança de se ela existir não dar erro
*
*/
try {
  //$dbh = new PDO($dsn, 'root', 'root');
  $dbh = new \PDO("mysql:host=localhost;charset=utf8", "root", "root", [
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
  ]);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "CREATE DATABASE IF NOT EXISTS RESTAURANTE";
  $dbh->exec($sql);
  $dbh = new \PDO("mysql:host=localhost;dbname=RESTAURANTE;charset=utf8", "root", "root", [
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
  ]);
  $sql='CREATE TABLE IF NOT EXISTS reservas(
    id int(11) NOT NULL AUTO_INCREMENT,
    nome_utilizador text NOT NULL,
    email_utilizador text NOT NULL,
    telemovel_utilizador int(11) NOT NULL,
    data date NOT NULL,
    hora varchar(64) NOT NULL,
    qtd_pessoas int(11) NOT NULL,
    PRIMARY KEY (id)
  )';
  $dbh->exec($sql);

  $sql='CREATE TABLE IF NOT EXISTS dono (
    id int(11) NOT NULL AUTO_INCREMENT,
    nome TEXT NOT NULL,
    N_id int(11) NOT NULL,
    password TEXT NOT NULL,
    email TEXT NOT NULL,
    telemovel int(11) NOT NULL,
    PRIMARY KEY(id),
    UNIQUE KEY `N_id` (`N_id`)
  )';
  $dbh->exec($sql);

  $sql= 'CREATE TABLE IF NOT EXISTS ementa (
    id int(11) NOT NULL AUTO_INCREMENT,
    produto text NOT NULL,
    tipo varchar(64) NOT NULL,
    preco float NOT NULL,
    extras text NOT NULL,
    PRIMARY KEY (id)
  )';
  $dbh->exec($sql);


  $sql= 'CREATE TABLE IF NOT EXISTS horario (
    id int(11) NOT NULL AUTO_INCREMENT,
    segunda text NOT NULL,
    terca text NOT NULL,
    quarta text NOT NULL,
    quinta text NOT NULL,
    sexta text NOT NULL,
    sabado text NOT NULL,
    domingo text NOT NULL,
    feriados text NOT NULL,
    PRIMARY KEY (id)
  )';
  $dbh->exec($sql);

  $sql= 'CREATE TABLE IF NOT EXISTS restaurante (
    id int(11) NOT NULL AUTO_INCREMENT,
    rota_id int(11) DEFAULT NULL,
    nome text NOT NULL,
    morada text NOT NULL,
    localidade varchar(255) NOT NULL,
    latitude text,
    longitude text,
    rating int(11) DEFAULT NULL,
    img1 blob NOT NULL,
    takeaway int(11) NOT NULL,
    aberto int(11) DEFAULT NULL,
    tipo text NOT NULL,
    tipocomida text NOT NULL,
    ponto_interesse int(11) DEFAULT NULL,
    tags text,
    pequeno_almoco int(11) NOT NULL,
    brunch int(11) NOT NULL,
    link_pagina text,
    telemovel bigint(20) NOT NULL,
    email text NOT NULL,
    count_rating int(11) DEFAULT NULL,
    preco_medio int(11) DEFAULT NULL,
    descricao varchar(255) DEFAULT NULL,
    capacidade int(11) NOT NULL,
    dinheiro tinyint(1) NOT NULL,
    cheque tinyint(1) NOT NULL,
    multibanco tinyint(1) NOT NULL,
    PRIMARY KEY (id)
  )';
  $dbh->exec($sql);
  $log->info("Base de dados criada ou existente.");
  $route="http://engpro.dev";
  $route=json_encode($route);
  $curl = curl_init("http://engprows.dev/add/route");
  curl_setopt($curl, CURLOPT_POST,1);
  curl_setopt($curl, CURLOPT_HEADER, false);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS,$route);
  $response = curl_exec($curl);

} catch (PDOException $e) {
  $log->fatal("ERROR ao criar a base de dados");
  die('Connection failed: ');
}


/**
* Rota teste.
*
*
**/
$app->match('/', function () use ($app, $dbh) {
  $log = Logger::getLogger('myLogger');
  $log->info("READY ws1!!");
  return new Response('Ready!', 200);

})
->method('GET|POST');

$app->post('/new/dono', function(Request $request) use ($app, $dbh) {

  $searchowner= $dbh->prepare('SELECT * FROM dono');
  $searchowner->execute();
  $owner = $searchowner->fetchAll(PDO::FETCH_ASSOC);
  if(empty($owner)){
    $dono = json_decode($request->getContent(), true);
    $sth = $dbh->prepare('INSERT INTO dono (nome,N_id,email,telemovel,password) VALUES (:nome,:N_id,:email,:telemovel,:password)');
    $sth->execute($dono);
    // response, 201 created
    $response = new Response('Ok', 201);
    $log = Logger::getLogger('myLogger');
    $log->info("Dono Registado");
    return $response;
  }
  return $app->json(array("result"=>"dono já atribuido"));
})
->method('GET|POST');

$app->post('/login', function(Request $request) use ($app, $dbh) {
  $log = Logger::getLogger('myLogger');
  $dono = json_decode($request->getContent(), true);
  $sth= $dbh->prepare('SELECT password FROM dono where N_id=:N_id');
  $sth->bindValue(":N_id", (string) $dono['N_id'] , PDO::PARAM_STR);
  $sth->execute();
  $data= $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($data)) {
    $response = new Response('Error', 404);
    return $response;
  }
  $N_id=$dono['N_id'];
  $password=$dono['password'];
  if(password_verify($password,$data[0]['password']))
  {
    $response = new Response('Ok', 201);
    $log->info("Login efetuado");
    return $response;
  }
  $response = new Response('erro- invalido', 404);
  $log->info("Login erro");
  return $response;
})
->method('GET|POST');

/*
* \brief Insere um novo restaurante
*
* Vai inserir o restaurante que o utilizador desejar , permite inserir mais que um.
*/
$app->post('/new/restaurante', function(Request $request) use ($app, $dbh) {

  $searchrest= $dbh->prepare('SELECT * FROM restaurante');
  $searchrest->execute();
  $rest = $searchrest->fetchAll(PDO::FETCH_ASSOC);
  if(empty($rest)){
    $data = json_decode($request->getContent(), true);

    $sth = $dbh->prepare('INSERT INTO restaurante (nome,morada,localidade,img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,descricao,capacidade,dinheiro,cheque,multibanco)
    VALUES(:nome,:morada,:localidade,:img1,:takeaway,:tipo,:tipocomida,:tags,:pequeno_almoco,:brunch,:link_pagina,:telemovel,:email,:preco_medio,:descricao,:dinheiro,:capacidade,:cheque,:multibanco)');
    $sth->bindValue(":nome", (string) $data['nome'] , PDO::PARAM_STR);
    $sth->bindValue(":morada", (string) $data['morada'] , PDO::PARAM_STR);
    $sth->bindValue(":localidade", (string) $data['localidade'] , PDO::PARAM_STR);
    $sth->bindValue(":takeaway", (INT) $data['takeaway'] , PDO::PARAM_INT);
    $sth->bindValue(":tipo", (string) $data['tipo'] , PDO::PARAM_STR);
    $sth->bindValue(":tipocomida", (string) $data['tipocomida'] , PDO::PARAM_STR);
    $sth->bindValue(":tags", (string) $data['tags'] , PDO::PARAM_STR);
    $sth->bindValue(":pequeno_almoco", (int) $data['pequeno_almoco'] , PDO::PARAM_INT);
    $sth->bindValue(":brunch", (int) $data['brunch'] , PDO::PARAM_INT);
    $sth->bindValue(":link_pagina", (string) $data['link_pagina'] , PDO::PARAM_STR);
    $sth->bindValue(":telemovel", (INT) $data['telemovel'] , PDO::PARAM_INT);
    $sth->bindValue(":email", (string) $data['email'] , PDO::PARAM_STR);
    $sth->bindValue(":preco_medio", (float) $data['preco_medio'] , PDO::PARAM_STR);
    $sth->bindValue(":descricao", (string) $data['descricao'] , PDO::PARAM_STR);
    $sth->bindValue(":capacidade", (int) $data['capacidade'] , PDO::PARAM_STR);
    $sth->bindValue(":dinheiro", (int) $data['dinheiro'] , PDO::PARAM_INT);
    $sth->bindValue(":multibanco", (int) $data['multibanco'] , PDO::PARAM_INT);
    $sth->bindValue(":cheque", (int) $data['cheque'] , PDO::PARAM_INT);
    $sth->bindValue(":img1", (string) file_get_contents($data['img1']) , PDO::PARAM_STR);
    $sth->execute();
    // response, 201 created
    $response = new Response('Ok', 201);
    $log = Logger::getLogger('myLogger');
    $log->info("Restaurante criado");
    return $response;
  }
  return $app->json(array("result"=>"já existe um restaurante"));

})
->method('GET|POST');

/*
* \brief Insere Horario para restaurante
*
* Vai inserir o horario para o restaurante que o utilizador desejar e associa-o ao ultimo restauranteque o utilizador inserir pois esta função é armazenada primeiro e devolve o ID na propria.
*/
$app->put('/new/horario', function(Request $request) use ($app, $dbh) {

  $data = json_decode($request->getContent(), true); // load the received json data

  $sth = $dbh->prepare('INSERT INTO horario (segunda, terca, quarta,quinta,sexta,sabado,domingo,feriados)
  VALUES(:segunda,:terca,:quarta,:quinta,:sexta,:sabado,:domingo,:feriados)');
  $sth->execute($data);
  // response, 201 created
  $id = $dbh->lastInsertId();
  $response = new Response("ok", 201);
  $log = Logger::getLogger('myLogger');
  $log->info("Horario criado.");
  return $response;

});


/*
* Definir uma ementa
*/
$app->post('/new/ementa', function (Request $request) use ($app, $dbh) {

  $data = json_decode($request->getContent(), true); // load the received json data
  $sth = $dbh->prepare('INSERT INTO ementa (produto, tipo , preco, extras) VALUES(:produto, :tipo, :preco, :extras)');
  $sth->execute($data);

  // response, 201 created
  $id = $dbh->lastInsertId();
  $response = new Response("ok", 201);
  $log = Logger::getLogger('myLogger');
  $log->info("Ementa criada.");
  return $response;

})
->method('GET|POST');

/*
* Definir Servicos de pagamanto
*
*/
$app->post('/new/pagamento', function (Request $request) use ($app, $dbh) {

  $searchpagamento = $dbh->prepare('SELECT * FROM servicos_pagamento');
  $searchpagamento->execute();
  $pagamento = $searchpagamento->fetchAll(PDO::FETCH_ASSOC);
  if(empty($pagamento)){
    $data = json_decode($request->getContent(), true); // load the received json data
    $sth = $dbh->prepare('INSERT INTO restaurante (dinheiro,multibanco,cheque) VALUES(:dinheiro,:multibanco,:cheque)');
    $sth->execute($data);

    $id = $dbh->lastInsertId();
    $response = new Response($id, 201);
    $log = Logger::getLogger('myLogger');
    $log->info("Metodo de pagamento adicionado.");
    return $response;
  }
  return $app->json(array("result"=>"já existe uma ementa"));
})
->method('GET|POST');



/*
* Nova reserva de restaurante
*
*/
$app->match('/new/reserva', function (Request $request) use ($app, $dbh) {
  $data = json_decode($request->getContent(), true); // load the received json data
  $sth = $dbh->prepare('SELECT capacidade FROM restaurante');
  $sth->execute();
  $capacidade = $sth->fetchAll(PDO::FETCH_ASSOC);
  if($capacidade<$data['qtd_pessoas']) {
    $response = new Response("erro", 201);
    $log = Logger::getLogger('myLogger');
    $log->info("Sem espaço");
    return $response;
  }
  $sth = $dbh->prepare('INSERT INTO reservas (nome_utilizador,email_utilizador,telemovel_utilizador,data,hora, qtd_pessoas) VALUES(:nome,:email,:telemovel,:data,:hora,:qtd_pessoas)');
  $sth->execute($data);
  $sth = $dbh->prepare('UPDATE restaurante SET capacidade=capacidade-:qtd_pessoas');
  $sth->execute(array($data['qtd_pessoas']));

  // response, 201 created
  $id = $dbh->lastInsertId();
  $response = new Response("OK", 201);
  $log = Logger::getLogger('myLogger');
  $log->info("Reserva adicionada");
  return $response;
})
->method('GET|POST');



/*
* Definir o preco
*
* Nota - este preco é o preco_medio, que se encontra na tabela do restaurante
*/
$app->match('/edit/preco/{id}', function (Request $request, $id) use ($app, $dbh) {
  $data = json_decode($request->getContent(), true); // load the received json data
  $sth = $dbh->prepare('UPDATE restaurante SET preco_medio=:preco_medio where id=:id');
  $sth->bindValue(":preco_medio", (int) $data->preco_medio , PDO::PARAM_INT);
  $sth->bindValue(":id", (int) $id , PDO::PARAM_INT);


  $sth->execute($data);
  // response, 201 created
  $id = $dbh->lastInsertId();
  $response = new Response($id, 201);
  $log = Logger::getLogger('myLogger');
  $log->info("Preço adicionado.");
  return $response;
})
->method('GET|POST');



/*
* Definir Descricao
*/
$app->match('/edit/descricao/{id}', function (Request $request, $id) use ($app, $dbh) {
  $data = json_decode($request->getContent(), true); // load the received json data
  $sth = $dbh->prepare('UPDATE restaurante SET descricao=:descricao WHERE id =:id');
  $sth->bindValue(":descricao", (string) $data->descricao , PDO::PARAM_STR);
  $sth->bindValue(":id", (int) $id , PDO::PARAM_INT);

  $sth->execute($data);
  // response, 201 created
  $id = $dbh->lastInsertId();
  $response = new Response($id, 201);
  $log = Logger::getLogger('myLogger');
  $log->info("Descrição definida.");
  return $response;
})
->method('GET|POST');




/*
* Definir localizacao
*/

$app->match('/edit/localizacao/{id}', function (Request $request, $id) use ($app, $dbh) {
  $data = json_decode($request->getContent(), true); // load the received json data
  $sth = $dbh->prepare('UPDATE restaurante SET  localidade=:localidade where id=:id');
  $sth->bindValue(":localizacao", (string) $data->localizacao , PDO::PARAM_STR);
  $sth->bindValue(":id", (int) $id , PDO::PARAM_INT);


  $sth->execute($data);
  // response, 201 created
  $id = $dbh->lastInsertId();
  $response = new Response($id, 201);
  $log = Logger::getLogger('myLogger');
  $log->info("Localização definida.");
  return $response;
})
->method('GET|POST');



$app->put('/edit/restaurante/{id}', function(Request $request, $id) use ($app, $dbh) {
  $data = json_decode($request->getContent(), true);

  $sth = $dbh->prepare('UPDATE restaurante SET nome=:nome,morada=:morada,localidade=:localidade,img1=:img1,takeaway=:takeaway,tipo=:tipo,tipocomida=:tipocomida,tags=:tags,pequeno_almoco=:pequeno_almoco,brunch=:brunch,link_pagina=:link_pagina,telemovel=:telemovel,email=:email,preco_medio=:preco_medio,descricao=:descricao,capacidade=:capacidade WHERE id=:id');
  $sth->bindValue(":id", (int) $id , PDO::PARAM_INT);
  $sth->bindValue(":nome", (string) $data['nome'] , PDO::PARAM_STR);
  $sth->bindValue(":morada", (string) $data['morada'] , PDO::PARAM_STR);
  $sth->bindValue(":localidade", (string) $data['localidade'] , PDO::PARAM_STR);
  $sth->bindValue(":takeaway", (int) $data['takeaway'] , PDO::PARAM_INT);
  $sth->bindValue(":tipo", (string) $data['tipo'] , PDO::PARAM_STR);
  $sth->bindValue(":tipocomida", (string) $data['tipocomida'] , PDO::PARAM_STR);
  $sth->bindValue(":tags", (string) $data['tags'] , PDO::PARAM_STR);
  $sth->bindValue(":pequeno_almoco", (int) $data['pequeno_almoco'] , PDO::PARAM_INT);
  $sth->bindValue(":brunch", (int) $data['brunch'] , PDO::PARAM_INT);
  $sth->bindValue(":link_pagina", (string) $data['link_pagina'] , PDO::PARAM_STR);
  $sth->bindValue(":telemovel", (int) $data['telemovel'] , PDO::PARAM_INT);
  $sth->bindValue(":email", (string) $data['email'] , PDO::PARAM_STR);
  $sth->bindValue(":preco_medio", (float) $data['preco_medio'] , PDO::PARAM_STR);
  $sth->bindValue(":descricao", (string) $data['descricao'] , PDO::PARAM_STR);
  $sth->bindValue(":capacidade", (int) $data['capacidade'] , PDO::PARAM_INT);
  $sth->bindValue(":img1", (string) $data['img1'] , PDO::PARAM_STR);
  $sth->execute();
  $log = Logger::getLogger('myLogger');
  $log->info("restraunte editado");
  $response = new Response("ok", 201);
  return $response;

})->assert('id', '\d+');

// UPDATE de ementa
$app->put('/edit/ementa/{id}', function(Request $request, $id) use ($app, $dbh) {
  $data = json_decode($request->getContent(), true);

  $sth = $dbh->prepare('UPDATE ementa SET produto=:produto, tipo=:tipo, preco=:preco, extras=:extras  WHERE id='.$id);
  $sth->execute($data);
  $log = Logger::getLogger('myLogger');
  $log->info("Ementa editada");
  $response = new Response("ok", 201);
  return $response;

})->assert('id', '\d+');

// update aos metodos de pagamento
$app->put('/edit/pagamento/{id}', function(Request $request, $id) use ($app, $dbh) {
  $data = json_decode($request->getContent(), true);

  $sth = $dbh->prepare('UPDATE restaurante SET dinheiro=:dinheiro, multibanco=:multibanco, cheque=:cheque WHERE id='.$id);
  $sth->execute($data);
  $log = Logger::getLogger('myLogger');
  $log->info("metodo pagamento editado");
  $response = new Response("ok", 201);
  return $response;

})->assert('id', '\d+'); // verify that id is a digit


//update do horario
$app->put('/edit/horario/{id}', function(Request $request, $id) use ($app, $dbh) {
  $data = json_decode($request->getContent(), true);

  $sth = $dbh->prepare('UPDATE horario SET segunda=:segunda, terca=:terca, quarta=:quarta, quinta=:quinta, sexta=:sexta, sabado=:sabado, domingo=:domingo,feriados=:feriados WHERE id='.$id);
  $sth->execute($data);
  $log = Logger::getLogger('myLogger');
  $log->info("Horario editado");
  $response = new Response("ok", 201);
  return $response;

})
->assert('id', '\d+'); // verify that id is a digit



$app->put('/edit/reserva/id/{id}', function (Request $request, $id) use ($app, $dbh) {

  $data = json_decode($request->getContent(), true);
  $sth = $dbh->prepare('SELECT qtd_pessoas FROM reservas where id=:id');
  $sth->execute(array($id));
  $qtd=$sth->fetchAll(PDO::FETCH_ASSOC);
  $sth = $dbh->prepare('SELECT capacidade FROM restaurante');
  $sth->execute();
  $cap=$sth->fetchAll(PDO::FETCH_ASSOC);
  if($cap<$data['qtd_pessoas']) {
    $response = new Response("erro", 201);
    $log = Logger::getLogger('myLogger');
    $log->info("Sem espaço");
    return $response;
  }
  $result=$cap[0]['capacidade']-(abs(($qtd[0]['qtd_pessoas']-$data['qtd_pessoas'])));
  $sth = $dbh->prepare('UPDATE reservas SET nome_utilizador=:nome,email_utilizador=:email,telemovel_utilizador=:telemovel,data=:data,hora=:hora,qtd_pessoas=:qtd_pessoas WHERE id=:id');
  $sth->bindValue(":id", (int) $id , PDO::PARAM_INT);
  $sth->bindValue(":nome", (string) $data['nome'] , PDO::PARAM_STR);
  $sth->bindValue(":email", (string) $data['email'] , PDO::PARAM_STR);
  $sth->bindValue(":telemovel", (int) $data['telemovel'] , PDO::PARAM_INT);
  $sth->bindValue(":hora", (string) $data['hora'] , PDO::PARAM_STR);
  $sth->bindValue(":data", (string) $data['data'] , PDO::PARAM_INT);
  $sth->bindValue(":qtd_pessoas", (int) $data['qtd_pessoas'] , PDO::PARAM_INT);
  $sth->execute();

  $sth = $dbh->prepare('UPDATE restaurante SET capacidade=?');
  $sth->execute(array($result));

  $response = new Response("ok", 201);
  $log = Logger::getLogger('myLogger');
  $log->info("Reserva editada.");
  return $response;

});



/**
* \brief Editar Reserva
*
* Edita a reserva atraves do nome de utlizador
*/
$app->put('/edit/reserva/nome/{user}', function (Request $request, $user) use ($app, $dbh) {

  $data = json_decode($request->getContent(), true);
  $sth = $dbh->prepare('UPDATE reservas SET nome_utilizador=:nome,email_utilizador=:email,telemovel_utilizador=:telemovel,data=:data,hora=:hora,qtd_pessoas=:qtd_pessoas WHERE nome_utilizador=:user');
  $sth->bindValue(":user", (string) $user , PDO::PARAM_STR);
  $sth->execute($data);

  $response = new Response($id, 201);
  $log = Logger::getLogger('myLogger');
  $log->info("Reserva editada.");
  return $response;
});


/**
* \brief Editar Reserva
*
* Edita a reserva atraves do email
*/
$app->put('/edit/reserva/email/{email_user}', function (Request $request, $email_user) use ($app, $dbh) {

  $data = json_decode($request->getContent(), true);
  $sth = $dbh->prepare('UPDATE reservas SET nome_utilizador=:nome,email_utilizador=:email,telemovel_utilizador=:telemovel,data=:data,hora=:hora,qtd_pessoas=:qtd_pessoas  WHERE email_utilizador=:email_user');
  $sth->bindValue(":email_user", (string) $email_user , PDO::PARAM_STR);
  $sth->execute($data);

  $response = new Response($id, 201);
  $log = Logger::getLogger('myLogger');
  $log->info("Reserva editada.");
  return $response;

});


/**
* \brief Editar Reserva
*
* Edita a reserva atraves do telemovel
*/
$app->put('/edit/reserva/telemovel/{telemovel_user}', function (Request $request, $telemovel_user) use ($app, $dbh) {

  $data = json_decode($request->getContent(), true);
  $sth = $dbh->prepare('UPDATE reservas SET nome_utilizador=:nome,email_utilizador=:email,telemovel_utilizador=:telemovel,data=:data,hora=:hora,qtd_pessoas=:qtd_pessoas WHERE telemovel_utilizador=:telemovel_user');
  $sth->bindValue(":telemovel_user", (int) $telemovel_user , PDO::PARAM_INT);
  $sth->execute($data);
  $response = new Response($id, 201);
  $log = Logger::getLogger('myLogger');
  $log->info("Reserva editada.");
  return $response;
});

$app->delete('/del/horario/{id}', function($id) use ($app, $dbh) {

  $sth = $dbh->prepare('DELETE FROM horario WHERE id=:id');
  $sth->bindValue(":id", (int) $id , PDO::PARAM_INT);
  $sth->execute();
  $log = Logger::getLogger('myLogger');
  $log->info("Horario apagado");
  return new Response(null, 204);
})
->assert('id', '\d+');


$app->delete('/del/ementa/{id}', function($id) use ($app, $dbh) {

  $sth = $dbh->prepare('DELETE FROM ementa WHERE id=:id');
  $sth->bindValue(":id", (int) $id , PDO::PARAM_INT);
  $sth->execute();
  $log = Logger::getLogger('myLogger');
  $log->info("Horario apagado");
  return new Response(null, 204);
})
->assert('id', '\d+');


$app->delete('/del/reserva/{id}', function($id) use ($app, $dbh) {

  $sth = $dbh->prepare('SELECT qtd_pessoas FROM reservas where id=:id');
  $sth->execute(array($id));
  $qtd=$sth->fetchAll(PDO::FETCH_ASSOC);
  $sth = $dbh->prepare('SELECT capacidade FROM restaurante');
  $sth->execute();
  $cap=$sth->fetchAll(PDO::FETCH_ASSOC);
  $result=$qtd[0]['qtd_pessoas']+$cap[0]['capacidade'];

  $sth = $dbh->prepare('UPDATE restaurante SET capacidade=?');
  $sth->execute(array($result));
  $sth = $dbh->prepare('DELETE FROM reservas WHERE id=:id');
  $sth->bindValue(":id", (int) $id , PDO::PARAM_INT);
  $sth->execute();
  $log = Logger::getLogger('myLogger');
  $log->info("Reserva apagada");
  return new Response(null, 204);
})
->assert('id', '\d+');



$app->delete('/del/reserva/nome/{nome}', function($resquest,$nome) use ($app, $dbh) {

  $sth = $dbh->prepare('DELETE FROM reservas WHERE nome_utilizador=:nome');
  $sth->bindValue(":nome", (string) $nome , PDO::PARAM__STR);
  $sth->execute();
  $reservas = $sth->fetchAll(PDO::FETCH_ASSOC);
  if($reservas < 1) {
    $log->error("Restaurante inexistente");
    return new Response(" reserva não existe", 404);
  }
  // Retorna que apagou com sucesso
  $log = Logger::getLogger('myLogger');
  $log->info("Reserva apagada");
  return new Response(null, 204);
})
->assert('id', '\d+');

$app->delete('/del/reserva/email/{email}', function($resquest,$email) use ($app, $dbh) {

  $sth = $dbh->prepare('DELETE FROM reservas WHERE email_utilizador=:email');
  $sth->bindValue(":email", (string) $email , PDO::PARAM_STR);
  $sth->execute();
  $reservas = $sth->fetchAll(PDO::FETCH_ASSOC);
  if($reservas < 1) {
    $log->error("Restaurante inexistente");
    return new Response(" reserva não existe", 404);
  }
  // Retorna que apagou com sucesso
  $log = Logger::getLogger('myLogger');
  $log->info("Reserva apagada");
  return new Response(null, 204);
})
->assert('id', '\d+');

$app->delete('/del/reserva/telemovel/{telemovel}', function($resquest,$telemovel) use ($app, $dbh) {

  $sth = $dbh->prepare('DELETE FROM reservas WHERE telemovel_utilizador=:telemovel');
  $sth->bindValue(":telemovel", (int) $telemovel , PDO::PARAM_INT);
  $sth->execute();
  $reservas = $sth->fetchAll(PDO::FETCH_ASSOC);
  if($reservas < 1) {
    $log->error("Restaurante inexistente");
    return new Response(" reserva não existe", 404);
  }
  // Retorna que apagou com sucesso
  $log = Logger::getLogger('myLogger');
  $log->info("Reserva apagada");
  return new Response(null, 204);
})
->assert('id', '\d+');



// DELETE restaurante

$app->delete('/del/restaurante', function() use ($app, $dbh) {

  $delete = $dbh->prepare('TRUNCATE TABLE ementa');
  $delete->execute();
  $delete = $dbh->prepare('TRUNCATE TABLE horario');
  $delete->execute();
  $delete = $dbh->prepare('TRUNCATE TABLE reservas');
  $delete->execute();
  $delete = $dbh->prepare('TRUNCATE TABLE restaurante');
  $delete->execute();
  $log = Logger::getLogger('myLogger');
  $log->info("Restaurante apagada");
  return new Response("restaurante e toda a informação foi apagada", 204);
});

// SELECT
// e.g., curl -X GET -i http://engpro.dev/obtain/id/1
$app->match('/obtain/id', function (Request $resquest) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante');
  $sth->execute();

  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante)) {
    return $app->json(array("result"=>"sem restaurantes"));
  }
  return $app->json($restaurante);
})
// you can use get or post for this route
->value("id", 1) //set a default value
->assert('id', '\d+')
->method('GET|POST'); // verify that id is a digit


$app->match('/obtain/id/{id}', function (Request $resquest,$id) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante where id=?');
  $sth->execute(array($id));

  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante)) {
    return $app->json(array("result"=>"sem restaurantes"));
  }
  return $app->json($restaurante);
})
// you can use get or post for this route
->value("id", 1) //set a default value
->assert('id', '\d+')
->method('GET|POST'); // verify that id is a digit


$app->match('/obtain/nome/{nome}', function (Request $resquest,$nome) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante WHERE nome like ?');
  $nome=explode("+",$nome);
  $nome=implode(" ",$nome);
  $sth->execute(array("%".$nome."%"));

  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante)) {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Retorno de todos os restaurantes com este nome: ".$nome);
  return $app->json($restaurante);
})
->method('GET|POST');

$app->match('/obtain/restaurante/rating', function (Request $resquest) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT rating FROM restaurante');
  $sth->execute();

  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante)) {
    return $app->json(array("result"=>"sem restaurante"));
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Pedido de rating");
  return $app->json($restaurante);
})
->method('GET|POST');



//obtem restaurante com base na localidade
$app->match('/obtain/localidade/{localidade}', function (Request $request, $localidade) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante WHERE localidade = :localidade');
  $sth->bindValue(':localidade', $localidade, PDO::PARAM_STR);
  $sth->execute();

  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante)) {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Retorno de todos os restaurantes com esta localidade: ".$localidade);
  return $app->json($restaurante);
})
->method('GET|POST');

$app->match('/obtain/ementa/', function (Request $resquest) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT * FROM ementa');
  $sth->execute();

  $ementa = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($ementa)) {
    return $app->json(array("result"=>"horario invalido"));
  }
  return $app->json($ementa);
})
->method('GET|POST');

$app->match('/obtain/ementa/id/{id}', function (Request $resquest,$id) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT * FROM ementa where id=:id');
  $sth->execute(array($id));

  $ementa = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($ementa)) {
    return $app->json(array("result"=>"ementa invalido"));
  }
  return $app->json($ementa);
})
->method('GET|POST');


$app->match('/obtain/horario', function (Request $resquest) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT * FROM horario');
  $sth->execute();

  $horario = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($horario)) {
    return $app->json(array("result"=>"horario invalido"));
  }
  return $app->json($horario);
})
->method('GET|POST');


$app->match('/obtain/horario/id/{id}', function (Request $resquest,$id) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT * FROM horario where id=:id');
  $sth->execute(array($id));

  $horario = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($horario)) {
    return $app->json(array("result"=>"horario invalido"));
  }
  return $app->json($horario);
})
->method('GET|POST');


$app->match('/obtain/pagamento', function (Request $resquest) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT id,multibanco,cheque,dinheiro FROM restaurante');
  $sth->execute();

  $pagamento = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($pagamento)) {
    return $app->json(array("result"=>"pagamento invalido"));
  }
  return $app->json($pagamento);
})
->method('GET|POST');


//obtem restaurante com takeaway
$app->match('/obtain/takeaway', function (Request $request) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante WHERE takeaway=1');
  $sth->execute();

  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante)) {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Retorno de todos os restaurantes com takeaway");
  return $app->json($restaurante);
})
->method('GET|POST');

//obtem restaurante com pequeno_almoco
$app->match('/obtain/pequenoalmoco', function (Request $request) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante WHERE pequeno_almoco=1');
  $sth->execute();

  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante)) {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Retorno de todos os restaurantes com pequeno almoco");
  return $app->json($restaurante);
})
->method('GET|POST');

$app->match('/obtain/takeaway/local/{localidade}', function (Request $request,$localidade) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante WHERE takeaway=1 AND localidade=?');
  $sth->execute(array($localidade));

  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante)) {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Retorno de todos os restaurantes com takeaway");
  return $app->json($restaurante);
})
->method('GET|POST');

//rota wildcard - permite pesquisar por tipo de restaurante, tipo de comida
$app->match('/obtain/wildcard/{info}', function (Request $request,$info) use ($app, $dbh) {

  $info=explode("+",$info);
  $info=implode(" ",$info);
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante WHERE tipo LIKE ?');
  $sth->execute(array("%".$info."%"));
  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if (empty($restaurante)) {
    $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante WHERE tipocomida LIKE ?');
    $sth->execute(array("%".$info."%"));
    $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  }
  if (empty($restaurante)) {
    $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante WHERE tags LIKE ?');
    $sth->execute(array("%".$info."%"));
    $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  }
  if (empty($restaurante)) {
    $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante WHERE preco_medio=:info');
    $sth->bindValue(":info", (float) $info , PDO::PARAM_STR);
    $sth->execute();
    $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  }
  if (empty($restaurante)) {
    $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante WHERE descricao like ?');
    $sth->execute(array("%".$info."%"));
    $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  }
  if(empty($restaurante)) {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Retorno de todos os restaurantes do tipo ".$info." ou com tipo de comida ".$info." ou com tags ".$info." ou com preco medio = ".$info);
  return $app->json($restaurante);
})
->method('GET|POST');

/*
* Login de um restaurante
*/
/*$app->match('/login/{id}', function ($id) use ($app, $dbh) {
$sth = $dbh->prepare('SELECT * FROM restaurante WHERE id=?');
$sth->execute(array($id));

$restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
if(empty($restaurante)) {
return $app->json(array("result"=>"restaurante não existe - $id"));
}
return $app->json($restaurante);
})
->value("id", 1) //set a default value
->assert('id', '\d+'); // verify that id is a digit*/


// e.g., curl -X GET http://api.dev/books/xml/1 OR curl -X GET http://api.dev/books/json
/*$app->post("/restauranterand", function (Request $request) use ($app, $dbh) {
$sth = $dbh->prepare('SELECT * FROM restaurante ORDER BY rand() LIMIT 10 ');
$sth->execute();
$restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
return $app->json($restaurante);

});*/


/*$app->get('/restaurantehighrating', function (Request $request) use ($app, $dbh) {
$sth = $dbh->prepare('SELECT * FROM restaurante ORDER BY DESC limit 10');
$sth->execute();
$restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
return $app->json($restaurante);
});*/

//devolve restaurante por localidade
$app->get('/obtain/local/{localidade}', function (Request $request, $localidade) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante where localidade LIKE ?');
  $sth->execute(array("%".$localidade."%"));
  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante))
  {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  return $app->json($restaurante);
})
->method('GET|POST');

$app->get('/obtain/morada/{morada}', function (Request $request, $morada) use ($app, $dbh) {
  //$sth = $dbh->prepare('SELECT * FROM restaurante where morada LIKE ?');
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante WHERE morada LIKE ?');
  $morada=explode("+",$morada);
  $morada=implode(" ",$morada);
  $sth->execute(array("%".$morada."%"));
  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante))
  {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  return $app->json($restaurante);
})
->method('GET|POST');


/*Obter restaurante com um certo tipo de comida*/
$app->match('/obtain/tipocomida/{tipocomida}', function (Request $resquest,$tipocomida) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante WHERE tipocomida=?');
  $sth->execute(array($tipocomida));

  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante)) {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  return $app->json($restaurante);
})
->method('GET|POST');

$app->match('/obtain/tipocomida/local/{tipocomida}/{localidade}', function (Request $resquest,$tipocomida,$localidade) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante WHERE tipocomida=:tipocomida and localidade=:localidade');
  $sth->execute(array($tipocomida));

  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante)) {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  return $app->json($restaurante);
})
->method('GET|POST');

/*Obter restaurante que sao ponto de interesse*/
$app->match('/obtain/pontointeresse', function (Request $resquest,$ponto_interesse) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante WHERE ponto_interesse=1');
  $sth->execute();

  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante)) {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  return $app->json($restaurante);
})
->method('GET|POST');

//obtem imagens de um dado restaurante
$app->match('/obtain/imagens/{id}', function (Request $resquest,$id) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT TO_BASE64(img1) AS img1 FROM restaurante WHERE id=:id');
  $sth->execute(array($id));

  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante)) {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  return $app->json($restaurante);
})
->method('GET|POST');

/*Obter restaurante com um certo preco medio*/
$app->match('/obtain/preco_medio/{preco_medio}', function (Request $resquest,$preco_medio) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante WHERE preco_medio=?');
  $sth->execute(array($preco_medio));

  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante)) {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  return $app->json($restaurante);
})
->method('GET|POST');

/*Obter restaurante de um certo preco tipo*/
$app->match('/obtain/tipo/{tipo}', function (Request $resquest,$tipo) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante WHERE tipo=?');
  $sth->execute(array($tipo));

  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante)) {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  return $app->json($restaurante);
})
->method('GET|POST');

/*verifica se um restaurante está aberto*/
$app->match('/obtain/isopen', function (Request $resquest) use ($app, $dbh) {
  $log = Logger::getLogger('myLogger');
  $sth = $dbh->prepare('SELECT id,aberto,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante');
  $sth->execute();
  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);

  $aberto=0;
  if(empty($restaurante)) {
    $aberto=0;
    $log->info("Sem restaurantes abertos ");
    return $app->json(array("result"=>"restaurante invalido"));
  }
  else {
    $sth = $dbh->prepare('SELECT * FROM horario');
    $sth->execute();
    $horario = $sth->fetchAll(PDO::FETCH_ASSOC);

   $today=date("l");
   if (strcmp($today,"Monday")==0) {
     $today="segunda";
   }
   else if (strcmp($today,"Tuesday")==0) {
     $today="terca";
   }
   else if (strcmp($today,"Wednesday")==0) {
     $today="quarta";
   }
   else if (strcmp($today,"Thursday")==0) {
     $today="quinta";
   }
   else if (strcmp($today,"Fiday")==0) {
     $today="sexta";
   }
   else if (strcmp($today,"Saturday")==0) {
     $today="sabado";
   }
   else if (strcmp($today,"Sunday")==0) {
     $today="domingo";
   }
   else{
     $today="feriado";
   }

    $horario=explode(" ",$horario[0][$today]);
    //$horario=implode("+",$horario);
    date_default_timezone_set("Europe/London");
    $time=date("h:i");
    if(strcmp($horario[0],"00:00")==0){
      $horario[0]="24:00";
    }
    if(strcmp($horario[1],"00:00")==0){
      $horario[1]="24:00";
    }

    if (strtotime($horario[0])<strtotime($time) && strtotime($time)<strtotime($horario[1])) {
      $aberto=1;
      $sth = $dbh->prepare('UPDATE restaurante SET aberto=1');
      $sth->execute();

    }
    else {
      $aberto=0;
      $sth = $dbh->prepare('UPDATE restaurante SET aberto=0');
      $sth->execute();
    }
}
if ($aberto==1) {
  $log->info("Returno de todos os restaurantes abertos");
  return $app->json($restaurante);
}
else {
  $log->info("Sem restaurantes abertos ");
  return $app->json(array("result"=>"restaurante invalido apos pesquisa"));
}
})
->method('GET|POST');

/*verifica se um restaurante está aberto no local desejado*/
$app->match('/obtain/isopen/{localidade}', function (Request $resquest,$localidade) use ($app, $dbh) {
  $log = Logger::getLogger('myLogger');
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante WHERE localidade=:localidade and aberto=1');
  $sth->bindValue(":localidade", (string) $localidade , PDO::PARAM_STR);
  $sth->execute();

  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante)) {
    $log->info("Sem restaurantes abertos ");
    return $app->json(array("result"=>"restaurante invalido"));
  }

  $log->info("Returno de todos os restaurantes abertos");
  return $app->json($restaurante);
})
->method('GET|POST');

//envia uma newsletter para todos os users
/*$app->match('/newsletter',function (Request $resquest) use ($app, $dbh) {
$sth = $dbh->prepare('SELECT nome,email FROM utilizadores');
$sth->execute();

$users = $sth->fetchAll(PDO::FETCH_ASSOC);
if(empty($users)) {
return "error";
}
$send= new Mail();
$send->mail_send_newsletter($users);
return "ok";
})
->method('GET|POST');*/

//adiciona tipo de comida
$app->match('/edit/tipo/{tipo}/{id}', function (Request $resquest,$tipo,$id) use ($app, $dbh) {
  $sth = $dbh->prepare('UPDATE restaurante SET tipo=:tipo where id=:id');
  $sth->bindValue(":tipo", (string) $data->tipo , PDO::PARAM_STR);
  $sth->bindValue(":id", (int) $id , PDO::PARAM_INT);
  $sth->execute();

  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante)) {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  return $app->json($restaurante);
})
->method('GET|POST');

// devolve a informação de restaurante com brunch
$app->match('/obtain/brunch', function (Request $request) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante WHERE brunch=1');
  $sth->execute();

  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante)) {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  return $app->json($restaurante);
})
->method('GET|POST');

//devolve a informação de contacto
$app->match('/obtain/contacto/{id}', function (Request $resquest,$id) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT link_pagina,email,telemovel FROM restaurante WHERE id=?');
  $sth->execute(array($id));

  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante)) {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  return $app->json($restaurante);
})
->method('GET|POST');

//devolve a rating de um determinado restaurante
$app->match('/obtain/rating/{id}', function (Request $resquest ,$id) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT count_rating FROM restaurante WHERE id=?');
  $sth->execute(array($id));

  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante)) {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  return $app->json($restaurante);
})
->method('GET|POST');

// procura restaurante com uma tag identica a tag de procura
$app->match('/obtain/tags/{tags}', function (Request $resquest , $tags) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante WHERE tags LIKE ?');
  //$sth->bindValue(':tags', $tags, PDO::PARAM_STR);
  $sth->execute(array("%".$tags."%"));

  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante)) {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  return $app->json($restaurante);
})
->method('GET|POST');





//devolve restaurante por localidade e brunch
$app->get('/obtain/brunch/local/{localidade}', function (Request $request, $localidade) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante where localidade LIKE ? and brunch=1');
  $sth->execute(array("%".$localidade."%"));
  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante))
  {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  return $app->json($restaurante);
})
->method('GET|POST');

//devolve restaurante por nome e brunch
$app->get('/obtain/brunch/nome/{nome}', function (Request $request, $nome) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante where nome LIKE ? and brunch=1');
  $nome=explode("+",$nome);
  $nome=implode(" ",$nome);
  $sth->execute(array("%".$nome."%"));
  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante))
  {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  return $app->json($restaurante);
})
->method('GET|POST');

//devolve restaurante por nome e takeaway
$app->get('/obtain/takeaway/nome/{nome}', function (Request $request, $nome) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante where nome LIKE ? and takeaway=1');
  $nome=explode("+",$nome);
  $nome=implode(" ",$nome);
  $sth->execute(array("%".$nome."%"));
  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante))
  {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  return $app->json($restaurante);
})
->method('GET|POST');

//devolve restaurante por nome e pequeno almoco
$app->get('/obtain/pequenoalmoco/nome/{nome}', function (Request $request, $nome) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante where nome LIKE ? and pequeno_almoco=1');
  $nome=explode("+",$nome);
  $nome=implode(" ",$nome);
  $sth->execute(array("%".$nome."%"));
  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante))
  {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  return $app->json($restaurante);
})
->method('GET|POST');

//devolve restaurante por localidade e brunch
$app->get('/obtain/brunch/localidade/{localidade}', function (Request $request, $localidade) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante where localidade LIKE ? and brunch=1');
  $sth->execute(array("%".$localidade."%"));
  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante))
  {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  return $app->json($restaurante);
})
->method('GET|POST');

//devolve restaurante por localidade e takeaway
$app->get('/obtain/takeaway/localidade/{localidade}', function (Request $request, $localidade) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante where localidade LIKE ? and takeaway=1');
  $sth->execute(array("%".$localidade."%"));
  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante))
  {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  return $app->json($restaurante);
})
->method('GET|POST');

//devolve restaurante por localidade e pequeno almoco
$app->get('/obtain/pequenoalmoco/localidade/{localidade}', function (Request $request, $localidade) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante where localidade LIKE ? and pequeno_almoco=1');
  $sth->execute(array("%".$localidade."%"));
  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante))
  {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  return $app->json($restaurante);
})
->method('GET|POST');

//devolve restaurante por morada e brunch
$app->get('/obtain/brunch/morada/{morada}', function (Request $request, $morada) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante where morada LIKE ? and brunch=1');
  $morada=explode("+",$morada);
  $morada=implode(" ",$morada);
  $sth->execute(array("%".$morada."%"));
  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante))
  {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  return $app->json($restaurante);
})
->method('GET|POST');

//devolve restaurante por morada e takeaway
$app->get('/obtain/takeaway/morada/{morada}', function (Request $request, $morada) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante where morada LIKE ? and takeaway=1');
  $morada=explode("+",$morada);
  $morada=implode(" ",$morada);
  $sth->execute(array("%".$morada."%"));
  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante))
  {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  return $app->json($restaurante);
})
->method('GET|POST');

//devolve restaurante por morada e pequeno almoco
$app->get('/obtain/pequenoalmoco/morada/{morada}', function (Request $request, $morada) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante where morada LIKE ? and pequeno_almoco=1');
  $morada=explode("+",$morada);
  $morada=implode(" ",$morada);
  $sth->execute(array("%".$morada."%"));
  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante))
  {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  return $app->json($restaurante);
})
->method('GET|POST');

//começo de pesquisa com multiplos padroes com nome
//devolve restaurante por nome e brunch e takeway
$app->get('/obtain/brunch/takeaway/nome/{nome}', function (Request $request, $nome) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante where nome LIKE ? and brunch=1 and takeaway=1');
  $nome=explode("+",$nome);
  $nome=implode(" ",$nome);
  $sth->execute(array("%".$nome."%"));
  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante))
  {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  return $app->json($restaurante);
})
->method('GET|POST');

//devolve restaurante por nome e brunch e pequeno_almoco
$app->get('/obtain/brunch/pequenoalmoco/nome/{nome}', function (Request $request, $nome) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante where nome LIKE ? and brunch=1 and pequeno_almoco=1');
  $nome=explode("+",$nome);
  $nome=implode(" ",$nome);
  $sth->execute(array("%".$nome."%"));
  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante))
  {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  return $app->json($restaurante);
})
->method('GET|POST');

$app->get('/obtain/takeaway/pequenoalmoco/nome/{nome}', function (Request $request, $nome) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante where nome LIKE ? and takeaway=1 and pequeno_almoco=1');
  $sth->execute(array("%".$nome."%"));
  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante))
  {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  return $app->json($restaurante);
})
->method('GET|POST');

$app->get('/obtain/brunch/takeaway/pequenoalmoco/nome/{nome}', function (Request $request, $nome) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante where nome LIKE ? and takeaway=1 and pequeno_almoco=1 and brunch=1');
  $nome=explode("+",$nome);
  $nome=implode(" ",$nome);
  $sth->execute(array("%".$nome."%"));
  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante))
  {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  return $app->json($restaurante);
})
->method('GET|POST');
//fim de pesquisa com multiplos padroes com nome

//começo de pesquisa com multiplos padroes com localidade
//devolve restaurante por nome e brunch e takeway
$app->get('/obtain/brunch/takeaway/localidade/{localidade}', function (Request $request, $localidade) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante where localidade LIKE ? and brunch=1 and takeaway=1');
  $sth->execute(array("%".$localidade."%"));
  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante))
  {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  return $app->json($restaurante);
})
->method('GET|POST');

//devolve restaurante por nome e brunch e pequeno_almoco
$app->get('/obtain/brunch/pequenoalmoco/localidade/{localidade}', function (Request $request, $localidade) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante where localidade LIKE ? and brunch=1 and pequeno_almoco=1');
  $sth->execute(array("%".$localidade."%"));
  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante))
  {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  return $app->json($restaurante);
})
->method('GET|POST');

$app->get('/obtain/takeaway/pequenoalmoco/localidade/{localidade}', function (Request $request, $localidade) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante where localidade LIKE ? and takeaway=1 and pequeno_almoco=1');
  $sth->execute(array("%".$localidade."%"));
  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante))
  {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  return $app->json($restaurante);
})
->method('GET|POST');

$app->get('/obtain/brunch/takeaway/pequenoalmoco/localidade/{localidade}', function (Request $request, $localidade) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante where localidade LIKE ? and takeaway=1 and pequeno_almoco=1 and brunch=1');
  $sth->execute(array("%".$localidade."%"));
  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante))
  {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  return $app->json($restaurante);
})
->method('GET|POST');
//fim de pesquisa com multiplos padroes com localidade


//começo de pesquisa com multiplos padroes com morada
//devolve restaurante por nome e brunch e takeway
$app->get('/obtain/brunch/takeaway/morada/{morada}', function (Request $request, $morada) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante where morada LIKE ? and brunch=1 and takeaway=1');
  $morada=explode("+",$morada);
  $morada=implode(" ",$morada);
  $sth->execute(array("%".$morada."%"));
  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante))
  {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  return $app->json($restaurante);
})
->method('GET|POST');

//devolve restaurante por nome e brunch e pequeno_almoco
$app->get('/obtain/brunch/pequenoalmoco/morada/{morada}', function (Request $request, $morada) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante where morada LIKE ? and brunch=1 and pequeno_almoco=1');
  $morada=explode("+",$morada);
  $morada=implode(" ",$morada);
  $sth->execute(array("%".$morada."%"));
  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante))
  {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  return $app->json($restaurante);
})
->method('GET|POST');

$app->get('/obtain/takeaway/pequenoalmoco/morada/{morada}', function (Request $request, $morada) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante where morada LIKE ? and takeaway=1 and pequeno_almoco=1');
  $morada=explode("+",$morada);
  $morada=implode(" ",$morada);
  $sth->execute(array("%".$morada."%"));
  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante))
  {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  return $app->json($restaurante);
})
->method('GET|POST');

$app->get('/obtain/brunch/takeaway/pequenoalmoco/morada/{morada}', function (Request $request, $morada) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante where morada LIKE ? and takeaway=1 and pequeno_almoco=1 and brunch=1');
  $morada=explode("+",$morada);
  $morada=implode(" ",$morada);
  $sth->execute(array("%".$morada."%"));
  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante))
  {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  return $app->json($restaurante);
})
->method('GET|POST');
//fim de pesquisa com multiplos padroes com morada

//brunch and takeaway sem barra
$app->get('/obtain/brunch/takeaway', function (Request $request) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante where takeaway=1 and brunch=1');
  $sth->execute();
  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante))
  {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  return $app->json($restaurante);
})
->method('GET|POST');

//brunch and pequeno_almoco sem barra
$app->get('/obtain/brunch/pequenoalmoco', function (Request $request) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante where pequeno_almoco=1 and brunch=1');
  $sth->execute();
  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante))
  {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  return $app->json($restaurante);
})
->method('GET|POST');

//takeaway and pequeno_almoco sem barra
$app->get('/obtain/takeaway/pequenoalmoco', function (Request $request) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante where pequeno_almoco=1 and takeaway=1');
  $sth->execute();
  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante))
  {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  return $app->json($restaurante);
})
->method('GET|POST');

//brunch, takeaway e pequeno_almoco
$app->get('/obtain/brunch/takeaway/pequenoalmoco', function (Request $request) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante where takeaway=1 and pequeno_almoco=1 and brunch=1');
  $sth->execute();
  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante))
  {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  return $app->json($restaurante);
})
->method('GET|POST');

//verifica se um restaurante está aberto e serve brunch
$app->match('/obtain/isopen/brunch', function (Request $resquest) use ($app, $dbh) {
  $log = Logger::getLogger('myLogger');
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante WHERE aberto=1 and brunch=1');
  $sth->execute();

  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante)) {
    $log->info("Sem restaurantes abertos ");
    return $app->json(array("result"=>"restaurante invalido"));
  }

  $log->info("Returno de todos os restaurantes abertos e servem brunch");
  return $app->json($restaurante);
})
->method('GET|POST');

/*Obter restaurante que sao ponto de interesse e com brunch*/
$app->match('/obtain/pontointeresse/brunch', function (Request $resquest,$ponto_interesse) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante WHERE ponto_interesse=1 and brunch=1');
  $sth->execute();

  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante)) {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Retorno de todos os restaurantes que sao ponto de interesse e servem brunch");
  return $app->json($restaurante);
})
->method('GET|POST');

/*Restaurante aberto e com takeaway*/
$app->match('/obtain/isopen/takeaway', function (Request $request) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante WHERE aberto=1 and takeaway=1');
  $sth->execute();

  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante)) {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Retorno de todos os restaurantes com takeaway abertos");
  return $app->json($restaurante);
})
->method('GET|POST');

/*Obter restaurante de um certo preco tipo e aberto*/
$app->match('/obtain/isopen/tipo/{tipo}', function (Request $resquest,$tipo) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante WHERE aberto=1 and tipo=?');
  $sth->execute(array($tipo));

  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante)) {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Retorno de todos os restaurantes com um certo tipo e abertos");
  return $app->json($restaurante);
})
->method('GET|POST');


/*Obter restaurante que sao ponto de interesse e aberto*/
$app->match('/obtain/isopenpontointeresse', function (Request $resquest,$ponto_interesse) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT id,rota_id,nome,morada,localidade,TO_BASE64(img1) as img1,takeaway,tipo,tipocomida,tags,pequeno_almoco,brunch,link_pagina,telemovel,email,preco_medio,rating,descricao,capacidade,multibanco,cheque,dinheiro FROM restaurante WHERE aberto=1 and ponto_interesse=1');
  $sth->execute();

  $restaurante = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($restaurante)) {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Retorno de todos os restaurantes que sao ponto de interesse e abertos");
  return $app->json($restaurante);
})
->method('GET|POST');

$app->match('/obtain/reservas/all', function (Request $resquest) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT * FROM reservas');
  $sth->execute();

  $reserva = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($reserva)) {
    return $app->json(array("result"=>"sem reservas"));
  }
  return $app->json($reserva);
})
->method('GET|POST');

$app->match('/obtain/reservas/user/{nome}', function (Request $resquest,$nome) use ($app, $dbh) {

  $sth = $dbh->prepare('SELECT * FROM reservas where nome_utilizador= ?');
  $sth->execute(array($nome));

  $reservas = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($reservas)) {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  return $app->json($reservas);
})
->method('GET|POST');

$app->match('/obtain/reservas/telemovel/{numero}', function (Request $resquest,$numero) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT * FROM reservas where telemovel_utilizador=?');
  $sth->execute(array($telemovel));

  $reservas = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($reservas)) {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  return $app->json($reservas);
})
->method('GET|POST');

$app->match('/obtain/reservas/email/{email}', function (Request $resquest,$email) use ($app, $dbh) {
  $sth = $dbh->prepare('SELECT * FROM reservas where email_utilizador=?');
  $sth->execute(array($email));

  $reservas = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($reservas)) {
    return $app->json(array("result"=>"restaurante invalido"));
  }
  return $app->json($reservas);
})
->method('GET|POST');

$app->match('/obtain/reservas/email/telemovel/nome/{email}/{telemovel}/{nome}', function (Request $resquest,$email,$telemovel,$nome) use ($app, $dbh) {

  $sth = $dbh->prepare('SELECT * FROM reservas where email_utilizador=:email and telemovel_utilizador=:telemovel and nome_utilizador=:nome');
  $sth->bindValue(":telemovel", (string) $telemovel , PDO::PARAM_STR);
  $sth->bindValue(":email", (string) $email , PDO::PARAM_STR);
  $sth->bindValue(":nome", (string) $nome, PDO::PARAM_STR);
  $sth->execute();
  $reservas = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($reservas)) {
    return $app->json(array("result"=>"sem reservas"));
  }
  return $app->json($reservas);
})
->method('GET|POST');


// Modo debug ativo
$app['debug'] = true;
// EXECUTA A API
$app->run();
