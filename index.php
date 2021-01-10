<?php

require_once ("Query/Table.php");

$users = new Table('users');

$result = $users->select(['name','email']);

print_r($result);














