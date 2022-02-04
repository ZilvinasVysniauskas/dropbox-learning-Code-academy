<?php
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/autoload.php';
$usersTable = new \Common\DatabaseTable($pdo, 'usersTable', 'id');
$companyTable = new \Common\DatabaseTable($pdo, 'companyTable', 'id');
$geoTable = new \Common\DatabaseTable($pdo, 'geoTable', 'id');
$addressTable = new \Common\DatabaseTable($pdo, 'addressTable', 'id');
$json = file_get_contents('https://jsonplaceholder.typicode.com/users');
$data = json_decode($json, true);

if ($_POST['backendAction'] === 'updateUserValues'){
    $data = [
        'set' => [
            'name' => $_POST['name'],
            'username' => $_POST['username'],
            'email' => $_POST['email']
        ],
        'conditions' => [
            'id' => $_POST['id']
        ]
    ];
    $usersTable->updateValuesInDb($data);
}
if ($_POST['backendAction'] === 'deleteRowsById'){
    $geoTableId = $addressTable->findById($_POST['addressTableId'])[0]['geoId'];
    $usersTable->deleteFromDb($_POST['userTableId']);
    $companyTable->deleteFromDb($_POST['companyTableId']);
    $addressTable->deleteFromDb($_POST['addressTableId']);
    $geoTable->deleteFromDb($geoTableId);
}
if ($_POST['backendAction'] === 'addUser'){
    $addressId = uniqid('', true);
    $companyId = uniqid('', true);
    $geoId = uniqid('', true);
    $data = [
        'name' => $_POST['name'],
        'username' => $_POST['username'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'website' => $_POST['website'],
        'addressId' => $addressId,
        'companyId' => $companyId
    ];
    $usersTable->insertIntoDb($data);
    $data = [
        'id' => $addressId,
        'street' => $_POST['addressStreet'],
        'suite' => $_POST['addressSuite'],
        'city' => $_POST['addressCity'],
        'zipcode' => $_POST['addressZipcode'],
        'geoId' => $geoId
    ];
    $addressTable->insertIntoDb($data);
    $data = [
        'id' => $geoId,
        'lat' => $_POST['addressGeoLat'],
        'lng' => $_POST['addressGeoLng']
    ];
    $geoTable->insertIntoDb($data);

    $data = [
        'id' => $companyId,
        'name' => $_POST['companyName'],
        'catch' => $_POST['companyCatch'],
        'bs' => $_POST['companyBs']
    ];
    $companyTable->insertIntoDb($data);
}