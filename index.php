<?php

require_once("QueryBuilder/Table.php");
require_once("AdvancedDatabase/Database.php");
require_once("AdvancedDatabase/FileFactory.php");


$user = new Table('users');


$result = $user->chunk(2, function ($result) {
	echo "<pre>";
	var_dump($result);
	echo "</pre>";
});

//echo "<pre>";
//var_dump($result);
//echo "</pre>";

$result = $user->select()->get('object');


$file = new FileFactory();

$csv_file = $file->create_file(new FileItem('csv'));

$csv_file->import("AdvancedDatabase/export (1).csv",'table');







