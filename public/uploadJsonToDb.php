<?php
//include __DIR__ . '/../includes/DatabaseConnection.php';
//include __DIR__ . '/../includes/autoload.php';
//$usersTable = new \Common\DatabaseTable($pdo, 'usersTable', 'id');
//$companyTable = new \Common\DatabaseTable($pdo, 'companyTable', 'id');
//$geoTable = new \Common\DatabaseTable($pdo, 'geoTable', 'id');
//$addressTable = new \Common\DatabaseTable($pdo, 'addressTable', 'id');
//$json = file_get_contents('https://jsonplaceholder.typicode.com/users');
//$data = json_decode($json, true);
//
//
//foreach ($data as $user){
//    $addressId = uniqid('', true);
//    $companyId = uniqid('', true);
//    $geoId = uniqid('', true);
//    $data = [
//        'name' => $user['name'],
//        'username' => $user['username'],
//        'email' => $user['email'],
//        'phone' => $user['phone'],
//        'website' => $user['website'],
//        'addressId' => $addressId,
//        'companyId' => $companyId
//    ];
//    $usersTable->insertIntoDb($data);
//    $data = [
//        'id' => $addressId,
//        'street' => $user['address']['street'],
//        'suite' => $user['address']['suite'],
//        'city' => $user['address']['city'],
//        'zipcode' => $user['address']['zipcode'],
//        'geoId' => $geoId
//    ];
//    $addressTable->insertIntoDb($data);
//    $data = [
//        'id' => $geoId,
//        'lat' => $user['address']['geo']['lat'],
//        'lng' => $user['address']['geo']['lng']
//    ];
//    $geoTable->insertIntoDb($data);
//
//    $data = [
//        'id' => $companyId,
//        'name' => $user['company']['name'],
//        'catch' => $user['company']['catchPhrase'],
//        'bs' => $user['company']['bs']
//    ];
//    $companyTable->insertIntoDb($data);
//}
//
