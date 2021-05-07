<?php

require_once("QueryBuilder/Table.php");
require_once("AdvancedDatabase/Database.php");
require_once("AdvancedDatabase/FileFactory.php");


$user = new Table('users');

$result = $user->find(1);

print_r($result);


//$file = new FileFactory();
//
//$csv_file = $file->create_file(new FileItem('csv'));
//
//$csv_file->export('table');






















