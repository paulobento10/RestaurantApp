<?php

$curl = curl_init("http://engpro.dev/del/pagamento");
curl_setopt($curl, CURLOPT_CUSTOMREQUEST,'DELETE');
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);
header('location: restaurante_hub.php');

?>
