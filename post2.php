<?php
$strJsonFileContents = file_get_contents("js/data.json");
$arrayJson = json_decode($strJsonFileContents, true);
var_dump($arrayJson);
foreach ($_POST['arrToDelete'] as $photoId){
    unset($arrayJson[$photoId]);
}

$encodedJson = json_encode($arrayJson);
$file = 'js/data.json';
file_put_contents($file, $encodedJson);
