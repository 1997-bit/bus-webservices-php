<?php


require_once __DIR__ . '/BusService.php';

$server = new SoapServer(null, ['uri' => 'urn:BusWebServices']);
$server->setClass('BusService');
$server->handle();
