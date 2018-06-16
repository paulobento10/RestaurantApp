<?php

if(!isset($_GET['id']))
{
  header('location: profile.php');
}

if(!isset($_GET['rid']))
{
  header('location: profile.php');
}
$id_reserva=$_GET['id'];
$rid_restaurante=$_GET['rid'];

$curl = curl_init("http://engprows.dev/reserva/del/rid/".$id_reserva."/".$rid_restaurante);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST,'DELETE');
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);
header('location: profile.php');


?>
