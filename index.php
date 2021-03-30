<?php

require_once("QueryBuilder/Table.php");
require_once("AdvancedDatabase/Database.php");

$user = new Table('users');

$result = $user->select()->get('object');

$backup = new Database();

$backup = $backup->backup();

print_r($backup);





















