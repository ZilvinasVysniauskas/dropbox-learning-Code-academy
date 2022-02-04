<?php
include __DIR__ . '/../includes/autoload.php';
include __DIR__ . '/../includes/DatabaseConnection.php';

$imgTable = new \Common\DatabaseTable($pdo, 'userImages', 'id');
$foldersTable = new \Common\DatabaseTable($pdo, 'folders', 'id');
$photoController = new \Dropbox\Controllers\PhotoController($imgTable, $foldersTable);

if (!empty($_POST['loadImages'])){
    $photoController->imageDataFromDbToJson($_POST['loadImages']);
}
if (!empty($_POST['loadFoldersBy'])){
    if ($_POST['action'] === 'all'){
        $photoController->folderDataFromDbToJson();
    }
    else {
        $photoController->folderDataFromDbToJson($_POST['loadFoldersBy'], $_POST['action']);
    }

}
