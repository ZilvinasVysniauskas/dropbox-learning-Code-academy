<?php


include __DIR__ . '/../includes/autoload.php';
include __DIR__ . '/../includes/DatabaseConnection.php';


$imgTable = new \Common\DatabaseTable($pdo, 'userImages', 'id');
$foldersTable = new \Common\DatabaseTable($pdo, 'folders', 'id');
$photoController = new \Dropbox\Controllers\PhotoController($imgTable, $foldersTable);



if (!empty($_POST['arrToDelete'])){
    $imgTable->deleteFromDbMultiple($_POST['arrToDelete']);
    foreach ($_POST['arrToDelete'] as $photoId){
        unlink('uploads/' . $photoId . '.jpg');
    }
}
if (!empty($_FILES['files']['name'])){
    $photoController->loadImageDataToDb($_FILES);
}
if (!empty($_POST['folderName'])){
    $photoController->addFolderIntoDb($_POST);
}
if (!empty($_POST['placeInFolder'])){
    foreach ($_POST['placeInFolder'] as $img){
        $data = [
            'set' => [
                'folderId' => $_POST['folder'],
            ],
            'conditions' => [
                'id' => $img
            ]
        ];
        $imgTable->updateValuesInDb($data);
    }
}