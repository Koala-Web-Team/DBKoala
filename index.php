<?php


require_once("Connection/ConnectionFactory.php");


$db = new ConnectionFactory();

$connect = $db->setConnection('mysql');

$con = $connect->createConnection(['db' => 'atms']);

$statement = $con->prepare('SELECT name from users');

$statement->execute();

$result = $statement->fetchAll();













