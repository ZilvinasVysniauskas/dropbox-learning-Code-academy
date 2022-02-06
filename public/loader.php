<?php
include __DIR__ . '/../includes/autoload.php';
include __DIR__ . '/../includes/DatabaseConnection.php';
session_start();
$imgTable = new \Common\DatabaseTable($pdo, 'userImages', 'id');
$photoController = new \Dropbox\Controllers\PhotoController($imgTable);

if (!empty($_POST['loadImages'])){
    $photoController->imageDataFromDbToJson($_POST['loadImages']);
}
