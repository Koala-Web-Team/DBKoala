<?php

require_once("QueryBuilder/Table.php");

$user = new Table('users');

$result = $user->find('1');

print_r($result->first_name);














