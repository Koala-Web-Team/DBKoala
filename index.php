<?php

require_once("QueryBuilder/Table.php");
require_once("AdvancedDatabase/Database.php");
require_once("AdvancedDatabase/FileFactory.php");



$users = new Table('users');

$count = 1;

$result = $users->chunk(2, function ($result) use ($count){
    echo "<pre>";
    var_dump($result);
    $count++;
    echo "</pre>";
});


echo $count;





