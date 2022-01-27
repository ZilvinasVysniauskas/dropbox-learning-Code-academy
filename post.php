<?php
$strJsonFileContents = file_get_contents("js/data.json");
$array = json_decode($strJsonFileContents, true);

foreach ($_FILES['file']['name'] as $key => $value){
    echo $_FILES['file']['name'][$key];
    echo $_FILES['file']['tmp_name'][$key];
    echo $_FILES['file']['size'][$key];
    $name = (uniqid('', true) . '.jpg');
    $nameId = str_replace('.', '', $name);
    $array[$nameId] = [
        'imgId' => $nameId,
        'imgPath' => 'pictures/' . $name,
        'imgSize' => ($_FILES['file']['size'][$key]),
        'imgName' => $_FILES['file']['name'][$key]
    ];
    imagejpeg(imagecreatefromstring(file_get_contents($_FILES['file']['tmp_name'][$key])), 'pictures/' . $name);
}
$encodedJson = json_encode($array);
$file = 'js/data.json';
file_put_contents($file, $encodedJson);
//header('location: http://localhost:8000/');

