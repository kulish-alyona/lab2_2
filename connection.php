<?php
require_once __DIR__ ."/vendor/autoload.php";
$client = (new MongoDB\Client)->db->client;
$seance = (new MongoDB\Client)->db->seance;
?>