<?php
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/autoload.php';
$usersTable = new \Common\DatabaseTable($pdo, 'usersTable', 'id');
$companyTable = new \Common\DatabaseTable($pdo, 'companyTable', 'id');
$geoTable = new \Common\DatabaseTable($pdo, 'geoTable', 'id');
$addressTable = new \Common\DatabaseTable($pdo, 'addressTable', 'id');
$json = file_get_contents('https://jsonplaceholder.typicode.com/users');
$data = json_decode($json, true);

if ($_POST['loadData'] === 'all'){
    $result = $usersTable->selectDataFromDb();

    echo json_encode($result);
}
if ($_POST['loadData'] === 'allTablesOneUser'){
    $sql = 'select u.name, u.username, u.email, u.phone, u.website, a.suite, a.street, a.city, a.zipcode, c.catch, c.bs, c.name as companyName, g.lat, g.lng
from usersTable as u
inner join addressTable as a on u.addressId = a.id
inner join companyTable as c on u.companyId = c.id
inner join geoTable as g on a.geoId = g.id
where u.id =' . $_POST['id'];
    $query = $pdo->prepare($sql);
    $query->execute();
    echo json_encode($query->fetchAll()[0]);
}
