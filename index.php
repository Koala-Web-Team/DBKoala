<?php

require_once("QueryBuilder/Table.php");

$user = new Table('users');

$result = $user->find('1');
	//	$result = $user->selectRaw('count(*) as user_count, name');
	//	$result=$user->raw(' count(*) as dept_total');
print_r($result->first_name);














