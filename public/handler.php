<?php
include __DIR__ . '/../includes/autoload.php';
include __DIR__ . '/../includes/DatabaseConnection.php';
session_start();

$imgTable = new \Common\DatabaseTable($pdo, 'userImages', 'id');
$photoController = new \Dropbox\Controllers\PhotoController($imgTable);


if (!empty($_POST['arrToDelete'])){
    $imgTable->deleteFromDbMultiple($_POST['arrToDelete']);
    foreach ($_POST['arrToDelete'] as $photoId){
        echo $photoId;
        unlink($_POST['currentLocation'] . $photoId);
    }
}
if (!empty($_FILES['files']['name'])){
    $photoController->loadImageDataToDb($_FILES, $_POST['location']);
}
if (!empty($_POST['folderName'])){
    $photoController->addFolder($_POST['folderName'], $_POST['folderLocation']);
}
if (!empty($_POST['placeInFolder'])){
    foreach ($_POST['placeInFolder'] as $img){
        rename($_POST['currentLocation'] . '/' . $img, $_POST['folder'] . '/' . $img);
    }
}