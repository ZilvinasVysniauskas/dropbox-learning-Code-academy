<?php

$pdo = new PDO('mysql:host=localhost;dbname=dropbox;charset=utf8', 'root', 'root');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
