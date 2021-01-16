<?php

require_once ("Query/Table.php");

$user = new Table('osama');

$result = $user->select(['fname','lname','phone'])->get();


print_r($result);














