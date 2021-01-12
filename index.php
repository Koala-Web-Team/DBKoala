<?php

require_once ("Query/Table.php");

$users = new Table('users');

$result = $users->select(['email'])->where(['name' => 'mohamed osama','department_id' => 1])->get();

print_r($result);














