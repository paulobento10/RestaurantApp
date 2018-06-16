<?php
/**
* This is the file description
*
* @author Pedro Costa
* @author Paulo Bento
*rota: engprows.dev
*/
require_once __DIR__ . '/../../vendor/autoload.php';
include 'send_email_geral.php';

Logger::configure('../config.xml');

// Fetch a logger, it will inherit settings from the root logger
$log = Logger::getLogger('myLogger');

// Start logging
//$log->trace("My first message.");   // Not logged because TRACE < WARN
//$log->debug("My second message.");  // Not logged because DEBUG < WARN
//$log->info("My third message.");    // Not logged because INFO < WARN
//$log->warn("My fourth message.");   // Logged because WARN >= WARN
//$log->error("My fifth message.");   // Logged because ERROR >= WARN
//$log->fatal("My sixth message.");   // Logged because FATAL >= WARN
//https://maps.googleapis.com/maps/api/place/textsearch/json?query=123+main+street&key=AIzaSyCUurf3xzUF_u3-3HIVNOPkXQOebQPJHdQ
//

// namespaces
use Silex\Application;
use Silex\Provider\SerializerServiceProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


// create the app
$app = new Silex\Application();

// using for serialize data for xml and json format
$app->register(new SerializerServiceProvider());

try {

  $dbh = new \PDO("mysql:host=localhost;dbname=USERS;charset=utf8", "root", "root", [
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
  ]);
  $log->info("Base de dados criada ou existente.");
} catch (PDOException $e) {
  $log->fatal("ERROR ao criar a base de dados");
  die('Connection failed: ');
}

/**
* \brief Esta é uma rota de teste
*
* Apresenta a mensagem Ready se tudo estiver operacional
*/
$app->match('/', function () use ($app, $dbh) {
  $log = Logger::getLogger('myLogger');
  $log->info("READY ws2!!");
  return new Response('Ready!', 200);
})
->method('GET|POST');

$app->match('/add/route', function (request $request) use ($app, $dbh) {
  $route=json_decode($request->getContent(),true);
  $search = $dbh->prepare('SELECT id FROM restaurante where rota=?');
  $search->execute(array($route));
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  if(empty($rota))
  {
    $sth= $dbh->prepare('INSERT INTO restraunte (rota) values (?)');
    $search->execute(array($route));
    $log = Logger::getLogger('myLogger');
    $log->info("rota gravada");
    return new Response('Inserted', 200);
  }

  $log = Logger::getLogger('myLogger');
  $log->info("rota já gravada");
  return new Response('Ready', 200);
})
->method('GET|POST');

/**
* \brief Restaurantes com brunch
*
* Devolve todos os restaurantes com brunch
*/
$app->match('/obtain/wildcard/{info}', function (Request $request, $info) use ($app,$dbh) {

  $delivery = array();
  $search = $dbh->prepare('SELECT rota FROM restaurante');
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $size=sizeof($rota);

  for($i=0;$i<$size;$i++)
  {
    $path=$rota[$i]['rota']."/obtain/wildcard/".$info;
    $data= file_get_contents($path);
    $data=json_decode($data);
    if(!isset($data->result))
    {
      $delivery[]=$data;
    }
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Restaurantes do tipo ".$info." ou com tipo de comida ".$info." ou com tags ".$info." ou com preco medio = ".$info);
  $delivery=json_encode($delivery);
  return $delivery;
})
->method('GET|POST');

/**
* \brief Restaurantes com brunch
*
* Devolve todos os restaurantes com brunch
*/
$app->match('/obtain/brunch', function (Request $request) use ($app,$dbh) {

  $delivery = array();
  $search = $dbh->prepare('SELECT rota FROM restaurante');
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $size=sizeof($rota);

  for($i=0;$i<$size;$i++)
  {
    $path=$rota[$i]['rota']."/obtain/brunch";
    $data= file_get_contents($path);
    $data=json_decode($data);
    if(!isset($data->result))
    {
      $delivery[]=$data;
    }
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Restaurantes com brunch");
  $delivery=json_encode($delivery);
  return $delivery;
})
->method('GET|POST');

/**
* \brief Restaurantes com brunch
*
* Devolve todos os restaurantes com este nome e brunch
*/
$app->match('/obtain/brunch/nome/{nome}', function (Request $request, $nome) use ($app,$dbh) {

  $delivery = array();
  $search = $dbh->prepare('SELECT rota FROM restaurante');
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $size=sizeof($rota);

  for($i=0;$i<$size;$i++)
  {
    $path=$rota[$i]['rota']."/obtain/brunch/nome/".$nome;
    $data= file_get_contents($path);
    $data=json_decode($data);
    if(!isset($data->result))
    {
      $delivery[]=$data;
    }
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Restaurantes ".$nome." com brunch");
  $delivery=json_encode($delivery);
  return $delivery;
})
->method('GET|POST');

/**
* \brief Restaurantes com takeaway
*
* Devolve todos os restaurantes com este nome e takeaway
*/
$app->match('/obtain/takeaway/nome/{nome}', function (Request $request, $nome) use ($app,$dbh) {

  $delivery = array();
  $search = $dbh->prepare('SELECT rota FROM restaurante');
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $size=sizeof($rota);

  for($i=0;$i<$size;$i++)
  {
    $path=$rota[$i]['rota']."/obtain/takeaway/nome/".$nome;
    $data= file_get_contents($path);
    $data=json_decode($data);
    if(!isset($data->result))
    {
      $delivery[]=$data;
    }
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Restaurantes ".$nome." com takeaway");
  $delivery=json_encode($delivery);
  return $delivery;
})
->method('GET|POST');

/**
* \brief Restaurantes com takeaway
*
* Devolve todos os restaurantes com este nome e takeaway
*/
$app->match('/obtain/pequenoalmoco/nome/{nome}', function (Request $request, $nome) use ($app,$dbh) {

  $delivery = array();
  $search = $dbh->prepare('SELECT rota FROM restaurante');
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $size=sizeof($rota);

  for($i=0;$i<$size;$i++)
  {
    $path=$rota[$i]['rota']."/obtain/pequenoalmoco/nome/".$nome;
    $data= file_get_contents($path);
    $data=json_decode($data);
    if(!isset($data->result))
    {
      $delivery[]=$data;
    }
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Restaurantes ".$nome." com pequeno almoço");
  $delivery=json_encode($delivery);
  return $delivery;
})
->method('GET|POST');

/**
* \brief Restaurantes com brunch
*
* Devolve todos os restaurantes com ests localidade e brunch
*/
$app->match('/obtain/brunch/localidade/{localidade}', function (Request $request, $localidade) use ($app,$dbh) {

  $delivery = array();
  $search = $dbh->prepare('SELECT rota FROM restaurante');
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $size=sizeof($rota);

  for($i=0;$i<$size;$i++)
  {
    $path=$rota[$i]['rota']."/obtain/brunch/localidade/".$localidade;
    $data= file_get_contents($path);
    $data=json_decode($data);
    if(!isset($data->result))
    {
      $delivery[]=$data;
    }
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Restaurantes em ".$localidade." com brunch");
  $delivery=json_encode($delivery);
  return $delivery;
})
->method('GET|POST');

/**
* \brief Restaurantes com takeaway
*
* Devolve todos os restaurantes com esta localidade e takeaway
*/
$app->match('/obtain/takeaway/localidade/{localidade}', function (Request $request, $localidade) use ($app,$dbh) {

  $delivery = array();
  $search = $dbh->prepare('SELECT rota FROM restaurante');
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $size=sizeof($rota);

  for($i=0;$i<$size;$i++)
  {
    $path=$rota[$i]['rota']."/obtain/takeaway/localidade/".$localidade;
    $data= file_get_contents($path);
    $data=json_decode($data);
    if(!isset($data->result))
    {
      $delivery[]=$data;
    }
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Restaurantes em ".$localidade." com takeaway");
  $delivery=json_encode($delivery);
  return $delivery;
})
->method('GET|POST');

/**
* \brief Restaurantes com pequeno almoco
*
* Devolve todos os restaurantes com esta localidade e pequeno almoco
*/
$app->match('/obtain/pequenoalmoco/localidade/{localidade}', function (Request $request, $localidade) use ($app,$dbh) {

  $delivery = array();
  $search = $dbh->prepare('SELECT rota FROM restaurante');
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $size=sizeof($rota);

  for($i=0;$i<$size;$i++)
  {
    $path=$rota[$i]['rota']."/obtain/pequenoalmoco/localidade/".$localidade;
    $data= file_get_contents($path);
    $data=json_decode($data);
    if(!isset($data->result))
    {
      $delivery[]=$data;
    }
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Restaurantes em ".$localidade." com pequeno");
  $delivery=json_encode($delivery);
  return $delivery;
})
->method('GET|POST');

/**
* \brief Restaurantes com brunch
*
* Devolve todos os restaurantes com esta morada e brunch
*/
$app->match('/obtain/brunch/morada/{morada}', function (Request $request, $morada) use ($app,$dbh) {

  $delivery = array();
  $search = $dbh->prepare('SELECT rota FROM restaurante');
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $size=sizeof($rota);
  $morada=explode(" ",$morada);
  $morada=implode("+",$morada);
  for($i=0;$i<$size;$i++)
  {
    $path=$rota[$i]['rota']."/obtain/brunch/morada/".$morada;
    $data= file_get_contents($path);
    $data=json_decode($data);
    if(!isset($data->result))
    {
      $delivery[]=$data;
    }
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Restaurantes em ".$morada." com brunch");
  $delivery=json_encode($delivery);
  return $delivery;
})
->method('GET|POST');

/**
* \brief Restaurantes com takeaway
*
* Devolve todos os restaurantes com esta morada e takeaway
*/
$app->match('/obtain/takeaway/morada/{morada}', function (Request $request, $morada) use ($app,$dbh) {

  $delivery = array();
  $search = $dbh->prepare('SELECT rota FROM restaurante');
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $size=sizeof($rota);
  $morada=explode(" ",$morada);
  $morada=implode("+",$morada);
  for($i=0;$i<$size;$i++)
  {
    $path=$rota[$i]['rota']."/obtain/takeaway/morada/".$morada;
    $data= file_get_contents($path);
    $data=json_decode($data);
    if(!isset($data->result))
    {
      $delivery[]=$data;
    }
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Restaurantes em ".$morada." com takeaway");
  $delivery=json_encode($delivery);
  return $delivery;
})
->method('GET|POST');


/**
* \brief Restaurantes com takeway
*
* Devolve todos os restaurantes com esta morada e takeway
*/
$app->match('/obtain/pequenoalmoco/morada/{morada}', function (Request $request, $morada) use ($app,$dbh) {

  $delivery = array();
  $search = $dbh->prepare('SELECT rota FROM restaurante');
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $size=sizeof($rota);
  $morada=explode(" ",$morada);
  $morada=implode("+",$morada);
  for($i=0;$i<$size;$i++)
  {
    $path=$rota[$i]['rota']."/obtain/pequenoalmoco/morada/".$morada;
    $data= file_get_contents($path);
    $data=json_decode($data);
    if(!isset($data->result))
    {
      $delivery[]=$data;
    }
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Restaurantes em ".$morada." com pequeno almoco");
  $delivery=json_encode($delivery);
  return $delivery;
})
->method('GET|POST');

//começo de pesquisa com multiplos padroes com nome
/**
* \brief Restaurantes com takeaway e brunch
*
* Devolve todos os restaurantes com este nome brunch e takeway
*/
$app->match('/obtain/brunch/takeaway/nome/{nome}', function (Request $request, $nome) use ($app,$dbh) {

  $delivery = array();
  $search = $dbh->prepare('SELECT rota FROM restaurante');
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $size=sizeof($rota);

  for($i=0;$i<$size;$i++)
  {
    $path=$rota[$i]['rota']."/obtain/brunch/takeaway/nome/".$nome;
    $data= file_get_contents($path);
    $data=json_decode($data);
    if(!isset($data->result))
    {
      $delivery[]=$data;
    }
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Restaurantes ".$nome." com brunch e takeaway");
  $delivery=json_encode($delivery);
  return $delivery;
})
->method('GET|POST');

/**
* \brief Restaurantes com brunch e pequeno almoco
*
* Devolve todos os restaurantes com esta morada e takeway
*/
$app->match('/obtain/brunch/pequenoalmoco/nome/{nome}', function (Request $request, $nome) use ($app,$dbh) {

  $delivery = array();
  $search = $dbh->prepare('SELECT rota FROM restaurante');
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $size=sizeof($rota);

  for($i=0;$i<$size;$i++)
  {
    $path=$rota[$i]['rota']."/obtain/brunch/pequenoalmoco/nome/".$nome;
    $data= file_get_contents($path);
    $data=json_decode($data);
    if(!isset($data->result))
    {
      $delivery[]=$data;
    }
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Restaurantes ".$nome." com brunch e pequeno almoco");
  $delivery=json_encode($delivery);
  return $delivery;
})
->method('GET|POST');

/**
* \brief Restaurantes com takeaway e pequeno almoco
*
* Devolve todos os restaurantes com este nome pequeno almoco e takeaway
*/
$app->match('/obtain/takeaway/pequenoalmoco/nome/{nome}', function (Request $request, $nome) use ($app,$dbh) {

  $delivery = array();
  $search = $dbh->prepare('SELECT rota FROM restaurante');
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $size=sizeof($rota);

  for($i=0;$i<$size;$i++)
  {
    $path=$rota[$i]['rota']."/obtain/takeaway/pequenoalmoco/nome/".$nome;
    $data= file_get_contents($path);
    $data=json_decode($data);
    if(!isset($data->result))
    {
      $delivery[]=$data;
    }
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Restaurantes ".$nome." com takeaway e pequeno almoco");
  $delivery=json_encode($delivery);
  return $delivery;
})
->method('GET|POST');

/**
* \brief Restaurantes com takeaway, pequeno almoco e brunch
*
* Devolve todos os restaurantes com este nome pequeno almoco, takeaway e brunch
*/
$app->match('/obtain/brunch/takeaway/pequenoalmoco/nome/{nome}', function (Request $request, $nome) use ($app,$dbh) {

  $delivery = array();
  $search = $dbh->prepare('SELECT rota FROM restaurante');
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $size=sizeof($rota);

  for($i=0;$i<$size;$i++)
  {
    $path=$rota[$i]['rota']."/obtain/brunch/takeaway/pequenoalmoco/nome/".$nome;
    $data= file_get_contents($path);
    $data=json_decode($data);
    if(!isset($data->result))
    {
      $delivery[]=$data;
    }
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Restaurantes ".$nome." com brunch, pequeno almoco e takeaway");
  $delivery=json_encode($delivery);
  return $delivery;
})
->method('GET|POST');
//fim de pesquisa com multiplos padroes com nome

//começo de pesquisa com multiplos padroes com localidade
/**
* \brief Restaurantes com takeaway e brunch
*
* Devolve todos os restaurantes com este nome brunch e takeway
*/
$app->match('/obtain/brunch/takeaway/localidade/{localidade}', function (Request $request, $localidade) use ($app,$dbh) {

  $delivery = array();
  $search = $dbh->prepare('SELECT rota FROM restaurante');
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $size=sizeof($rota);

  for($i=0;$i<$size;$i++)
  {
    $path=$rota[$i]['rota']."/obtain/brunch/takeaway/localidade/".$localidade;
    $data= file_get_contents($path);
    $data=json_decode($data);
    if(!isset($data->result))
    {
      $delivery[]=$data;
    }
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Restaurantes em".$localidade." com brunch e takeaway");
  $delivery=json_encode($delivery);
  return $delivery;
})
->method('GET|POST');

/**
* \brief Restaurantes com brunch e pequeno almoco
*
* Devolve todos os restaurantes com esta morada e takeway
*/
$app->match('/obtain/brunch/pequenoalmoco/localidade/{localidade}', function (Request $request, $localidade) use ($app,$dbh) {

  $delivery = array();
  $search = $dbh->prepare('SELECT rota FROM restaurante');
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $size=sizeof($rota);

  for($i=0;$i<$size;$i++)
  {
    $path=$rota[$i]['rota']."/obtain/brunch/pequenoalmoco/localidade/".$localidade;
    $data= file_get_contents($path);
    $data=json_decode($data);
    if(!isset($data->result))
    {
      $delivery[]=$data;
    }
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Restaurantes em ".$localidade." com brunch e pequeno almoco");
  $delivery=json_encode($delivery);
  return $delivery;
})
->method('GET|POST');

/**
* \brief Restaurantes com takeaway e pequeno almoco
*
* Devolve todos os restaurantes com este nome pequeno almoco e takeaway
*/
$app->match('/obtain/takeaway/pequenoalmoco/localidade/{localidade}', function (Request $request, $localidade) use ($app,$dbh) {

  $delivery = array();
  $search = $dbh->prepare('SELECT rota FROM restaurante');
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $size=sizeof($rota);

  for($i=0;$i<$size;$i++)
  {
    $path=$rota[$i]['rota']."/obtain/takeaway/pequenoalmoco/localidade/".$localidade;
    $data= file_get_contents($path);
    $data=json_decode($data);
    if(!isset($data->result))
    {
      $delivery[]=$data;
    }
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Restaurantes em ".$localidade." com takeaway e pequeno almoco");
  $delivery=json_encode($delivery);
  return $delivery;
})
->method('GET|POST');

/**
* \brief Restaurantes com takeaway, pequeno almoco e brunch
*
* Devolve todos os restaurantes com este nome pequeno almoco, takeaway e brunch
*/
$app->match('/obtain/brunch/takeaway/pequenoalmoco/localidade/{localidade}', function (Request $request, $localidade) use ($app,$dbh) {

  $delivery = array();
  $search = $dbh->prepare('SELECT rota FROM restaurante');
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $size=sizeof($rota);

  for($i=0;$i<$size;$i++)
  {
    $path=$rota[$i]['rota']."/obtain/brunch/takeaway/pequenoalmoco/localidade/".$localidade;
    $data= file_get_contents($path);
    $data=json_decode($data);
    if(!isset($data->result))
    {
      $delivery[]=$data;
    }
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Restaurantes em ".$localidade." com brunch, pequeno almoco e takeaway");
  $delivery=json_encode($delivery);
  return $delivery;
})
->method('GET|POST');
//fim de pesquisa com multiplos padroes com localidade

//começo de pesquisa com multiplos padroes com morada
/**
* \brief Restaurantes com takeaway e brunch
*
* Devolve todos os restaurantes com este nome brunch e takeway
*/
$app->match('/obtain/brunch/takeaway/morada/{morada}', function (Request $request, $morada) use ($app,$dbh) {

  $delivery = array();
  $search = $dbh->prepare('SELECT rota FROM restaurante');
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $size=sizeof($rota);
  $morada=explode(" ",$morada);
  $morada=implode("+",$morada);
  for($i=0;$i<$size;$i++)
  {
    $path=$rota[$i]['rota']."/obtain/brunch/takeaway/morada/".$morada;
    $data= file_get_contents($path);
    $data=json_decode($data);
    if(!isset($data->result))
    {
      $delivery[]=$data;
    }
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Restaurantes em".$morada." com brunch e takeaway");
  $delivery=json_encode($delivery);
  return $delivery;
})
->method('GET|POST');

/**
* \brief Restaurantes com brunch e pequeno almoco
*
* Devolve todos os restaurantes com esta morada e takeway
*/
$app->match('/obtain/brunch/pequenoalmoco/morada/{morada}', function (Request $request, $morada) use ($app,$dbh) {

  $delivery = array();
  $search = $dbh->prepare('SELECT rota FROM restaurante');
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $size=sizeof($rota);
  $morada=explode(" ",$morada);
  $morada=implode("+",$morada);
  for($i=0;$i<$size;$i++)
  {
    $path=$rota[$i]['rota']."/obtain/brunch/pequenoalmoco/morada/".$morada;
    $data= file_get_contents($path);
    $data=json_decode($data);
    if(!isset($data->result))
    {
      $delivery[]=$data;
    }
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Restaurantes em ".$morada." com brunch e pequeno almoco");
  $delivery=json_encode($delivery);
  return $delivery;
})
->method('GET|POST');

/**
* \brief Restaurantes com takeaway e pequeno almoco
*
* Devolve todos os restaurantes com este nome pequeno almoco e takeaway
*/
$app->match('/obtain/takeaway/pequenoalmoco/morada/{morada}', function (Request $request, $morada) use ($app,$dbh) {

  $delivery = array();
  $search = $dbh->prepare('SELECT rota FROM restaurante');
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $size=sizeof($rota);
  $morada=explode(" ",$morada);
  $morada=implode("+",$morada);
  for($i=0;$i<$size;$i++)
  {
    $path=$rota[$i]['rota']."/obtain/takeaway/pequenoalmoco/morada/".$morada;
    $data= file_get_contents($path);
    $data=json_decode($data);
    if(!isset($data->result))
    {
      $delivery[]=$data;
    }
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Restaurantes em ".$morada." com takeaway e pequeno almoco");
  $delivery=json_encode($delivery);
  return $delivery;
})
->method('GET|POST');

/**
* \brief Restaurantes com takeaway, pequeno almoco e brunch
*
* Devolve todos os restaurantes com este nome pequeno almoco, takeaway e brunch
*/
$app->match('/obtain/brunch/takeaway/pequenoalmoco/morada/{morada}', function (Request $request, $morada) use ($app,$dbh) {

  $delivery = array();
  $search = $dbh->prepare('SELECT rota FROM restaurante');
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $size=sizeof($rota);
  $morada=explode(" ",$morada);
  $morada=implode("+",$morada);
  for($i=0;$i<$size;$i++)
  {
    $path=$rota[$i]['rota']."/obtain/brunch/takeaway/pequenoalmoco/morada/".$morada;
    $data= file_get_contents($path);
    $data=json_decode($data);
    if(!isset($data->result))
    {
      $delivery[]=$data;
    }
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Restaurantes em ".$morada." com brunch, pequeno almoco e takeaway");
  $delivery=json_encode($delivery);
  return $delivery;
})
->method('GET|POST');
//fim de pesquisa com multiplos padroes com morada

/**
* \brief Restaurantes com takeaway,e brunch
*
* Devolve todos os restaurantes takeaway e brunch
*/
$app->match('/obtain/brunch/takeaway', function (Request $request) use ($app,$dbh) {

  $delivery = array();
  $search = $dbh->prepare('SELECT rota FROM restaurante');
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $size=sizeof($rota);
  for($i=0;$i<$size;$i++)
  {
    $path=$rota[$i]['rota']."/obtain/brunch/takeaway";
    $data= file_get_contents($path);
    $data=json_decode($data);
    if(!isset($data->result))
    {
      $delivery[]=$data;
    }
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Restaurantes com brunch e takeaway");
  $delivery=json_encode($delivery);
  return $delivery;
})
->method('GET|POST');

/**
* \brief Restaurantes com pequeno almoco,e brunch
*
* Devolve todos os restaurantes pequeno almoco e brunch
*/
$app->match('/obtain/brunch/pequenoalmoco', function (Request $request) use ($app,$dbh) {

  $delivery = array();
  $search = $dbh->prepare('SELECT rota FROM restaurante');
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $size=sizeof($rota);
  for($i=0;$i<$size;$i++)
  {
    $path=$rota[$i]['rota']."/obtain/brunch/pequenoalmoco";
    $data= file_get_contents($path);
    $data=json_decode($data);
    if(!isset($data->result))
    {
      $delivery[]=$data;
    }
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Restaurantes com brunch e pequeno almoco");
  $delivery=json_encode($delivery);
  return $delivery;
})
->method('GET|POST');

/**
* \brief Restaurantes com takeaway,e pequeno almoco
*
* Devolve todos os restaurantes takeaway e pequeno almoco
*/
$app->match('/obtain/takeaway/pequenoalmoco', function (Request $request) use ($app,$dbh) {

  $delivery = array();
  $search = $dbh->prepare('SELECT rota FROM restaurante');
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $size=sizeof($rota);
  for($i=0;$i<$size;$i++)
  {
    $path=$rota[$i]['rota']."/obtain/takeaway/pequenoalmoco";
    $data= file_get_contents($path);
    $data=json_decode($data);
    if(!isset($data->result))
    {
      $delivery[]=$data;
    }
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Restaurantes com takeaway e pequeno almoco");
  $delivery=json_encode($delivery);
  return $delivery;
})
->method('GET|POST');

/**
* \brief Restaurantes com takeaway, pequeno almoco e brunch
*
* Devolve todos os restaurantes com pequeno almoco, takeaway e brunch
*/
$app->match('/obtain/brunch/takeaway/pequenoalmoco', function (Request $request) use ($app,$dbh) {

  $delivery = array();
  $search = $dbh->prepare('SELECT rota FROM restaurante');
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $size=sizeof($rota);
  for($i=0;$i<$size;$i++)
  {
    $path=$rota[$i]['rota']."/obtain/brunch/takeaway/pequenoalmoco";
    $data= file_get_contents($path);
    $data=json_decode($data);
    if(!isset($data->result))
    {
      $delivery[]=$data;
    }
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Restaurantes com brunch, pequeno almoco e takeaway");
  $delivery=json_encode($delivery);
  return $delivery;
})
->method('GET|POST');

/**
* \brief Restaurantes com takeaway
*
* Devolve todos os restaurantes com takeaway
*/
$app->match('/obtain/takeaway', function (Request $request) use ($app,$dbh) {

  $delivery = array();
  $search = $dbh->prepare('SELECT rota FROM restaurante');
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $size=sizeof($rota);
  for($i=0;$i<$size;$i++)
  {
    $path=$rota[$i]['rota']."/obtain/takeaway";
    $data= file_get_contents($path);
    $data=json_decode($data);
    if(!isset($data->result))
    {
      $delivery[]=$data;
    }
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Restaurantes com takeaway");
  $delivery=json_encode($delivery);
  return $delivery;
})
->method('GET|POST');




/**
* \brief Restaurantes com pequeno_almoco
*
* Devolve todos os restaurantes com pequeno_almoco
*/
$app->match('/obtain/pequenoalmoco', function (Request $request) use ($app,$dbh) {

  $delivery = array();
  $search = $dbh->prepare('SELECT rota FROM restaurante');
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $size=sizeof($rota);
  for($i=0;$i<$size;$i++)
  {
    $path=$rota[$i]['rota']."/obtain/pequenoalmoco";
    $data= file_get_contents($path);
    $data=json_decode($data);
    if(!isset($data->result))
    {
      $delivery[]=$data;
    }
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Restaurantes com pequeno almoco");
  $delivery=json_encode($delivery);
  return $delivery;
})
->method('GET|POST');


/**
* \brief Insere um utilizador
*
* Insere um novo utilizador, com um username, nome, email e password
*/
$app->match('/user', function (Request $request) use ($app, $dbh) {
  $data = json_decode($request->getContent(), true);
  $sth = $dbh->prepare('INSERT INTO dados (username, nome, email, password, telemovel) VALUES(:username,:nome,:email,:password, :telemovel)');
  $sth->execute($data);

  $response = new Response('Ok', 201);
  $log = Logger::getLogger('myLogger');
  $log->info("Utilizador criado");
  return $response;
})
// you can use get or post for this route
->method('GET|POST');


$app->match('/localidade/existe/{local}', function ($local) use ($app, $dbh) {

  /*$local=explode(" ",$local);
  $local=implode("+",$local);*/

  $log = Logger::getLogger('myLogger');
  /*$exist=file_get_contents('https://maps.googleapis.com/maps/api/place/textsearch/json?query='.$local.'&key=AIzaSyBnZKKdkv7F8dq6jPkNadBJdHVffNp5ip');//key pedro: AIzaSyCUurf3xzUF_u3-3HIVNOPkXQOebQPJHdQ key paulo:ativa
  $json=json_decode($exist);*/
  $ok="OK";
  $existe=file_get_contents('http://engprows.dev/obtain/nome/'.$local);
  $existe=json_decode($existe);
  if(!empty($existe)) {
    $response = new Response('not', 200);
    $log->info("Não é um restaurante");
    return $response;
  }
  $sth = $dbh->prepare('SELECT local , status FROM cache_local where local=:local AND status=:status');
  $sth->bindValue(":local", (string) $local , PDO::PARAM_STR);
  $sth->bindValue(":status", (string) $ok , PDO::PARAM_STR);
  $sth->execute();
  $localidade = $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($localidade))
  {
    $save=file_get_contents('https://maps.googleapis.com/maps/api/place/textsearch/json?query='.$local.'&key=AIzaSyBnZKKdkv7F8dq6jPkNadBJdHVffNp5ipk');//key pedro: AIzaSyCUurf3xzUF_u3-3HIVNOPkXQOebQPJHdQ key paulo:ativa
    $sth = $dbh->prepare('INSERT INTO cache_local (local,status) VALUES( :local, :status)');
    $sth->bindValue(":local", (string) $local , PDO::PARAM_STR);
    $sth->bindValue(":status", (string) $ok , PDO::PARAM_STR);
    $sth->execute();
    //$json=json_decode($exist);
    return new Response($save->status,201);//$json;
  }

  $response = new Response('Ok', 201);
  $log->info("API GOOGLE , local existe");
  return $response;

})
->method('GET|POST');




/**
* \brief Login
*
* Verifica o login de um utilizador
* curl -X POST -H "Content-Type: application/json" -d '{"username": "pedro", "password","no"}' -i http://engprows.dev/login
*/
$app->match('/login', function(Request $request) use ($app, $dbh) {
  $data = json_decode($request->getContent(), true);
  $log = Logger::getLogger('myLogger');
  $dono = json_decode($request->getContent(), true);
  $sth = $dbh->prepare('SELECT password FROM dados where username=:username');
  $sth->bindValue(":username", (string) $data['username'] , PDO::PARAM_STR);
  $sth->execute();
  $info= $sth->fetchAll(PDO::FETCH_ASSOC);
  if(empty($info)) {
    $response = new Response('Error', 404);
    return $response;
  }
  $username=$data['username'];
  $password=$data['password'];
  if(password_verify($password,$info[0]['password']))
  {
    $response = new Response('Ok', 201);
    $log->info("Login efetuado");
    return $response;
  }

  $response = new Response('erro- invalido', 404);
  $log->info("Login erro");
  return $response;

})
// you can use get or post for this route
->method('GET|POST');

//reserva em restaurante
$app->match('/reserva/add/{id}', function (Request $request,$id) use ($app, $dbh) {
  $user = $request->getContent();

  $search = $dbh->prepare('SELECT rota FROM restaurante WHERE id=:id');
  $search->bindValue(":id", (int) $id , PDO::PARAM_INT);
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $path=$rota[0]['rota']."/new/reserva";

  $curl=curl_init($path);
  curl_setopt($curl, CURLOPT_POST,1);
  curl_setopt($curl, CURLOPT_POSTFIELDS,$user);
  $signal=curl_exec($curl);

  $log = Logger::getLogger('myLogger');
  $log->info("Reserva efetuada com sucesso");
  $response = new Response('OK', 201);
  return $response;
})
// you can use get or post for this route
->method('GET|POST');


$app->match('obtain/user/reserva/username/{username}/{id}', function (Request $request,$username,$id) use ($app, $dbh) {
  $user = $request->getContent();
  $search = $dbh->prepare('SELECT rota FROM restaurante WHERE id=:id');
  $search->bindValue(":id", (int) $id , PDO::PARAM_INT);
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $path=$rota[0]['rota']."/obtain/reserva";

  $curl=curl_init($path);
  curl_setopt($curl, CURLOPT_POST,1);
  curl_setopt($curl, CURLOPT_POSTFIELDS,$user);
  $signal=curl_exec($curl);

  $log = Logger::getLogger('myLogger');
  $log->info("Reserva efetuada com sucesso");
  $response = new Response('OK', 201);
  return $response;
})
// you can use get or post for this route
->method('GET|POST');


$app->match('obtain/user/reserva/{nome}/{email}/{telemovel}', function (Request $request,$nome,$email,$telemovel) use ($app, $dbh) {

  $delivery=array();
  $search = $dbh->prepare('SELECT rota FROM restaurante');
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  for($i=0;$i<sizeof($rota);$i++)
  {
    $path=$rota[$i]['rota']."/obtain/reservas/email/telemovel/nome/".$email."/".$telemovel."/".$nome;
    $go=file_get_contents($path);
    $go=json_decode($go);
    if(!isset($res->result))
    {
      $delivery[]=$go;
    }
  }
  $delivery=json_encode($delivery);
  $log = Logger::getLogger('myLogger');
  $log->info("Reservas do utilizador pedidas");
  $response = new Response('OK', 201);
  return $delivery;
})
// you can use get or post for this route
->method('GET|POST');




/**
* \brief Editar Reserva
*
* Edita a reserva atraves do id
*/
$app->match('/reserva/edit/id/{id}/{rid}', function (Request $request,$id,$rid) use ($app, $dbh) {

  $user = $request->getContent();
  $search = $dbh->prepare('SELECT rota FROM restaurante WHERE id=:id');
  $search->bindValue(":id", (int) $rid , PDO::PARAM_INT);
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  if(empty($rota))
  {
    $response = new Response('erro', 201);
    $log = Logger::getLogger('myLogger');
    $log->info("Não encontrei restaurante");
    return $response;
  }
  $path=$rota[0]['rota']."/edit/reserva/id/".$id;

  $curl=curl_init($path);
  curl_setopt($curl, CURLOPT_CUSTOMREQUEST,'PUT');
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_POSTFIELDS,$user);
  $signal=curl_exec($curl);


  $response = new Response($signal, 201);
  $log = Logger::getLogger('myLogger');
  $log->info("Reserva efetuada com sucesso");
  return $response;
})
// you can use get or post for this route
->method('GET|POST');

$app->delete('/reserva/del/rid/{id}/{rid}', function($id,$rid) use ($app, $dbh) {
  $search = $dbh->prepare('SELECT rota FROM restaurante WHERE id=:rid');
  $search->bindValue(":rid", (int) $rid , PDO::PARAM_INT);
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  if(empty($rota))
  {
    $response = new Response('erro', 201);
    $log = Logger::getLogger('myLogger');
    $log->info("Não encontrei restaurante");
    return $response;
  }

  $path=$rota[0]['rota']."/del/reserva/".$id;

  $curl=curl_init($path);
  curl_setopt($curl, CURLOPT_CUSTOMREQUEST,'DELETE');
  curl_setopt($curl, CURLOPT_HEADER, false);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  $signal=curl_exec($curl);


  $response = new Response('Ok', 201);
  $log = Logger::getLogger('myLogger');
  $log->info("Reserva efetuada com sucesso");
  return $response;
});




//apage reserva com base no ID da rota e no nome da reserva
$app->match('/reserva/del/nome/{id}/{nome}', function (Request $request,$id,$nome) use ($app, $dbh) {
  $search = $dbh->prepare('SELECT rota FROM restaurante WHERE id=:id');
  $search->bindValue(":id", (int) $id , PDO::PARAM_INT);
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $path=$rota[$id]['rota']."/del/reserva/nome/".$nome;

  $curl=curl_init($path);
  //curl_setopt($curl, CURLOPT_POST,1);
  //curl_setopt($curl, CURLOPT_POSTFIELDS,$user);
  $signal=curl_exec($curl);


  $response = new Response('Ok', 201);
  $log = Logger::getLogger('myLogger');
  $log->info("Reserva efetuada com sucesso");
  return $response;
})
// you can use get or post for this route
->method('GET|POST');


$app->match('/reserva/del/email/{id}/{email}', function (Request $request,$id,$email) use ($app, $dbh) {
  //$user = json_decode($request->getContent(), true);

  $search = $dbh->prepare('SELECT rota FROM restaurante WHERE id=:id');
  $search->bindValue(":id", (int) $id , PDO::PARAM_INT);
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $path=$rota[$id]['rota']."/del/reserva/email/".$email;

  $curl=curl_init($path);
  //curl_setopt($curl, CURLOPT_POST,1);
  //curl_setopt($curl, CURLOPT_POSTFIELDS,$user);
  $signal=curl_exec($curl);


  $response = new Response('Ok', 201);
  $log = Logger::getLogger('myLogger');
  $log->info("Reserva efetuada com sucesso");
  return $response;
})
// you can use get or post for this route
->method('GET|POST');


$app->match('/reserva/del/telemovel/{id}/{telemovel}', function (Request $request,$id,$telemovel) use ($app, $dbh) {
  //$user = json_decode($request->getContent(), true);

  $search = $dbh->prepare('SELECT rota FROM restaurante WHERE id=:id');
  $search->bindValue(":id", (int) $id , PDO::PARAM_INT);
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $path=$rota[$id]['rota']."/del/reserva/telemovel/".$telemovel;

  $curl=curl_init($path);
  //curl_setopt($curl, CURLOPT_POST,1);
  //curl_setopt($curl, CURLOPT_POSTFIELDS,$user);
  $signal=curl_exec($curl);


  $response = new Response('Ok', 201);
  $log = Logger::getLogger('myLogger');
  $log->info("Reserva efetuada com sucesso");
  return $response;
})
// you can use get or post for this route
->method('GET|POST');



$app->match('/obtain/all', function (Request $request) use ($app, $dbh) {

  $search = $dbh->prepare('SELECT rota FROM restaurante');
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $size=sizeof($rota);
  for($i=0;$i<$size;$i++)
  {
    $path=$rota[$i]['rota']."/obtain/id";
    $data= file_get_contents($path);
    $data=json_decode($data);
    if(!isset($data->result))
    {
      $delivery[]=$data;
    }
  }
  $log = Logger::getLogger('myLogger');
  $log->info("todos os resturantes");
  $delivery=json_encode($delivery);
  return $delivery;
})
->method('GET|POST');

$app->match('/obtain/user/username/{user}', function (Request $request,$user) use ($app, $dbh) {

  $search = $dbh->prepare('SELECT nome,email,telemovel FROM dados WHERE username=:user');
  $search->bindValue(":user", (string) $user , PDO::PARAM_STR);
  $search->execute();
  $user = $search->fetchAll(PDO::FETCH_ASSOC);
  if(empty($user))
  {
    $response = new Response('null', 201);
    $log = Logger::getLogger('myLogger');
    $log->info("sem utilizadores");
    return $response;
  }
  $user=json_encode($user);
  $log = Logger::getLogger('myLogger');
  $log->info("Dados de utilizador: ".$user);
  return $user;
})
// you can use get or post for this route
->value("id", 1) //set a default value
->assert('id', '\d+') // verify that id is a digit
->method('GET|POST');




// SELECT
// e.g., curl -X GET -i http://engprows.dev/obtain/id/1 OR curl -X POST -i http://engprows.dev/obtain/id/1
/**
* \brief Obtem o id de um utilizador
*
* Obtem o id de um utilizador com base no id inserido
*/
$app->match('/obtain/id/{id}', function (Request $request,$id) use ($app, $dbh) {

  $search = $dbh->prepare('SELECT rota FROM restaurante WHERE id=:id');
  $search->bindValue(":id", (int) $id , PDO::PARAM_INT);
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $path=$rota[0]['rota']."/obtain/id";

  $data= file_get_contents($path);

  $log = Logger::getLogger('myLogger');
  $log->info("Obtido restaurante: ".$id);

  return $data;
})
// you can use get or post for this route
->value("id", 1) //set a default value
->assert('id', '\d+') // verify that id is a digit
->method('GET|POST');


/**
* \brief Obtem o restaurante
*
* Obtem o restaurante com base no nome
*/
$app->match('/obtain/nome/{nome}', function (Request $request,$nome) use ($app,$dbh) {

  $delivery = array();
  $search = $dbh->prepare('SELECT rota FROM restaurante');

  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $size=sizeof($rota);

  for($i=0;$i<$size;$i++)
  {
    $path=$rota[$i]['rota']."/obtain/nome/".$nome;

    $data= file_get_contents($path);
    $data=json_decode($data);
    if(!isset($data->result))
    {
      $delivery[]=$data;
    }
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Restaurantes com nome: ".$nome);
  $delivery=json_encode($delivery);
  return $delivery;
  //return $app->json(array("result"=>"sem resultados"));
  //return new Response(" Não existe restaurantes com - $nome nome", 404);

})
->method('GET|POST');

/**
* \brief Restaurantes com uma determinada localidade
*
* Devolve restaurantes com uma determinada localidade
*/
$app->get('/obtain/localidade/{localidade}', function (Request $request, $localidade) use ($app,$dbh) {

  $delivery = array();
  $search = $dbh->prepare('SELECT rota FROM restaurante');
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $size=sizeof($rota);
  for($i=0;$i<$size;$i++)
  {
    $path=$rota[$i]['rota']."/obtain/localidade/".$localidade;
    $data= file_get_contents($path);
    $data=json_decode($data);
    if(!isset($data->result))
    {
      $delivery[]=$data;
    }
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Restaurantes com localidade: ".$localidade);
  $delivery=json_encode($delivery);
  return $delivery;

})
->method('GET|POST');


//obtem restaurante com takeaway
$app->match('/obtain/takeaway/local/{localidade}', function (Request $request,$localidade) use ($app, $dbh) {

  $delivery = array();
  $search = $dbh->prepare('SELECT rota FROM restaurante');
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $size=sizeof($rota);
  for($i=0;$i<$size;$i++)
  {
    $path=$rota[$i]['rota']."/obtain/takeaway/local/".$localidade;
    $data= file_get_contents($path);
    $data=json_decode($data);
    if(!isset($data->result))
    {
      $delivery[]=$data;
    }
  }
  //return $app->json(array("result"=>"sem resultados"));
  $delivery=json_encode($delivery);
  return $delivery;


})
->method('GET|POST');


/**
* \brief Restaurantes aleatorios
*
* Gera e selecciona restaurantes aleatorios
*/
$app->post("/obtain/restraunte/random", function (Request $request) use ($app,$dbh) {

  $search = $dbh->prepare('SELECT rota FROM restaurante');
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $size=sizeof($rota);
  $r=rand(0,$size-1);
  $path=$rota[$r]['rota']."/obtain/id";
  $data= file_get_contents($path);
  $data=json_decode($data);
  while(empty($data))
  {
    $r=rand(0,$size-1);
    $path=$rota[$r]['rota']."/obtain/id";
    $data= file_get_contents($path);
    $data=json_decode($data);
  }
  $delivery[]=$data;
  $delivery=json_encode($delivery);
  return $delivery;
})
->method('GET|POST');


/**
* \brief Restaurantes com rating maior
*
* Devolve o restaurante com o maior rating
*/
$app->get('/obtain/toprating', function (Request $request) use ($app,$dbh) {

  $delivery="";
  $top=0;
  $search = $dbh->prepare('SELECT rota FROM restaurante');
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $size=sizeof($rota);
  for($i=0;$i<$size;$i++)
  {
    $path=$rota[$i]['rota']."/obtain/id";
    $data= file_get_contents($path);
    $data=json_decode($data);
    if(isset($data[0]->rating))
    {
      if($data[0]->rating > $top)
      {
          $top=$data[0]->rating;
          $delivery=$data;
      }
    }
  }
  $delivery=json_encode($delivery);
  return $delivery;
})
->method('GET|POST');

/**
* \brief Obtem o restaurante
*
* Obtem o restaurante com base na morada
*/

$app->get('/obtain/morada/{morada}', function (Request $request, $morada) use ($app,$dbh) {

  $delivery = array();
  $search = $dbh->prepare('SELECT rota FROM restaurante');
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $size=sizeof($rota);
  $morada=explode(" ",$morada);
  $morada=implode("+",$morada);
  for($i=0;$i<$size;$i++)
  {
    $path=$rota[$i]['rota']."/obtain/morada/".$morada;
    $data= file_get_contents($path);
    $data=json_decode($data);
    if(!isset($data->result))
    {
      $delivery[]=$data;
    }
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Restaurantes com morada: ".$morada);
  $delivery=json_encode($delivery);
  return $delivery;

})
->method('GET|POST');

/**
* \brief Obtem o restaurante
*
* Obtem o ementa de todos os restaurantes
*/

$app->get('/obtain/ementa', function (Request $request) use ($app,$dbh) {

  $delivery = array();
  $search = $dbh->prepare('SELECT rota FROM restaurante');
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $size=sizeof($rota);
  for($i=0;$i<$size;$i++)
  {
    $path=$rota[$i]['rota']."/obtain/ementa";
    $data= file_get_contents($path);
    $data=json_decode($data);
    if(!isset($data->result))
    {
      $delivery[]=$data;
    }
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Ementa de restaurantes pedida");
  $delivery=json_encode($delivery);
  return $delivery;

})
->method('GET|POST');

/**
* \brief Obtem o restaurante
*
* Obtem o horario de todos os restaurantes
*/

$app->get('/obtain/horario', function (Request $request) use ($app,$dbh) {

  $delivery = array();
  $search = $dbh->prepare('SELECT rota FROM restaurante');
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $size=sizeof($rota);
  for($i=0;$i<$size;$i++)
  {
    $path=$rota[$i]['rota']."/obtain/horario";
    $data= file_get_contents($path);
    $data=json_decode($data);
    if(!isset($data->result))
    {
      $delivery[]=$data;
    }
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Ementa de restaurantes pedida");
  $delivery=json_encode($delivery);
  return $delivery;

})
->method('GET|POST');



/**
* \brief Obtem o restaurante
*
* Obtem o metodo de pagamento de todos os restaurantes
*/
$app->get('/obtain/pagamento', function (Request $request) use ($app,$dbh) {

  $delivery = array();
  $search = $dbh->prepare('SELECT rota FROM restaurante');
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $size=sizeof($rota);
  for($i=0;$i<$size;$i++)
  {
    $path=$rota[$i]['rota']."/obtain/pagamento";
    $data= file_get_contents($path);
    $data=json_decode($data);
    if(!isset($data->result))
    {
      $delivery[]=$data;
    }
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Ementa de restaurantes pedida");
  $delivery=json_encode($delivery);
  return $delivery;

})
->method('GET|POST');


/**
* \brief Obtem o restaurante
*
* Obtem ementa do restaurante com base no nome
*/
$app->get('/obtain/ementa/nome/{nome}', function (Request $request, $nome) use ($app,$dbh) {

  $delivery = array();
  $search = $dbh->prepare('SELECT rota FROM restaurante');
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $size=sizeof($rota);
  for($i=0;$i<$size;$i++)
  {
    $path=$rota[$i]['rota']."/obtain/nome/".$nome;
    $data= file_get_contents($path);
    $data=json_decode($data);
    if(!isset($data->result))
    {
      $pathementa=$rota[$i]['rota']."/obtain/ementa";
      $data= file_get_contents($pathementa);
      $data=json_decode($data);
      $delivery[]=$data;
    }
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Ementa de restaurantes pedida");
  $delivery=json_encode($delivery);
  return $delivery;

})
->method('GET|POST');

/**
* \brief Obtem o restaurante
*
* Obtem horario do restaurante com base no nome
*/
$app->get('/obtain/horario/nome/{nome}', function (Request $request, $nome) use ($app,$dbh) {

  $delivery = array();
  $search = $dbh->prepare('SELECT rota FROM restaurante');
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $size=sizeof($rota);
  for($i=0;$i<$size;$i++)
  {
    $path=$rota[$i]['rota']."/obtain/nome/".$nome;
    $data= file_get_contents($path);
    $data=json_decode($data);
    if(!isset($data->result))
    {
      $pathementa=$rota[$i]['rota']."/obtain/horario";
      $data= file_get_contents($pathementa);
      $data=json_decode($data);
      $delivery[]=$data;
    }
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Ementa de restaurantes pedida");
  $delivery=json_encode($delivery);
  return $delivery;

})
->method('GET|POST');

/**
* \brief Obtem o restaurante
*
* Obtem metodo do pagamento do restaurante com base no nome
*/
$app->get('/obtain/pagamento/nome/{nome}', function (Request $request, $nome) use ($app,$dbh) {

  $delivery = array();
  $search = $dbh->prepare('SELECT rota FROM restaurante');
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $size=sizeof($rota);
  for($i=0;$i<$size;$i++)
  {
    $path=$rota[$i]['rota']."/obtain/nome/".$nome;
    $data= file_get_contents($path);
    $data=json_decode($data);
    if(!isset($data->result))
    {
      $pathementa=$rota[$i]['rota']."/obtain/pagamento";
      $data= file_get_contents($pathementa);
      $data=json_decode($data);
      $delivery[]=$data;
    }
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Ementa de restaurantes pedida");
  $delivery=json_encode($delivery);
  return $delivery;

})
->method('GET|POST');




/**
* \brief Restaurantes com um certo tipo de comida
*
* Devolve restaurantes com um certo tipo de comida
*/
$app->match('/obtain/tipocomida/{tipocomida}', function (Request $request,$tipocomida) use ($app,$dbh) {

  $delivery = array();
  $search = $dbh->prepare('SELECT rota FROM restaurante');
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $size=sizeof($rota);
  for($i=0;$i<$size;$i++)
  {
    $path=$rota[$i]['rota']."/obtain/tipocomida/".$tipocomida;
    $data= file_get_contents($path);
    $data=json_decode($data);
    if(!isset($data->result))
    {
      $delivery[]=$data;
    }
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Restaurantes com tipo de comida: ".$tipocomida);
  $delivery=json_encode($delivery);
  return $delivery;

})
->method('GET|POST');

/**
* \brief Restaurantes que sao um ponto de interesse
*
* Devolve restaurantes que sao um ponto de interesse
*/
$app->match('/obtain/pontointeresse/{ponto_interesse}', function (Request $request,$ponto_interesse) use ($app) {
  $delivery = array();
  $search = $dbh->prepare('SELECT rota FROM restaurante');
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $size=sizeof($rota);
  for($i=0;$i<$size;$i++)
  {
    $path=$rota[$i]['rota']."/obtain/pontointeresse/".$ponto_interesse;
    $data= file_get_contents($path);
    $data=json_decode($data);
    if(!isset($data->result))
    {
      $delivery[]=$data;
    }
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Restaurantes que sao ponto de interesse");
  $delivery=json_encode($delivery);
  return $delivery;
})
->method('GET|POST');

/**
* \brief Restaurantes com um determinado preco medio
*
* Devolve restaurantes com um determinado preco medio
*/
$app->match('/obtain/preco_medio/{preco_medio}', function (Request $request,$preco_medio) use ($app) {

  $delivery = array();
  $search = $dbh->prepare('SELECT rota FROM restaurante');
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $size=sizeof($rota);
  for($i=0;$i<$size;$i++)
  {
    $path=$rota[$i]['rota']."/obtain/preco_medio/".$preco_medio;
    $data= file_get_contents($path);
    $data=json_decode($data);
    if(!isset($data->result))
    {
      $delivery[]=$data;
    }
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Restaurantes com um preco medio de: ".$preco_medio);
  $delivery=json_encode($delivery);
  return $delivery;
})
->method('GET|POST');

/**
* \brief Restaurantes com um determinado tipo
*
* Devolve restaurantes com um determinado tipo
*/
$app->match('/obtain/tipo/{tipo}', function (Request $request,$tipo) use ($app) {
  $delivery = array();
  $search = $dbh->prepare('SELECT rota FROM restaurante');
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $size=sizeof($rota);
  for($i=0;$i<$size;$i++)
  {
    $path=$rota[$i]['rota']."/obtain/tipo/".$tipo;
    $data= file_get_contents($path);
    $data=json_decode($data);
    if(!isset($data->result))
    {
      $delivery[]=$data;
    }
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Restaurantes do tipo: ".$tipo);
  $delivery=json_encode($delivery);
  return $delivery;
})
->method('GET|POST');

/**
* \brief verifica se um restaurante esta aberto
*
* Devolve se o restaurante esta aberto
*/
$app->match('obtain/isopen', function (Request $request) use ($app, $dbh) {
  $delivery = array();
  $search = $dbh->prepare('SELECT rota FROM restaurante');
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $size=sizeof($rota);
  for($i=0;$i<$size;$i++)
  {
    $path=$rota[$i]['rota']."/obtain/isopen";
    $data= file_get_contents($path);
    $data=json_decode($data);
    if(!isset($data->result))
    {
      $delivery[]=$data;
    }
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Verificar se o restaurante está aberto ws2");
  $delivery=json_encode($delivery);
  return $delivery;
})
->method('GET|POST');

/**
* \brief Envio de newsletter
*
* Envia newsletter a todos os utilizadores
*/
$app->match('/newsletter',function (Request $request) use ($app) {
  $log = Logger::getLogger('myLogger');
  $log->info("Envio de newsletter");
  return $data= file_get_contents("http://engpro.dev/newsletter");


})
->method('GET|POST');

/**
* \brief Informação de contacto
*
* Devolve a informação de contacto
*/
$app->match('/obtain/contacto/{id}', function (Request $request,$id) use ($app) {
  $log = Logger::getLogger('myLogger');
  $log->info("Devolve a informação de contacto");
  return $data= file_get_contents("http://engpro.dev/contacto/".$id);


})
->method('GET|POST');

/**
* \brief Rating de restaurante
*
* Devolve o rating de um restaurante
*/
$app->match('/obtain/rating/{id}', function (Request $request ,$id) use ($app) {
  $log = Logger::getLogger('myLogger');
  $log->info("Rating de um determinado restaurante");
  return $data= file_get_contents("http://engpro.dev/rating/".$id);


})
->method('GET|POST');

/**
* \brief Procura por tag
*
* Devolve o resultado da procura de restaurentes por uma tag igual ou semelhante
*/
$app->match('/obtain/tags/{tags}', function (Request $request , $tags) use ($app) {
  $delivery = array();
  $search = $dbh->prepare('SELECT rota FROM restaurante');
  $search->execute();
  $rota = $search->fetchAll(PDO::FETCH_ASSOC);
  $size=sizeof($rota);
  for($i=0;$i<$size;$i++)
  {
    $path=$rota[$i]['rota']."/obtain/tags/".$tags;
    $data= file_get_contents($path);
    $data=json_decode($data);
    if(!isset($data->result))
    {
      $delivery[]=$data;
    }
  }
  $log = Logger::getLogger('myLogger');
  $log->info("Restaurante com a tag: ".$tags);
  $delivery=json_encode($delivery);
  return $delivery;

})
->method('GET|POST');



// enable debug mode - optional this could be commented
$app['debug'] = true;
// execute the app
$app->run();
