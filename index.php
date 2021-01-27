<?php

require_once("QueryBuilder/Table.php");

$user = new Table('users');

$result = $user->chunk(2, function ($result) {
	echo "<pre>";
	var_dump($result);
	echo "</pre>";
});

//echo "<pre>";
//var_dump($result);
//echo "</pre>";











